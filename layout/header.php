<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peminjaman Ruangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      padding-top: 70px; /* Adjusting padding to accommodate fixed navbar */
      font-family: Arial, sans-serif;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar-brand img {
      margin-right: 10px;
      max-height: 30px;
      width: auto;
    }

    .logout-btn {
      margin-left: 20px;
    }

    @media (max-width: 768px) {
      .navbar-brand img {
        max-height: 25px;
      }
    }

    .nav-link {
      margin-left: 15px;
      margin-right: 15px;
      color: #000;
      transition: color 0.3s;
    }

    .nav-link:hover {
      color: #007bff;
      text-decoration: none;
    }

    .navbar-nav .nav-item {
      margin-left: 10px;
      margin-right: 10px;
    }

    .nav-item:hover .dropdown-menu {
      display: block;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 120px;
      z-index: 1000;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown-menu a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      transition: background-color 0.3s;
    }

    .dropdown-menu a:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/Logo UNTAN.png" width="30" height="30" class="d-inline-block align-top" alt="">
          Peminjaman Ruangan Fakultas Teknik Universitas Tanjungpura
        </a>
        <ul class="navbar-nav d-flex flex-row align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/user_bookings'; ?>">Booking Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/Riwayat_booking'; ?>">Check Status Booking</a>
          </li>
          <?php if ($id_user && $page != 'module/user/login' && $page != 'module/user/register') : ?>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#">Menu</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/user_bookings'; ?>">Booking Ruangan</a>
                <a class="dropdown-item" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/Riwayat_booking'; ?>">Check Status Booking</a>
                <form action="<?php echo BASE_URL."/module/user/logout.php"; ?>" method="post">
                  <button type="submit" class="dropdown-item" style="background-color: transparent; border: none;">Logout</button>
                </form>
              </div>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container">
    <!-- Konten halaman lainnya dimulai di sini -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
