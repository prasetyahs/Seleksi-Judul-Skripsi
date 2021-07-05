<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/seleksiskripsi/vendor/autoload.php';
include 'config/database.php';

use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Clustering\KMeans;

function stemmingJudul($input)
{
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $dictionary = $stemmerFactory->createDefaultDictionary();
    $dictionary->addWordsFromTextFile($_SERVER['DOCUMENT_ROOT'] . '/seleksiskripsi/stopword.txt');
    $stemmer = new \Sastrawi\Stemmer\Stemmer($dictionary);

    return $stemmer->stem($input); //internet
}

function stopwordJudul($input)
{
    $remover = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
    $r = $remover->createStopWordRemover();
    $removeData = ($r->remove($input));
    return $removeData;
}

function tokenizerData($samples)
{
    $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
    $vectorizer->fit($samples);
    $vectorizer->transform($samples);
    return $samples;
}

function tfidTransform($samples)
{
    $transformer = new TfIdfTransformer($samples);
    $transformer->transform($samples);
    return $samples;
}

// $fp = fopen("result_data_preprocessing.csv", 'w');
$row = 1;
$dataExtract  = [];
if (($handle = fopen("datasetfull.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count(array_unique($data));
        $row++;
        for ($c = 0; $c < $num; $c++) {
            $stop = stopwordJudul(strtolower($data[$c]));
            $output = stemmingJudul($stop);
            array_push($dataExtract, ["judul_skripsi" => $data[$c], "text_preprocessing" => $output]);
        }
    }
    fclose($handle);
    // fclose($fp);
}

$judulSkripsi = [];
foreach ($dataExtract as $data) {
    array_push($judulSkripsi, $data['text_preprocessing']);
    print($data['text_preprocessing']."<br>\n");
    // fputcsv($fp, $data['text_preprocessing']);
    // $dataJudul = [
    //     "judul_skripsi" =>$data['judul_skripsi'],
    //     "text_preprocessing" => $data['text_preprocessing'],
    //     "label" => 0,
    //     "proposal"=>"test"
    // ];

    // $insertJudul = create($dataJudul, $conn, 'tbl_judul_skripsi');
}
$resultTextTokenizing = tokenizerData($judulSkripsi);
// $X = tfidTransform($resultTextTokenizing);
// $kmeans = new KMeans(10);
// $result = $kmeans->cluster($X);


//Write fields
// foreach ($judulSkripsi as $fields) {
//     // print_r($fields);
//     fputcsv($fp, $fields);
// }