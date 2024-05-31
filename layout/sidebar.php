<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
?>

<div class="topnav">
  <a href="<?php echo BASE_URL."index.php?page=home"; ?>">
    <div class="leftnav">
      <div class="logo1">
        <img alt="alt" src="<?php echo BASE_URL."images/logopng.png"; ?>"/>
      </div>
      <div class="logo2">
        <img alt="alt" src="<?php echo BASE_URL."images/tulisanpng.png"; ?>"/>
      </div>
      
    </div>
  </a>
  <div class="rightnav">
    <div class="logo3" style="float: right;" >
        <?php
              $queryProfile = mysqli_query($conn, "SELECT * FROM account WHERE id_user='$id_user'");
              while ($row = mysqli_fetch_assoc($queryProfile)) {
                  $gender = $row['gender']; 
              ?>

                  <figure class="snip1390">
                  <a href="<?php echo BASE_URL."index.php?page=module/user/profile"; ?>">
                      <?php if ($gender == "pria") { ?>
                          <img src="images/testi/testi1.jpeg" alt="profile-sample3" class="profile" style="    height: 6vh;
                          border-radius: 10px;
                          margin-right: 25px;" />
                      <?php } else { ?>
                          <img src="images/testi/testi2.jpeg" alt="profile-sample4" class="profile" style="    height: 6vh;
                          border-radius: 10px;
                          margin-right: 25px;"/>
                      <?php } ?>
                      </a>
                  </figure>
              <?php } ?>
        </div>
    <div class="sidebar">
      <input type="checkbox" id="check" />
      <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
      </label>
      <div class="sidebar2">
        <ul>
          <li>
            <i><a href="<?php echo BASE_URL."index.php?page=home"; ?>">Home</a></i>
          </li>
          <li>
            <i><a href="<?php echo BASE_URL."index.php?page=menu"; ?>">Menu</a></i>
          </li>
          <li>
            <i><a href="<?php echo BASE_URL."index.php?page=module/resep/uploadresep"; ?>">Upload Resep</a></i>
          </li>
          <li>
            <i><a href="<?php echo BASE_URL."index.php?page=module/testimoni/masukan"; ?>">Kritik & Saran</a></i>
          </li>
          <li>
            <i><a href="<?php echo BASE_URL."index.php?page=testimoni"; ?>">Testimoni</a></i>
          </li>
          <?php
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>