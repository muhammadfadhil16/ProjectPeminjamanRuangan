    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #f00;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>

<body>
    <nav>
        <ul>
            <li><a href="<?php echo BASE_URL."index.php?page=module/admin/Data_Peminjaman"; ?>">Peminjaman</a></li>
            <li><a href="<?php echo BASE_URL."index.php?page=module/admin/admin_riwayat_peminjaman"; ?>">Riwayat Pemesanan</a></li>
            <!-- Tambahkan link lain yang diperlukan -->
        </ul>
    </nav>
    <div class="container">
        <!-- Konten lain untuk dashboard admin -->
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Ini adalah halaman dashboard admin.</p>
    </div>
</body>
</html>
