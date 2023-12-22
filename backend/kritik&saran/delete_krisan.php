<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $mapel = $_GET['mapel'];
    $query = "delete from krisan where id = $id";
    mysqli_query($mysqli, $query);
    echo "<script>alert('Kritik dan Saran berhasil dihapus!');window.location.href='kritik_saran.php?id=".$mapel."';</script>";
?>