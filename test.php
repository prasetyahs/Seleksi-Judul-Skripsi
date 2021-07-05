
<?php

// include composer autoloader
require_once __DIR__ . '/vendor/autoload.php';


// create stemmer
// cukup dijalankan sekali saja, biasanya didaftarkan di service container
$remover = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
$stopWord = $remover->getStopWords();
$r = $remover->createStopWordRemover();
$removeData = $r->remove('Perancangan');

// echo $removeData;

$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$dictionary = $stemmerFactory->createDefaultDictionary();
$dictionary->addWordsFromTextFile(__DIR__ . '/stopword.txt');


$stemmer = new \Sastrawi\Stemmer\Stemmer($dictionary);

var_dump($stemmer->stem($removeData)); //internet
