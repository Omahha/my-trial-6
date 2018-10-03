<?php
   require_once 'vendor/autoload.php';
   
   use \Dejurin\GoogleTranslateForFree;

    $source = 'en';
    $target = 'ja';
    $attemps = 5;

    $text = $_POST["inputText"];
    $translate = new GoogleTranslateForFree();
    $result = $translate->translate($source, $target, $text, $attemps);
    
header("Location: index.php?result=".$result);
exit;