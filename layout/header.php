<?php
// File: header.php

include_once("function/koneksi.php");
include_once("function/helper.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
$page = basename($_SERVER['PHP_SELF']);
$hideBookingButtons = isset($_SESSION['id_user']) || $page == 'login.php' || $page == 'register.php';

function displayBookingButtons($hideBookingButtons) {
    if (!$hideBookingButtons) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/user_bookings'; ?>">Booking Ruangan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/Riwayat_booking'; ?>">Check Status Booking</a>
        </li>
        <?php
    }
}
?>

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
            .navbar-nav .dropdown-menu {
                display: none !important; /* Hide dropdown on navbar */
            }
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
                    <?php if (!$hideBookingButtons) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/user_bookings'; ?>">Booking Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . 'index.php?page=module/BookingRuangan/Riwayat_booking'; ?>">Check Status Booking</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($id_user && $page != 'login.php' && $page != 'register.php') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php displayBookingButtons($hideBookingButtons); ?>
                                <li><hr class="dropdown-divider"></li>
                                <form action="<?php echo BASE_URL . "/module/user/logout.php"; ?>" method="post">
                                    <button type="submit" class="dropdown-item" style="background-color: transparent; border: none;">Logout</button>
                                </form>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Other content in your page goes here -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
