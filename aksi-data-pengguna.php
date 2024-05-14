<?php

session_start();
require '../koneksi.php';

if (isset($_POST['tambahData'])) {
    $nik                        = $_POST['nik'];
    $nama_lengkap               = $_POST['nama_lengkap'];
    $username                   = $_POST['username'];
    $password                   = $_POST['password'];
    $alamat_lengkap             = $_POST['alamat_lengkap'];
    $nomor_telepon              = $_POST['nomor_telepon'];
    $tanggal_lahir              = date('Y-m-d', strtotime($_POST['tanggal_lahir']));
    $status_pekerjaan           = $_POST['status_pekerjaan'];
    $jenis_kelamin              = $_POST['jenis_kelamin'];

    $queryInsert = "INSERT INTO lulusan (nik,nama_lengkap,username,password,alamat_lengkap,nomor_telepon,tanggal_lahir,status_pekerjaan,jenis_kelamin,status,level) VALUES ('$nik','$nama_lengkap','$username','$password','$alamat_lengkap','$nomor_telepon','$tanggal_lahir','$status_pekerjaan','$jenis_kelamin','','Lulusan')";
    $queryRun = mysqli_query($conn, $queryInsert);

    if ($queryRun) {
        $_SESSION['message'] = "Data Pengguna Berhasil Ditambahkan";
        $_SESSION['message_code'] = "success";
        header("location: page-data-pengguna.php");
    } else {
        $_SESSION['message'] = "Gagal Membuat Data Pengguna";
        $_SESSION['message_code'] = "error";
        header("Location: page-data-pengguna.php");
    }
}

if (isset($_POST['delete_id'])) {
    $lulusan_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM lulusan WHERE id_lulusan='$lulusan_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Data Pengguna Berhasil Dihapus";
        $_SESSION['message_code'] = "success";
        header("Location: page-data-pengguna.php");
    } else {
        $_SESSION['message'] = "Student Not Deleted";
        $_SESSION['message_code'] = "error";
        header("Location: data-lulusan.php");
    }
}

if (isset($_POST['updateData'])) {
    $id_lulusan                 = $_POST['id_lulusan'];
    $nik                        = $_POST['nik'];
    $nama_lengkap               = $_POST['nama_lengkap'];
    $username                   = $_POST['username'];
    $password                   = $_POST['password'];
    $alamat_lengkap             = $_POST['alamat_lengkap'];
    $nomor_telepon              = $_POST['nomor_telepon'];
    $tanggal_lahir              = date('Y-m-d', strtotime($_POST['tanggal_lahir']));
    $status_pekerjaan           = $_POST['status_pekerjaan'];
    $jenis_kelamin              = $_POST['jenis_kelamin'];
    $skema_pelatihan            = $_POST['skema_pelatihan'];
    $tanggal_mulai_pelatihan    = date('Y-m-d', strtotime($_POST['tanggal_mulai_pelatihan']));
    $tanggal_selesai_pelatihan  = date('Y-m-d', strtotime($_POST['tanggal_selesai_pelatihan']));

    $queryUpdate = "UPDATE lulusan SET id_lulusan = '$id_lulusan', nik = '$nik', nama_lengkap = '$nama_lengkap', username = '$username', password = '$password', alamat_lengkap = '$alamat_lengkap', nomor_telepon = '$nomor_telepon', tanggal_lahir = '$tanggal_lahir', status_pekerjaan = '$status_pekerjaan', jenis_kelamin = '$jenis_kelamin', skema_pelatihan = '$skema_pelatihan', tanggal_mulai_pelatihan = '$tanggal_mulai_pelatihan', tanggal_selesai_pelatihan = '$tanggal_selesai_pelatihan' WHERE id_lulusan = '$id_lulusan'";
    $queryRunUpdate = mysqli_query($conn, $queryUpdate);

    if ($queryRunUpdate) {
        $_SESSION['message'] = "Data Pengguna Berhasil Diupdate";
        $_SESSION['message_code'] = "success";
        header("Location: page-data-pengguna.php");
    } else {
        $_SESSION['message'] = "Gagal Mengupdate Data Pengguna";
        $_SESSION['message_code'] = "error";
        header("Location: page-data-pengguna.php");
    }
}