<?php

    $BASE_URL = 'http://localhost/seleksiskripsi/';

    function Redirect($url, $permanent = false){
        // header('Location: ' . $url, true, $permanent ? 301 : 302);
        echo "<script>window.location.href = '$url';</script>";
        exit(0);
    }