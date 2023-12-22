<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_POST['id'];
    $kritik = $_POST['kritik'];
    $saran = $_POST['saran'];
    $query = "INSERT INTO krisan (kritik,saran,user) VALUES ('$kritik','$saran','$_SESSION[username]')";
    mysqli_query($mysqli, $query);
    echo "<script>alert('Kritik dan Saran berhasil ditambahkan!');window.location.href='../kumpulan_soal/draft_materi.php?id=".$id."';</script>";
?>