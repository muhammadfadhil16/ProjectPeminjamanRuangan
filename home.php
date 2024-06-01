<?php
if(!$id_user){
    header("location: ".BASE_URL."index.php?page=module/user/login");
  }
  ?>
<section>
        <div class="container-img-home">
            <img src="images/home/home3.jpg" class="bg-img" alt="Gambar Latar Belakang" />
            <div class="containerHead">
                <div class="leftHead">
                    <div class="title">
                        <h5>Booking Ruangan Fakultas Teknik</h5>
                    </div>
                    <div class="subtitle">
                        <p>Solusi Mudah untuk Kebutuhan Peminjaman Ruangan Anda</p>
                    </div>
                  </div>
                </div>
              </div>
              <ul class="opsi">
                  <li><a href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/user_bookings'; ?>">Booking Ruangan</a></li>
                  <li><a href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/Riwayat_booking'; ?>">Check Status Booking</a></li>
              </ul>
    </section>
</body>
</html>
