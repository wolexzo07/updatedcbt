<?php
      include("../finishit.php");
      $to       =   "biobakutimothy@gmail.com";
      $subject  =   "PBNG USER REGISTRATION";
      $message  =   "I am coming now pls helpme asap.</i>";
      $name     =   "Projectbase.ng";
      $mailsend =   sendmail($to,$subject,$message,$name);
      if($mailsend==1){
        echo '<h2>email sent.</h2>';
      }
      else{
        echo '<h2>There are some issue.</h2>';
      }
?>
