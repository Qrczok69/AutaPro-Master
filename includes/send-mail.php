<?php
// includes/send-mail.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($phone)) {
        header("Location: ../index.php?msg=error#kontakt");
        exit;
    }

    $to = SITE_EMAIL;
    $subject = "AutaPro LEAD: $name ($phone)";
    
    $body = "Nowy LEAD ze strony:\n\n";
    $body .= "Imie: $name\nTelefon: $phone\nEmail: $email\n\n";
    $body .= "Wiadomosc:\n$message\n";

    $headers = "From: no-reply@autapro.pl\r\nReply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: ../index.php?msg=success#kontakt");
    } else {
        header("Location: ../index.php?msg=error#kontakt");
    }
} else {
    header("Location: ../index.php");
}
?>
