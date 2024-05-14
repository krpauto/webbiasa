<?php

session_start();
require "../koneksi.php";

if (isset($_POST['simpanPengumuman'])) {
    $id_pengumuman  = $_POST['id_pengumuman'];
    $id_user        = $_POST['id_user'];
    $judul          = $_POST['judul'];
    $tanggal_upload = $_POST['tanggal_upload'];

    $upload_file    = $_FILES['upload_file']['name'];
    $ukuran_file    = $_FILES['upload_file']['size'];

    // Mengecek apakah file lebih besar 2mb atau tidak
    if ($ukuran_file > 2097152) {
        // Jika file lebih besar dari 2mb maka akan gagal mengupload file
        $_SESSION['message'] = "Ukuran File Terlalu Besar! Max 2 MB";
        $_SESSION['message_code'] = "error";
        header("location: page-data-pengumuman.php");
    } else {
        // Mengecek apakah ada file yang di upload atau tidak
        if ($upload_file != "") {

            // Ekstensi yang hanya diperbolehkan untuk di upload
            $ekstensi_file  = array('png', 'jpg', 'jpeg', 'pdf', 'docx');
            // Memisahkan nama file dengan ekstensinya
            $pisahkan_ekstensi  = explode('.', $upload_file);
            $ekstensi   = strtolower(end($pisahkan_ekstensi));
            // Nama file yang berada di dalam direktori temporer server
            $file_tmp   = $_FILES['upload_file']['tmp_name'];
            // Membuat huruf berdasarkan nama yang di tentukan
            $huruf = "DOK";
            // menyatukan huruf dengan nama file aslinya
            $upload_file_new = $huruf . ' - ' . $upload_file;

            // Mengecek apakah ekstensi file sesuai dengan ekstensi file yang di upload
            if (in_array($ekstensi, $ekstensi_file) === true) {
                // Memindahkan file ke dalam folder files
                move_uploaded_file($file_tmp, "files/" . $upload_file_new);

                // Query 
                $queryInsert = mysqli_query($conn, "INSERT INTO pengumuman VALUES('$id_pengumuman','$id_user','$judul','$tanggal_upload','$upload_file_new')");

                if ($queryInsert) {
                    $_SESSION['message'] = "File Pengumuman Berhasil Ditambahkan!";
                    $_SESSION['message_code'] = "success";
                    header("location:page-data-pengumuman.php");
                } else {
                    $_SESSION['message'] = "File Pengumuman Gagal Ditambahkan!";
                    $_SESSION['message_code'] = "error";
                    header("location: page-data-pengumuman.php");
                }
            } else {
                $_SESSION['message'] = "File Ekstensi Yang Di Upload Tidak Diperbolehkan!";
                $_SESSION['message_code'] = "error";
                header("location: page-data-pengumuman.php");
            }
        } else {
            // Apabila tidak ada file yang di upload maka query di bawah ini akan dijalankan
            $queryInsert = mysqli_query($conn, "INSERT INTO pengumuman VALUES('$id_pengumuman','$id_user','$judul','$tanggal_upload')");

            if ($queryInsert) {
                $_SESSION['message'] = "File Pengumuman Berhasil Ditambahkan!";
                $_SESSION['message_code'] = "success";
                header("location:page-data-pengumuman.php");
            } else {
                $_SESSION['message'] = "File Pengumuman Gagal Ditambahkan!";
                $_SESSION['message_code'] = "error";
                header("location: page-data-pengumuman.php");
            }
        }
    }
}

