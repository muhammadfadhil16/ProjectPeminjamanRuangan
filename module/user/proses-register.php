<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    
    if(mysqli_num_rows($query) == 1) {
        header("location: ".BASE_URL."index.php?page=module/user/register&notif=username");
    } else if ($password != $re_password) {
        header("location: ".BASE_URL."index.php?page=module/user/register&notif=password");
    } else {
        $hash_default_salt = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user (email, password) VALUES ('$email', '$hash_default_salt' )");

        $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$username' AND password='$hash_default_salt'");
        $row = mysqli_fetch_array($query);
        $id_user = $row['id_user'];

        header("location: ".BASE_URL."index.php?page=module/user/login");
    }