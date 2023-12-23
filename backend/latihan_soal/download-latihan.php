<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $kategori = $_GET['kategori'];
    $query = "select * from soal where id_kategori = $id";
    $result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Download Latihan Soal</title>

    <link rel="stylesheet" href="download-latihan.css" />

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
        <a class="menuLatihan" href="">Latihan Soal</a>
        <a class="menuKumpulan" href="../kumpulan_soal/draft_materi.php?id=<?php echo $kategori ?>">Kumpulan Soal</a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['$username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="draft_quiz.php?id=<?php echo $kategori ?>"><img src="../icon/back.svg" alt=""></a>
      <a href="draft_quiz.php?id=<?php echo $kategori ?>">Back</a>
    </div>

    <center>
      <div class="main">
        <!-- Nama Mapel -->
          <div class="namaMapel">
              <?php
                $kategori_query = "select * from kategori where id = $id";
                $kategori_result = mysqli_query($mysqli, $kategori_query);
                $kategori_row = mysqli_fetch_assoc($kategori_result);
                echo "<p>".$kategori_row['kategori']."</p>";
              ?>
          </div>
  
        <!-- Dropdown Pilih Kelas buat User Guru,Admin,Siswa -->
        <div class="dropdown">
          <button>Pilih Kelas</button>
          <div class="dropdown-content">
            <a href="#">Kelas 12</a>
            <a href="#">Kelas 11</a>
            <a href="#">Kelas 10</a>
          </div>
        </div>
  
        <!-- Menu Tambah Soal hanya bisa buat User Guru dan Admin -->
        <div class="tambahSoal">
          <a class="add" href="tambah-soal.php?id=<?php echo $id ?>&kategori=<?php echo $kategori ?>"><img src="../icon/add.svg" alt=""></a>
          <a class="tambah" href="tambah-soal.php?id=<?php echo $id ?>&kategori=<?php echo $kategori ?>">Tambah Soal</a>
        </div>
  
        <!-- Kesulitan -->
        <div class="kesulitan">
          <select class="level" name="kesulitan" id="kesulitan">
            <option value="Kesulitan Soal">Kesulitan Soal</option>
            <option value="mudah">Mudah</option>
            <option value="sulit">Sulit</option>
          </select>
        </div>
  
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
                <th>Pertanyaan</th>
                <th>Kategori</th>
                <th>Kesulitan</th>
                <th>Jawaban</th>
                <th>Aksi</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['pertanyaan']."</td>";
                    echo "<td>".$kategori_row['kategori']."</td>";
                    echo "<td>".$row['kesulitan']."</td>";
                    $query_jawaban = "select * from pilihan where id = ".$row['jawaban'];
                    $result_jawaban = mysqli_query($mysqli, $query_jawaban);
                    $jawaban = mysqli_fetch_assoc($result_jawaban);
                    echo "<td>".$jawaban['teks_pilihan']."</td>";
                    echo "<td>";
                    echo "<a class='edit'href='edit-soal.php?id=".$row['id']."&kategori=".$kategori."'><img src='../icon/edit.svg' alt=''></a>";
                    echo '<a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>';
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
            <!-- <tr> -->
                  <!-- Tombol Edit, Hapus bisa buat user Guru,Admin -->
                  <!-- Edit Materi<a class="edit" href="edit-materi.html"><img src="../icon/edit.svg" alt=""></a> -->
                  <!-- Hapus Materi<a class="trash" href=""><img src="../icon/trash.svg" alt=""></a> -->

                  <!-- Tombol Unduh bisa buat user Siswa, Guru, Admin -->
                  <!-- <a class="unduh" href=""><img src="../icon/unduh.svg" alt=""></a> -->
                <!-- </td> -->
            <!-- </tr> -->
        </table>
      </div>
    </center>

    <!-- FOOTER -->
    <footer>
      <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>
