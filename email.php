<?php
/*
Name: Michael Perron
Coding 06
Purpose: get data from contact form, validate,
determine which page (success or failure) that it
should be sent to.
*/

function main() {
    
    if (!empty($_POST)) {
        
        $name = $_POST['contactName'];
        $subject = $_POST['contactSub'];
        $message = $_POST['contactMess'];
        $from = $_POST['contactFrom'];
        
        $name = trim($name);
        $subject = trim($subject);
        $message = trim($message);
        $from = trim($from);
        
        $name = strip_tags($name);
        $subject = strip_tags($subject);
        $message = strip_tags($message);
        $from = strip_tags($from);

        $name = substr($name, 0, 64);
        $subject = substr($subject, 0, 64);
        $message = substr($message, 0, 64);

        $nameLen = strlen($name);
        $subjectLen = strlen($subject);
        $messageLen = strlen($message);
        $fromLen = strlen($from);

        $from = filter_var($from, FILTER_VALIDATE_EMAIL);
        
        if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {
            
            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            $to = $from;
                
            if (mail($to, $subject, $message, $headers)) {
                echo "okay";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
// this kicks off the script
main();
