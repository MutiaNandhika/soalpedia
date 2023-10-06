<?php
require_once("config.php");
//fungsi register
function register($data){
    global $mysqli;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($mysqli, $data["password"]);
    $password2 = mysqli_real_escape_string($mysqli, $data["password2"]);

    //pengecekan username
    $user = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($user)){
        echo "<script>
                alert('Username sudah terdaftar, gunakan username lain');
            </script>";
        return false;
    }
    //pengecekan password
    if($password !== $password2){
        echo "<script>
               alert('Password tidak sesuai');
            </script>";
        return false;
    }
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //memasukan data ke database
    mysqli_query($mysqli, "INSERT INTO user(username,email,password) VALUES('$username', '$email', '$password')");
    return mysqli_affected_rows($mysqli);
}

?>