<?php

function resultDataPengajuan($conn, $id_user)
{
    $query = "SELECT * FROM tb_pengajuan JOIN tb_pembimbing on tb_pengajuan.id_pembimbing = tb_pembimbing.id_pembimbing JOIN tbl_judul_skripsi ON tb_pengajuan.id_judul = tbl_judul_skripsi.id_judul WHERE id_user='$id_user'";
    $execQuery = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    return $result;
}

function periode()
{
    $get_month = (int) date("m");
    $get_year = (int)date('Y');
    if ($get_month >= 9 && $get_month <= 12) {
        return "Periode Gasal ( " . $get_year . "- " . intval($get_year + 1) . ")";
    } else {
        return "Periode Genap ( " . $get_year . "- " . intval((int)$get_year + 1) . ")";
    }
}

function deletePengajuan($conn, $BASE_URL, $id){
    $where = [
        'id_pengajuan' => $id
    ];
    $delete = delete('tb_pengajuan', $where, $conn);
    if ($delete) {
        $_SESSION['message'] = "Data Pengajuan skripsi berhasil dihapus";
        $_SESSION['type'] = "success";
        $_SESSION['title'] = "Success";
        // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
        Redirect($BASE_URL . 'dashboard/data-skripsi.php');
   }
}

function addJadwal($data,$conn,$BASE_URL){
    $idRuang = $_POST['ruang'];
    $idPengajuan = $_POST['id_pengajuan'];

    if($idRuang != null){
        $data = [
            'id_ruang' => $idRuang,
            'id_pengajuan' => $idPengajuan
        ];
        $dataUpdate = [
            'status_jadwal' => 1
        ];
        $where = [
            'id_pengajuan' => $idPengajuan
        ];
        update($dataUpdate,$where,'tb_pengajuan',$conn);
        $add = create($data,$conn,'tb_jadwal');
        if($add){
            $_SESSION['message'] = "Data Pengajuan Sidang berhasil dijadwalkan !";
            $_SESSION['type'] = "success";
            $_SESSION['title'] = "Success";
            // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
            Redirect($BASE_URL . 'dashboard/buat-jadwal.php');
        }
    }else{
        $_SESSION['message'] = "Mohon maaf, tolong lengkapi form data.";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning !";
        // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
        Redirect($BASE_URL . 'dashboard/buat-jadwal.php');
    }
}