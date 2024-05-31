<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if($query && mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_array($query);
        $passwordCheck = $row['password'];
        $hash_default_salt = password_hash($password, PASSWORD_DEFAULT);

        if(password_verify($password, $passwordCheck)) {
            $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$passwordCheck'");
            $row = mysqli_fetch_array($query);
            
        
            session_start();
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['email'] = $row['email'];
            header("location: ".BASE_URL."index.php?page=home");
        } else {
            header("location: ".BASE_URL."index.php?page=module/user/login&notif=tes");
        }
    } else {
        header("location: ".BASE_URL."index.php?page=module/user/login&notif=first");
    }