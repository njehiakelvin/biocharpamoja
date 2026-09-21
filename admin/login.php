<?php
// admin/login.php
session_start();
include '../assets/php/db_connect.php';

// If already logged in, go straight to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Invalid username or password.";
    if (isset($stmt)) $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Biochar Pamoja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --bp-green: #2d6a4f; --bp-mid: #40916c; --bp-light: #d8f3dc; }
        body { background: #f0f4f2; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-card {
            width: 100%; max-width: 400px; padding: 2.5rem;
            border-radius: 12px; background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
        }
        .login-logo { text-align: center; margin-bottom: 1.5rem; }
        .login-logo .icon { width: 56px; height: 56px; background: var(--bp-light); border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--bp-green); margin-bottom: .75rem; }
        .login-logo h5 { font-weight: 700; color: #1a2e25; margin: 0; }
        .login-logo small { color: #95a89f; font-size: .82rem; }
        .form-label { font-size: .85rem; font-weight: 600; color: #3d5a48; }
        .form-control { border-radius: 8px; border-color: #d0dbd5; }
        .form-control:focus { border-color: var(--bp-mid); box-shadow: 0 0 0 3px rgba(64,145,108,.15); }
        .btn-login { background: var(--bp-green); border-color: var(--bp-green); padding: 10px; font-weight: 600; border-radius: 8px; }
        .btn-login:hover { background: var(--bp-mid); border-color: var(--bp-mid); }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <div class="icon"><i class="fas fa-leaf"></i></div>
        <h5>Biochar Pamoja</h5>
        <small>Admin Panel</small>
    </div>

    <?php if ($error): ?>
    <div class="alert alert-danger py-2 text-center" style="font-size:.88rem;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-login w-100">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
        </button>
    </form>
    <div class="text-center mt-4">
        <a href="../index.php" style="font-size:.82rem; color:#95a89f;">
            <i class="fas fa-arrow-left me-1"></i>Back to website
        </a>
    </div>
</div>
</body>
</html>