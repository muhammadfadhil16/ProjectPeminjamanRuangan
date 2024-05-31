<?php
	if($id_user){
		header("location: ".BASE_URL);
	}
?>

<section>
  <div id="feedback-form">
    <h2 class="header">Register</h2>
    <div class="field-form">
      <div class="coll-notif">
        <?php
          $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
          
          if($notif == "password") {
            $message = "Maaf, Password yang Anda input tidak sesuai";
            echo "<script type='text/javascript'>alert('$message');</script>";
          } else if($notif == "username") {
            $message = "Maaf, Username yang Anda input sudah terdaftar";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
        ?>
      </div>
      <form action="<?php echo BASE_URL."/module/user/proses-register.php"; ?>" method="post">
        <input type="text" name="email" placeholder="Email" required/>
        <input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
        <input
          type="password"
          name="re_password"
          placeholder="Re-Type Password"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required
        />
        <button type="submit">Register</button>
      </form>
      <a href="<?php echo BASE_URL."index.php?page=module/user/login"; ?>" class="user-data">Sudah Punya akun? Masuk disini</a>
    </div>
  </div>
</section>
