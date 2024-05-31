<?php
	if(!$id_user){
		header("location: ".BASE_URL);
	}

	$query = mysqli_query($conn, "SELECT * FROM account WHERE id_user='$id_user'");
  $row = mysqli_fetch_assoc($query);
?>

<style>
    table {
        text-align: left;
    }

		label {
			color: black !important;
		}
</style>
<section>
	<div id="feedback-form">
		<h2 class="header">Edit Profile</h2>
		<div>
			<form action="<?php echo BASE_URL."module/user/proses-profile-edit.php";  ?>" method="post">
				<div class="coll-notif">
					<?php
						$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
						
						if($notif == "password-failed") {
							$message = "Maaf, Password yang Anda input tidak sesuai";
							echo "<script type='text/javascript'>alert('$message');</script>";
						} else if($notif == "username") {
							$message = "Maaf, Username yang Anda input sudah terdaftar";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					?>
				</div>
				<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
				<label for="">Username</label>
				<input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" required/>

				<label for="nama_depan">Nama Depan</label>
				<input type="text" name="nama_depan" placeholder="Nama Depan" value="<?php echo $row['nama_depan'] ?>" required>

				<label for="nama_belakang">Nama Belakang</label>
				<input type="text" name="nama_belakang" placeholder="Nama Belakang" value="<?php echo $row['nama_belakang'] ?>" required>

				<label for="password">Password</label>
				<input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>

				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
				<button type="submit">Update</button>
			</form>
		</div>
	</div>
</section>