<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $kategori = $_GET['kategori'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM master_soal WHERE id_kategori = $id";
        $file = mysqli_query($mysqli, $query);
        
        if ($file) {
            $row = mysqli_fetch_assoc($file);
            $filePath = '../file_soal/' . $row['nama_file'];
            
            // Delete file from the database
            $deleteQuery = "DELETE FROM master_soal WHERE id_kategori = $id";
            mysqli_query($mysqli, $deleteQuery);
            
            // Delete file from the path
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $query_soal = "select * from soal where id_kategori = $id";
        $nullify = "UPDATE soal SET jawaban = NULL WHERE id_kategori = $id";
        mysqli_query($mysqli, $nullify);
        $soal = mysqli_query($mysqli, $query_soal);
        while ($row = mysqli_fetch_assoc($soal)) {
            $id_soal = $row['id'];
            $query_pilihan = "select * from pilihan where id_soal = $id_soal";
            $pilihan = mysqli_query($mysqli, $query_pilihan);
            while ($row = mysqli_fetch_assoc($pilihan)) {
                $id_pilihan = $row['id'];
                $delete_pilihan = "DELETE FROM pilihan WHERE id = $id_pilihan";
                mysqli_query($mysqli, $delete_pilihan);
            }
            $delete_soal = "DELETE FROM soal WHERE id = $id_soal";
            mysqli_query($mysqli, $delete_soal);
        }
        $query_komentar = "select * from komentar where id_kategori = $id";
        $komentar = mysqli_query($mysqli, $query_komentar);
        while ($row = mysqli_fetch_assoc($komentar)) {
            $id_komentar = $row['id'];
            $delete_komentar = "DELETE FROM komentar WHERE id = $id_komentar";
            mysqli_query($mysqli, $delete_komentar);
        }
        $delete = "DELETE FROM kategori WHERE id = $id";
        mysqli_query($mysqli, $delete);
        echo "<script>alert('Kategori berhasil dihapus!');window.location.href='draft_materi.php?id=".$kategori."';</script>";
    }
    
?>