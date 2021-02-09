<?php
/*
Name: Michael Perron
Coding 03
Purpose: This page accepts user inputs from form, validates it,
and processes it to be output to result.html.
 */

require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine;

$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/result.html');
$footer = file_get_contents('templates/footer.html');

$header_data = ["pagetitle" => "Code03 Michael Perron", "logo" => "Code03", "home" => HOME,
                "form" => FORM];

$footer_data = [
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Home Page"];

/* * *********************************************
* STEP 1: INPUT: Do NOT process, just get the data.
* Do not delete this comment,
* ********************************************** */
if (!empty($_POST['title']) && !empty($_POST['drink']) && !empty($_POST['pet']) && !empty($_POST['ficPlace']) && !empty($_POST['rlPlace'])) {
    $title = $_POST['title'];
    $drink = $_POST['drink'];
    $pet = $_POST['pet'];
    $ficPlace = $_POST['ficPlace'];
    $rlPlace = $_POST['rlPlace'];
} else {
    $title = "";
    $drink = "";
    $pet = "";
    $ficPlace = "";
    $rlPlace = "";
}

/* * ******************************************************
* STEP 2: VALIDATION: Always clean your input first!!!!
* Do NOT process, only CLEAN and VALIDATE.
* Do not delete this comment.
* ****************************************************** */            
$title = trim($title);
$drink = trim($drink);
$pet = trim($pet);
$ficPlace = trim($ficPlace);
$rlPlace = trim($rlPlace);

$title = strip_tags($title);
$drink = strip_tags($drink);
$pet = strip_tags($pet);
$ficPlace = strip_tags($ficPlace);
$rlPlace = strip_tags($rlPlace);

$title = substr($title, $titleLen, 64);
$drink = substr($drink, $drinkLen, 64);
$pet = substr($pet, $petLen, 64);
$ficPlace = substr($ficPlace, $ficLen, 64);
$rlPlace = substr($rlPlace, $realLen, 64);

$titleLen = strlen($title);
$drinkLen = strlen($drink);
$petLen = strlen($pet);
$ficLen = strlen($ficPlace);
$realLen = strlen($rlPlace);
$sentence = "You are " . $title . " " . $drink . " " . $pet . " of ". $ficPlace . " and " . $rlPlace;
$sentenceLength = strlen($sentence);

if($sentenceLength > 30){
    $heckcute = "That’s a heck of a title!​";
}
if($sentenceLength < 30){
    $heckcute = "That’s a cute little title.";
}

if (!empty($title) && !empty($drink) && !empty($pet) && !empty($ficPlace) && !empty($rlPlace)) {
/* * *************************************************************************
* STEP 3 and 4: PROCESSING and OUTPUT: Notice this code only executes
* if you have valid data from steps 1 and 2. Your code must always have
* a saftey feature similar to this.
* Do not delete this comment.
* ************************************************************************ */ 
    $body_data = [
        "result" => $sentence,
        "titlesentence" => "the first word has " .$titleLen. "letters",
        "drinksentence" => "the first word has " .$drinkLen. "letters",
        "petsentence" => "the first word has " .$petLen. "letters",
        "ficsentence" => "the first word has " .$ficLen. "letters",
        "rlsentence" => "the first word has " .$realLen. "letters",
        "sizesentence" => "Length of the whole title (including spaces): " .$sentenceLength,
        "heckcute" => $heckcute,
        "try" => "try again"];  
}
else {
    $body_data = ["notVal" =>  "I’m sorryyy, your input was not valid."];
}

echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $body_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;