<?php 
  include_once("function/koneksi.php");
  include_once("function/helper.php");

  $id_user = $_GET['id_user'];
  mysqli_query($conn, "DELETE FROM upload_resep WHERE id_user='$id_user'");
  mysqli_query($conn, "DELETE FROM testimoni WHERE id_user='$id_user'");
  mysqli_query($conn, "DELETE FROM activity WHERE id_user='$id_user'");
  mysqli_query($conn, "DELETE FROM account WHERE id_user='$id_user'");

  header("location: ".BASE_URL."index.php?page=module/admin/user");