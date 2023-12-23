<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    print_r($_POST);
    $id = $_POST['id'];
    $mapel = $_POST['mapel'];
    $kesulitan = $_POST['kesulitan'];
    $id_kategori = $_POST['kategori'];
    $pertanyaan = $_POST['pertanyaan'];
    $query = "UPDATE soal SET kesulitan = '$kesulitan', id_kategori = '$id_kategori', pertanyaan = '$pertanyaan' WHERE id = $id";
    $updatesoal = mysqli_query($mysqli, $query);

    $id_jawaban = $_POST['id_jawaban'];
    $jawaban = $_POST['jawaban'];
    $query2 = "UPDATE pilihan SET teks_pilihan = '$jawaban' WHERE id = $id_jawaban";
    $updatejawaban = mysqli_query($mysqli, $query2);

    $id_opsi2 = $_POST['id_opsi2'];
    $opsi2 = $_POST['opsi2'];
    $query3 = "UPDATE pilihan SET teks_pilihan = '$opsi2' WHERE id = $id_opsi2";
    $updateopsi2 = mysqli_query($mysqli, $query3);

    $id_opsi3 = $_POST['id_opsi3'];
    $opsi3 = $_POST['opsi3'];
    $query4 = "UPDATE pilihan SET teks_pilihan = '$opsi3' WHERE id = $id_opsi3";
    $updateopsi3 = mysqli_query($mysqli, $query4);

    $id_opsi4 = $_POST['id_opsi4'];
    $opsi4 = $_POST['opsi4'];
    $query5 = "UPDATE pilihan SET teks_pilihan = '$opsi4' WHERE id = $id_opsi4";
    $updateopsi4 = mysqli_query($mysqli, $query5);

    if($updatesoal && $updatejawaban && $updateopsi2 && $updateopsi3 && $updateopsi4){
        echo "<script>alert('Soal berhasil diubah!');window.location.href='download-latihan.php?id=".$_POST['kategori']."&kategori=".$_POST['mapel']."';</script>";
    }
    else{
        echo "<script>alert('Soal gagal diubah!');window.location.href='download-latihan.php?id=".$_POST['kategori']."&kategori=".$_POST['mapel']."';</script>";
    }

?>