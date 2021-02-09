<?php
/*
Name: Michael Perron
Coding 03
Purpose: This page is the landing page. As per instructions,
it has an image at 100% in mobile size and 40% at desktop size.
Also, the text wraps around the image in full view and drops
beneath it in mobile view. 
 */

require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine;

$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/home.html');
$footer = file_get_contents('templates/footer.html');

$header_data = ["pagetitle" => "Code03 Michael Perron",
                "logo" => "Code03",
                "home" => HOME,
                "form" => FORM];

$body_data = ["body-img" => "/images/mask.png"];

$footer_data = [
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Home Page"];

echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $body_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;
