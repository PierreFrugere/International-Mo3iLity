<?php
$headers = "From: Sendmail Tests" . PHP_EOL;
$headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
$to = "joevin.soulenq@gmail.com";
$subject = "CoucouTEST";
$message = "test bonjour la  famille";
if (!mail($to, $subject, $message, $headers)) {
    $send_error = "Erreur lors de l'envoi de l'email :(";
}
