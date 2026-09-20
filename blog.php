<?php
$page_title = "News &amp; Updates, Biochar Pamoja";
include 'assets/php/db_connect.php';

/* ── Newsletter subscription ── */
$sub_msg    = "";
$sub_status = "";

if (isset($_POST['subscribe'])) {
    $email = $conn->real_escape_string($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check = $conn->query("SELECT id FROM subscribers WHERE email='$email'");
        if ($check->num_rows > 0) {
            $sub_msg    = "You are already subscribed!";
            $sub_status = "warning";
        } else {
            $conn->query("INSERT INTO subscribers (email) VALUES ('$email')");
            $sub_msg    = "Welcome to the community! You've been subscribed.";
            $sub_status = "success";
        }
    } else {
        $sub_msg    = "Please enter a valid email address.";
        $sub_status = "danger";
    }
}

/* ── Comment submission ── */
if (isset($_POST['submit_comment'])) {
    $post_id = (int)$_POST['post_id'];
    $name    = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);
    if (!empty($name) && !empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (post_id, name, comment, status) VALUES (?, ?, ?, 'pending')");
        $stmt->bind_param("iss", $post_id, $name, $comment);
        $stmt->execute();
        header("Location: blog.php?msg=pending#post-" . $post_id);
        exit();
    }
}

include 'includes/header.php';
?>

<style>
/* ── Blog hero ── */
.blog-hero {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--logo-teal) 100%);
    padding: 70px 0 50px;
    color: white;
    text-align: center;
}
.blog-hero h1 { font-weight: 900; }

/* ── Post cards ── */
.post-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    margin-bottom: 36px;
    transition: box-shadow 0.3s;
}
.post-card:hover { box-shadow: 0 16px 40px rgba(0,0,0,0.12); }

.post-img-wrap { position: relative; overflow: hidden; }
.post-img-wrap img,
.post-img-wrap .carousel { height: 380px; }
.post-img-wrap img { width: 100%; height: 380px; object-fit: cover; display: block; }

