<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_POST['id'];
    $mapel = $_POST['mapel'];
    if(!isset($_POST['jawaban1'])){
        echo "<script>alert('Cache hasil jawaban hilang, mohon kirim ulang jawaban anda!');history.back();</script>";
    }
    // print_r($_POST);
    $benar = 0;
    $i = 1;
    while (isset($_POST["id_soal$i"])){
        $jawaban = $_POST["jawaban$i"];
        $id_soal = $_POST["id_soal$i"];
        $query = "SELECT * FROM soal WHERE id = $id_soal";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_assoc($result);
        if ($jawaban == $row['jawaban']){
            $benar++;
        }
        $i++;
    }
    $jumlah = $i-1;
    $nilai = round($benar/$jumlah*100);
    // echo "jumlah = " .$jumlah;
    // echo "benar = ".$benar;
    // echo "nilai = ".$nilai;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>

    <link rel="stylesheet" href="hasil.css" />

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

    <center>
        <div class="main">
            <span>Review</span>
            
            <div class="papan">
                <div class="skor">
                    <p>Anda mendapatkan skor <?php echo $nilai ?></p>
                </div>

                <div class="benar">
                    <h3>Jawaban Benar</h3>
                    <p><?php echo $benar ?> / <?php echo $jumlah ?></p>
                </div>
            </div>

            <div class="akurasi">
                <p><?php echo $nilai ?> Akurasi</p>
            </div>

            <div class="kuis">
                <a href="draft_quiz.php?id=<?php echo $mapel ?>">Temukan Kuis Lainnya</a>
            </div>

            <?php
                $num = 1;
                while (isset($_POST["id_soal$num"])){
                    $jawaban = $_POST["jawaban$num"];
                    $id_soal = $_POST["id_soal$num"];
                    $query = "SELECT * FROM soal WHERE id = $id_soal";
                    $result = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_assoc($result);
                    if ($jawaban == $row['jawaban']){
                        echo "<div class='hasil'>";
                        echo "<div class='jawaban'>";
                        echo "<p>".$row['pertanyaan']."</p>";
                        echo "<p class='correct'>Jawaban Anda: ".$jawaban."</p>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='hasil'>";
                        echo "<div class='jawaban'>";
                        echo "<p>".$row['pertanyaan']."</p>";
                        echo "<p class='wrong'>Jawaban Anda: ".$jawaban."</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                    $num++;
                }                
            ?>
            <!-- <div class="hasil">
                <center><h2>Hasil:</h2></center>
                <div class="jawaban">
                    <p>Siapa nama presiden Indonesia?</p>
                    <p class="wrong">Jawaban Anda: Joko Widodo</p>
                </div>

                <div class="jawaban">
                    <p>Siapa nama presiden Indonesia?</p>
                    <p class="correct">Jawaban Anda: Joko Widodo</p>
                </div>
            </div> -->
        </div>

        <div class="komentar">
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <td colspan="2"><b>Komentar</b></td>
                </tr>
                <tr>
                    <?php
                        $query = "SELECT * FROM komentar WHERE id_kategori = $id limit 1";
                        $result = mysqli_query($mysqli, $query);
                        $row = mysqli_fetch_assoc($result);
                        $id_user = $row['id_user'];
                        $user_query = "SELECT * FROM user WHERE id = $id_user";
                        $user_result = mysqli_query($mysqli, $user_query);
                        $user_row = mysqli_fetch_assoc($user_result);
                    ?>
                    <td colspan="2" class="komen-list">
                        <label for="nama"><?php echo $user_row['username'] ?></label><br>
                        <input type="text" name="nama" id="nama" value="<?php echo $row['komentar'] ?>"><br><br>
  
                        <a href="komentar.php?id=<?php echo $id ?>&mapel=<?php echo $mapel ?>">Lihat semua komentar</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="submit">
                        <form action="proses_komentar.php" method="POST">
                            <input type="hidden" name="id_kategori" value="<?php echo $id ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>">
                            <input type="text" name="komentar" placeholder="Kirim Komentar...">
                            <label for="submit"></label>
                            <button type="submit"><img src="../icon/submit.svg" alt=""></button>
                        </form>
                    </td>
                </tr>
            </table>
          </div>
    </center>

    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
</body>
</html>