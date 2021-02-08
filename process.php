<?php
/*
 * your comment header here
 */

//this will load the mustache template library
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

// these lines load your header, footer, and body template into strings
$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/result.html');
$footer = file_get_contents('templates/footer.html');

/*
 * the following three lines of code set up your PAGE SPECIFIC variables
 * these will be different page to page. page specific data is loaded into
 * an associative array where the key is used by Mustache as a {{variable}}
 * and the value is inserted into the page (see the template examples).
 */

// this will be used to send the page title into the page
// you can add more things to send if you like
$header_data = ["pagetitle" => "Code03 Michael Perron", "logo" => "Code03", "home" => HOME,
                "form" => FORM];

// notice this holds mixed numeric and string data,
// you can do this in a loosly typed language like PHP
// you can add more things to send if you like
$body_data = [  "notVal" => $notValid,
                "sentence" => $sentence,
                "sentence" => $sentence,
                "titleSentence"=> $titleSentence,
                "drinkSentence"=> $drinkSentence,
                "petSentence" => $petSentence,
                "ficSentence" => $ficSentence,
                "rlSentence" => $rlSentence,
                "sizeOfSentence" => $sizeOfSentence,
                "bigTitle" => $bigTitle,
                "smallTitle" => $smallTitle];


                echo '<div id="response">' .$sentence. '</div>' ;


//this is being used to send a footer title and local time to the footer
// you can add more things to send if you like
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

if (!empty($title) && !empty($drink) && !empty($pet) && !empty($ficPlace) && !empty($rlPlace)) {
/* * *************************************************************************
* STEP 3 and 4: PROCESSING and OUTPUT: Notice this code only executes
* if you have valid data from steps 1 and 2. Your code must always have
* a saftey feature similar to this.
* Do not delete this comment.
* ************************************************************************ */                
   $sentence = "You are " . $title . " " . $drink . " " . $pet . " of ". $ficPlace . " and " . $rlPlace;
    echo sprintf('You are %s %s %s of %s and  %s.',
    $title,
    $drink,
    $pet,
    $ficPlace,
    $rlPlace);

        $titleLen = strlen($title);
        if ($titleLen > 0) {
           echo $titleSentence = $title. " is " . $titleLen . " characters.";
        }

        $drinkLen = strlen($drink);
        if ($drinkLen > 0) {
            echo $drinkSentence = $drink. " is " . $drinkLen . " characters.";
        }
        
        $petLen = strlen($pet);
        if ($petLen > 0) {
            echo $petSentence = $pet. " is " . $petLen . " characters.";
        }

        $ficLen = strlen($ficPlace);
        if ($ficLen > 0) {
            echo $ficSentence = $ficPlace. " is " . $ficLen . " characters.";
        }

        $realLen = strlen($rlPlace);
        if ($realLen > 0) {
            echo $rlSentence = $rlPlace. " is " . $realLen . " characters.";
        }

        $sentenceLength = strlen($sentence);
        echo $sizeOfSentence = "Length of the whole title (including spaces): " .$sentenceLength;

        if($sentenceLength > 30){
            echo $bigTitle = "That’s a heck of a title!​";
        }

        if($sentenceLength < 30){
            echo $smallTitle = "That’s a cute little title.";
        }
        // echo '<a href="form.php">try again</a><br>';
    
}
else {
    // echo '<div class="bg">';
    $notValid = "I’m sorryy, your input was not valid.";
    echo sprintf('%s', $notValid);

        
        // echo '<a href="form.php">try again</a><br>';
    
}


// , "titleDesc" => "title",
//         "drinkDesc" => "favorite drink", "petDesc" => "pet name",
//         "ficDesc" => "fictional place", "rlDesc" => "real place"];



/*
 * this combines the variables with the templates and creates a complete web page.
 * each page can now have the same header and footer style with different variables
 * such as page title. in this way we can use a sigle header and footer template
 * for all pages, and only worry about changing the body from page to page.
 */
echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $body_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;








