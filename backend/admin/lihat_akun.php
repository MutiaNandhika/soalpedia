<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    if($_SESSION['role'] != 'admin') {
        header("Location: ../index.php");
    }
    $query = "select * from user";
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tabel User</title>

    <link rel="stylesheet" href="lihat.css" />

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
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="../mapel/mapel.php"><img src="../icon/back.svg" alt=""></a>
      <a href="../mapel/mapel.php">Back</a>
    </div>

    <center>
        <div class="main">
          <div class="tabel-user">
            <p>Tabel User</p>
          </div>
        </div>

        <div class="tambahUser">
          <a class="add" href="tambah-user.php"><img src="../icon/add.svg" alt=""></a>
          <a class="tambah" href="tambah-user.php">Tambah User</a>
        </div>
    </center>

    <center>
      <div class="download">
        <!-- TABEL User -->
        <table border="0" cellpadding="10" cellspacing="0">
            <tr class="tag-head">
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            <?php
              $i = 1;
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['role']."</td>";
                echo "<td>";
                echo "<div class='icon'>";
                echo "<a class='edit' href='edit-user.php?id=".$row['id']."'><img src='../icon/edit.svg' alt=''></a>";
                echo "<a class='trash' href='delete-user.php?id=".$row['id']."'><img src='../icon/trash.svg' alt=''></a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
                $i++;
              }
            ?>
            <!-- <tr>
                <td>1</td>
                <td>Farah</td>
                <td>www@gmail.com</td>
                <td>Siswa</td>
                <td>
                  <div class="icon">
                    Tombol Edit Porfil
                    <a class="edit" href="../mapel/edit-profil.html"><img src="../icon/edit.svg" alt=""></a>

                    Tombol Hapus
                    <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
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
