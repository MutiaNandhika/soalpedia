<?php
    include "../config.php";
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: ../logres.php");
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kumpulan Soal</title>

    <link rel="stylesheet" href="form-materi.css" />

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <nav class="header">
        <div class="logo1">
          <img class="logoAwal" src="../gambar/logo2.svg" alt="SoalPedia" />
        </div>
        <div class="menuAwal">
            <a class="menuLatihan" href=""></a>
            <a class="menuKumpulan" href=""></a>
        </div>
        <div class="btnAwal">
            <!-- Buat nama user --><a class="user" href="">Halo, Nandhi</a>
        </div>
    </nav>
  
    <div class="heading">
        <a href="draft_materi.html"><img src="../icon/back.svg" alt=""></a>
        <a href="draft_materi.html">Back</a>
    </div>

    <div class="main">
        <span>Tambah File Materi</span>
        <form action="proses_file.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Judul Materi</td>
                    <td>:</td>
                    <td>
                        <label for="judul"></label>
                        <input class="judul" type="text" name="judul" placeholder="masukkan judul...">
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <td>File Materi</td>
                    <td>:</td>
                    <td>
                        <label for="file"></label>
                        <input class="file" type="file" name="file" placeholder="masukkan file...">
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <td></td>
                    <td><input type="hidden" name="id" value = <?php echo $id ?>></td>
                    <td>
                        <label for="cancel"></label>
                        <input class="cancel" type="submit" name="cancel" value="Cancel">

                        <label for="submit"></label>
                        <input class="submit" type="submit" name="submit" value="Submit">
                </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
</body>
</html>