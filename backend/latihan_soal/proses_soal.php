<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    print_r($_POST);
    $kesulitan = $_POST['kesulitan'];
    $id_kategori = $_POST['kategori'];
    $pertanyaan = $_POST['pertanyaan'];
    $a = $_POST['jawaban'];
    $b = $_POST['opsi2'];
    $c = $_POST['opsi3'];
    $d = $_POST['opsi4'];
    $query = "INSERT INTO soal (id_kategori,kesulitan,pertanyaan) VALUES ('$id_kategori','$kesulitan','$pertanyaan')";
    $insertsoal = mysqli_query($mysqli, $query);
    $id_soal_baru = mysqli_insert_id($mysqli);
    echo $id_soal_baru;
    $query2 = "INSERT INTO pilihan (id_soal,teks_pilihan) VALUES ('$id_soal_baru','$a')";
    $insertjawaban = mysqli_query($mysqli, $query2);
    $id_jawaban = mysqli_insert_id($mysqli);
    echo $id_jawaban;
    $query6 = "UPDATE soal SET jawaban='$id_jawaban' WHERE id='$id_soal_baru'";
    $updatejawaban = mysqli_query($mysqli, $query6);

    $query3 = "INSERT INTO pilihan (id_soal,teks_pilihan) VALUES ('$id_soal_baru','$b')";
    $insertopsi2 = mysqli_query($mysqli, $query3);
    
    $query4 = "INSERT INTO pilihan (id_soal,teks_pilihan) VALUES ('$id_soal_baru','$c')";
    $insertopsi3 = mysqli_query($mysqli, $query4);

    $query5 = "INSERT INTO pilihan (id_soal,teks_pilihan) VALUES ('$id_soal_baru','$d')";
    $insertopsi4 = mysqli_query($mysqli, $query5);

    if($insertsoal && $insertjawaban && $insertopsi2 && $insertopsi3 && $insertopsi4){
        echo "<script>alert('Soal berhasil ditambahkan!');window.location.href='download-latihan.php?id=".$_POST['id']."&kategori=".$_POST['mapel']."';</script>";
    }
    else{
        echo "<script>alert('Soal gagal ditambahkan!');window.location.href='download-latihan.php?id=".$_POST['id']."&kategori=".$_POST['mapel']."';</script>";
    }

?>