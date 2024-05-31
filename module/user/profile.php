<?php
	if(!$id_user){
		header("location: ".BASE_URL);
	}

    $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
            
    if($notif == "ekstensi") {
        $message = "Maaf, ekstensi file yang diupload tidak diizinkan";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if($notif == "edit-resep-sucsess") {
        $message = "Edit Resep Berhasil";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>

<style>
    table {
        text-align: left;
    }
</style>
<section>
    <div id="feedback-form">
        <h2 class="header">Profile</h2>
        <div class="container">
            <?php
            $queryProfile = mysqli_query($conn, "SELECT * FROM account WHERE id_user='$id_user'");
            while ($row = mysqli_fetch_assoc($queryProfile)) {
                $gender = $row['gender']; 
            ?>
    
            <div class="row">
                <figure class="snip1390">
                    <?php if ($gender == "pria") { ?>
                        <img src="images/testi/testi1.jpeg" alt="profile-sample3" class="profile"/>
                    <?php } else { ?>
                        <img src="images/testi/testi2.jpeg" alt="profile-sample4" class="profile"/>
                    <?php } ?>
                </figure>
            </div>
    
            <?php } ?>
        </div>
        <div>
            <div class="coll">
                <?php
                    $data = mysqli_query($conn, "SELECT * FROM account where id_user = '$id_user'"); 
                    while($dta = mysqli_fetch_array($data)){
                ?>
                    <table>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $dta['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Depan </th>
                        <td><?php echo $dta['nama_depan']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Belakang </th>
                        <td><?php echo $dta['nama_belakang']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin </th>
                        <td><?php echo $dta['gender']; ?></td>
                    </tr>
                    </table>
                    <a href="<?php echo BASE_URL."index.php?page=module/user/profile-edit&id_user=$dta[id_user]"; ?>">
                        <button type="submit">Edit Profile</button>
                    </a>
                    <a href="<?php echo BASE_URL."index.php?page=module/user/logout"; ?>">
                        <button type="submit">Logout</button>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<div id="container">
    <h2 style="text-align: center;">Resep Saya</h2>
    <div class="container-menu">
        <div class="content-news-profile">
            <section>
                <?php 
                    $resep = mysqli_query($conn, "SELECT * FROM upload_resep WHERE id_user='$id_user'");
                    if(mysqli_num_rows($resep) == 0) {
                        echo "<h1 style='padding: 2rem 0 5rem 0; text-align:center;'>Belum ada Resep Yang Tersedia</h1>";
                    } else {
                ?>
                    <div class="container">
                    <?php 
                        while($rowResep = mysqli_fetch_assoc($resep)) {
                            $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$rowResep[kategori]'");
                            $rowKategori = mysqli_fetch_assoc($queryKategori);
                    ?>
                            <div class="row">
                            <div class="container-card">
                                <div class="card">
                                    <img src="./images/<?php echo "$rowKategori[nama_kategori]/$rowResep[gambar]"; ?>" alt="alt" />
                                    <div class="card-body">
                                        <div class="card-button">
                                            <a href="<?php echo BASE_URL."index.php?page=module/resep/edit-resep&id_resep=$rowResep[id_resep]"; ?>">
                                                <button type="submit">Edit</button>
                                            </a>
                                            <a href="<?php echo BASE_URL."index.php?page=module/resep/hapus-resep&id_resep=$rowResep[id_resep]"; ?>">
                                                <button type="submit">Hapus</button>
                                            </a>
                                        </div>
                                        <a href="<?php echo BASE_URL."index.php?page=module/resep/detail-resep&id_resep=$rowResep[id_resep]"; ?>">
                                        <div class="isi">
                                            <h3><?php echo $rowResep['nama_resep']; ?></h3>
                                            <h5><?php echo $rowResep['resep_owner']; ?></h5>
                                            <h4>Bahan - Bahan</h4>
                                            <p style="white-space: pre-wrap;"><?php echo $rowResep['bahan']; ?></p>
                                            <h4>Langkah - langkah</h4>
                                            <p style="white-space: pre-wrap;"><?php echo $rowResep['step']; ?></p>
                                        </div>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            </div>
                        <?php 
                        }
                    echo "</div>";
                    } ?>
            </section>
        </div>
    </div>
</div>

<script>
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  }
</script>
<script src="js/script.js"></script>