<?php


    function addDosen($data,$conn,$BASE_URL){
        $namaDosen = $data['nama_dosen'];

        if($namaDosen != null){
            $data = [
                'nama_pembimbing' => $namaDosen,

            ];
            $add = create($data,$conn,'tb_pembimbing');
            if($add){
                $_SESSION['message'] = "Data Dosen Pembimbing Berhasil ditambahkan";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Berhasil";
                Redirect($BASE_URL.'dashboard/data-dosen.php');
            }
        }else{
            $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/data-dosen.php');
        }
    }

    function updateDosen($data,$conn,$BASE_URL){
        $namaDosen = $data['nama_dosen'];
        $idPembimbing = $data['id_pembimbing'];


        if($namaDosen != null){
            $data = [
                'nama_pembimbing' => $namaDosen,

            ];
            $where = [
                'id_pembimbing' => $idPembimbing
            ];
            $update = update($data,$where,'tb_pembimbing',$conn);
            if($update){
                $_SESSION['message'] = "Data Dosen Pembimbing Berhasil diperbarui";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Berhasil";
                Redirect($BASE_URL.'dashboard/data-dosen.php');
            }
        }else{
            $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/data-dosen.php');
        }
    }

    function deleteDosen($id,$BASE_URL,$conn){
        $where = [
            'id_pembimbing' => $id
        ];

        $delete = delete('tb_pembimbing',$where,$conn);
        if($delete){
            $_SESSION['message'] = "Data Dosen Berhasil dihapus";
            $_SESSION['type'] = "success";
            $_SESSION['title'] = "Berhasil";
            Redirect($BASE_URL.'dashboard/data-dosen.php');
        }
    }