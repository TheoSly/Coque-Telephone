<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


class Sendemail {
  public $nom;
  public $msg;
  public $email;


  static function sendnews() {
    if(isset($_POST["send"])){

      $mail = new PHPMailer(); $mail->IsSMTP(); $mail->Mailer = "smtp";
  
      $mail->SMTPDebug  = 1;  
      $mail->SMTPAuth   = TRUE;
      $mail->SMTPSecure = "tls";
      $mail->Port       = 587;
      $mail->Host       = "smtp.gmail.com";
      $mail->Username   = "no.reply.myzic@gmail.com";
      $mail->Password   = "uqri krhg xbid piii";
  
      $mail->IsHTML(true);
      $mail->addAddress($_POST["email"]);
      $mail->SetFrom("no.reply.myzic@gmail.com", "MYZIC");
      $mail->AddReplyTo("no.reply.myzic@gmail.com", "MYZIC");
      $mail->Subject = "Bonjour, nous vous confirmons votre inscription à la newsletters !";
      $content = "<b>Bonjour, nous vous confirmons votre inscription à la newsletters !</b>";
  
  
      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
      echo "Error while sending Email.";
      header("Refresh:0"); 
  
      var_dump($mail);
      } else {
      header("Refresh:0"); 
      }
  }

  }


  static function sendcontact() {



if(isset($_POST["send"])){
    $nom = $_POST['nom'];
    $msg = $_POST['message'];

    $mail = new PHPMailer(); $mail->IsSMTP(); $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "no.reply.myzic@gmail.com";
    $mail->Password   = "uqri krhg xbid piii";

    $mail->IsHTML(true);
    $mail->addAddress($_POST["email"]);
    $mail->SetFrom("no.reply.myzic@gmail.com", "MYZIC");
    $mail->AddReplyTo("no.reply.myzic@gmail.com", "MYZIC");
    $mail->Subject = "Bonjour, $nom votre message a bien ete transmis au support!";
    $content = "<b>Vous obtienderez une réponse dans les 48 heures !</b>";


    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
      header("Location: controleur.php?page=autres&action=sendcontacterror");

    var_dump($mail);
    } else {
    echo "Email sent successfully";
    header("Location: controleur.php?page=autres&action=confimationsendcontact");
    }
}

  }
}













