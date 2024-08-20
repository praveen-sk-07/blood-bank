<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.elasticemail.com'; // Replace with your SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'praveensk77777@gmail.com'; // SMTP username
        $mail->Password = '7B9E052607C017332183CBDF6FAD0A9F8970'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to (587 for TLS)

        //Recipients
        $mail->setFrom('praveensk77777@gmail.com', 'Your Name');
        $mail->addAddress('praveensk77777@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";

        $mail->send();
        echo "Your message has been sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send your message. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
