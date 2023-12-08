<?php
//menambahkan modul fungsi
require_once("functions.php");

if(isset($_POST["register"])){
    if(register($_POST) > 0){
        echo "<script>
                alert('User baru berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>Role</td>
            <td>
                <select name="role">
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Konfirmasi</td>
            <td><input type="password" name="password2"></td>
        </tr>
        <tr>
            <td><button type="submit" name="register">register</td>
    </table>
    </form>
</body>
</html>