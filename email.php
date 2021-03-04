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
    
    if (!empty($_POST)) {
        /* ********************************************
         * TODO (erase this comment when you are done)
         * ********************************************
         * Do your validation and cleaning here. You need to extract FOUR
         * things from the $_POST array...
           $name --> trim it, strip HTML tags, and sub-string it to 64
           $subject --> trim it, strip HTML tags, and sub-string it to 64
           $message --> trim it, strip HTML tags, and sub-string it to 1000
           $from --> look up and use the PHP filter_var() with FILTER_VALIDATE_EMAIL
           https://www.php.net/manual/en/function.filter-var.php
         * 
         */
        
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

        $name = trim($name);
        $subject = trim($subject);
        $message = trim($message);
        $from = trim($from);
        
        $name = strip_tags($name);
        $subject = strip_tags($subject);
        $message = strip_tags($message);
        $from = strip_tags($from);

        $nameLen = strlen($name);
        $subjectLen = strlen($subject);
        $messageLen = strlen($message);
        $fromLen = strlen($from);
      
        $name = substr($name, $nameLen, 64);
        $subject = substr($subject, $subjectLen, 64);
        $message = substr($message, $messageLen, 1000);
        $from = substr($from, $fromLen, 64);

        successpage();
        echo $nameLen;
        echo $subjectLen;
        echo $messageLen;
        echo $fromLen;

/* * *************************************************************************
* STEP 3 and 4: PROCESSING and OUTPUT: Notice this code only executes
* if you have valid data from steps 1 and 2. Your code must always have
* a saftey feature similar to this.
* Do not delete this comment.
* ************************************************************************ */
        
        
        
        // /* The cleaning routines above may leave any variable empty. If we
        //  * find an empty variable, we stop processing because that means
        //  * someone tried to send us something malicious and/or incorrect. */
        // if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {

        //     /* this forms the correct email headers to send an email */
        //     $headers = "From: $from\r\n";
        //     $headers .= "Reply-To: $from\r\n";
        //     $headers .= "MIME-Version: 1.0\r\n";
        //     $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

        //     /* Now attempt to send the email. This uses a REAL email function
        //      * and will send an email. Make sure you only sned it to yourself.
        //      * server, you would use just "mail" instead of "mymail" and
        //      * it will be sent normally. Read about the PHP mail() function
        //      * https://www.php.net/manual/en/function.mail.php
        //      * then it's up to you to fill out the paramters correctly.
        //      */
        //     if (mail(/****fill out the paramters here****/)) {
        //         successpage();
        //     } else {
        //         failurepage();
        //     }
        // } else {
        //     failurepage();
        // }
    } else {
        failurepage();
    }
}

// this kicks off the script
main();