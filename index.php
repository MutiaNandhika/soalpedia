<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Selamat datang, <?= $_SESSION["nama"]; ?></h1>
    <?php if ($_SESSION["role"] == "admin") : ?>
        <a href="admin.php">Admin</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>