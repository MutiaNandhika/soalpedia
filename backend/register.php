<?php
    include 'config.php';
    if(isset($_POST['register'])){
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password'];
        $role = $_POST['role'];
    
    $password = password_hash($password1, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (nama, username, email, password, role) VALUES ('$nama', '$username', '$email', '$password', '$role')";
    $result = mysqli_query($mysqli, $query);
    
    if($result){
        echo "<script>alert('Berhasil mendaftar!');window.location.href='logres.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar!');window.location.href='logres.php';</script>";
    }
    }
    
?>