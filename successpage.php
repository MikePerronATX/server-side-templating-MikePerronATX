<?php
/*
 Name: Michael Perron
Coding 03
Purpose: This page sends template form data to
form.html for display.
 */

require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine;

$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/successpage.html');
$footer = file_get_contents('templates/footer.html');

$header_data = ["pagetitle" => "Code03 Michael Perron",
                "logo" => "Code03", 
                "home" => HOME,
                "form" => FORM,
                "contact" => CONTACT];

$body_data = ["body-img" => "/images/new-orleans-hero.jpg"];

$footer_data = [
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Success Page"];

echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $body_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;