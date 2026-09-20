<?php
// admin/dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include '../assets/php/db_connect.php';
require_once '../assets/vendor/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// --- ENSURE SETTINGS TABLE EXISTS ---
$conn->query("CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value TEXT NOT NULL
)");

// Default settings if not present
$default_settings = [
    'smtp_host'       => 'mail.biocharpamoja.co.ke',
    'smtp_port'       => '587',
    'smtp_user'       => 'info@biocharpamoja.co.ke',
    'smtp_pass'       => '',
    'smtp_from_name'  => 'Biochar Pamoja',
    'notify_email'    => 'info@biocharpamoja.co.ke',
];
foreach ($default_settings as $k => $v) {
    $stmt = $conn->prepare("INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES (?, ?)");
    $stmt->bind_param("ss", $k, $v);
    $stmt->execute();
}

// Load all settings into array
$settings = [];
$res = $conn->query("SELECT setting_key, setting_value FROM site_settings");
while ($row = $res->fetch_assoc()) { $settings[$row['setting_key']] = $row['setting_value']; }

$flash = ['type' => '', 'msg' => ''];

// --- 1. SAVE SETTINGS ---
if (isset($_POST['save_settings'])) {
    $fields = ['smtp_host','smtp_port','smtp_user','smtp_from_name','notify_email'];
    foreach ($fields as $f) {
        $val = trim($_POST[$f] ?? '');
        $stmt = $conn->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=?");
        $stmt->bind_param("sss", $f, $val, $val);
        $stmt->execute();
        $settings[$f] = $val;
    }
    // Only update password if provided
    if (!empty($_POST['smtp_pass'])) {
        $val = $_POST['smtp_pass'];
        $stmt = $conn->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=?");
        $k2 = "smtp_pass"; $stmt->bind_param("sss", $k2, $val, $val);
        $stmt->execute();
        $settings['smtp_pass'] = $val;
    }
    // Update username
    if (!empty($_POST['admin_username'])) {
        $new_user = trim($_POST['admin_username']);
        $stmt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
        $stmt->bind_param("si", $new_user, $_SESSION['user_id']);
        $stmt->execute();
        $_SESSION['username'] = $new_user;
    }
    // Update password
    if (!empty($_POST['new_password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $hashed = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
            $stmt->bind_param("si", $hashed, $_SESSION['user_id']);
            $stmt->execute();
            $flash = ['type'=>'success','msg'=>'Settings saved and password updated.'];
        } else {
            $flash = ['type'=>'danger','msg'=>'Passwords do not match — other settings were saved.'];
        }
    } else {
        $flash = ['type'=>'success','msg'=>'Settings saved.'];
    }
}

// --- 2. HANDLE NEWSLETTER SENDING ---
$newsletter_msg = "";
if (isset($_POST['send_newsletter'])) {
    $subject = strip_tags(trim($_POST['subject']));
    $body    = strip_tags(trim($_POST['message']));
    $subs    = $conn->query("SELECT email FROM subscribers");
    $count   = 0; $failed = 0;
    while ($row = $subs->fetch_assoc()) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $settings['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $settings['smtp_user'];
            $mail->Password   = $settings['smtp_pass'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int)$settings['smtp_port'];
            $mail->setFrom($settings['smtp_user'], $settings['smtp_from_name']);
            $mail->addAddress($row['email']);
            $mail->Subject = $subject;
            $mail->Body    = nl2br(htmlspecialchars($body));
            $mail->AltBody = $body;
            $mail->send(); $count++;
        } catch (Exception $e) {
            error_log("Newsletter failed for {$row['email']}: " . $mail->ErrorInfo); $failed++;
        }
    }
    $newsletter_msg = "Sent to $count subscriber(s)." . ($failed ? " $failed failed — check logs." : "");
}

