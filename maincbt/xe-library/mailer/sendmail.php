<?php
    #require_once('PHPMailer.php');
    require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
    function sendmail($to,$subject,$message,$name){
                  #$mail             = new PHPMailer();
                  $mail = new PHPMailer\PHPMailer\PHPMailer();
                  $body             = $message;
                  $mail->IsSMTP();
                  $mail->SMTPAuth   = true;
                  $mail->Host       = "smtp.gmail.com";
                  $mail->Port       = 465;
                  $mail->Username   = "wolexzo007@gmail.com";
                  $mail->Password   = "biobakuoladunni1990";
                  $mail->SMTPSecure = 'ssl';
                  $mail->SetFrom('support@projectbase.ng', 'Projectbase.ng');
                  $mail->AddReplyTo("support@projectbase.ng","Projectbase.ng");
                  $mail->Subject    = $subject;
                  $mail->AltBody    = "";
                  $mail->MsgHTML($body);
                  $address = $to;
                  $mail->AddAddress($address, $name);
                  if(!$mail->Send()) {
                      return 0;
                  } else {
                        return 1;
                 }
    }
?>
