<?php
session_start();
require_once("functions.php");
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Queasy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ini Homepage</h1>
    <?php if(!isset($_SESSION["login"])) : ?>
        <a href="login.php">Login disini</a>
        <br>
        <a href="register.php">Register disini</a>
    <?php endif; ?>
    <?php if(isset($_SESSION["login"])) : ?>
        <p>Halo, anda berhasil login sebagai <?php echo $_SESSION["username"]; ?></p>
        <a href="logout.php">Logout disini</a>
    <?php endif; ?>
    
</body>
</html>