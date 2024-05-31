<?php
  require '../function/koneksi.php';
  require '../function/helper.php';
  $keyword = $_GET["keyword"];
  $queryResep = "SELECT * FROM upload_resep
                      WHERE 
                      nama_resep LIKE '%$keyword%' OR
                      resep_owner LIKE '%$keyword%' OR
                      bahan LIKE '%$keyword%' OR
                      step LIKE '%$keyword%'";

  $resep = mysqli_query($conn, $queryResep);
?>

<div class="container-menu">
  <div class='content-news-ajax'>
    <section>
      <div class='container'>
  <?php 
    while($rowResep = mysqli_fetch_assoc($resep)) {
      $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$rowResep[kategori]'");
      $rowKategori = mysqli_fetch_assoc($queryKategori);
            echo "<div class='row'>";
              echo "<div class='container-card'>";
                echo "<div class='card'>";
                  echo "<img src='./images/$rowKategori[nama_kategori]/".$rowResep['gambar']."' alt='alt' />";
                  echo "<div class='card-body'>";
                  echo "<a href='" . BASE_URL . "index.php?page=module/resep/detail-resep&id_resep=" . $rowResep['id_resep'] . "'>";
                  echo "<div class='isi'>";
                    echo "<h3>".$rowResep['nama_resep']."</h3>";
                    echo "<h5>".$rowResep['resep_owner']."</h5>";
                    echo "<p style='white-space: pre-wrap;'>".$rowResep['bahan']."</p>";
                    echo "<p style='white-space: pre-wrap;'>".$rowResep['step']."</p>";
                  echo "</div>";
                  echo "</a>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          }
          ?>
      </div>
    </section>
  </div>
</div>