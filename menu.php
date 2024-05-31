<?php
  include_once("layout/sidebar.php");
?>

<div class="search">
  <div class="input-search">
    <input type="text" name="keyword" autocomplete="off" placeholder="Search...." id="keyword"/>
  </div>
</div>

<div id="container">
  <div class="container-menu">
    <?php 
      $queryResep = mysqli_query($conn, "SELECT * FROM upload_resep");
      $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
      if(mysqli_num_rows($queryResep) == 0) {
        echo "<h1 style='margin-bottom:30vh; text-align:center;'>Belum ada Resep Yang Tersedia</h1>";
      } else {
          while($rowKategori = mysqli_fetch_assoc($queryKategori)) {
          $queryResepBy = mysqli_query($conn, "SELECT * FROM upload_resep WHERE kategori='$rowKategori[id_kategori]'");
          if(mysqli_num_rows($queryResepBy) > 0) {
    ?>
            <button type='button' class='collapsible'><?php echo $rowKategori['nama_kategori']; ?></button>
            <div class='content-news'>
              <section>
                <div class='container'>
                  <div class='row'>
    <?php
          }
          while($rowResep = mysqli_fetch_assoc($queryResepBy)) {
            if($rowResep['kategori'] == $rowKategori['id_kategori']) {
    ?>
              <div class='container-card'>
                <div class='card'>
                  <img src="./images/<?php echo "$rowKategori[nama_kategori]/$rowResep[gambar]"; ?>" alt="alt" />
                  <div class='card-body'>
                    <div class="card-button"></div>
                    <a href="<?php echo BASE_URL."index.php?page=module/resep/detail-resep&id_resep=$rowResep[id_resep]&id_user=$id_user"; ?>">
                      <div class="isi">
                        <h3><?php echo $rowResep['nama_resep']; ?></h3>
                        <h5><?php echo $rowResep['resep_owner']; ?></h5>
                        <h4>Bahan - Bahan</h4>
                        <p style="white-space: pre-wrap;"><?php echo $rowResep['bahan']; ?></p>
                        <h4>Langkah - Langkah</h4>
                        <p style="white-space: pre-wrap;"><?php echo $rowResep['step']; ?></p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
    <?php
            }
          }

          if(mysqli_num_rows($queryResepBy) > 0) {
    ?>
            </div>
            </div>
            </section>
            </div>
    <?php
          }
        }
      }
    ?>
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
