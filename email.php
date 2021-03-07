<?php
/*
Name: Michael Perron
Coding 05
Purpose: get data from contact form, validate,
determine which page (success or failure) that it
should be sent to.
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

        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $from = $_POST['from'];

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
            echo("is here");
            
            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            $to = $from;
                
            if (mail($to, $subject, $message, $headers)) {
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
