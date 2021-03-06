<?php

/*
 Name: Michael Perron
Coding 05
Purpose: display.
 */

require_once 'mustache/mustache/src/Mustache/Autoloader.php';


function successpage() {

    Mustache_Autoloader::register();

    $mustache = new Mustache_Engine;

    $header = file_get_contents('templates/header.html');
    $body = file_get_contents('templates/successpage.html');
    $footer = file_get_contents('templates/footer.html');
    
    $header_data = [
        "pagetitle" => "Code03 Michael Perron",
        "logo" => "Code03", 
        "home" => HOME,
        "form" => FORM,
        "contact" => CONTACT];
    
    $footer_data = [
        "localtime" => date('l jS \of F Y h:i:s A'),
        "footertitle" => "Success Page"];

    echo $mustache->render($header, $header_data) . PHP_EOL;
    echo $mustache->render($body, $body_data) . PHP_EOL;
    echo $mustache->render($footer, $footer_data) . PHP_EOL;
}

function failurepage() {
    Mustache_Autoloader::register();

    $mustache = new Mustache_Engine;

    $header = file_get_contents('templates/header.html');
    $body = file_get_contents('templates/failurepage.html');
    $footer = file_get_contents('templates/footer.html');
    
    $header_data = [
        "pagetitle" => "Code03 Michael Perron",
        "logo" => "Code03", 
        "home" => HOME,
        "form" => FORM,
        "contact" => CONTACT];
    
    $footer_data = [
        "localtime" => date('l jS \of F Y h:i:s A'),
        "footertitle" => "Failure Page"];
    echo $mustache->render($header, $header_data) . PHP_EOL;
    echo $mustache->render($body, $body_data) . PHP_EOL;
    echo $mustache->render($footer, $footer_data) . PHP_EOL;

}

function main() {
    
    if (!empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['message'])
                && !empty($_POST['from'])) {
        
/* * *********************************************
* STEP 1: INPUT: Do NOT process, just get the data.
* Do not delete this comment,
* ********************************************** */

    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $from = $_POST['from'];


/* * ******************************************************
* STEP 2: VALIDATION: Always clean your input first!!!!
* Do NOT process, only CLEAN and VALIDATE.
* Do not delete this comment.
* ****************************************************** */

    if (filter_var($from, FILTER_VALIDATE_EMAIL)) {
        echo("$from is a valid email address");
    } else {
    echo("$from is not a valid email address");
    }

    

    $name = trim($name);
    $subject = trim($subject);
    $message = trim($message);
    
    $name = strip_tags($name);
    $subject = strip_tags($subject);
    $message = strip_tags($message);
    
    $name = substr($name, $nameLen, 64);
    $subject = substr($subject, $subjectLen, 64);
    $message = substr($message, $messageLen, 1000);

    $nameLen = strlen($name);
    $subjectLen = strlen($subject);
    $messageLen = strlen($message);
    
    
        /* The cleaning routines above may leave any variable empty. If we
         * find an empty variable, we stop processing because that means
         * someone tried to send us something malicious and/or incorrect. */
        if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {
            
            /* this forms the correct email headers to send an email */
            $headers = "From: $from\r\n";
            $headers = "Name: $name\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            /* Now attempt to send the email. This uses a REAL email function
             * and will send an email. Make sure you only sned it to yourself.
             * server, you would use just "mail" instead of "mymail" and
             * it will be sent normally. Read about the PHP mail() function
             * https://www.php.net/manual/en/function.mail.php
             * then it's up to you to fill out the paramters correctly.
             */
            
            $to = "mikeperron.atx@gmail.com";
            
            if (mail($to, $subject, $message, $headers)) {
                $time = time();
                print "Script Ran $time";
                successpage();
                
            } else {
                failurepage();
            }
        } else {
            failurepage();
        }
    } else {
        failurepage();
    }
}

// this kicks off the script
main();