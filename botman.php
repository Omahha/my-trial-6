<?php
   require_once 'vendor/autoload.php';

   use BotMan\BotMan\BotMan;
   use BotMan\BotMan\BotManFactory;
   use BotMan\BotMan\Drivers\DriverManager;
   
   use \Dejurin\GoogleTranslateForFree;

   use \DetectLanguage\DetectLanguage;
   DetectLanguage::setApiKey("87bd89dad3e829243777382a605b2dc2");

   $config = [];

   DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

   $botman = BotManFactory::create($config);

  
$botman->hears('{word}', function ($bot, $word) {
    
        $lang = DetectLanguage::simpleDetect($word);
        $target = "ja";
        $text = $word;
        $t = new GoogleTranslateForFree();
        $result = $t->translate($lang, $target, $text);
    
    $bot->reply($result);
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});

// Start listening
$botman->listen();