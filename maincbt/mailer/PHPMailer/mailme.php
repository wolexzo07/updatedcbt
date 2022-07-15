<?php

use PHPMailer;
use SMTP;
use Exception;
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'standard3.doveserver.com ';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'support@projectbase.ng';                 // SMTP username
    $mail->Password = 'Affinity1990?';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('hello@projectbase.ng', 'PBNG-Hello');
    #$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('wolexzo007@gmail.com');               // Name is optional
    #$mail->addReplyTo('info@example.com', 'Information');
    #$mail->addCC('cc@example.com');
    #$mail->addBCC('bcc@example.com');

    //Attachments
   # $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'PBNG USER REGISTRATION';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
