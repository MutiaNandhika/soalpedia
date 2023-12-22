<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_POST['id'];
    $mapel = $_POST['mapel'];
    $kategori = $_POST['kategori'];
    $kelas = $_POST['kelas'];
    $query = "INSERT INTO kategori (id_mapel, kategori, kelas) VALUES ('$mapel', '$kategori', '$kelas')";
    $result = mysqli_query($mysqli, $query);
    if($result){
        echo "<script>alert('Kategori berhasil ditambahkan!');window.location.href='draft_materi.php?id=".$id."';</script>";
    }
    else{
        echo "<script>alert('Kategori gagal ditambahkan!');window.location.href='draft_materi.php?id=".$id."';</script>";
    }
?>