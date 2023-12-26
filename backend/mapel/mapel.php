<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: ../logres.php");
    }
    $query = "SELECT * FROM mapel";
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kumpulan Soal</title>

    <link rel="stylesheet" href="mapel.css" />

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
      <img class="logoAwal" src="../gambar/logo2.svg" alt="SoalPedia" />
      <div class="logo1">
        <?php if ($_SESSION['role'] == 'admin') : ?>
        <a class="user-list" href="../admin/lihat_akun.php">Lihat Tabel User</a>
        <?php endif ?>
      </div>

      <?php if(!$_SESSION['login']) : ?>
      <div class="btnAwal">
        <a class="btnMasuk" href="../logres.php">Masuk</a>
        <a class="btnDaftar" href="../logres.php">Daftar</a>
      </div>
      <?php endif?>
      <?php if($_SESSION['login']) : ?>

      <div class="btnAwal">
        <a class="btnMasuk" href="../index.php">Selamat Datang <?php echo $_SESSION['username'] ?></a>
        <a class="edit-profil" href="edit-profil.php">Edit Profil</a>
        <a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
      <?php endif?>
    </nav>

    <div class="heading">
      <p class="paragraf1">Materi Pelajaran</p>
    </div>
    
    <div class="main">
      <?php
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='materi'>";
            echo "<div><a href='../kumpulan_soal/draft_materi.php?id=".$row['id']."'><img class='gambarMateri' src='../gambar/".$row['img']."' alt='' /></a></div>";
            echo "<div><a class='namaMateri' href='../kumpulan_soal/draft_materi.php?id=".$row['id']."'>".$row['pelajaran']."</a></div>";
            echo "</div>";
        }
      ?>
    </div>
      <!-- <div class="materi">
        <div><img class="gambarMateri" src="../gambar/pai.svg" alt="" /></div>
        <div>
          <a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a>
        </div>
      </div>
      <div class="materi">
        <div>
          <img class="gambarMateri" src="../gambar/pancasila.svg" alt="" />
        </div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
      <div class="materi">
        <div><img class="gambarMateri" src="../gambar/bindo.svg" alt="" /></div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
      <div class="materi">
        <div><img class="gambarMateri" src="../gambar/mipa.svg" alt="" /></div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
      <div class="materi">
        <div>
          <img class="gambarMateri" src="../gambar/olahraga.svg" alt="" />
        </div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
      <div class="materi">
        <div>
          <img class="gambarMateri" src="../gambar/senbud.svg" alt="" />
        </div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
      <div class="materi">
        <div>
          <img class="gambarMateri" src="../gambar/geografi.svg" alt="" />
        </div>
        <div><a class="namaMateri" href="../latihan_soal/draft_quiz.html">Natural Science</a></div>
      </div>
    </div> -->

    <!-- FOOTER -->
    <footer>
      <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>