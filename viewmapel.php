<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require_once("functions.php");
$mapel = mysqli_query($mysqli, "SELECT * FROM mapel");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Soal</title>
</head>
<body>
<table>
        <?php foreach($mapel as $row) : ?>
            <tr>
                <td>
                    <a href="viewkategori.php?id=<?= $row["id"]; ?>"><?= $row["pelajaran"]; ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>