if (isset($_POST['updatePengumuman'])) {

    if ($_POST['id_pengumuman'] != "") {
        // Mengambil data dari form lalu ditampung didalam variabel
        $id_pengumuman  = $_POST['id_pengumuman'];
        $id_user        = $_POST['id_user'];
        $judul          = $_POST['judul'];
        $tanggal_upload = $_POST['tanggal_upload'];

        $upload_file    = $_FILES['upload_file']['name'];
        $ukuran_file    = $_FILES['upload_file']['size'];
    } else {
        header("location: page-data-pengumuman.php");
    }

    // Mengecek apakah file lebih besar 2mb atau tidak
    if ($ukuran_file > 1044070) {
        // Jika file lebih besar dari 1mb maka akan gagal mengupload file
        $_SESSION['message'] = "Ukuran File Terlalu Besar!";
        $_SESSION['message_code'] = "error";
        header("location: page-data-pengumuman.php");
    } else {
        // Mengecek apakah ada file yang diupload atau tidak
        if ($upload_file != "") {
            // ekstensi file yang diperbolehkan untuk diupload 
            $ekstensi_file  = array('jpg', 'jpeg', 'png');
            // memisahkan nama file dengan ekstensinya
            $x              = explode('.', $upload_file);
            $ekstensi       = strtolower(end($x));
            // nama file yang berada di dalam direktori temporer server
            $file_tmp       = $_FILES['upload_file']['tmp_name'];
            // Membuat huruf berdasarkan nama yang di tentukan
            $huruf = "DOK";
            // menyatukan huruf dengan nama file aslinya
            $upload_file_new = $huruf . ' - ' . $upload_file;

            if (in_array($ekstensi, $ekstensi_file) === true) {

                $get_pdf = "SELECT file FROM pengumuman WHERE id_pengumuman='$id_pengumuman'";
                $data_pdf = mysqli_query($conn, $get_pdf);
                // Mengubah data yang diambil menjadi array
                $pdf_lama = mysqli_fetch_array($data_pdf);

                // Menghapus pdf lama di dalam folder pdf
                unlink("files/" . $pdf_lama['file']);
                // Memindahkan file pdf ke dalam folder "files"
                move_uploaded_file($file_tmp, "files/" . $upload_file_new);

                // Query update
                $queryUpdate = mysqli_query($conn, "UPDATE pengumuman SET judul='$judul', tanggal_upload='$tanggal_upload', file='$upload_file_new' WHERE id_pengumuman='$id_pengumuman'");

                // mengecek apakah data gagal di input atau tidak
                if ($queryUpdate) {
                    $_SESSION['message'] = "File Pengumuman Berhasil Diupdate!";
                    $_SESSION['message_code'] = "success";
                    header("location:page-data-pengumuman.php");
                } else {
                    $_SESSION['message'] = "File Gagal Di Upload!";
                    $_SESSION['message_code'] = "error";
                    header("location: page-data-pengumuman.php");
                }
            } else {
                $_SESSION['message'] = "File Ekstensi Yang Di Upload Tidak Diperbolehkan!";
                $_SESSION['message_code'] = "error";
                header("location: page-data-pengumuman.php");
            }
        } else {
            // Query update
            $queryUpdate = mysqli_query($conn, "UPDATE pengumuman SET judul='$judul', tanggal_upload='$tanggal_upload' WHERE id_pengumuman='$id_pengumuman'");

            // mengecek apakah data gagal di input atau tidak
            if ($queryUpdate) {
                $_SESSION['message'] = "File Pengumuman Berhasil Diupdate!";
                $_SESSION['message_code'] = "success";
                header("location:page-data-pengumuman.php");
            } else {
                $_SESSION['message'] = "File Gagal Di Upload!";
                $_SESSION['message_code'] = "error";
                header("location: page-data-pengumuman.php");
            }
        }
    }
} else {
    header("location: page-data-pengumuman.php");
}

if (isset($_POST['delete_btn_set'])) {
    $del_id = $_POST['delete_id'];

    // Mengambil data file di dalam table pengumuman
    $get_pdf    = "SELECT file FROM pengumuman WHERE id_pengumuman='$del_id'";
    $data_pdf   = mysqli_query($conn, $get_pdf);
    // Mengubah data yang diambil menjadi array
    $pdf_lama   = mysqli_fetch_array($data_pdf);

    // Menghapus file pdf lama di dalam folder files
    unlink("files/" . $pdf_lama['file']);

    // Query delete
    $queryDelete = mysqli_query($conn, "DELETE FROM pengumuman WHERE id_pengumuman='$del_id'");

    // $queryDelete = "DELETE FROM pengumuman WHERE id_pengumuman = '$del_id' ";
    // $queryDeleteRun = mysqli_query($conn, $queryDelete);
}
