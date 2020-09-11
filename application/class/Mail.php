<?php

namespace App;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Mail
{
    public function __construct($type, $mailto, $prenom, $nom, $pwd)
    {
        
        $path = "http://annonces/";

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            // $mail->SMTPDebug = true; // Enable verbose debug output

            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'lea.zervini@mail.com';                     // SMTP username
            $mail->Password   = '**';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('lea.zervini@mail.com', 'ELEPHADS');
            $mail->addAddress($mailto, $prenom . ' ' . $nom);    
            
            // Content
            $mail->isHTML(true);     // Set email format to HTML
            
            if ($type === 'valid') {
                $url = $path . '/validation' . $pwd;
                $mail->Subject = 'Confirmez votre annonce';
                $mail->Body ='<h1><a href="http:/annonces/"><img src="../../public/assets/logo.png" alt="Logo du site ELEPHADS"> POPY</a></h1><br><br><p>Bonjour '.$prenom.' !</p><br>
                <p>Nous vous remercions de votre dépôt d\'annonce.</p></br><a href="'.$url .'">Cliquez sur ce lien pour confirmer votre annonce.</a>';
            } elseif ($type === 'delete') {
                $url = $path . '/supprimer' . $pwd;
                $mail->Subject = 'Votre annonce a été publiée';
                $mail->Body ='<h1><a href="http:/annonces/"><img src="../../public/assets/logo.png" alt="Logo du site ELEPHADS"> POPY</a></h1><br><br><p>Bonjour '.$prenom.' !</p><br>
                <p>êtes-vous sûr(e) de bien vouloir supprimer votre annonce ? Celle-ci ne pourra pas être récupérer ultérieurement.</p><br><a href="'.$url .'">Cliquez sur ce lien pour supprimer votre annonce.</a>';
            } else {
                echo 'Wrong Type Parameter';
                return;
            }
            
        
            $mail->send();
             echo 'Le message a été envoyé';
        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur de l'expéditeur: {$mail->ErrorInfo}";
        }
    }
}