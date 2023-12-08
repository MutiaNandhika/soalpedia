<?php
require_once("config.php");
//fungsi register
function register($data){
    global $mysqli;
    $username = strtolower(stripslashes($data["username"]));
    $nama = strtolower(stripslashes($data["nama"]));
    $email = strtolower(stripslashes($data["email"]));
    $role = strtolower(stripslashes($data["role"]));
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
    mysqli_query($mysqli, "INSERT INTO user(username,nama,role,email,password) VALUES('$username','$nama','$role', '$email', '$password')");
    return mysqli_affected_rows($mysqli);
}

function login ($data){
    global $mysqli;
    $username = $data["username"];
    $password = $data["password"];

    //cek username
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1){
        //cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row["role"];
            $_SESSION["nama"] = $row["nama"];   
        }
    }
    return mysqli_affected_rows($mysqli);
}
?>