<?php

namespace App;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Crypt;
use App\Annonces;

class Mail
{

    public function __construct($mailto, $id)
    {
        $annonces = new Annonces();
        $annonces = $annonces->sendInfo($id);
        var_dump($annonces);
        $path = "http://annonces/";
        $courriel =$annonces['courriel'];
        $uuid = $annonces['uuid'];
        $courrielChiffre = Crypt::encrypt($courriel);
        $uuidChiffre = Crypt::encrypt($uuid);
        $hash = Crypt::hashStr($courrielChiffre, $uuidChiffre);
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
            $mail->addAddress($mailto);

            // Content
            $mail->isHTML(true);     // Set email format to HTML

            // on construit nos url
            $url_confirmer = $path . 'confirmer-annonce' . '/' . $uuidChiffre . '/' . $courrielChiffre . '/' . $hash;
            $url_supprimer = $path . 'supprimer-annonce' . '/' . $uuidChiffre . '/' . $courrielChiffre . '/' . $hash;
            $url_modifier = $path . 'modifier-annonce' . '/' . $uuidChiffre . '/' . $courrielChiffre . '/' . $hash;

            // on remplit notre mail
            $mail->Subject = 'Liens de votre annonce';
            $mail->Body ='<h1><a href="http:/annonces/"><img src="../../public/assets/logo.png" alt="Logo du site ELEPHADS"></a></h1><br><br>
            <p>Bonjour !</p><br><p>Nous vous remercions de votre dépôt d\'annonce.</p></br>
            <a href="'. $url_confirmer .'">Cliquez sur ce lien pour confirmer votre annonce.</a>
            <br><br>
            <a href="'. $url_modifier .'">Cliquez sur ce lien pour modifier votre annonce.</a>
            <br><br>
            <a href="'.  $url_supprimer .'">Cliquez sur ce lien pour supprimer votre annonce.</a>
            <br><br>';

            // et on l'envoie
            $mail->send();
            echo 'Le message a été envoyé';
        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur de l'expéditeur: {$mail->ErrorInfo}";
        }
    }
}