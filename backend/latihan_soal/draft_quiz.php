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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Latihan Soal</title>

    <link rel="stylesheet" href="draftQuiz.css" />

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
        <a class="menuKumpulan" href="../kumpulan_soal/draft_materi.php?id=<?php echo $id ?>">Kumpulan Soal</a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <div class="back">
        <a href="../mapel/mapel.php"><img src="../icon/back.svg" alt=""></a>
        <a href="../mapel/mapel.php">Back</a>
      </div>

      <div class="kritik-saran">
        <a class="tambah" href="../kritik&saran/tambah_krisan.php?id=<?php echo $id ?>"><img src="../icon/add.svg" alt="" /></a>
        <a class="krisan" href="../kritik&saran/tambah_krisan.php?id=<?php echo $id ?>">Kritik & Saran</a>
      </div>
      <?php if ($_SESSION['role'] == 'editor') : ?>
      <!-- Lihat Laporan HANYA UNTUK EDITOR -->
      <div class="lihat-laporan">
        <a href="../laporan_soal/list-soal.php?id=<?php echo $id ?>">Lihat Laporan</a>
      </div>
      <?php endif ?>
      <?php if ( $_SESSION['role'] == 'admin') : ?>
      <!-- Tombol Lihat Kritik & Saran HANYA UNTUK ADMIN -->
      <div class="lihat-krisan">
        <a class="info" href="../kritik&saran/kritik_saran.php?id=<?php echo $id ?>"><img src="../icon/info2.svg" alt="" /></a>
        <a class="lihat" href="../kritik&saran/kritik_saran.php?id=<?php echo $id ?>">Lihat Kritik & Saran</a>
      </div>
      <?php endif ?>
    </div>

    <center>
    <div class="main">
      <!-- Nama Mapel -->
      <div class="namaMapel">
            <?php if(isset($_GET['id'])) : ?>
              <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM mapel WHERE id = $id";
                $result = mysqli_query($mysqli, $query);
                $row = mysqli_fetch_assoc($result);
              ?>
              <p><?php echo $row['pelajaran'] ?></p>
            <?php else : ?>
              <p>Semua Materi</p>
            <?php endif ?>
      </div>

      <!-- Dropdown Pilih Kelas buat User Guru,Admin,Siswa -->
      <div class="dropdown">
        <button>Pilih Kelas</button>
        <div class="dropdown-content">
          <a href="draft_quiz.php?id=<?php echo $id ?>&kelas=12">Kelas 12</a>
          <a href="draft_quiz.php?id=<?php echo $id ?>&kelas=11">Kelas 11</a>
          <a href="draft_quiz.php?id=<?php echo $id ?>&kelas=10">Kelas 10</a>
        </div>
      </div>
      <?php if($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin') : ?>
      <!-- Menu Tambah Soal hanya bisa buat User Guru dan Admin -->
      <div class="tambahSoal">
        <a class="add" href="../kumpulan_soal/form-kategori.php?id=<?php echo $id?>"><img src="../icon/add.svg" alt=""></a>
        <a class="tambah" href="../kumpulan_soal/form-kategori.php?id=<?php echo $id?>">Tambah Kategori</a>
      </div>
      <?php endif ?>

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
        <form class="cari" action="" method="post">
          <button>
            <img src="../icon/search.svg" alt="">
          </button>
          <label for="search"></label>
          <input type="text" name="search" placeholder="Cari...">
        </form>
     </div>
    </div>
    </center>
    <div class='draft'>
    <?php
        if(!isset($_GET['kelas'])){
            $query = "SELECT * FROM kategori WHERE id_mapel = $id";
        } else {
            $kelas = $_GET['kelas'];
            $query = "SELECT * FROM kategori WHERE id_mapel = $id AND kelas = $kelas";
        }
        
        $result = mysqli_query($mysqli, $query);
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='draftQuiz'>";
            echo "<div class='listQuiz'>";
            echo "<img src='../gambar/quiz.svg' alt=''>";
            echo "<a class='quiz-1' href='soal.php?id=".$row['id']."&mapel=".$id."'>".$row['kategori']."</a>";
            echo "</div>";
            if ($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin') {
                echo "<div class='icon'>";
                echo "<a class='info3' href='download-latihan.php?id=".$row['id']."&kategori=".$id."'><img src='../icon/info3.svg' alt=''></a>";
                echo "<a class='edit' href='edit-soal.php?id=".$row['id']."'><img src='../icon/edit.svg' alt=''></a>";
                echo "<a class='trash' href='../kumpulan_soal/delete_kategori.php?id=".$row['id']."&kategori=".$id."'><img src='../icon/trash.svg' alt=''></a>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>
    </div>
    <!-- <div class="draft">
      <div class="draftQuiz">
        List Soal Quiz
        <div class="listQuiz">
          <img src="../gambar/quiz.svg" alt="">
          <a class="quiz-1" href="soal.html">Luas dan batas wilayah Indonesia</a>
        </div>
        
        Tombol Edit dan Hapus buat Guru,Admin
        <div class="icon">
          <a class="edit" href="edit-soal.html"><img src="../icon/edit.svg" alt=""></a> <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
        </div>
      </div>

      <div class="draftQuiz">
        List Soal Quiz
        <div class="listQuiz">
          <img src="../gambar/quiz.svg" alt="">
          <a class="quiz-1" href="soal.html">Luas dan batas wilayah Indonesia</a>
        </div>
        
        Tombol Edit dan Hapus buat Guru,Admin
        <div class="icon">
          <a class="edit" href="edit-soal.html"><img src="../icon/edit.svg" alt=""></a> <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
        </div>
      </div>
      
      <div class="draftQuiz">
        List Soal Quiz
        <div class="listQuiz">
          <img src="../gambar/quiz.svg" alt="">
          <a class="quiz-1" href="soal.html">Luas dan batas wilayah Indonesia</a>
        </div>
        
        Tombol Edit dan Hapus buat Guru,Admin
        <div class="icon">
          <a class="edit" href="edit-soal.html"><img src="../icon/edit.svg" alt=""></a> <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
        </div>
      </div>
    </div> -->

    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>
