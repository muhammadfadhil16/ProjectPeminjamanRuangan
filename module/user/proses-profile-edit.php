<?php
  include_once("../../function/koneksi.php");
  include_once("../../function/helper.php");

  $id_user = $_POST['id_user'];
  $username = $_POST['username'];
  $nama_depan = $_POST['nama_depan'];
  $nama_belakang = $_POST['nama_belakang'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  $query = mysqli_query($conn, "SELECT * FROM account WHERE username='$username'");
  
  if(mysqli_num_rows($query) > 1) {
    header("location:".BASE_URL."index.php?page=module/user/profile-edit&notif=username");
  } else if($password != $confirm_password){
    header("location:".BASE_URL."index.php?page=module/user/profile-edit&notif=password-failed");
  } else {
    $hash_default_salt = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE account SET username='$username',
                                            nama_depan='$nama_depan',
                                            nama_belakang='$nama_belakang',
                                            password = '$hash_default_salt'
                                            WHERE id_user='$id_user'");

    mysqli_query($conn, "UPDATE activity SET last_activity=NOW() WHERE id_user='$id_user'");
    
    header("location:".BASE_URL."index.php?page=module/user/profile&notif=edit-success");
  }
