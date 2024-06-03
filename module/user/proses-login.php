<?php
session_start();
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
if ($query && mysqli_num_rows($query) == 1) {
    $row = mysqli_fetch_array($query);
    $passwordCheck = $row['password'];

    if (password_verify($password, $passwordCheck)) {
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['email'] = $row['email'];
        header("location: " . BASE_URL . "index.php?page=home");
        exit();
    } else {
        $_SESSION['error_message'] = "Email atau password salah!";
        header("location: ".BASE_URL."index.php?page=module/user/login&notif=tes");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Email atau password salah!";
    header("location: ".BASE_URL."index.php?page=module/user/login&notif=first");
    exit();
}
?>
