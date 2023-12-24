<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $mapel = $_GET['mapel'];
    $kategori = $_GET['kategori'];
    $id = $_GET['id'];
    $query_soal = "select * from soal where id = $id";
    $nullify = "UPDATE soal SET jawaban = NULL WHERE id = $id";
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
    echo "<script>alert('soal berhasil dihapus!');window.location.href='download-latihan.php?id=".$mapelzz ."&kategori=".$kategori."';</script>";
    
?>