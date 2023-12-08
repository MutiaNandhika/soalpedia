<?php
    require_once("functions.php");
    session_start();
    if(isset($_POST["login"])){
        if (login($_POST) > 0){
            echo "<script>
                    alert('Login berhasil');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Login gagal');
                </script>";
        }
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
    <a href="register.php">Register</a>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="login" value="Login">
    </form>
    
</body>
</html>