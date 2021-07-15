<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendMail($email,$subject,$body){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try{
                                                                //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = "SMTP.gmail.com";                        // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username =  "bookstore3210@gmail.com";                            // SMTP username
        $mail->Password = "Bookstore 69";                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->setFrom("bookstore3210@gmail.com", 'Book Store');
        $mail->addAddress($email); 
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        
        $mail->send();
        //echo 'Message has been sent';
        return 1;
    }
    catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;        
        return $mail->ErrorInfo;
        return 0;
    }
}

?>