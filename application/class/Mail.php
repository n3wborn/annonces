<?php

namespace App;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Mail
{
    public function __construct($type, $mailto, $prenom, $nom, $motdepasse)
    {
        
        $host = "http://annonces/";

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            // $mail->SMTPDebug = true; // Enable verbose debug output

            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'dd3a76c21395d4';                     // SMTP username
            $mail->Password   = '9a5f410c988e01';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('dd3a76c21395d4', 'ELEPHADS');
            $mail->addAddress($mailto, $prenom . ' ' . $nom);    
        }
    }
}