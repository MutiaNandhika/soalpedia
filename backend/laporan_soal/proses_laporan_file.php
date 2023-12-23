<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_POST['id'];
    $laporan = $_POST['laporan'];
    echo $id;
    echo $laporan;
    $query = "INSERT INTO pelaporan (masalah,id_file) VALUES ('$laporan','$id')";
    mysqli_query($mysqli, $query);
    echo "<script>alert('Laporan berhasil ditambahkan!');history.back();</script>";
    
?>