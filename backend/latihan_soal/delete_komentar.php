<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $query = "DELETE FROM komentar WHERE id = $id";
    mysqli_query($mysqli, $query);
    echo "<script>alert('Komentar berhasil dihapus!');
        history.back();
    </script>";

?>