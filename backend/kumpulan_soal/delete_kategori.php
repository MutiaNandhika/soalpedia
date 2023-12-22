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
        $delete = "DELETE FROM kategori WHERE id = $id";
        mysqli_query($mysqli, $delete);
        echo "<script>alert('Kategori berhasil dihapus!');window.location.href='draft_materi.php?id=".$kategori."';</script>";
    }
    
?>