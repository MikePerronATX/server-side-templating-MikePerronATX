<?php
/*
 * This file receives input from the user, validates it,
 * processes it, and sends it to result.html to be displated.
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
    "footertitle" => "Result Page"];

/* * *********************************************
* STEP 1: INPUT: Do NOT process, just get the data.
* Do not delete this comment,
* ********************************************** */
if (!empty($_POST['title']) && !empty($_POST['drink']) && !empty($_POST['pet'])
                && !empty($_POST['ficPlace']) && !empty($_POST['rlPlace'])
                && !empty($_POST['email']) && !empty($_POST['remail'])) {

    $title = $_POST['title'];
    $drink = $_POST['drink'];
    $pet = $_POST['pet'];
    $ficPlace = $_POST['ficPlace'];
    $rlPlace = $_POST['rlPlace'];
    $email = $_POST['email'];
    $remail = $_POST['remail'];

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
    $email = trim($email);
    $remail = trim($remail);

    $title = strip_tags($title);
    $drink = strip_tags($drink);
    $pet = strip_tags($pet);
    $ficPlace = strip_tags($ficPlace);
    $rlPlace = strip_tags($rlPlace);
    $email = strip_tags($email);
    $remail = strip_tags($remail);

    $title = substr($title, $titleLen, 64);
    $drink = substr($drink, $drinkLen, 64);
    $pet = substr($pet, $petLen, 64);
    $ficPlace = substr($ficPlace, $ficLen, 64);
    $rlPlace = substr($rlPlace, $realLen, 64);
    $email = substr($email, $emailLen, 64);
    $remail = substr($remail, $remailLen, 64);

    $titleLen = strlen($title);
    $drinkLen = strlen($drink);
    $petLen = strlen($pet);
    $ficLen = strlen($ficPlace);
    $realLen = strlen($rlPlace);
    $emailLen = strlen($email);
    $remailLen = strlen($remail);
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
        "titlelen" => $titleLen,
        "drinklen" => $drinkLen,
        "petlen" => $petLen,
        "ficlen" => $ficLen,
        "reallen" => $realLen,
        "emaillen" => $emailLen,
        "remaillen" => $remailLen,
        "sentlen" => $sentenceLength,
        "empty" => "d-none",
        "heckcute" => $heckcute,];
    }
}
else {
    $title = "";
    $drink = "";
    $pet = "";
    $ficPlace = "";
    $rlPlace = "";
    
    $body_data = ["full" =>  "d-none"];
}
echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $body_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;