<?php

/*
 Name: Michael Perron
Coding 05
Purpose: display.
 */
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine;

function successpage() {

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
}

function failurepage() {

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
}

function main() {

   /* ********************************************
    * TODO (erase this comment when you are done)
    * ********************************************
    * these two lines are for debugging purposes to get started.
    * erase them both when you are ready to complete this processing
    */
    

    // var_dump($_POST);
    // exit();
    



    /* This will test to make sure we have a non-empty $_POST from
     * the form submission. */
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


        /* The cleaning routines above may leave any variable empty. If we
         * find an empty variable, we stop processing because that means
         * someone tried to send us something malicious and/or incorrect. */
        if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {

            /* this forms the correct email headers to send an email */
            $headers = "From: $from\r\n";
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
            if (mail(/****fill out the paramters here****/)) {
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