.post-category-badge {
    position: absolute;
    top: 16px; left: 16px;
    background: var(--primary-green);
    color: white;
    border-radius: 50px;
    padding: 4px 14px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.post-body { padding: 32px; }
.post-meta { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 12px; }
.post-title { font-size: 1.4rem; font-weight: 800; margin-bottom: 12px; color: var(--text-main); }
.post-excerpt { color: var(--text-muted); line-height: 1.8; margin-bottom: 22px; }

.btn-read-more {
    display: inline-flex; align-items: center; gap: 8px;
    background: transparent;
    border: 2px solid var(--primary-green);
    color: var(--primary-green);
    border-radius: 50px;
    padding: 9px 22px;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all 0.25s;
    text-decoration: none;
    cursor: pointer;
}
.btn-read-more:hover {
    background: var(--primary-green);
    color: white;
}

/* ── Expanded post body ── */
.post-expanded {
    border-top: 1px solid var(--border-color);
    background: var(--bg-secondary);
    padding: 36px;
}
.post-content-full { line-height: 1.9; color: var(--text-main); }

/* ── Comments ── */
.comments-panel {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 24px;
    height: 100%;
}
.comment-bubble {
    background: var(--bg-secondary);
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 12px;
}
.comment-bubble:last-child { margin-bottom: 0; }
.comment-scroll { max-height: 280px; overflow-y: auto; }

/* Comment form fields */
.post-expanded .form-control {
    background: var(--bg-secondary);
    border-color: var(--border-color);
    color: var(--text-main);
    border-radius: 10px;
}
.post-expanded .form-control:focus {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 0.2rem rgba(25,135,84,0.2);
    background: var(--bg-secondary);
    color: var(--text-main);
}
body.dark-mode .post-expanded .form-control {
    background: #2d2d2d;
    border-color: #404040;
    color: #e0e0e0;
}

/* ── Newsletter ── */
.newsletter-section {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white;
    padding: 70px 0;
}
.newsletter-input-group {
    background: white;
    border-radius: 50px;
    padding: 6px 6px 6px 20px;
    display: flex;
    align-items: center;
    max-width: 520px;
    margin: 0 auto;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
.newsletter-input-group input {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.95rem;
    color: #333;
    padding: 4px 0;
}
.newsletter-input-group button {
    background: var(--primary-green);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 10px 24px;
    font-weight: 700;
    white-space: nowrap;
    transition: background 0.25s;
}
.newsletter-input-group button:hover { background: var(--logo-teal); }
</style>

<!-- HERO -->
<section class="blog-hero">
    <div class="container">
        <span class="badge bg-white text-success fw-bold px-3 py-2 mb-3" style="font-size:0.82rem;letter-spacing:1px;">NEWS &amp; UPDATES</span>
        <h1 class="display-5 mb-2">Latest Stories</h1>
        <p class="lead" style="opacity:0.85;max-width:520px;margin:0 auto;">Field reports, research findings, and community impact from across Kenya.</p>
    </div>
</section>

<!-- PENDING COMMENT TOAST -->
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'pending'): ?>
<div class="alert alert-success alert-dismissible fade show fixed-top m-3" style="z-index:1060;max-width:500px;" role="alert">
    <i class="fas fa-check-circle me-2"></i><strong>Thanks!</strong> Your comment has been submitted and is awaiting approval.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- POSTS -->
<section class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <?php
                $sql    = "SELECT * FROM blog_posts ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0):
                    $counter = 0;
                    while ($row = $result->fetch_assoc()):
                        $id          = $row['id'];
                        $gallery     = json_decode($row['gallery_images'], true);
                        $has_gallery = !empty($gallery) && count($gallery) > 0;

                        // Alternating layout
                        $img_order = ($counter % 2 === 0) ? 'order-lg-1' : 'order-lg-2';
                        $txt_order = ($counter % 2 === 0) ? 'order-lg-2' : 'order-lg-1';
                ?>

                <div class="post-card" id="post-<?php echo $id; ?>">
                    <div class="row g-0 align-items-stretch">

                        <!-- IMAGE / CAROUSEL COLUMN -->
                        <div class="col-lg-5 order-1 <?php echo $img_order; ?>">
                            <?php if ($has_gallery): ?>
                                <div id="postCarousel<?php echo $id; ?>" class="carousel slide h-100" data-bs-ride="carousel">
                                    <div class="carousel-inner h-100">
                                        <?php if (!empty($row['image'])): ?>
                                            <div class="carousel-item active h-100">
                                                <img src="<?php echo htmlspecialchars($row['image']); ?>" class="d-block w-100" style="height:380px;object-fit:cover;" alt="Post image">
                                            </div>
                                        <?php endif; ?>
                                        <?php foreach ($gallery as $gi => $img):
                                            $active = (empty($row['image']) && $gi === 0) ? 'active' : ''; ?>
                                            <div class="carousel-item <?php echo $active; ?> h-100">
                                                <img src="<?php echo htmlspecialchars($img); ?>" class="d-block w-100" style="height:380px;object-fit:cover;" alt="Gallery">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <span class="post-category-badge"><?php echo htmlspecialchars($row['category']); ?></span>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel<?php echo $id; ?>" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#postCarousel<?php echo $id; ?>" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                                </div>
                            <?php else: ?>
                                <div class="post-img-wrap h-100">
                                    <img src="<?php echo !empty($row['image']) ? htmlspecialchars($row['image']) : 'assets/images/hero1.jpg'; ?>" alt="Post Image" style="height:380px;">
                                    <span class="post-category-badge"><?php echo htmlspecialchars($row['category']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- TEXT COLUMN -->
                        <div class="col-lg-7 order-2 <?php echo $txt_order; ?> d-flex flex-column">
                            <div class="post-body flex-grow-1">
                                <div class="post-meta">
                                    <i class="fas fa-calendar-alt text-success me-1"></i>
                                    <?php echo date('F d, Y', strtotime($row['created_at'])); ?>
                                </div>
                                <h3 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p class="post-excerpt">
                                    <?php echo substr(strip_tags($row['content']), 0, 200) . '…'; ?>
                                </p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <button class="btn-read-more" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#expand-<?php echo $id; ?>"
                                        aria-expanded="false">
                                        Read More <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <button class="btn-read-more" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#expand-<?php echo $id; ?>"
                                        aria-expanded="false"
                                        style="border-color:var(--logo-teal);color:var(--logo-teal);">
                                        <i class="fas fa-comment"></i> Comment
                                    </button>
                                </div>
                            </div>

                            <!-- EXPANDED CONTENT -->
                            <div class="collapse" id="expand-<?php echo $id; ?>">
                                <div class="post-expanded">
                                    <div class="post-content-full mb-5">
                                        <?php echo nl2br(htmlspecialchars($row['content'])); ?>
                                    </div>
                                    <hr style="border-color:var(--border-color);">
                                    <div class="row g-4 mt-2" id="comments-<?php echo $id; ?>">
                                        <!-- Comments list -->
                                        <div class="col-md-6">
                                            <div class="comments-panel">
                                                <h6 class="fw-bold mb-3"><i class="fas fa-comments text-success me-2"></i>Discussion</h6>
                                                <div class="comment-scroll">
                                                    <?php
                                                    $c_sql = "SELECT * FROM comments WHERE post_id = $id AND status = 'approved' ORDER BY created_at DESC";
                                                    $c_res = $conn->query($c_sql);
                                                    if ($c_res->num_rows > 0):
                                                        while ($com = $c_res->fetch_assoc()):
                                                    ?>
                                                    <div class="comment-bubble">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <strong class="small"><?php echo htmlspecialchars($com['name']); ?></strong>
                                                            <small class="text-muted"><?php echo date('M d', strtotime($com['created_at'])); ?></small>
                                                        </div>
                                                        <p class="mb-0 small text-muted"><?php echo htmlspecialchars($com['comment']); ?></p>
                                                    </div>
                                                    <?php endwhile; else: ?>
                                                    <p class="text-muted text-center small py-3">No comments yet. Be the first!</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Comment form -->
                                        <div class="col-md-6">
                                            <div class="comments-panel">
                                                <h6 class="fw-bold mb-3"><i class="fas fa-pen text-success me-2"></i>Leave a Reply</h6>
                                                <form method="POST" action="blog.php">
                                                    <input type="hidden" name="post_id" value="<?php echo $id; ?>">
                                                    <div class="mb-3">
                                                        <input type="text" name="name" class="form-control" placeholder="Your name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea name="comment" class="form-control" rows="4" placeholder="Share your thoughts…" required></textarea>
                                                    </div>
                                                    <button type="submit" name="submit_comment" class="btn btn-success w-100 rounded-pill">
                                                        Post Comment <small class="opacity-75">(moderated)</small>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $counter++;
                    endwhile;
                else:
                ?>
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4>No posts yet</h4>
                    <p class="text-muted">Check back soon for field reports and project updates.</p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter-section" id="newsletter">
    <div class="container text-center">
        <h2 class="fw-bold mb-2">Don't Miss an Update</h2>
        <p class="lead mb-4" style="opacity:0.85;">Join our community for field reports, research findings, and project news.</p>

        <?php if ($sub_msg): ?>
            <div class="alert alert-<?php echo $sub_status; ?> alert-dismissible fade show d-inline-block mb-4 text-start" style="min-width:320px;" role="alert">
                <?php echo $sub_msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="blog.php#newsletter">
            <div class="newsletter-input-group">
                <input type="email" name="email" placeholder="Enter your email address…" required>
                <button type="submit" name="subscribe">Subscribe <i class="fas fa-paper-plane ms-1"></i></button>
            </div>
            <p class="small mt-3 mb-0" style="opacity:0.65;">No spam. Unsubscribe anytime.</p>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
