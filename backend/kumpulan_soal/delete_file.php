<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM master_soal WHERE id = $id";
        $file = mysqli_query($mysqli, $query);
        
        if ($file) {
            $row = mysqli_fetch_assoc($file);
            $filePath = '../file_soal/' . $row['nama_file'];
            
            // Delete file from the database
            $deleteQuery = "DELETE FROM master_soal WHERE id = $id";
            mysqli_query($mysqli, $deleteQuery);
            
            // Delete file from the path
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            echo "<script>alert('File berhasil dihapus!');window.location.href='download_materi.php?id=".$id."';</script>";
        }
    }
    
?>