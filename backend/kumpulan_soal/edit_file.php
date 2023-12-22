<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $mapel = $_POST['mapel'];
    $kategori= $_POST['kategori'];
    $tgl = date('Y-m-d');
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    if(($_FILES['file']['name']!="")){
        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $ext = explode('.', $file);
        $ext = end($ext);
        $ext = strtolower($ext);
        $ext_boleh = array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx');
        $file_baru = $_POST['judul'];
        $file_baru .= '.';
        $file_baru .= $ext;
        $path = '../file_soal/';
        $path .= $file_baru;
        if(in_array($ext, $ext_boleh)){
            if(move_uploaded_file($tmp, $path)){
                $query = "UPDATE master_soal SET nama_file = '$file_baru', tgl = '$tgl' WHERE id = $id";
                $result = mysqli_query($mysqli, $query);
                if($result){
                    echo "<script>alert('Upload Berhasil');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
                }
                else{
                    echo "<script>alert('Upload Gagal, file tidak ditambah ke database');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
                }
            }
            else{
                echo "<script>alert('Upload Gagal, file tidak bisa dipindah');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
            }
        }
        else{
            echo "<script>alert('Upload Gagal, Hanya menerima pdf atau docx ');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
        }
    } else {
        // If the file is not uploaded, then only update the title and the filename
        $select = "SELECT nama_file FROM master_soal WHERE id = $id";
        $result_select = mysqli_query($mysqli, $select);
        $row_select = mysqli_fetch_assoc($result_select);
        $file = $row_select['nama_file'];
        $ext = explode('.', $file);
        $ext = end($ext);
        $query = "UPDATE master_soal SET nama_file = '$judul', tgl = '$tgl' WHERE id = $id";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            $path = '../file_soal/' . $file;
            $new_file_baru = $judul. '.' . $ext; // You can customize the filename generation logic here
            $new_path = '../file_soal/' . $new_file_baru;
            
            // Rename the file on the server
            if (file_exists($path) && rename($path, $new_path)) {
                $query_update_filename = "UPDATE master_soal SET nama_file = '$new_file_baru', tgl = '$tgl' WHERE id = $id";
                $result_update_filename = mysqli_query($mysqli, $query_update_filename);
                if ($result_update_filename) {
                    echo "<script>alert('Update Berhasil');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
                } else {
                    echo "<script>alert('Update Gagal, file tidak diubah di database');window.location.href='download_materi.php?id=$kategori&mapel=$mapel&mapel=$mapel';</script>";
                }
            } else {
                echo "<script>alert('Update Gagal, file tidak dapat direname di server');window.location.href='download_materi.php?id=$kategori&mapel=$mapel';</script>";
            }
        } else {
            echo "<script>alert('Update Gagal, data tidak diubah di database');window.location.href='download_materi.php?id=$$kategori&mapel=$mapel';</script>";
        }
    }
    
?>