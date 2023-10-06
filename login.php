<?php
session_start();
if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}
//menambahkan modul fungsi
require_once("functions.php");
$username = $_POST["username"];
$password = $_POST["password"];

$user = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");
//cek username
if(mysqli_num_rows($user) === 1){
    $row = mysqli_fetch_assoc($user);
    //cek password
    if(password_verify($password, $row["password"])){
        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit;
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <?php if(isset($error)) : ?>
            <p style="color: red;">Username / Password salah</p>
        <?php endif; ?>
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><button type="login" name="register">login</td>
        </tr> 
        <tr>
            <td colspan="2"><p>Belum punya akun? <a href="register.php">daftar disini</a></p></td>
        </tr>
    </table>
    </form>
</body>
</html>