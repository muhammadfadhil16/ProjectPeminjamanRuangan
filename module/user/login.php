<section>
<div class="container-img-home">
  <img src="images/TeknikInformatikaUNTAN.jpg" class="bg-img pe-none object-fit-cover" alt="Gambar Latar Belakang" />
  <div id="feedback-form" class="containerHead">
    <h2 class="header">Login</h2>
     <div class="field-form">
       <form action="<?php echo BASE_URL."/module/user/proses-login.php";  ?>" method="post">
         <div class="coll-notif">
           <?php
             $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
             
             if($notif == "first"){
               $message = "Maaf, username atau password yang kamu masukan tidak cocok";
               echo "<script type='text/javascript'>alert('$message');</script>";
             } else if($notif == "tes"){
               $message = "Maaf, username atau password yang kamu masukan ";
               echo "<script type='text/javascript'>alert('$message');</script>";
             }
           ?>
         </div>
         <input type="text" name="email" placeholder="Email" required/>
         <input type="password" name="password" placeholder="Password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
         <button type="submit">Login</button>
       </form>
       <p> Belum Punya akun? <span> <a href="<?php echo BASE_URL."index.php?page=module/user/register"; ?>" class="user-data text-reset">Daftar disini</a></span></p>
     </div>
   </div>
</div>
</section>
