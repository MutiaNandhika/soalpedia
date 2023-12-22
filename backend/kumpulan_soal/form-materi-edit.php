<?php
    include "../config.php";
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: ../logres.php");
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM master_soal WHERE id = $id";
        $file = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_assoc($file);
        $file_part = explode(".", $row['nama_file']);
        $nama = $file_part[0];
    }
    $kategori = $_GET['kategori'];
    $mapel = $_GET['mapel'];  
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
            <!-- Buat nama user --><a class="user" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        </div>
    </nav>
  
    <div class="heading">
        <a href="download_materi.php?id=<?php echo $kategori ?>&mapel=<?php echo $mapel ?>"><img src="../icon/back.svg" alt=""></a>
        <a href="download_materi.php?id=<?php echo $kategori ?>&mapel=<?php echo $mapel ?>">Back</a>
    </div>

    <div class="main">
        <span>Edit File Materi</span>
        <form action="edit_file.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Judul Materi</td>
                    <td>:</td>
                    <td>
                        <label for="judul"></label>
                        <input class="judul" type="text" name="judul" placeholder="masukkan judul..." value = "<?php echo $nama ?>">
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

                <tr><td><input type="hidden" name="mapel" value = <?php echo $mapel ?>></td></tr>

                <tr>
                    <td><input type="hidden" name="kategori" value = <?php echo $kategori ?>></td>
                    <td><input type="hidden" name="id" value = <?php echo $id ?>></td>
                    <td>
                        <label for="cancel"></label>
                        <a href="download_materi.php?id=<?php echo $kategori ?>&mapel=<?php echo $mapel ?>" class="cancel" name="cancel" >Cancel</a>

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