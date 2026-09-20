<?php
// admin/manage_blog.php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include '../assets/php/db_connect.php';

// ── Ensure SEO columns exist (safe to run every time) ─────────────────────
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS slug VARCHAR(255) DEFAULT ''");
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS excerpt TEXT DEFAULT NULL");
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS meta_title VARCHAR(255) DEFAULT NULL");
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS meta_description VARCHAR(320) DEFAULT NULL");
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS tags VARCHAR(255) DEFAULT NULL");
$conn->query("ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS status ENUM('published','draft') DEFAULT 'published'");

// ── Helpers ────────────────────────────────────────────────────────────────
function make_slug(string $str): string {
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
    $str = preg_replace('/[\s-]+/', '-', $str);
    return trim($str, '-');
}

// ── Load post for editing ─────────────────────────────────────────────────
$post = null;
$mode = 'new';
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id=?");
    $stmt->bind_param("i", $id); $stmt->execute();
    $post = $stmt->get_result()->fetch_assoc();
    if ($post) $mode = 'edit';
}

$flash = '';
$flash_type = 'success';

// ── Handle save ───────────────────────────────────────────────────────────
if (isset($_POST['save_blog'])) {
    $title       = trim($_POST['title'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $content     = trim($_POST['content'] ?? '');
    $excerpt     = trim($_POST['excerpt'] ?? '');
    $tags        = trim($_POST['tags'] ?? '');
    $status      = $_POST['status'] === 'draft' ? 'draft' : 'published';
    $meta_title  = trim($_POST['meta_title'] ?? '') ?: $title;
    $meta_desc   = trim($_POST['meta_description'] ?? '');
    $edit_id     = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

    // Auto-generate slug from title; keep existing for edits unless blank
    $raw_slug = trim($_POST['slug'] ?? '');
    $slug = $raw_slug ? make_slug($raw_slug) : make_slug($title);

    // Ensure slug uniqueness
    $check = $conn->prepare("SELECT id FROM blog_posts WHERE slug=? AND id!=?");
    $check->bind_param("si", $slug, $edit_id); $check->execute();
    if ($check->get_result()->num_rows > 0) {
        $slug = $slug . '-' . time();
    }

    // Auto-generate excerpt from content if blank
    if (empty($excerpt)) {
        $excerpt = substr(strip_tags($content), 0, 160) . '…';
    }
    // Auto-generate meta description from excerpt if blank
    if (empty($meta_desc)) {
        $meta_desc = substr(strip_tags($excerpt), 0, 160);
    }

    // Main image upload
    $db_image = $_POST['current_image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if (in_array($ext, $allowed)) {
            $filename = time() . '_' . make_slug(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME)) . '.' . $ext;
            $target = "../assets/uploads/$filename";
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
                $db_image = "assets/uploads/$filename";
        }
    }

    // Gallery upload
    $gallery_json = $_POST['current_gallery'] ?? '[]';
    if (!empty($_FILES['gallery']['name'][0])) {
        $existing = json_decode($gallery_json, true) ?: [];
        foreach ($_FILES['gallery']['name'] as $k => $name) {
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','webp','gif'];
            if (!in_array($ext, $allowed)) continue;
            $fn = time() . '_' . $k . '_' . make_slug(pathinfo($name, PATHINFO_FILENAME)) . '.' . $ext;
            if (move_uploaded_file($_FILES['gallery']['tmp_name'][$k], "../assets/uploads/$fn"))
                $existing[] = "assets/uploads/$fn";
        }
        $gallery_json = json_encode($existing);
    }

    if ($edit_id) {
        $s = $conn->prepare("UPDATE blog_posts SET title=?,category=?,content=?,excerpt=?,image=?,gallery_images=?,slug=?,tags=?,status=?,meta_title=?,meta_description=? WHERE id=?");
        $s->bind_param("sssssssssssi", $title,$category,$content,$excerpt,$db_image,$gallery_json,$slug,$tags,$status,$meta_title,$meta_desc,$edit_id);
    } else {
        $s = $conn->prepare("INSERT INTO blog_posts (title,category,content,excerpt,image,gallery_images,slug,tags,status,meta_title,meta_description) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $s->bind_param("sssssssssss", $title,$category,$content,$excerpt,$db_image,$gallery_json,$slug,$tags,$status,$meta_title,$meta_desc);
    }

    if ($s->execute()) {
        $new_id = $edit_id ?: $conn->insert_id;
        header("Location: manage_blog.php?edit=$new_id&saved=1");
        exit();
    } else {
        $flash = 'Save failed: ' . $conn->error;
        $flash_type = 'danger';
    }
}

if (isset($_GET['saved'])) $flash = $mode === 'edit' ? 'Post updated.' : 'Post published.';

// ── Load all posts for sidebar list ───────────────────────────────────────
$all_posts = $conn->query("SELECT id, title, status, created_at FROM blog_posts ORDER BY created_at DESC");

$p = $post; // shorthand for output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $mode === 'edit' ? 'Edit Post' : 'New Post'; ?> — Biochar Pamoja Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- EasyMDE rich text editor -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <style>
        :root {
            --bp-green: #2d6a4f;
            --bp-mid:   #40916c;
            --bp-light: #d8f3dc;
            --bp-accent:#f4a261;
            --radius:   10px;
        }
        * { box-sizing: border-box; }
        body { background: #f0f4f2; font-family: 'Segoe UI', system-ui, sans-serif; margin: 0; }

        /* ── Top nav ── */
        .topnav {
            background: var(--bp-green); color: #fff;
            padding: 0 24px; height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .topnav a { color: #b7e4c7; text-decoration: none; font-size: .85rem; }
        .topnav a:hover { color: #fff; }
        .topnav .brand { font-weight: 700; font-size: .95rem; color: #fff; display: flex; align-items: center; gap: 10px; }

        /* ── Layout ── */
        .page-wrap { display: grid; grid-template-columns: 260px 1fr; gap: 0; min-height: calc(100vh - 56px); }

        /* ── Posts sidebar ── */
        .posts-sidebar {
            background: #fff; border-right: 1px solid #e2e8e5;
            overflow-y: auto; max-height: calc(100vh - 56px); position: sticky; top: 56px;
        }
        .posts-sidebar .sidebar-head {
            padding: 16px 18px; font-weight: 700; font-size: .8rem;
            letter-spacing: .06em; text-transform: uppercase; color: #95a89f;
            border-bottom: 1px solid #e2e8e5; display: flex; align-items: center; justify-content: space-between;
        }
        .post-item {
            padding: 12px 18px; border-bottom: 1px solid #f0f4f2;
            text-decoration: none; display: block; transition: background .12s;
        }
        .post-item:hover { background: #f7faf8; }
        .post-item.active { background: var(--bp-light); border-left: 3px solid var(--bp-green); }
        .post-item .pi-title { font-size: .88rem; font-weight: 600; color: #1a2e25; line-height: 1.3; }
        .post-item .pi-meta { font-size: .75rem; color: #95a89f; margin-top: 3px; display: flex; gap: 8px; align-items: center; }
        .pi-status { font-size: .7rem; padding: 2px 7px; border-radius: 99px; font-weight: 600; }
        .pi-status.published { background: #d8f3dc; color: #2d6a4f; }
        .pi-status.draft { background: #fff3cd; color: #856404; }
        .new-post-btn {
            display: flex; align-items: center; gap: 6px;
            background: var(--bp-green); color: #fff; border: none;
            padding: 5px 12px; border-radius: 6px; font-size: .78rem; font-weight: 600;
            text-decoration: none; white-space: nowrap;
        }
        .new-post-btn:hover { background: var(--bp-mid); color: #fff; }

        /* ── Editor area ── */
        .editor-area { padding: 28px 32px; overflow-y: auto; }

        /* ── Section cards ── */
        .section-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e2e8e5; margin-bottom: 20px; overflow: hidden;
        }
        .section-head {
            padding: 13px 20px; font-size: .78rem; font-weight: 700;
            letter-spacing: .07em; text-transform: uppercase; color: #95a89f;
            border-bottom: 1px solid #e2e8e5; display: flex; align-items: center; gap: 8px;
        }
        .section-body { padding: 20px; }

        /* ── Form ── */
        .form-label { font-size: .82rem; font-weight: 600; color: #3d5a48; margin-bottom: 4px; }
        .form-hint { font-size: .76rem; color: #95a89f; margin-top: 4px; }
        .form-control, .form-select {
            border-radius: 8px; border-color: #d0dbd5; font-size: .9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bp-mid); box-shadow: 0 0 0 3px rgba(64,145,108,.15);
        }
        .char-count { font-size: .75rem; color: #adb5bd; float: right; margin-top: 4px; }
        .char-count.warn { color: #f4a261; }
        .char-count.over { color: #dc3545; }

        /* ── SEO preview ── */
        .seo-preview {
            background: #f8f9fa; border: 1px solid #e2e8e5;
            border-radius: 8px; padding: 14px 16px; margin-top: 16px;
        }
        .seo-preview .sp-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #95a89f; margin-bottom: 8px; }
        .seo-preview .sp-title { font-size: 1.05rem; color: #1a0dab; font-weight: 400; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .seo-preview .sp-url { font-size: .82rem; color: #006621; margin: 2px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .seo-preview .sp-desc { font-size: .85rem; color: #4d5156; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        /* ── Image previews ── */
        .img-preview { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 8px; }
        .gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 10px; }
        .gallery-grid img { width: 100%; height: 80px; object-fit: cover; border-radius: 6px; }
        .gallery-item { position: relative; }
        .gallery-item .remove-img {
            position: absolute; top: 4px; right: 4px;
            background: rgba(220,53,69,.9); color: #fff; border: none;
            border-radius: 50%; width: 22px; height: 22px; font-size: .7rem;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
        }

        /* ── Publish bar ── */
        .publish-bar {
            position: sticky; bottom: 0; background: #fff;
            border-top: 1px solid #e2e8e5; padding: 14px 32px;
            display: flex; align-items: center; gap: 12px; z-index: 10;
        }
        .btn-publish { background: var(--bp-green); border-color: var(--bp-green); padding: 9px 24px; font-weight: 600; }
        .btn-publish:hover { background: var(--bp-mid); border-color: var(--bp-mid); }
        .btn-draft { background: #fff; border-color: #d0dbd5; color: #3d5a48; padding: 9px 20px; }
        .btn-draft:hover { background: #f0f4f2; }

        /* ── Flash ── */
        .flash-wrap { padding: 0 32px; margin-top: 20px; }
        .flash-bar { border-radius: var(--radius); font-size: .9rem; }

        /* ── Mobile ── */
        @media (max-width: 900px) {
            .page-wrap { grid-template-columns: 1fr; }
            .posts-sidebar { display: none; }
            .editor-area { padding: 16px; }
            .publish-bar { padding: 12px 16px; }
        }
    </style>
</head>
<body>

<!-- ── Top nav ── -->
<div class="topnav">
    <div class="brand">
        <a href="dashboard.php" style="color:#b7e4c7;"><i class="fas fa-arrow-left"></i></a>
        Blog Editor
    </div>
    <div style="display:flex;gap:20px;align-items:center;">
        <?php if($mode === 'edit' && $p): ?>
        <a href="../blog.php" target="_blank"><i class="fas fa-eye me-1"></i>View Blog</a>
        <?php endif; ?>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
    </div>
</div>

<div class="page-wrap">

    <!-- ── Posts sidebar ── -->
    <aside class="posts-sidebar">
        <div class="sidebar-head">
            All Posts
            <a href="manage_blog.php" class="new-post-btn"><i class="fas fa-plus"></i> New</a>
        </div>
        <?php if($all_posts->num_rows === 0): ?>
            <div style="padding:20px;color:#95a89f;font-size:.85rem;">No posts yet.</div>
        <?php else: while($ap = $all_posts->fetch_assoc()): ?>
        <a href="manage_blog.php?edit=<?php echo $ap['id']; ?>" class="post-item <?php echo ($mode==='edit' && $p['id']==$ap['id']) ? 'active' : ''; ?>">
            <div class="pi-title"><?php echo htmlspecialchars($ap['title']); ?></div>
            <div class="pi-meta">
                <span class="pi-status <?php echo $ap['status']; ?>"><?php echo ucfirst($ap['status']); ?></span>
                <?php echo date('M d, Y', strtotime($ap['created_at'])); ?>
            </div>
        </a>
        <?php endwhile; endif; ?>
    </aside>

    <!-- ── Editor ── -->
    <div style="display:flex;flex-direction:column;min-height:calc(100vh - 56px);">

        <?php if($flash): ?>
        <div class="flash-wrap">
            <div class="alert alert-<?php echo $flash_type; ?> flash-bar alert-dismissible fade show mt-0" role="alert">
                <?php echo htmlspecialchars($flash); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" id="blog-form" style="flex:1;display:flex;flex-direction:column;">
            <input type="hidden" name="edit_id" value="<?php echo $p['id'] ?? ''; ?>">
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($p['image'] ?? ''); ?>">
            <input type="hidden" name="current_gallery" id="current_gallery" value='<?php echo htmlspecialchars($p['gallery_images'] ?? '[]'); ?>'>
            <input type="hidden" name="status" id="status-input" value="<?php echo $p['status'] ?? 'published'; ?>">

            <div class="editor-area" style="flex:1;">
                <div class="row g-4">

                    <!-- ── Left column: main content ── -->
                    <div class="col-lg-8">

                        <!-- Title & basics -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-heading"></i> Post Details</div>
                            <div class="section-body">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title-input" class="form-control form-control-lg" style="font-weight:600;" value="<?php echo htmlspecialchars($p['title'] ?? ''); ?>" required placeholder="Post title…">
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Slug (URL)</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="font-size:.8rem;color:#95a89f;">/blog/</span>
                                            <input type="text" name="slug" id="slug-input" class="form-control" value="<?php echo htmlspecialchars($p['slug'] ?? ''); ?>" placeholder="auto-generated">
                                        </div>
                                        <div class="form-hint">Leave blank to auto-generate from title.</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Category</label>
                                        <select name="category" class="form-select">
                                            <?php foreach(['News','Projects','Events','Research','Updates'] as $cat): ?>
                                            <option <?php echo ($p['category']??'') === $cat ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Tags</label>
                                        <input type="text" name="tags" class="form-control" value="<?php echo htmlspecialchars($p['tags'] ?? ''); ?>" placeholder="biochar, soil health, kenya (comma-separated)">
                                        <div class="form-hint">Comma-separated keywords.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Excerpt -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-align-left"></i> Excerpt</div>
                            <div class="section-body">
                                <textarea name="excerpt" id="excerpt-input" class="form-control" rows="3" maxlength="300" placeholder="Short summary shown on blog listing page…"><?php echo htmlspecialchars($p['excerpt'] ?? ''); ?></textarea>
                                <div class="form-hint">Shown on the blog listing page and in search results. Leave blank to auto-generate from content. <span id="excerpt-count" class="char-count">0 / 160</span></div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-pen-nib"></i> Content</div>
                            <div class="section-body">
                                <textarea name="content" id="content-editor"><?php echo htmlspecialchars($p['content'] ?? ''); ?></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- ── Right column: media + SEO ── -->
                    <div class="col-lg-4">

                        <!-- Main image -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-image"></i> Cover Image</div>
                            <div class="section-body">
                                <?php if(!empty($p['image'])): ?>
                                <img src="../<?php echo htmlspecialchars($p['image']); ?>" class="img-preview" id="main-img-preview">
                                <?php else: ?>
                                <div id="main-img-placeholder" style="width:100%;height:120px;background:#f0f4f2;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#95a89f;font-size:.85rem;margin-bottom:8px;">
                                    <span><i class="fas fa-image me-2"></i>No image</span>
                                </div>
                                <img src="" class="img-preview d-none" id="main-img-preview">
                                <?php endif; ?>
                                <input type="file" name="image" id="main-img-input" class="form-control" accept="image/*">
                                <div class="form-hint">JPG, PNG, WebP. Shown as the post's cover.</div>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-images"></i> Gallery</div>
                            <div class="section-body">
                                <div class="gallery-grid" id="gallery-preview">
                                    <?php
                                    $gallery = json_decode($p['gallery_images'] ?? '[]', true) ?: [];
                                    foreach($gallery as $gi => $img): ?>
                                    <div class="gallery-item" data-index="<?php echo $gi; ?>">
                                        <img src="../<?php echo htmlspecialchars($img); ?>">
                                        <button type="button" class="remove-img" onclick="removeGalleryImg(this, '<?php echo htmlspecialchars($img); ?>')"><i class="fas fa-times"></i></button>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <input type="file" name="gallery[]" id="gallery-input" class="form-control mt-3" accept="image/*" multiple>
                                <div class="form-hint">Add multiple images to the post carousel.</div>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="section-card">
                            <div class="section-head"><i class="fas fa-search"></i> SEO</div>
                            <div class="section-body">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta-title-input" class="form-control" maxlength="70" value="<?php echo htmlspecialchars($p['meta_title'] ?? $p['title'] ?? ''); ?>" placeholder="Defaults to post title">
                                    <div class="form-hint">Ideal: 50–60 chars. <span id="meta-title-count" class="char-count">0 / 60</span></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta-desc-input" class="form-control" rows="3" maxlength="320" placeholder="Brief description for search engines…"><?php echo htmlspecialchars($p['meta_description'] ?? ''); ?></textarea>
                                    <div class="form-hint">Ideal: 140–160 chars. <span id="meta-desc-count" class="char-count">0 / 160</span></div>
                                </div>

                                <!-- Google SERP preview -->
                                <div class="seo-preview">
                                    <div class="sp-label">Google preview</div>
                                    <div class="sp-title" id="preview-title"><?php echo htmlspecialchars($p['meta_title'] ?? $p['title'] ?? 'Post title'); ?></div>
                                    <div class="sp-url" id="preview-url">biocharpamoja.co.ke/blog/<?php echo htmlspecialchars($p['slug'] ?? 'post-slug'); ?></div>
                                    <div class="sp-desc" id="preview-desc"><?php echo htmlspecialchars($p['meta_description'] ?? 'Meta description will appear here…'); ?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- /editor-area -->

            <!-- ── Publish bar ── -->
            <div class="publish-bar">
                <button type="submit" name="save_blog" class="btn btn-primary btn-publish" onclick="setStatus('published')">
                    <i class="fas fa-check me-2"></i><?php echo $mode === 'edit' ? 'Update Post' : 'Publish Post'; ?>
                </button>
                <button type="submit" name="save_blog" class="btn btn-draft" onclick="setStatus('draft')">
                    <i class="fas fa-save me-2"></i>Save as Draft
                </button>
                <?php if($mode === 'edit'): ?>
                <a href="manage_blog.php" class="btn btn-outline-secondary ms-auto">+ New Post</a>
                <?php endif; ?>
                <a href="dashboard.php" class="btn btn-link text-muted ms-<?php echo $mode==='edit'?'2':'auto'; ?>" style="font-size:.85rem;">← Dashboard</a>
            </div>

        </form>
    </div><!-- /editor column -->
</div><!-- /page-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
// ── Rich text editor ────────────────────────────────────────────
const easyMDE = new EasyMDE({
    element: document.getElementById('content-editor'),
    spellChecker: false,
    autosave: { enabled: true, uniqueId: 'bp_blog_<?php echo $p["id"] ?? "new"; ?>' },
    toolbar: ['bold','italic','heading','|','quote','unordered-list','ordered-list','|','link','image','|','preview','side-by-side','fullscreen','|','guide'],
    placeholder: 'Write your post content here… Markdown supported.',
    minHeight: '320px',
});

// ── Slug auto-generate ──────────────────────────────────────────
const titleInput = document.getElementById('title-input');
const slugInput  = document.getElementById('slug-input');
let slugManual = slugInput.value.length > 0;
titleInput.addEventListener('input', function() {
    if (!slugManual) {
        slugInput.value = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g,'').replace(/[\s-]+/g,'-').replace(/^-|-$/g,'');
    }
    updateSEOPreview();
});
slugInput.addEventListener('input', function() { slugManual = true; updateSEOPreview(); });

// ── Char counters ───────────────────────────────────────────────
function charCounter(inputId, countId, ideal) {
    const el = document.getElementById(inputId);
    const ct = document.getElementById(countId);
    if (!el || !ct) return;
    function update() {
        const len = el.value.length;
        ct.textContent = `${len} / ${ideal}`;
        ct.className = 'char-count' + (len > ideal * 1.1 ? ' over' : len > ideal ? ' warn' : '');
    }
    el.addEventListener('input', () => { update(); updateSEOPreview(); });
    update();
}
charCounter('meta-title-input', 'meta-title-count', 60);
charCounter('meta-desc-input',  'meta-desc-count',  160);
charCounter('excerpt-input',    'excerpt-count',    160);

// ── SEO live preview ─────────────────────────────────────────────
function updateSEOPreview() {
    const title   = document.getElementById('meta-title-input').value || document.getElementById('title-input').value || 'Post title';
    const slug    = document.getElementById('slug-input').value || 'post-slug';
    const desc    = document.getElementById('meta-desc-input').value || document.getElementById('excerpt-input').value || 'Meta description will appear here…';
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-url').textContent   = 'biocharpamoja.co.ke/blog/' + slug;
    document.getElementById('preview-desc').textContent  = desc;
}
document.getElementById('meta-title-input').addEventListener('input', updateSEOPreview);
document.getElementById('meta-desc-input').addEventListener('input', updateSEOPreview);
document.getElementById('excerpt-input').addEventListener('input', updateSEOPreview);
updateSEOPreview();

// ── Main image preview ───────────────────────────────────────────
document.getElementById('main-img-input').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const prev = document.getElementById('main-img-preview');
            const ph   = document.getElementById('main-img-placeholder');
            prev.src = e.target.result;
            prev.classList.remove('d-none');
            if (ph) ph.style.display = 'none';
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// ── Gallery remove ───────────────────────────────────────────────
function removeGalleryImg(btn, path) {
    const item = btn.closest('.gallery-item');
    item.remove();
    const hiddenInput = document.getElementById('current_gallery');
    let gallery = JSON.parse(hiddenInput.value || '[]');
    gallery = gallery.filter(p => p !== path);
    hiddenInput.value = JSON.stringify(gallery);
}

// ── Gallery new file preview ─────────────────────────────────────
document.getElementById('gallery-input').addEventListener('change', function() {
    const grid = document.getElementById('gallery-preview');
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'gallery-item';
            div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:80px;object-fit:cover;border-radius:6px;">`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

// ── Publish status ───────────────────────────────────────────────
function setStatus(s) { document.getElementById('status-input').value = s; }
</script>
</body>
</html>
