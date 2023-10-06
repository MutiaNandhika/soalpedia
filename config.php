<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    $databasehost = "localhost";
    $databasename = "queasy";
    $databaseusername = "root";
    $databasepassword = "";

    $mysqli = mysqli_connect($databasehost, $databaseusername, $databasepassword, $databasename);
?>

