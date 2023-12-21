<?php
  session_start();
  require_once '../config.php';
  if(!isset($_SESSION['login'])){
    header("Location: ../logres.php");
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM master_soal WHERE id_kategori = $id";
    $file = mysqli_query($mysqli, $query);
  } else {
    $query = "SELECT * FROM master_soal";
    $file = mysqli_query($mysqli, $query);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Download Materi</title>

    <link rel="stylesheet" href="downloadMateri.css" />

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
        <a class="menuLatihan" href="../latihan_soal/draft_quiz.html">Latihan Soal</a>
        <a class="menuKumpulan" href="draft_materi.html">Kumpulan Soal</a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="draft_materi.php"><img src="../icon/back.svg" alt=""></a>
      <a href="draft_materi.php">Back</a>
    </div>

    <center>
      <div class="main">
        <!-- Nama Mapel -->
          <div class="namaMapel">
            <?php if(isset($_GET['id'])) : ?>
              <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM kategori WHERE id = $id";
                $result = mysqli_query($mysqli, $query);
                $row = mysqli_fetch_assoc($result);
              ?>
              <p><?php echo $row['kategori'] ?></p>
            <?php else : ?>
              <p>Semua Materi</p>
            <?php endif ?>
          </div>
  
        <!-- Dropdown Pilih Kelas buat User Guru,Admin,Siswa,Editor -->
        <div class="dropdown">
          <button>Pilih Kelas</button>
          <div class="dropdown-content">
            <a href="#">Kelas 12</a>
            <a href="#">Kelas 11</a>
            <a href="#">Kelas 10</a>
          </div>
        </div>
        <?php if($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin') : ?>
        <!-- Menu Tambah Soal hanya bisa buat User Guru dan Admin -->
        <div class="tambahSoal">
          <a class="add" href="form-materi.php?id=<?php echo $id ?>"><img src="../icon/add.svg" alt=""></a>
          <a class="tambah" href="form-materi.php?id=<?php echo $id ?>">Tambah Soal</a>
        </div>
        <?php endif ?>
  
        <!-- Searching -->
          <div class="search">
              <label for="search"></label>
              <input type="text" name="search" placeholder="Cari...">
          </div>
      </div>

      <div class="download">
        <!-- TABEL Materi -->
        <table border="0" cellpadding="10" cellspacing="0">
            <tr>
                <th>Nama</th>
                <th>Pemilik</th>
                <th>Tipe File</th>
                <th>Terakhir Diubah</th>
                <th>Aksi</th>
            </tr>
            <?php 
              while($row = mysqli_fetch_assoc($file)){
                $rawnama = $row['nama_file'];
                $nama_part = explode('.', $rawnama);
                $nama = $nama_part[0];
                $ext = end($nama_part);
                $pemilik = "SELECT * FROM user WHERE id = ".$row['id_pemilik'];
                $result = mysqli_query($mysqli, $pemilik);
                $user = mysqli_fetch_assoc($result);
                $pemilik = $user['nama'];
                echo "<td>".$nama."</td>";
                echo "<td>".$pemilik."</td>";
                echo "<td>".$ext."</td>";
                echo "<td>".$row['tgl']."</td>";
                echo "<td>";
                if($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin'){
                  echo "<a class='edit' href=''><img src='../icon/edit.svg' alt=''></a>";
                  echo "<a class='trash' href='delete_file.php?id=".$row['id']."'><img src='../icon/trash.svg' alt=''></a>";
                }
                if($_SESSION['role'] == 'siswa'){
                  echo "<a class='unduh' href='../file_soal/".$row['nama_file']."'><img src='../icon/unduh.svg' alt=''></a>";
                }
                if($_SESSION['role'] == 'editor'){
                  echo "<div class='kritik-saran'>";
                  echo "<a class='add-kritik' href=''><img src='../icon/add.svg' alt='' /></a>";
                  echo "<a class='krisan' href=''>Kritik & Saran</a>";
                  echo "</div>";
                }
                echo "</td>";
                echo "</tr>";
              }
            ?>
            <!-- <tr>
                <td>Soal Indonesia Maritim</td>
                <td>Muthia Nandhika</td>
                <td>PDF</td>
                <td>10 November 2023</td>
                <td>1,8 MB</td>
                <td>
                   Tombol Edit, Hapus, Unduh bisa buat user Guru,Admin
                  <a class="edit" href=""><img src="../icon/edit.svg" alt=""></a>
                  <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
                  Tombol Unduh hanya bisa buat user Siswa
                  <a class="unduh" href=""><img src="../icon/unduh.svg" alt=""></a>

                  Tombol Kritik & Saran buat user Editor 
                  <div class="kritik-saran">
                    <a class="add-kritik" href=""><img src="../icon/add.svg" alt="" /></a>
                    <a class="krisan" href="">Kritik & Saran</a>
                  </div>
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
