<?php

    include '../proccess/crud.php';
    include '../config/database.php';
    $id = $_GET['id'];
    $getData = readDataAllRow($conn,"SELECT * FROM tbl_hasil WHERE id_pengajuan = '$id'");
    echo json_encode($getData);