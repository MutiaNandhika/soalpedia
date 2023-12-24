<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $mapel = $_GET['mapel'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Komentar</title>

    <link rel="stylesheet" href="komentar.css" />

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
        <a class="menuLatihan" href="draft_quiz.html">Latihan Soal</a>
        <a class="menuKumpulan" href="../kumpulan_soal/draft_materi.html">Kumpulan Soal</a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="../latihan_soal/draft_quiz.php?id=<?php echo $mapel?>"><img src="../icon/back.svg" alt=""></a>
      <a href="../latihan_soal/draft_quiz.php?id=<?php echo $mapel?>">Back</a>
    </div>

    <center>
    <div class="main">
        <h3>Komentar</h3>
        <div class="tabel-main">
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <td colspan="2" class="komen-list">
                    <?php
                      $query = "SELECT * FROM komentar WHERE id_kategori = $id";
                      $komentar = mysqli_query($mysqli, $query);
                        while($row = mysqli_fetch_assoc($komentar)){
                          echo "<div class='komen'>";
                          $user_query = "SELECT * FROM user WHERE id = ".$row['id_user'];
                          $user = mysqli_fetch_assoc(mysqli_query($mysqli, $user_query));
                          echo "<span>".$user['username']." - ".$user['role']."</span>";
                          echo "<div class='isi-komen'>";
                          echo "<p>".$row['komentar']."</p>";
                          if ($_SESSION['role'] == 'siswa') {
                            if ($_SESSION['id'] == $row['id_user']) {
                              echo "<button><a href='delete_komentar.php?id=".$row['id']."'><img src='../icon/trash.svg'></a></button>";
                            }
                          }
                          if($_SESSION['role'] == 'editor' || $_SESSION['role'] == 'admin'){
                            echo "<button><a href='delete_komentar.php?id=".$row['id']."'><img src='../icon/trash.svg'></a></button>";
                          }
                          
                          echo "</div>";
                          echo "</div>";

                          
                        }
                    ?>
                        <!-- <div class="komen">
                          <span>Nandhi - Siswa</span>
                          <div class="isi-komen">
                            <p>Pada soal nomor 1 terdapat salah ketik</p>
                            <button><img src="../icon/trash.svg"></button>
                          </div>
                        </div>

                        <div class="komen">
                          <span>Nandhi - Siswa</span>
                          <div class="isi-komen">
                            <p>Pada soal nomor 1 terdapat salah ketik</p>
                            <button><img src="../icon/trash.svg"></button>
                          </div>
                        </div> -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="submit">
                    <form action="proses_komentar.php" method="POST">
                            <input type="hidden" name="id_kategori" value="<?php echo $id ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="mapel" value="<?php echo $mapel ?>">
                            <input type="text" name="komentar" placeholder="Kirim Komentar...">
                            <label for="submit"></label>
                            <button type="submit"><img src="../icon/submit.svg" alt=""></button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </center>
    
    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>
