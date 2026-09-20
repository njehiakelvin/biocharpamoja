<?php
require_once 'db_connect.php';
require_once '../vendor/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ── Base URL for redirects ─────────────────────────────────
$base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
define('CONTACT_PAGE', $base_url . '/contact.php');

// ── Settings ──────────────────────────────────────────────
$recipient    = "info@biocharpamoja.co.ke";
$sender_email = "info@biocharpamoja.co.ke";

// ── Only handle POST ──────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . CONTACT_PAGE);
    exit;
}

// ── 1. Sanitize & validate ────────────────────────────────
$name    = str_replace(["\r", "\n"], " ", strip_tags(trim($_POST["Firstname"] ?? "")));
$email   = filter_var(trim($_POST["Email"] ?? ""), FILTER_SANITIZE_EMAIL);
$message = trim($_POST["Message"] ?? "");

if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: " . CONTACT_PAGE . "?status=invalid");
    exit;
}

// ── 2. Save to database ───────────────────────────────────
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();
$stmt->close();

// ── 3. Send email via PHPMailer (SMTP) ────────────────────
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'mail.biocharpamoja.co.ke';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USER'] ?? $sender_email;
    $mail->Password   = $_ENV['MAIL_PASS'] ?? '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($sender_email, 'Biochar Pamoja Website');
    $mail->addAddress($recipient, 'Biochar Pamoja');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "New Contact from Website: $name";
    $mail->Body    = "
        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
        <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
    ";
    $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    header("Location: " . CONTACT_PAGE . "?status=success");

} catch (Exception $e) {
    error_log("Mailer error: " . $mail->ErrorInfo);
    header("Location: " . CONTACT_PAGE . "?status=error");
}
exit;
