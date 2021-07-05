<?php
include '../proccess/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/seleksiskripsi/vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;

//paggination
$endNumber = 7;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = ($page > 1) ? ($page * $endNumber) - $endNumber : 0;
$numData = $limit + 1;
$previous = $page - 1;
$next = $page + 1;

function fetchJudulSkripsi($conn, $limit, $end)
{
    $query = "SELECT * FROM tbl_judul_skripsi limit $limit,$end";
    $execQuery = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    return $result;
}

function fetchAllJudulSkripsi($conn)
{
    $query = "SELECT * FROM tbl_judul_skripsi";
    $execQuery = mysqli_query($conn, $query);
    $result = mysqli_num_rows($execQuery);
    return $result;
}

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


function resultSearch($conn, $label)
{
    $query = "SELECT * FROM tbl_judul_skripsi where label = '$label'";
    $execQuery = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    return $result;
}


function textPreprocessing($input)
{
    $input = stemmingJudul($input[0]);
    $input = [stopwordJudul($input)];
    return $input;
}

$vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
function vectorCount($dataSample)
{
    $GLOBALS['vectorizer']->fit($dataSample);
    $GLOBALS['vectorizer']->transform($dataSample);
    return $dataSample;
}
$transformer;
function tfIDTransform($dataSample)
{
    $GLOBALS['transformer'] = new TfIdfTransformer($dataSample);
    $GLOBALS['transformer']->transform($dataSample);
    return $dataSample;
}

function processMetode($conn, $input)
{

    $allData = fetchJudulSkripsi($conn, 0, fetchAllJudulSkripsi($conn));
    $dataSample = [];
    $dataLabel = [];
    foreach ($allData as $sample) {
        array_push($dataSample, $sample['text_preprocessing']);
        array_push($dataLabel, $sample['label']);
    }

    //text preprocessing
    $dataSample = vectorCount($dataSample);
    $dataSample = tfIDTransform($dataSample);

    //pembobotan text 
    $GLOBALS['vectorizer']->transform($input);
    $GLOBALS['transformer']->transform($input);

    //test prediction
    $classifier = new KNearestNeighbors(5);
    $classifier->train($dataSample, $dataLabel);
    $predict =  $classifier->predict($input)[0];
    return $predict;
}

function searchJudulSkripsi($conn)
{
    $input = [$_POST['judul_skripsi']];
    $input = textPreprocessing($input);
    $resultSearch = resultSearch($conn, processMetode($conn, $input));
    return $resultSearch;
}

function resultSearchWithPresentase($conn, $BASE_URL)
{
    $resultSearch = searchJudulSkripsi($conn);
    $search = $_POST['judul_skripsi'];
    $filtered = str_replace(' ', '', $search);
    if ($filtered != null) {
        foreach ($resultSearch as $key => $d) {
            similar_text(str_replace(' ', '', strtolower($d['judul_skripsi'])), str_replace(' ', '', strtolower($_POST['judul_skripsi'])), $percent);;
            $d['presentasi'] = (int) $percent;
            $resultSearch[$key] = $d;
        }
        usort($resultSearch, function ($a, $b) {
            return $b['presentasi'] - $a['presentasi'];
        });
        return $resultSearch;
    } else {
        $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        Redirect($BASE_URL . 'dashboard/cari-jurnal.php');
    }
}



function addDataSkripsi($conn, $BASE_URL, $id_user)
{

    $input = [$_POST['judul_skripsi']];
    $input = textPreprocessing($input);
    $textPreprocessing = $input[0];
    $predict = processMetode($conn, $input);
    $resultSearch = searchJudulSkripsi($conn, $predict);
    $percent = 0;
    foreach ($resultSearch as $key => $d) {
        similar_text(str_replace(' ', '', strtolower($d['judul_skripsi'])), str_replace(' ', '', strtolower($_POST['judul_skripsi'])), $percent);;
        $d['presentasi'] = (int) $percent;
        $resultSearch[$key] = $d;
    }
    $dataPersentaseMirip =  array_filter($resultSearch, function ($var) {
        return ($var['presentasi'] > 75);
    });
    if (empty($dataPersentaseMirip)) {
        $fileProposal = $_FILES['proposal']['name'];
        $allowExt = ['pdf', 'doc', 'docx'];
        $exploadFile = explode('.', $fileProposal);
        $extension = strtolower(end($exploadFile));
        $fileTmp = $_FILES['proposal']['tmp_name'];
        $locationUpload = '../assets/proposal/';
        if (!empty($_POST['judul_skripsi']) && !empty($_POST['studi_kasus']) && !empty($_POST['angkatan']) && !empty($_POST['pembimbing']) && !empty($fileProposal)) {
            print("data ga koosong");
            $fileProposal = $id_user . "-proposal" . $fileProposal;
            if (in_array($extension, $allowExt) == true) {
                move_uploaded_file($fileTmp, $locationUpload . $fileProposal);
                $dataJudul = [
                    "judul_skripsi" => $_POST['judul_skripsi'],
                    "text_preprocessing" => $textPreprocessing,
                    "label" => $predict,
                    "proposal" => $fileProposal,
                    "studi_kasus" => $_POST['studi_kasus']
                ];
                $ex = create($dataJudul, $conn, 'tbl_judul_skripsi');
                $dataPengajuan = [
                    'id_user' => $id_user,
                    'id_pembimbing' => $_POST['pembimbing'],
                    'id_judul' => $conn->insert_id,
                    'tanggal_pengajuan' => date("Y-m-d"),
                    'status' => 0,
                    'periode'=>$_POST['periode']
                ];
                $insertTablePengajuan = create($dataPengajuan, $conn, 'tb_pengajuan');
                if ($ex && $insertTablePengajuan) {
                    $_SESSION['message'] = "Selamat, Judul Skripsi Anda Diterima Oleh Sistem";
                    $_SESSION['type'] = "success";
                    $_SESSION['title'] = "Success";
                    Redirect($BASE_URL . 'dashboard/daftar-skripsi.php');
                } else {
                    Redirect($BASE_URL . 'dashboard/daftar-skripsi.php');
                }
            } else {
                $_SESSION['message'] = "File proposal tidak sesuai";
                $_SESSION['type'] = "error";
                $_SESSION['title'] = "Warning";
                Redirect($BASE_URL . 'dashboard/daftar-skripsi.php');
            }
        } else {
            $_SESSION['message'] = "Mohon maaf, untuk pendaftaran skripsi isi data dengan lengkap";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL . 'dashboard/daftar-skripsi.php');
        }
    } else {
        $_SESSION['message'] = "Mohon maaf, Judul skripsi anda tidak diterima oleh sistem. silahkan cek di cari jurnal";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        Redirect($BASE_URL . 'dashboard/daftar-skripsi.php');
        return $dataPersentaseMirip;
    }
}