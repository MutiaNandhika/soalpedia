<?php
    include "../config.php";
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: ../logres.php");
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kategori Soal</title>

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
        <a href="draft_materi.php?id=<?php echo $id ?>"><img src="../icon/back.svg" alt=""></a>
        <a href="draft_materi.php?id=<?php echo $id ?>">Back</a>
    </div>

    <div class="main">
        <span>Tambah Kategori Materi</span>
        <form action="proses_kategori.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama Kategori</td>
                    <td>:</td>
                    <td>
                        <label for="kategori"></label>
                        <input class="judul" type="text" name="kategori" placeholder="masukkan nama kategori...">
                    </td>
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td>:</td>
                    <td>
                    <select class="" name="mapel" id="mapel">
                        <option value="">Pilih Mata Pelajaran</option>
                        <?php
                            $query = "SELECT * FROM mapel";
                            $result = mysqli_query($mysqli, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['id']."'";
                                if($row['id'] == $id){
                                    echo "selected";
                                }
                                echo ">".$row['pelajaran']."</option>";
                            }
                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>
                    <select class="" name="kelas" id="kelas">
                        <option value="">Pilih Kelas</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="id" value = <?php echo $id ?>></td>
                    <td>
                        <label for="cancel"></label>
                        <a href="draft_materi.php?id=<?php echo $id ?>" class="cancel" name="cancel" >Cancel</a>

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