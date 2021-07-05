<?php



function addData($data, $conn, $BASE_URL){
    $firstName = $data['first_name'];
    $lastName = $data['last_name'];
    $email = $data['email'];
    $password = $data['password'];
    $confirmPassword = $data['confirm_password'];
    $nim = $data['nim'];
    $angkatan = $data['angkatan'];
    $semester = $data['semester'];

    if ($firstName != null && $lastName && $email != null && $password != null && $confirmPassword != null) {
        if ($confirmPassword == $password) {
            $cekDataEmail = getDataRow("SELECT * FROM tbl_users WHERE email = '$email'", $conn);
            // var_dump($cekDataEmail == null);die;
            if ($cekDataEmail == null) {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $addData = "INSERT INTO tbl_users (first_name,last_name,email,password,role,nim,semester,angkatan) VALUES('$firstName','$lastName','$email','$hashPassword',0,'$nim','$semester','$angkatan')";
                $execQuery = mysqli_query($conn, $addData);
                // var_dump($execQuery);die;
                if (mysqli_affected_rows($conn) == 1) {
                    $_SESSION['message'] = "Selamat, akun anda berhasil didaftarkan";
                    $_SESSION['type'] = "success";
                    $_SESSION['title'] = "Success";
                    header("Location: " . $BASE_URL . "register.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Mohon maaf, Ada kesalahan saat proses pendaftaran !";
                    $_SESSION['type'] = "info";
                    $_SESSION['title'] = "Info";
                    header("Location: " . $BASE_URL . "register.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = "Mohon maaf, Email yang Anda input sudah digunakan !";
                $_SESSION['type'] = "info";
                $_SESSION['title'] = "Info";
                header("Location: " . $BASE_URL . "register.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Mohon maaf, Password yang anda masukan tidak cocok !";
            $_SESSION['type'] = "warning";
            $_SESSION['title'] = "Warning";
            header("Location: " . $BASE_URL . "register.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        header("Location: " . $BASE_URL . "register.php");
        exit();
    }
}

function updateData($conn,$data,$BASE_URL){
    $firstName = $data['first_name'];
    $lastName = $data['last_name'];
    $jk = $data['jk'];
    $angkatan = $data['angkatan'];
    $idUsers = $data['id_users'];
    if($firstName != null && $lastName != null && $jk != null && $angkatan != null){
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'jk'        => $jk,
            'angkatan'  => $angkatan
        ];
        $where = [
            'id_users' => $idUsers
        ];

        $update =  update($data,$where,'tbl_users',$conn);
        if($update){
            $_SESSION['message'] = "Data Mahasiswa berhasil diperbarui";
            $_SESSION['type'] = "success";
            $_SESSION['title'] = "Sukses";
            Redirect($BASE_URL.'dashboard/data-mahasiswa.php');
        }else{
            $_SESSION['message'] = "Mohon Maaf, terdapat kesalahan saat memperbarui data !";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/data-mahasiswa.php');
        }

    }else{
        $_SESSION['message'] = "Mohon lengkapi data !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        Redirect($BASE_URL.'dashboard/data-mahasiswa.php');
    }
}

function deleteData($conn,$id,$BASE_URL){
    $where = [
        "id_users" => $id
    ];
    $delete = delete('tbl_users',$where,$conn);
    if($delete){
        $_SESSION['message'] = "Data Mahasiswa berhasil dihapus";
        $_SESSION['type'] = "success";
        $_SESSION['title'] = "Sukses";
        Redirect($BASE_URL.'dashboard/data-mahasiswa.php');
    }
}

function getDataRow($query, $conn){
    $execQuery = mysqli_query($conn, $query);
    $data =  mysqli_fetch_assoc($execQuery);
    return $data;
}

function proccessLogin($data, $conn, $BASE_URL){
    $email = $data['email'];
    $password = $data['password'];

    if ($email != null && $password != null) {
        $cekDataEmail = getDataRow("SELECT * FROM tbl_users WHERE email = '$email'", $conn);
        if ($cekDataEmail != null) {
            if (password_verify($password, $cekDataEmail['password'])) {
                $role = $cekDataEmail['role'];
                if ($role > 0) {
                    $_SESSION['users_data'] = $cekDataEmail;
                    $_SESSION['admin'] = true;
                    header("Location: " . $BASE_URL . 'dashboard/index.php');
                    exit();
                } else {
                    $_SESSION['users_data'] = $cekDataEmail;
                    $_SESSION['admin'] = false;
                    header("Location: " . $BASE_URL . 'dashboard/index.php');
                    exit();
                }
            } else {
                $_SESSION['message'] = "Mohon maaf, password yang Anda input tidak cocok !";
                $_SESSION['type'] = "error";
                $_SESSION['title'] = "Warning";
                header("Location: " . $BASE_URL);
                exit();
            }
        } else {
            $_SESSION['message'] = "Mohon maaf, akun Anda tidak dapat ditemukan !";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            header("Location: " . $BASE_URL);
            exit();
        }
    } else {
        $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        header("Location: " . $BASE_URL);
        exit();
    }
}

function changeProfile($data, $image, $conn, $BASE_URL){
    $firstName = $data['first_name'];
    $lastName = $data['last_name'];
    $fullName = $firstName . ' ' . $lastName;
    $angkatan = $data['angkatan'];
    $semester = $data['semester'];
    $email = $data['email'];
    $jk = $data['jk'];
    $address = $data['address'];
    $files = $image['image']['name'];
    $sessionUsers = $_SESSION['users_data']['id_users'];
    if ($firstName != null && $lastName != null && $angkatan != null && $jk != null && $address != null) {
        $allowExt = ['png', 'jpg', 'jpeg'];
        $exploadFile = explode('.', $files);
        $extension = strtolower(end($exploadFile));
        $fileTmp = $image['image']['tmp_name'];
        $locationUpload = '../assets/image/';
        $cekPhoto = getDataRow("SELECT * FROM tbl_users WHERE id_users = '$sessionUsers'", $conn);
        if ($files != null) {
            $files = $files;
            if (in_array($extension, $allowExt) == true) {
                move_uploaded_file($fileTmp, $locationUpload . $files);
                $query = "UPDATE tbl_users SET first_name = '$firstName',
                                                last_name = '$lastName',
                                                angkatan = '$angkatan',
                                                jk = '$jk',
                                                address = '$address',
                                                image = '$files',
                                                semester = '$semester',
                                                email = '$email'
                                                WHERE id_users = '$sessionUsers'";
                $execQuery = mysqli_query($conn, $query);
                $getDataUsers = getDataRow("SELECT * FROM tbl_users WHERE id_users = '$sessionUsers'",$conn);
                $_SESSION['users_data'] = $getDataUsers;
                if ($execQuery) {
                    $_SESSION['message'] = "Data diri Anda berhasil diperbarui";
                    $_SESSION['type'] = "success";
                    $_SESSION['title'] = "Success";
                // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
                    Redirect($BASE_URL.'dashboard/profile.php');
                } else {
                    $_SESSION['message'] = "Mohon maaf, Data diri Anda gagal diperbarui !";
                    $_SESSION['type'] = "error";
                    $_SESSION['title'] = "Warning";
                    // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
                    Redirect($BASE_URL.'dashboard/profile.php');
                }
            } else {
                $_SESSION['message'] = "Mohon maaf, Silahkan input foto dengan extensi yang benar !";
                $_SESSION['type'] = "error";
                $_SESSION['title'] = "Warning";
                // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
                Redirect($BASE_URL.'dashboard/profile.php');
            }
        } else {
            $files = $cekPhoto['image'];
            $query = "UPDATE tbl_users SET first_name = '$firstName',
                                                last_name = '$lastName',
                                                angkatan = '$angkatan',
                                                jk = '$jk',
                                                address = '$address',
                                                image = '$files'
                                                WHERE id_users = '$sessionUsers'";
            $execQuery = mysqli_query($conn, $query);
            if ($execQuery) {
                $_SESSION['message'] = "Data diri Anda berhasil diperbarui";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Success";
                // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
                Redirect($BASE_URL.'dashboard/profile.php');
            } else {
                $_SESSION['message'] = "Mohon maaf, Data diri Anda gagal diperbarui !";
                $_SESSION['type'] = "error";
                $_SESSION['title'] = "Warning";
                // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
                Redirect($BASE_URL.'dashboard/profile.php');
            }
        }
    } else {
        $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        // echo "<script>window.location.href = '$BASE_URL'dashboard/profile.php;</script>";
        Redirect($BASE_URL.'dashboard/profile.php');
    }
}

function changePassword($data,$conn,$BASE_URL){
    $oldPassword = $data['old_password'];
    $newPassword = $data['new_password'];
    $confirmPassword = $data['confirm_password'];
    $sessionUsers = $_SESSION['users_data']['id_users'];
    if($oldPassword != null && $newPassword != null && $confirmPassword != null){
        $checkPassword = getDataRow("SELECT * FROM tbl_users WHERE id_users = '$sessionUsers'",$conn);
        $dataPassword = $checkPassword['password'];
        if(password_verify($oldPassword,$dataPassword)){
            if($confirmPassword == $newPassword){
                $hashPassword = password_hash($newPassword,PASSWORD_DEFAULT);
                $query = "UPDATE tbl_users SET password = '$hashPassword' WHERE id_users = '$sessionUsers'";
                $execQuery = mysqli_query($conn,$query);
                if($execQuery){
                    $_SESSION['message'] = "Password Anda berhasil diperbarui !";
                    $_SESSION['type'] = "success";
                    $_SESSION['title'] = "Success";
                    Redirect($BASE_URL.'dashboard/profile.php');
                    exit();
                }else{
                    $_SESSION['message'] = "Mohon maaf, Password Anda gagal diperbarui";
                    $_SESSION['type'] = "error";
                    $_SESSION['title'] = "Warning";
                    Redirect($BASE_URL.'dashboard/profile.php');
                    exit();
                }
            }else{
                $_SESSION['message'] = "Mohon maaf, Password Baru Anda tidak cocok dengan konfirmasi Password !";
                $_SESSION['type'] = "error";
                $_SESSION['title'] = "Warning";
                Redirect($BASE_URL.'dashboard/profile.php');
                exit();
            }
        }else{
            $_SESSION['message'] = "Mohon maaf, Password lama Anda tidak cocok !";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Warning";
            Redirect($BASE_URL.'dashboard/profile.php');
            exit();
        }
    }else{
        $_SESSION['message'] = "Mohon maaf, Data tidak boleh kosong !";
        $_SESSION['type'] = "error";
        $_SESSION['title'] = "Warning";
        Redirect($BASE_URL.'dashboard/profile.php');
        exit();
    }
}


