<?php

    function addHasil($data,$conn,$BASE_URL){
        $hasil = $data['hasil'];
        $revisi = $data['revisi'];
        $idPengajuan = $data['id_pengajuan'];
        for($i = 0; $i < count($revisi); $i++){
            $revisian = $revisi[$i];

            $data = [
                'hasil' => $hasil,
                'revisi' => $revisian,
                'id_pengajuan' => $idPengajuan
            ];

            $add = create($data,$conn,'tbl_hasil');
        }
        $dataUpdate = [
            'status_hasil' => 1
        ];
        $where = [
            'id_pengajuan' => $idPengajuan 
        ];
        $update = update($dataUpdate,$where,'tb_jadwal',$conn);
        $_SESSION['message'] = "Hasil Sidang berhasil ditambahkan";
        $_SESSION['type'] = "success";
        $_SESSION['title'] = "Berhasil";
        Redirect($BASE_URL.'dashboard/hasil-sidang.php');
    }

    function changeHasil($data,$conn,$BASE_URL){
        $idPengajuan = $data['id_pengajuan'];
        $hasil = $data['hasil'];
        $revisi = $data['revisi'];
        
        $where = [
            'id_pengajuan' => $idPengajuan
        ];
        delete('tbl_hasil',$where,$conn);
        $newRevisi = array_filter($revisi);
        $newValues = array_values($newRevisi);
        for($i = 0; $i < count($newRevisi); $i++){
            $revisian = $newValues[$i];
            
            $data = [
                'hasil' => $hasil,
                'revisi' => $revisian,
                'id_pengajuan' => $idPengajuan
            ];
            
            $add = create($data,$conn,'tbl_hasil');
            
        }
        $_SESSION['message'] = "Hasil Sidang berhasil diperbarui";
        $_SESSION['type'] = "success";
        $_SESSION['title'] = "Berhasil";
        Redirect($BASE_URL.'dashboard/hasil-sidang.php');
    }