// --- 3. HANDLE ACTIONS ---
$allowed_get_actions = ['delete_post','delete_msg','approve_comment','delete_comment'];
foreach ($allowed_get_actions as $action) {
    if (isset($_GET[$action]) && is_numeric($_GET[$action])) {
        $id = (int) $_GET[$action];
        switch ($action) {
            case 'delete_post':
                $s = $conn->prepare("DELETE FROM blog_posts WHERE id=?"); $s->bind_param("i",$id); $s->execute();
                header("Location: dashboard.php"); exit();
            case 'delete_msg':
                $s = $conn->prepare("DELETE FROM messages WHERE id=?"); $s->bind_param("i",$id); $s->execute();
                header("Location: dashboard.php?tab=messages"); exit();
            case 'approve_comment':
                $s = $conn->prepare("UPDATE comments SET status='approved' WHERE id=?"); $s->bind_param("i",$id); $s->execute();
                header("Location: dashboard.php?tab=comments"); exit();
            case 'delete_comment':
                $s = $conn->prepare("DELETE FROM comments WHERE id=?"); $s->bind_param("i",$id); $s->execute();
                header("Location: dashboard.php?tab=comments"); exit();
        }
    }
}

// --- 4. HANDLE BLOG SAVE ---
if (isset($_POST['save_post'])) {
    $title    = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content  = trim($_POST['content']);
    $edit_id  = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;
    $db_image_path = $_POST['current_image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], "../assets/uploads/$filename"))
            $db_image_path = "assets/uploads/$filename";
    }
    $gallery_json = $_POST['current_gallery'] ?? '[]';
    if (!empty($_FILES['gallery']['name'][0])) {
        $paths = [];
        foreach ($_FILES['gallery']['name'] as $k => $name) {
            $fn = time()."_".basename($name);
            if (move_uploaded_file($_FILES['gallery']['tmp_name'][$k], "../assets/uploads/$fn"))
                $paths[] = "assets/uploads/$fn";
        }
        $gallery_json = json_encode($paths);
    }
    if ($edit_id) {
        $s = $conn->prepare("UPDATE blog_posts SET title=?,category=?,content=?,image=?,gallery_images=? WHERE id=?");
        $s->bind_param("sssssi",$title,$category,$content,$db_image_path,$gallery_json,$edit_id);
    } else {
        $s = $conn->prepare("INSERT INTO blog_posts (title,category,content,image,gallery_images) VALUES (?,?,?,?,?)");
        $s->bind_param("sssss",$title,$category,$content,$db_image_path,$gallery_json);
    }
    $s->execute(); $s->close();
    header("Location: dashboard.php"); exit();
}

// --- METRICS ---
$count_blogs    = $conn->query("SELECT COUNT(*) as c FROM blog_posts")->fetch_assoc()['c'];
$count_msgs     = $conn->query("SELECT COUNT(*) as c FROM messages")->fetch_assoc()['c'];
$count_subs     = $conn->query("SELECT COUNT(*) as c FROM subscribers")->fetch_assoc()['c'];
$count_comments = $conn->query("SELECT COUNT(*) as c FROM comments WHERE status='pending'")->fetch_assoc()['c'];

