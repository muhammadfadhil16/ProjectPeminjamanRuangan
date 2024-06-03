<?php
  if($id_user){
    header("location: ".BASE_URL);
  }
?>

<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Register</h3>

            <form action="<?php echo BASE_URL."/module/user/proses-register.php"; ?>" method="post">
              <div class="form-outline mb-4">
                <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" required />
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="re_password" class="form-control form-control-lg" placeholder="Re-Type Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>

            </form>

            <hr class="my-4">

            <p class="mt-3">Sudah Punya akun? <a href="<?php echo BASE_URL."index.php?page=module/user/login"; ?>" class="text-reset">Masuk disini</a></p>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
