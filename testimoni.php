<section>
  <div class="container-testimoni">
    <?php
      $queryTesti = mysqli_query($conn, "SELECT * FROM testimoni");
      $count = mysqli_num_rows($queryTesti);

      if($count == 0) {
        echo "<h1>Belum ada Testimoni</h1>";
      } else {
        $i = 1;
    ?>
        <div class="container">
          <?php
            while($row = mysqli_fetch_assoc($queryTesti)) {
              $nama = mysqli_query($conn, "SELECT * FROM account WHERE id_user='$row[id_user]'");
              $nama = mysqli_fetch_assoc($nama);
              if($i % 3 == 0) {

              }
          ?>
              <div class="row">
                <figure class="snip1390">
            <?php if($nama['gender'] == "pria") { ?>
                    <img src="images/testi/testi1.jpeg" alt="profile-sample3" class="profile"/>
            <?php }else { ?>
                    <img src="images/testi/testi2.jpeg" alt="profile-sample4" class="profile"/>
            <?php } ?>
                  <figcaption>
                    <h2><?php echo $nama['username']; ?></h2>
                    <blockquote><?php echo $row['isi']; ?></blockquote>
                  </figcaption>
                </figure>
              </div>
      <?php $i++;
          } ?>
        </div>
<?php } ?>
  </div>
</section>