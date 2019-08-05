<?php
include("Exception.php");
include("OAuth.php");
include("POP3.php");
include("SMTP.php");
include("PHPMailer.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mail extends PHPMailer {
    public function __construct() {
        $file = dirname(__FILE__)."/settings.ini";
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
        try {
            parent::__construct(true);
            //Connection settings
            $this->SMTPDebug = $settings['mail']['debuglevel'];   // Enable verbose debug output
            $this->isSMTP();                                      // Set mailer to use SMTP
            $this->SMTPAuth = true;                               // Enable SMTP authentication
            $this->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->Port = $settings['mail']['port'];              // TCP port to connect to
            
            //Connection parameters
            $this->Host = $settings['mail']['host'];              // Specify main and backup SMTP servers
            $this->Username = $settings['mail']['email'];         // SMTP username
            $this->Password = $settings['mail']['password'];      // SMTP password

            //Set sender of mail.
            $this->setFrom($settings['mail']['email']);
            // message format
            $this->isHTML(true);                                  //Send text as HTML
        } catch (Exception $e) {
            die("failed to send mail! But post was created, no worries! Settings error");
        }
    }
    public function SendMail($title, $text, $recipient) {
        try {
            //Prepare mail object
            $this->addCC($recipient);
            $this->Subject = $title;
            $this->Body    = $text;
            $this->AltBody = strip_tags($text); //altbody is for mail clients that can't parse html, thus tags are stripped to prevent oddities.

            //Send mail object.
            $this->send();
            return true;
        } catch (Exception $e) {
            $message = $e->errorMessage();
            return "failed to send mail! But post was created, no worries! $message";
        }
    }
}