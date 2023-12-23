<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id_kategori = $_POST['id_kategori'];
    $komentar = $_POST['komentar'];
    $id_user = $_SESSION['id'];
    $query = "INSERT INTO komentar (id_kategori,id_user,komentar) VALUES ('$id_kategori','$id_user','$komentar')";
    mysqli_query($mysqli, $query);
    echo "<script>alert('Komentar berhasil ditambahkan!');
        window.location.href='komentar.php?id=$id_kategori';
    </script>";
?>