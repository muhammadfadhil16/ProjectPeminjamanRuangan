<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #007bff;
            margin-top: 50px; /* Adjust margin-top as needed */
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            text-align: center;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .mt-3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Admin Sign In</h5>

                        <?php
                        // Tampilkan pesan notifikasi jika ada
                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']); // Hapus pesan notifikasi setelah ditampilkan
                        }
                        ?>

                        <form action="<?php echo BASE_URL."/module/admin/proses_login_admin.php"; ?>" method="post">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    Remember password
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold mx-auto" type="submit">Login</button>
                            </div>
                        </form>
                        <hr class="my-4">
                        <p class="mt-3">Login sebagai User? <a href="<?php echo BASE_URL."index.php?page=module/user/login"; ?>" class="text-reset">Login sebagai User</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
