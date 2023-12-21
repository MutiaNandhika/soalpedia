<?php
    include "../config.php";
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: ../logres.php");
    }
    $tgl = date('Y-m-d');
    $id = $_POST['id'];
    $judul = $_POST['judul'];
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
            $query = "INSERT INTO master_soal (id_kategori, nama_file,id_pemilik, tgl) VALUES ('$id', '$file_baru', '$_SESSION[id]', '$tgl')";
            $result = mysqli_query($mysqli, $query);
            if($result){
                echo "<script>alert('Upload Berhasil');window.location.href='download_materi.php?id=$id';</script>";
            }
            else{
                echo "<script>alert('Upload Gagal, file tidak ditambah ke database');window.location.href='download_materi.php?id=$id';</script>";
            }
        }
        else{
            echo "<script>alert('Upload Gagal, file tidak bisa dipindah');window.location.href='download_materi.php?id=$id';</script>";
        }
    }
    else{
        echo "<script>alert('Upload Gagal, Hanya menerima pdf atau docx ');window.location.href='download_materi.php?id=$id';</script>";
    }
?>