$edit_data = null;
$active_tab = $_GET['tab'] ?? 'dashboard';
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit_data = $conn->prepare("SELECT * FROM blog_posts WHERE id=?");
    $edit_data->bind_param("i",$id); $edit_data->execute();
    $edit_data = $edit_data->get_result()->fetch_assoc();
    $active_tab = 'blogs';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Biochar Pamoja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --bp-green:   #2d6a4f;
            --bp-mid:     #40916c;
            --bp-light:   #d8f3dc;
            --bp-accent:  #f4a261;
            --sidebar-w:  240px;
            --radius:     10px;
        }

        * { box-sizing: border-box; }
        body { background: #f0f4f2; font-family: 'Segoe UI', system-ui, sans-serif; margin: 0; }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w); background: var(--bp-green);
            color: #fff; display: flex; flex-direction: column;
            z-index: 100; overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px 16px;
            font-size: .75rem; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: #b7e4c7;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }
        .sidebar-brand span { display: block; font-size: 1.1rem; color: #fff; letter-spacing: 0; margin-top: 2px; }
        .sidebar nav { flex: 1; padding: 12px 0; }
        .sidebar a {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 20px; color: #b7e4c7; text-decoration: none;
            font-size: .9rem; border-left: 3px solid transparent;
            transition: background .15s, color .15s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,.1);
            border-left-color: var(--bp-accent); color: #fff;
        }
        .sidebar a.text-danger { color: #ff6b6b !important; margin-top: 8px; }
        .sidebar a.text-danger:hover { background: rgba(255,107,107,.12); }
        .sidebar-footer { padding: 16px 20px; font-size: .78rem; color: #95d5b2; border-top: 1px solid rgba(255,255,255,.1); }

        /* ── Main ── */
        .main-wrap { margin-left: var(--sidebar-w); min-height: 100vh; }
        .topbar {
            background: #fff; padding: 14px 24px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #e2e8e5; position: sticky; top: 0; z-index: 50;
        }
        .topbar h5 { margin: 0; font-weight: 600; color: #1a2e25; }
        .topbar .user-pill {
            display: flex; align-items: center; gap: 8px;
            background: var(--bp-light); border-radius: 99px;
            padding: 6px 14px; font-size: .85rem; color: var(--bp-green); font-weight: 600;
        }
        .content { padding: 24px; }

        /* ── Stat cards ── */
        .stat-card {
            border: none; border-radius: var(--radius);
            box-shadow: 0 1px 6px rgba(0,0,0,.06);
            padding: 20px; display: flex; align-items: center; gap: 16px;
        }
        .stat-icon {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;
        }
        .stat-val { font-size: 1.8rem; font-weight: 700; line-height: 1; color: #1a2e25; }
        .stat-lbl { font-size: .8rem; color: #6c757d; margin-top: 2px; }

        /* ── Cards ── */
        .panel-card { background: #fff; border-radius: var(--radius); box-shadow: 0 1px 6px rgba(0,0,0,.06); overflow: hidden; }
        .panel-card .card-head {
            padding: 14px 20px; font-weight: 600; font-size: .9rem;
            border-bottom: 1px solid #eef1ef; color: #1a2e25;
            display: flex; align-items: center; justify-content: space-between;
        }

        /* ── Message cards ── */
        .msg-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e2e8e5; padding: 16px 18px;
            margin-bottom: 12px; transition: box-shadow .15s;
        }
        .msg-card:hover { box-shadow: 0 3px 12px rgba(0,0,0,.08); }
        .msg-card .msg-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 8px; flex-wrap: wrap; }
        .msg-card .msg-name { font-weight: 600; color: #1a2e25; font-size: .95rem; }
        .msg-card .msg-email { font-size: .82rem; color: var(--bp-mid); }
        .msg-card .msg-date { font-size: .78rem; color: #adb5bd; white-space: nowrap; }
        .msg-card .msg-body { margin-top: 10px; color: #3d5a48; font-size: .88rem; line-height: 1.6; white-space: pre-wrap; word-break: break-word; }
        .msg-card .msg-actions { margin-top: 12px; display: flex; gap: 8px; }

        /* ── Comment cards ── */
        .comment-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e2e8e5; padding: 16px 18px; margin-bottom: 12px;
        }
        .comment-card .cc-meta { font-size: .8rem; color: #6c757d; margin-top: 4px; }
        .comment-card .cc-body { margin-top: 8px; color: #3d5a48; font-size: .88rem; line-height: 1.6; }
        .comment-card .cc-actions { margin-top: 12px; display: flex; gap: 8px; }

        /* ── Forms ── */
        .form-label { font-size: .85rem; font-weight: 600; color: #3d5a48; margin-bottom: 4px; }
        .form-control, .form-select {
            border-radius: 8px; border-color: #d0dbd5; font-size: .9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bp-mid); box-shadow: 0 0 0 3px rgba(64,145,108,.15);
        }
        .btn-primary { background: var(--bp-green); border-color: var(--bp-green); }
        .btn-primary:hover { background: var(--bp-mid); border-color: var(--bp-mid); }
        .btn-success { background: #2d6a4f; border-color: #2d6a4f; }

        /* ── Settings ── */
        .settings-section { margin-bottom: 28px; }
        .settings-section h6 {
            font-size: .7rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: #95a89f; margin-bottom: 14px;
            padding-bottom: 8px; border-bottom: 1px solid #e2e8e5;
        }

        /* ── Mobile topbar ── */
        .mobile-topbar {
            display: none; position: sticky; top: 0; z-index: 200;
            background: var(--bp-green); padding: 12px 16px;
            align-items: center; justify-content: space-between;
        }
        .mobile-topbar .brand { color: #fff; font-weight: 700; font-size: 1rem; }
        .mobile-topbar .btn-menu { background: none; border: none; color: #fff; font-size: 1.2rem; }

        /* ── Mobile sidebar (offcanvas) ── */
        .offcanvas { width: 240px !important; }
        .offcanvas-body .nav-link {
            color: #b7e4c7; display: flex; align-items: center; gap: 10px;
            padding: 11px 20px; font-size: .9rem; border-left: 3px solid transparent;
        }
        .offcanvas-body .nav-link:hover { background: rgba(255,255,255,.1); color: #fff; border-left-color: var(--bp-accent); }
        .offcanvas-body .nav-link.text-danger { color: #ff6b6b !important; }

        /* ── Table (kept for blogs list only) ── */
        .table th { font-size: .8rem; font-weight: 700; color: #6c757d; text-transform: uppercase; letter-spacing: .04em; }

        /* ── Badge ── */
        .badge-pending { background: #fff3cd; color: #856404; font-size: .75rem; border-radius: 6px; padding: 3px 8px; }

        /* ── Alert ── */
        .flash-bar { border-radius: var(--radius); margin-bottom: 16px; font-size: .9rem; }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .mobile-topbar { display: flex; }
            .topbar { display: none; }
            .content { padding: 16px; }
            .stat-card { padding: 14px; }
            .stat-val { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<!-- ── Mobile topbar ── -->
<div class="mobile-topbar">
    <span class="brand">Biochar Pamoja</span>
    <button class="btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- ── Mobile sidebar offcanvas ── -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="nav flex-column">
            <a href="#" class="nav-link mobile-trigger" data-tab="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#" class="nav-link mobile-trigger" data-tab="blogs"><i class="fas fa-pen"></i> Manage Blog</a>
            <a href="#" class="nav-link mobile-trigger" data-tab="comments"><i class="fas fa-comments"></i> Comments <?php if($count_comments>0) echo "<span class='badge bg-danger ms-1'>$count_comments</span>"; ?></a>
            <a href="#" class="nav-link mobile-trigger" data-tab="messages"><i class="fas fa-envelope"></i> Messages</a>
            <a href="#" class="nav-link mobile-trigger" data-tab="newsletter"><i class="fas fa-paper-plane"></i> Newsletter</a>
            <a href="#" class="nav-link mobile-trigger" data-tab="settings"><i class="fas fa-cog"></i> Settings</a>
            <a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </div>
</div>

<!-- ── Desktop sidebar ── -->
<div class="sidebar">
    <div class="sidebar-brand">
        Admin Panel
        <span>Biochar Pamoja</span>
    </div>
    <nav>
        <a href="#" class="tab-link active" data-tab="dashboard"><i class="fas fa-tachometer-alt fa-fw"></i> Dashboard</a>
        <a href="#" class="tab-link" data-tab="blogs"><i class="fas fa-pen fa-fw"></i> Manage Blog</a>
        <a href="#" class="tab-link" data-tab="comments"><i class="fas fa-comments fa-fw"></i> Comments <?php if($count_comments>0) echo "<span class='badge bg-danger float-end'>$count_comments</span>"; ?></a>
        <a href="#" class="tab-link" data-tab="messages"><i class="fas fa-envelope fa-fw"></i> Messages <span class="badge bg-secondary float-end"><?php echo $count_msgs; ?></span></a>
        <a href="#" class="tab-link" data-tab="newsletter"><i class="fas fa-paper-plane fa-fw"></i> Newsletter</a>
        <a href="#" class="tab-link" data-tab="settings"><i class="fas fa-cog fa-fw"></i> Settings</a>
        <a href="../index.php" target="_blank" style="margin-top: auto;"><i class="fas fa-external-link-alt fa-fw"></i> Visit Site</a>
        <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
    </nav>
    <div class="sidebar-footer">
        Logged in as<br><strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong>
    </div>
</div>

<!-- ── Main content ── -->
<div class="main-wrap">
    <div class="topbar">
        <h5 id="page-title">Dashboard</h5>
        <div class="user-pill"><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></div>
    </div>

    <div class="content">

        <?php if($flash['msg']): ?>
        <div class="alert alert-<?php echo $flash['type']; ?> flash-bar alert-dismissible fade show">
            <?php echo htmlspecialchars($flash['msg']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- ════════════════ DASHBOARD ════════════════ -->
        <div class="tab-pane" id="tab-dashboard">
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white">
                        <div class="stat-icon" style="background:#d8f3dc; color:#2d6a4f;"><i class="fas fa-file-alt"></i></div>
                        <div><div class="stat-val"><?php echo $count_blogs; ?></div><div class="stat-lbl">Blog Posts</div></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white">
                        <div class="stat-icon" style="background:#fff3cd; color:#856404;"><i class="fas fa-comments"></i></div>
                        <div><div class="stat-val"><?php echo $count_comments; ?></div><div class="stat-lbl">Pending Comments</div></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white">
                        <div class="stat-icon" style="background:#cfe2ff; color:#084298;"><i class="fas fa-envelope"></i></div>
                        <div><div class="stat-val"><?php echo $count_msgs; ?></div><div class="stat-lbl">Messages</div></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white">
                        <div class="stat-icon" style="background:#fde8d8; color:#b85c00;"><i class="fas fa-users"></i></div>
                        <div><div class="stat-val"><?php echo $count_subs; ?></div><div class="stat-lbl">Subscribers</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ MANAGE BLOG ════════════════ -->
        <div class="tab-pane" id="tab-blogs" style="display:none;">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="panel-card">
                        <div class="card-head"><?php echo $edit_data ? 'Edit Post' : 'New Post'; ?></div>
                        <div class="p-4">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="edit_id" value="<?php echo $edit_data['id'] ?? ''; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $edit_data['image'] ?? ''; ?>">
                                <input type="hidden" name="current_gallery" value='<?php echo $edit_data['gallery_images'] ?? ''; ?>'>
                                <div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($edit_data['title'] ?? ''); ?>" required></div>
                                <div class="mb-3"><label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option>News</option><option>Projects</option><option>Events</option>
                                    </select>
                                </div>
                                <div class="mb-3"><label class="form-label">Main Image</label><input type="file" name="image" class="form-control"></div>
                                <div class="mb-3"><label class="form-label">Gallery</label><input type="file" name="gallery[]" class="form-control" multiple></div>
                                <div class="mb-3"><label class="form-label">Content</label><textarea name="content" class="form-control" rows="6" required><?php echo htmlspecialchars($edit_data['content'] ?? ''); ?></textarea></div>
                                <button type="submit" name="save_post" class="btn btn-primary w-100"><?php echo $edit_data ? 'Update Post' : 'Publish Post'; ?></button>
                                <?php if($edit_data): ?><a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-2">Cancel</a><?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="panel-card">
                        <div class="card-head">Published Posts</div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light"><tr><th>Title</th><th>Date</th><th>Actions</th></tr></thead>
                                <tbody>
                                <?php
                                $posts = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
                                while($p = $posts->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                                    <td><small class="text-muted"><?php echo date('M d, Y', strtotime($p['created_at'])); ?></small></td>
                                    <td>
                                        <a href="dashboard.php?edit=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                                        <a href="dashboard.php?delete_post=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this post?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ════════════════ COMMENTS ════════════════ -->
        <div class="tab-pane" id="tab-comments" style="display:none;">
            <h5 class="mb-3 fw-semibold">Pending Comments</h5>
            <?php
            $coms = $conn->query("SELECT * FROM comments WHERE status='pending' ORDER BY created_at ASC");
            if ($coms->num_rows === 0): ?>
                <div class="panel-card p-5 text-center text-muted"><i class="fas fa-check-circle fa-2x mb-3 text-success d-block"></i>No pending comments — all clear.</div>
            <?php else: while($c = $coms->fetch_assoc()): ?>
            <div class="comment-card">
                <div class="d-flex justify-content-between align-items-start">
                    <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                    <span class="badge-pending">Pending</span>
                </div>
                <div class="cc-meta">Post ID: <?php echo $c['post_id']; ?> &middot; <?php echo date('M d, Y', strtotime($c['created_at'])); ?></div>
                <div class="cc-body"><?php echo htmlspecialchars($c['comment']); ?></div>
                <div class="cc-actions">
                    <a href="dashboard.php?approve_comment=<?php echo $c['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-check me-1"></i>Approve</a>
                    <a href="dashboard.php?delete_comment=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete comment?')"><i class="fas fa-trash me-1"></i>Delete</a>
                </div>
            </div>
            <?php endwhile; endif; ?>
        </div>

        <!-- ════════════════ MESSAGES ════════════════ -->
        <div class="tab-pane" id="tab-messages" style="display:none;">
            <h5 class="mb-3 fw-semibold">Inbox</h5>
            <?php
            $msgs = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
            if ($msgs->num_rows === 0): ?>
                <div class="panel-card p-5 text-center text-muted"><i class="fas fa-inbox fa-2x mb-3 d-block"></i>No messages yet.</div>
            <?php else: while($m = $msgs->fetch_assoc()): ?>
            <div class="msg-card">
                <div class="msg-header">
                    <div>
                        <div class="msg-name"><?php echo htmlspecialchars($m['name']); ?></div>
                        <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>" class="msg-email"><?php echo htmlspecialchars($m['email']); ?></a>
                    </div>
                    <div class="msg-date"><?php echo isset($m['created_at']) ? date('M d, Y · g:i a', strtotime($m['created_at'])) : ''; ?></div>
                </div>
                <div class="msg-body"><?php echo htmlspecialchars($m['message']); ?></div>
                <div class="msg-actions">
                    <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>?subject=Re: Your message to Biochar Pamoja" class="btn btn-sm btn-outline-primary"><i class="fas fa-reply me-1"></i>Reply</a>
                    <a href="dashboard.php?delete_msg=<?php echo $m['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this message?')"><i class="fas fa-trash me-1"></i>Delete</a>
                </div>
            </div>
            <?php endwhile; endif; ?>
        </div>

        <!-- ════════════════ NEWSLETTER ════════════════ -->
        <div class="tab-pane" id="tab-newsletter" style="display:none;">
            <h5 class="mb-3 fw-semibold">Send Newsletter</h5>
            <?php if($newsletter_msg): ?>
            <div class="alert alert-success flash-bar alert-dismissible fade show">
                <?php echo htmlspecialchars($newsletter_msg); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>
            <div class="panel-card p-4" style="max-width:640px;">
                <form method="POST">
                    <div class="mb-3"><label class="form-label">Subject</label><input type="text" name="subject" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Message</label><textarea name="message" class="form-control" rows="8" required></textarea></div>
                    <button type="submit" name="send_newsletter" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Send to <?php echo $count_subs; ?> Subscriber<?php echo $count_subs != 1 ? 's' : ''; ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- ════════════════ SETTINGS ════════════════ -->
        <div class="tab-pane" id="tab-settings" style="display:none;">
            <h5 class="mb-4 fw-semibold">Settings</h5>
            <form method="POST" style="max-width:680px;">
                <input type="hidden" name="save_settings" value="1">

                <!-- Email / SMTP -->
                <div class="panel-card p-4 mb-4">
                    <div class="settings-section">
                        <h6>Email &amp; SMTP</h6>
                        <div class="row g-3">
                            <div class="col-sm-8"><label class="form-label">SMTP Host</label><input type="text" name="smtp_host" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_host']); ?>"></div>
                            <div class="col-sm-4"><label class="form-label">Port</label><input type="number" name="smtp_port" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_port']); ?>"></div>
                            <div class="col-sm-6"><label class="form-label">SMTP Username</label><input type="text" name="smtp_user" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_user']); ?>"></div>
                            <div class="col-sm-6">
                                <label class="form-label">SMTP Password</label>
                                <input type="password" name="smtp_pass" class="form-control" placeholder="Leave blank to keep current">
                            </div>
                            <div class="col-sm-6"><label class="form-label">From Name</label><input type="text" name="smtp_from_name" class="form-control" value="<?php echo htmlspecialchars($settings['smtp_from_name']); ?>"></div>
                            <div class="col-sm-6"><label class="form-label">Notification Email</label><input type="email" name="notify_email" class="form-control" value="<?php echo htmlspecialchars($settings['notify_email']); ?>"></div>
                        </div>
                    </div>
                </div>

                <!-- Account -->
                <div class="panel-card p-4 mb-4">
                    <div class="settings-section">
                        <h6>Admin Account</h6>
                        <div class="row g-3">
                            <div class="col-sm-6"><label class="form-label">Username</label><input type="text" name="admin_username" class="form-control" value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>"></div>
                            <div class="col-12"><hr class="my-1"><small class="text-muted">Change password — leave both blank to keep current password.</small></div>
                            <div class="col-sm-6"><label class="form-label">New Password</label><input type="password" name="new_password" class="form-control" placeholder="New password"></div>
                            <div class="col-sm-6"><label class="form-label">Confirm Password</label><input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Save Settings</button>
            </form>
        </div>

    </div><!-- /content -->
</div><!-- /main-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const tabs = document.querySelectorAll('.tab-pane');
    const links = document.querySelectorAll('.tab-link, .mobile-trigger');
    const pageTitle = document.getElementById('page-title');
    const titles = { dashboard:'Dashboard', blogs:'Manage Blog', comments:'Comments', messages:'Inbox', newsletter:'Newsletter', settings:'Settings' };

    function showTab(name) {
        tabs.forEach(t => t.style.display = 'none');
        const pane = document.getElementById('tab-' + name);
        if (pane) pane.style.display = 'block';
        links.forEach(l => l.classList.toggle('active', l.dataset.tab === name));
        if (pageTitle) pageTitle.textContent = titles[name] || '';
        history.replaceState(null,'', '?tab=' + name);
    }

    links.forEach(l => {
        l.addEventListener('click', function(e) {
            e.preventDefault();
            const tab = this.dataset.tab;
            showTab(tab);
            // close offcanvas if open
            const oc = document.getElementById('mobileSidebar');
            const inst = bootstrap.Offcanvas.getInstance(oc);
            if (inst) inst.hide();
        });
    });

    // Initialise from URL param
    const params = new URLSearchParams(window.location.search);
    const initial = params.get('tab') || '<?php echo $active_tab; ?>';
    showTab(initial);
})();
</script>
</body>
</html>
