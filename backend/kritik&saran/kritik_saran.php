<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $query = "SELECT * FROM krisan";
    $result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Laporan</title>

    <link rel="stylesheet" href="kritik_saran.css" />

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
        <div class="main">
          <div class="perbaikan">
            <p>Kritik dan Saran</p>
          </div>
        </div>
    </center>

    <center>
      <div class="download">
        <!-- TABEL Materi -->
        <table border="0" cellpadding="10" cellspacing="0">
            <tr class="tag-head">
                <th>No</th>
                <th>Nama</th>
                <th>Kritik</th>
                <th>Saran</th>
                <th>Aksi</th>
            </tr>
            <?php
                $i = 1;
                while($data = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>".$i."</td>";
                  echo "<td>".$data['user']."</td>";
                  echo "<td>".$data['kritik']."</td>";
                  echo "<td>".$data['saran']."</td>";
                  echo "<td><a class='trash' href='delete_krisan.php?id=".$data['id']."&mapel=".$id."'><img src='../icon/trash.svg' alt=''></a></td>";
                  echo "</tr>";
                  $i++;
                }
            ?>
                <!-- <td>1</td>
                <td>Farah</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi nihil, adipisci eum iusto ad doloribus!
                    Dolor eos minima nulla repellendus eveniet maxime aperiam ea dolorum quibusdam pariatur! Est, architecto impedit!
                </td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi nihil, adipisci eum iusto ad doloribus!
                    Dolor eos minima nulla repellendus eveniet maxime aperiam ea dolorum quibusdam pariatur! Est, architecto impedit!
                </td>
                <td>
                  <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
                </td> -->
            
        </table>
      </div>
    </center>

    <!-- FOOTER -->
    <footer>
      <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>
