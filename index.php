<?php
  session_start();
  
  include_once("function/helper.php");
	include_once("function/koneksi.php");

  $page = isset($_GET['page']) ? $_GET['page'] : 'Page, not found';
	$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
  
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/e0bb680df5.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="<?php echo BASE_URL."css/style.css"; ?>"/>
    <link rel="stylesheet" href="<?php echo BASE_URL."css/responsive.css"; ?>"/>
    <link
      rel="stylesheet"
      href="path/to/font-awesome/css/font-awesome.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
    >
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet"
    />

    <link rel="icon" href="images/logopng.png" type="image/icon type">

    <title>Peminjaman Ruangan Fakultas Teknik</title>
  </head>
  <body>
    <div class="content">
      <?php
    if($id_user){
      ?>
      <a href="<?php echo BASE_URL."index.php?page=module/user/logout"; ?>">
                        <button type="submit" class="container-fluid">Logout</button>
                    </a>
    <?php
    }
    if(!$id_user && $page != "module/user/login") {
      echo $id_user;
      ?>
      <a href="<?php echo BASE_URL."index.php?page=module/user/login"; ?>">
                        <button type="submit" class="container-fluid">Login</button>
                    </a>
    <?php
    }
  ?>
      <?php
        // include_once("layout/sidebar.php");

        $filename = "$page.php";
  
        if(file_exists($filename)) {
          include_once($filename);
        } else {
          include_once("home.php");
        }
      ?>
    </div>
    <?php
      include_once("layout/footer.php");
    ?>
  </body>
</html>
