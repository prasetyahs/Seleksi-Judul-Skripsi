<?php

    include '../proccess/crud.php';
    include '../config/database.php';
    $id = $_GET['id'];
    $getData = readDataPerRow($conn,"SELECT nama_ruang,PB1.id_pembimbing as id_1,PB2.id_pembimbing as id_2,PB1.nama_pembimbing as penguji_1, PB2.nama_pembimbing as penguji_2,id_ruang,tanggal FROM tb_ruang,tb_pembimbing PB1,tb_pembimbing PB2
    WHERE PB1.id_pembimbing = tb_ruang.dosen_1 AND
          PB2.id_pembimbing = tb_ruang.dosen_2 AND
          tb_ruang.id_ruang = '$id'");
    echo json_encode($getData);