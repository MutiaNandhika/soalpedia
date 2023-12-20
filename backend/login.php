<?php
    require_once 'config.php';
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($result);

    if($row){
        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            echo "<script>alert('Berhasil masuk!');window.location.href='mapel/mapel.php';</script>";
        } else {
            echo "<script>alert('Password salah!');window.location.href='logres.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');window.location.href='logres.php';</script>";
    }
?>