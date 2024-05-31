<?php
  if(!$id_user) {
    header("location:".BASE_URL."index.php?page=module/user/login");
  }
?>

<div class="container-img">
  <img src="images/home/home3.jpg" class="bg-img" alt="alt" />
  <?php
    include_once("layout/sidebar.php");
  ?>
  <section>
    <div
      class="container-form"
    >
      <form action="<?php echo BASE_URL."module/testimoni/proses-upload-testi.php?id_user=$id_user"; ?>" method="post">
        <div class="title-form">
          <h2>Kritik & Saran</h2>
        </div>

        <div class="container">
          <div class="row">
            <div class="">
              <label for="subject">Kritik & Saran</label>
            </div>
            <div class="textbox">
              <textarea
                id="isi"
                name="isi"
                placeholder="Kritik & Saran.."
                style="height: 200px"
                required
              ></textarea>
            </div>
          </div>

          <div class="box row">
            <label for="sumber">Anda mengetahui web ini dari mana</label>
              <select name="sumber">
                <option value="Instagram">Instagram</option>
                <option value="Twitter">Twitter</option>
                <option value="Teman">Teman</option>
                <option value="Internet">Internet</option>
              </select>
          </div>

          <div class="row">
            <p>Apakah Web ini membantu:</p>
            <div class="row-optionY">
              <input type="radio" id="ya" name="membantu" value="Ya" required/>
              <label for="Ya">Ya</label><br />
            </div>
            <div class="row-optionN">
              <input type="radio" id="tidak" name="membantu" value="Tidak" required/>
              <label for="Tidak">Tidak</label><br />
            </div>
          </div>

          <div class="button">
            <button type="submit">Upload</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
