<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = htmlspecialchars(trim($_GET['cf-name']));
    $email = htmlspecialchars(trim($_GET['cf-email']));
    $message = htmlspecialchars(trim($_GET['cf-message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';          // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yokeshmani46@gmail.com';     // Your Gmail address
        $mail->Password   = 'vrtd mrzp aqus ntgb';       // App password (not Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email headers
        $mail->setFrom($email, $name);
        $mail->addAddress('yokeshmani46@gmail.com');      // Your receiving email address
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
