<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $id_user = $_GET['id_user'];
    $isi = $_POST['isi'];
    $sumber = $_POST['sumber'];
    $membantu = $_POST['membantu'];

    mysqli_query($conn, "INSERT INTO testimoni (id_user, isi, sumber, membantu) VALUES ('$id_user', '$isi', '$sumber', '$membantu')");

    mysqli_query($conn, "UPDATE activity SET last_activity=NOW() WHERE id_user='$id_user'");

    header("location: ".BASE_URL."index.php?page=testimoni");