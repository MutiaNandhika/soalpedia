<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $query = "SELECT * FROM pelaporan";
    $laporan = mysqli_query($mysqli, $query);
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Laporan</title>

    <link rel="stylesheet" href="list-materi.css" />

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
        <!-- Menu Latihan dan Kumpulan -->
        <a class="menuLatihan" href=""></a>
        <a class="menuKumpulan" href=""></a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="../kumpulan_soal/draft_materi.php?id=<?php echo $id ?>"><img src="../icon/back.svg" alt=""></a>
      <a href="../kumpulan_soal/draft_materi.php?id=<?php echo $id ?>">Back</a>
    </div>

    <center>
      <div class="download">
        <!-- TABEL Materi -->
        <table border="0" cellpadding="10" cellspacing="0">
            <tr>
                <th>Soal</th>
                <th>Masalah</th>
                <th>Aksi</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($laporan)){
                    $id = $row['id_file'];
                    $query = "SELECT * FROM master_soal WHERE id = $id";
                    $files = mysqli_fetch_assoc(mysqli_query($mysqli, $query));
                    echo "<tr>";
                    echo "<td>".$files['nama_file']."</td>";
                    echo "<td>".$row['masalah']."</td>";
                    echo "<td><a class='trash' href=''><img src='../icon/trash.svg' alt=''></a></td>";
                    echo "</tr>";
                }
            ?>
            <!-- <tr>
                <td>Soal Indonesia Maritim</td>
                <td>Soal menyimpang, kunci jawaban salah</td>
                <td>
                  <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
                </td>
            </tr> -->
        </table>
      </div>
    </center>

    <!-- FOOTER -->
    <footer>
      <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>
