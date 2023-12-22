<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kritik dan Saran</title>

    <link rel="stylesheet" href="tambah.css" />

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
            <!-- Buat nama user --><a class="user" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        </div>
    </nav>
  
    <div class="heading">
        <a href="../kumpulan_soal/draft_materi.php?id=<?php echo $id ?>"><img src="../icon/back.svg" alt=""></a>
        <a href="../kumpulan_soal/draft_materi.php?id=<?php echo $id ?>">Back</a>
    </div>

    <div class="main">
        <span>Tambah Kritik dan Saran</span>
        <form action="proses_krisan.php" method="post">
            <table>
                <tr>
                    <td>Kritik</td>
                    <td>:</td>
                    <td>
                        <label for="kritik"></label>
                        <textarea class="kritik" name="kritik" rows="4" placeholder="ketik kritik..."></textarea>
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <td>Saran</td>
                    <td>:</td>
                    <td>
                        <label for="saran"></label>
                        <textarea class="saran" name="saran" rows="4" placeholder="ketik saran..."></textarea>
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <td></td>
                    <td><input type="hidden" name="id" value ="<?php echo $id ?>"></td>
                    <td>
                        <!-- Cancel Kritik & Saran -->
                        <label for="cancel"></label>
                        <input class="cancel" type="reset" name="cancel" value="Cancel">

                        <!-- Submit Kritik & Saran -->
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