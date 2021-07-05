<?php


    function addRuang($data,$conn,$BASE_URL){
        $namaRuang = $data['nama_ruang'];
        $tanggal = $data['tanggal'];
        $penguji_1 = $data['penguji_1'];
        $penguji_2 = $data['penguji_2'];

        if($namaRuang != null && $tanggal != null && $penguji_1 != null && $penguji_2 != null){
            $data = [
                'nama_ruang' => $namaRuang,
                'tanggal' => $tanggal,
                'dosen_1' => $penguji_1,
                'dosen_2' => $penguji_2,

            ];
            $add = create($data,$conn,'tb_ruang');
            if($add){
                $_SESSION['message'] = "Data Ruang Berhasil ditambahkan";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Berhasil";
                Redirect($BASE_URL.'dashboard/data-ruang.php');
            }
        }else{
            $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/data-ruang.php');
        }
    }

    function updateRuang($data,$conn,$BASE_URL){
        $namaRuang = $data['nama_ruang'];
        $tanggal = $data['tanggal'];
        $penguji_1 = $data['penguji_1'];
        $penguji_2 = $data['penguji_2'];
        $id_ruang = $data['id_ruang'];

        if($namaRuang != null && $tanggal != null && $penguji_1 != null && $penguji_2 != null){
            $data = [
                'nama_ruang' => $namaRuang,
                'tanggal' => $tanggal,
                'dosen_1' => $penguji_1,
                'dosen_2' => $penguji_2,

            ];
            $where = [
                'id_ruang' => $id_ruang
            ];
            $update = update($data,$where,'tb_ruang',$conn);
            if($update){
                $_SESSION['message'] = "Data Ruang Berhasil diperbarui";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Berhasil";
                Redirect($BASE_URL.'dashboard/data-ruang.php');
            }
        }else{
            $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/data-ruang.php');
        }
    }

    function deleteRuang($id,$BASE_URL,$conn){
        $where = [
            'id_ruang' => $id
        ];

        $delete = delete('tb_ruang',$where,$conn);
        if($delete){
            $_SESSION['message'] = "Data Ruang Berhasil dihapus";
            $_SESSION['type'] = "success";
            $_SESSION['title'] = "Berhasil";
            Redirect($BASE_URL.'dashboard/data-ruang.php');
        }
    }