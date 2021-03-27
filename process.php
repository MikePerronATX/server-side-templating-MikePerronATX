<?php
/*
Name: Michael Perron
Coding 06
This file receives input from the user, validates it,
processes it, and sends it to result.html to be displated.
*/
function main() {

    if (!empty($_POST['title']) && !empty($_POST['drink']) && !empty($_POST['pet'])
    && !empty($_POST['ficPlace']) && !empty($_POST['rlPlace']) && !empty($_POST['email'])
    && !empty($_POST['remail'])) {

        $title = $_POST['title'];
        $drink = $_POST['drink'];
        $pet = $_POST['pet'];
        $ficPlace = $_POST['ficPlace'];
        $rlPlace = $_POST['rlPlace'];
        $email = $_POST['email'];
        $remail = $_POST['remail'];

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

        $title = substr($title, 0 , 64);
        $drink = substr($drink, 0 , 64);
        $pet = substr($pet, 0 , 64);
        $ficPlace = substr($ficPlace, 0 , 64);
        $rlPlace = substr($rlPlace, 0 , 64);
        $email = substr($email, 0 , 64);
        $remail = substr($remail, 0 , 64);
    
        if (!empty($title) && !empty($drink) && !empty($pet) && !empty($ficPlace) && !empty($rlPlace)) {
            
            $titleLen = strlen($title);
            $drinkLen = strlen($drink);
            $petLen = strlen($pet);
            $ficLen = strlen($ficPlace);
            $realLen = strlen($rlPlace);
            $sentence = "You are " . $title . " " . $drink . " " . $pet . " of ". $ficPlace . " and " . $rlPlace;
            $sentenceLength = strlen($sentence);
            echo $sentenceLength;
            
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
// this kicks off the script
main();