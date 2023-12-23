<?php
    session_start();
    include_once("../config.php");
    if(!isset($_SESSION['username'])){
        header("Location: ../logres.php");
    }
    if (!isset($_SESSION['start_time'])) {
      $_SESSION['start_time'] = time();
    }
    

    $id = $_GET['id'];
    $mapel = $_GET['mapel'];
    $jumlah_soal = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_kategori = $id"));
    $halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"]-1 : 0;
    if(isset($_POST['simpan'])){
      if(isset($_POST['jawaban'.$_GET['halaman']])){
        $_SESSION['answers'.$_GET['halaman']] = $_POST['jawaban'.$_GET['halaman']];
        $_SESSION['id_soal'.$_GET['halaman']] = $_POST['id_soal'.$_GET['halaman']];
      }
    }

    $query = "SELECT * FROM soal WHERE id_kategori = $id LIMIT $halamanaktif , 1";
    $soal = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Latihan Soal</title>

    <link rel="stylesheet" href="soal.css" />

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
        <a class="menuKumpulan" href="../kumpulan_soal/draft_materi.html"></a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="draft_quiz.php?id=<?php echo $mapel ?>"><img src="../icon/back.svg" alt=""></a>
      <a href="draft_quiz.php?id=<?php echo $mapel ?>">Back</a>
    </div>

    <div class="main">
      <div class="pertanyaan">
        <div class="listPertanyaan">
          <h4><?php 
            $kategori_query = mysqli_query($mysqli, "SELECT * FROM kategori WHERE id = $id");
            $kategori = mysqli_fetch_assoc($kategori_query);
            echo $kategori['kategori'];
          ?></h4>

           <form class="pilgan" action="" method="post">
            <?php
              $i = $halamanaktif + 1;
              while($row = mysqli_fetch_assoc($soal)){
                echo "<div class='soal'>";
                echo "<a href=''>Pertanyaan ".$i."</a>";
                echo "<a class='editSoal' href='edit-soal.html'><img src='../icon/edit.svg' alt=''/></a>";
                echo "</div>";
                echo "<p>".$row['pertanyaan']."</p>";
                $pilihan = mysqli_query($mysqli, "SELECT * FROM pilihan WHERE id_soal = $row[id]");
                $opt = "a";
                while($pil = mysqli_fetch_assoc($pilihan)){
                  echo "<input class='jawaban' type='radio' name='jawaban".$i."' id='jawaban".$i."".$opt."' value='".$pil['id']."'";
                  if (isset($_SESSION['answers'.$i]) && $_SESSION['answers'.$i] == $pil['id']) {
                    echo "checked";
                  }
                  echo "/>";
                  echo "<label for='jawaban".$i."".$opt."'>".$pil['teks_pilihan']."</label><br />";
                  echo "<input type='hidden' name='id_soal".$i."' value='".$row['id']."'>";
                  $opt++;
                }
                $i++;
              }
            ?>
            <!--Pertanyaan Latihan Soal
            <div class="soal">
              <a href="">Pertanyaan</a>
              <a class="editSoal" href="edit-soal.html"><img src="../icon/edit.svg" alt=""/></a>
            </div>

            <p>Siapa presiden Indonesia saat ini?</p>

            <input class="jawaban" type="radio" name="jawaban" id="jawaban1" />
            <label for="jawaban1">Farah</label><br />

            <input class="jawaban" type="radio" name="jawaban" id="jawaban2" />
            <label for="jawaban2">Nandhi</label><br />

            <input class="jawaban" type="radio" name="jawaban" id="jawaban3" />
            <label for="jawaban3">Zia</label><br />

            <input class="jawaban" type="radio" name="jawaban" id="jawaban4" />
            <label for="jawaban4">Sesa</label>

            PAGINATION untuk berpindah ke nomor berikutnya-->
            <div class="pagination">
              <?php if($halamanaktif > 0) : ?>
              <button type="button" class="btn1" onclick="backBtn()"> < previous</button>
              <?php else: ?>
              <button type="button" class="btn1" onclick="backBtn()" disabled> < previous</button>
              <?php endif; ?>

              

              <ul>
                <?php
                  $i = 1;
                  while($i <= $jumlah_soal){
                    echo "<a href='?id=$id&halaman=$i&mapel=$mapel'><li class='link ";
                    if($i == $halamanaktif + 1){
                      echo "active";
                    }
                    echo "' value='".$i."' onclick='activeLink()'>".$i."</li></a>";
                    $i++;
                  }
                ?>
                <!-- <li class="link active" value="1" onclick="activeLink()">1</li>
                <li class="link" value="2" onclick="activeLink()">2</li>
                <li class="link" value="3" onclick="activeLink()">3</li>
                <li class="link" value="4" onclick="activeLink()">4</li>
                <li class="link" value="5" onclick="activeLink()">5</li>
                <li class="link" value="6" onclick="activeLink()">6</li> -->
              </ul>
              <?php if($halamanaktif < $jumlah_soal - 1) : ?>
              <button type="button" class="btn2" onclick="nextBtn()">&nbsp;&nbsp; next ></button>
              <?php else: ?>
              <button type="button" class="btn2" onclick="nextBtn()" disabled>&nbsp;&nbsp; next ></button>
              <?php endif; ?>

              <button type="submit" class="btn1" name="simpan" >Simpan</button> 
            </div>
          </form>
            <div class="selesai">
              <!-- Tombol Selesai -->
              <form action="hasil_quiz.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="mapel" value="<?php echo $mapel ?>">
                <?php
                  $i = 1;
                  while($i <= $jumlah_soal){
                    echo "<input type='hidden' name='jawaban".$i."' value='".$_SESSION['answers'.$i]."'>";
                    echo "<input type='hidden' name='id_soal".$i."' value='".$_SESSION['id_soal'.$i]."'>";
                    $i++;
                  }
                ?>
                <button type="submit">Selesai</button>
              </form>
              
            </div> 
          
        </div>
      </div>

      <!-- DROPDOWN Pelaporan -->
      <div class="dropdown">
        <img src="../icon/info.svg" alt="" />
        <form action="../laporan_soal/proses_laporan_soal.php" method="POST">
          <div class="dropdown-content">
            <p>Laporkan Soal</p>
            <input
              type="radio"
              name="laporan"
              id="menyimpang"
              value="Soal Menyimpang"
            />
            <label for="menyimpang">Soal Menyimpang</label><br />

            <input
              type="radio"
              name="laporan"
              id="teknis"
              value="Kesalahan Teknis"
            />
            <label for="teknis">Kesalahan Teknis</label><br />

            <input
              type="radio"
              name="laporan"
              id="instruksi"
              value="Ketidakjelasan Instruksi"
            />
            <label for="instruksi">Ketidakjelasan Instruksi</label><br />

            <input
              type="radio"
              name="laporan"
              id="konten"
              value="Konten Tidak Pantas"
            />
            <label for="konten">Konten Tidak Pantas</label><br />

            <input
              type="radio"
              name="laporan"
              id="perbaikan"
              value="Usulan Perbaikan"
            />
            <label for="perbaikan">Usulan Perbaikan</label><br /><br />

            <button class="kirim" type="submit">Kirim</button>
            <button class="batal" type="button">Batal</button>
          </div>
      </form>
      </div>

      <!-- MAPEL -->
      <div class="mapel">
        <div class="jenisMapel">
          <!-- Gambar Mapel -->
          <div class="gambar-mapel">
            <?php 
              $mapel = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM mapel WHERE id = $kategori[id_mapel]"));
              echo "<img src='../gambar/".$mapel['img']."' alt='$mapel[pelajaran]'>";
            ?>
            
          </div>

          <!-- Nama Mapel -->
          <div class="isiMapel">
            <h3 class="nmMapel"><?php echo $mapel['pelajaran'] ?></h3>
            <!-- Pertanyaan yang sudah dijawab --><p>Pertanyaan <br />15/25</p>
            <!-- Waktu pengerjaan -->
            <p id="timer">Time Remaining: <?php echo calculateRemainingTime(); ?></p>
            <?php

            function calculateRemainingTime() {
              $startTime = $_SESSION['start_time']; // Assuming you have stored the start time in the session
              $currentTime = time();
              $timeLimit = 30 * 60; // 30 minutes in seconds

              $remainingTime = $timeLimit - ($currentTime - $startTime);
              $formattedTime = gmdate("i:s", $remainingTime); // Format the remaining time as minutes and seconds

              if ($remainingTime <= 0) {
                return "Time's up!";
              }

              return $formattedTime;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <footer>
      <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>

    <script>
      function backBtn() {
        window.location = "soal.php?id=<?php echo $id ?>&halaman=<?php echo $_GET['halaman'] - 1 ?>&mapel=<?php echo $_GET['mapel'] ?>";
      }

      function nextBtn() {
        window.location = "soal.php?id=<?php echo $id ?>&halaman=<?php echo $_GET['halaman'] + 1 ?>&mapel=<?php echo $_GET['mapel'] ?>";
      }
    </script>
  </body>
</html>
