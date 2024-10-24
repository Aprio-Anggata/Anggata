<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=profil');
	}

	$user = $aksi->caridata("user_tbl WHERE id_user = '$_SESSION[id_user]'");
	$field = array(
		'user'=>@$_POST['user'],
		'password'=>@$_POST['password'],
		'full_name'=>@$_POST['full_name'],
		'nik'=>@$_POST['nik'],
		'role'=>@$_POST['role'],
		'status'=>@$_POST['status'],
		'date_valid_from'=>@$_POST['date_valid_from'],
		'date_valid_to'=>@$_POST['date_valid_to'],
		'email'=>@$_POST['email'],
		'direct_superior'=>@$_POST['direct_superior'],
		'nik_superior'=>@$_POST['nik_superior'],
	);
	
	@$cek_user = $aksi->cekdata("user_tbl WHERE user = '$_POST[user]' AND user != '$_SESSION[user]'");
	if (isset($_POST['ubah'])) {
		if ($cek_user > 0) {
			$aksi->pesan("user sudah ada !!!");
		}else{
			$aksi->update("user_tbl",$field,"id_user = '$_SESSION[id_user]'");
			$aksi->alert("Data Berhasil diubah","?menu=profil");
			$_SESSION['full_name']=@$_POST['full_name'];
			$_SESSION['user']=@$_POST['user'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>AKUN</title>
</head>
<style type="text/css">
  .panel-heading{
    background: #cceeff	 !important;
  }
  .panel-body{
	  background: #f7f8f7 !important;
  }
</style>
<body>
	<div class="container" style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading"><center><h4>UBAH DATA DIRI ANDA</h4></center></div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="form-group">
										<label>ID USER</label>
										<input type="text" name="id_user" class="form-control" value="<?php echo $user['id_user'] ?>" required readonly>
									</div>
									<div class="form-group">
										<label>USERNAME</label>
										<input type="text" name="user" class="form-control" value="<?php echo $user['user'] ?>" required placeholder="Masukan username Anda" required onsubmit="this.setCustomValidity('')"> 
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" value="<?php echo $user['password'] ?>" required placeholder="Masukan password Anda" required onsubmit="this.setCustomValidity('')"> 
									</div>
									<div class="form-group">
										<label>NIK</label>
										<input type="text" name="nik" class="form-control" value="<?php echo $user['nik'] ?>" readonly>
									</div>
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name'] ?>" required placeholder="Masukan nama lengkap Anda" required onsubmit="this.setCustomValidity('')"> 
									</div>
									<div class="form-group">
										<label>ROLE</label>
										<input type="text" name="role" class="form-control" value="<?php echo $user['role'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>STATUS</label>
										<select name="status" class="form-control" required>
											<option value="a" <?php if($user['status']=="a"){ echo "selected"; } ?>>a</option>
											<option value="n" <?php if($user['status']=="n"){ echo "selected"; } ?>>n</option>
										</select>
									</div>
									<div class="form-group">
										<label>DATE VALID FROM</label>
										<input type="date" name="date_valid_from" class="form-control" value="<?php echo $user['date_valid_from'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>DATE VALID TO</label>
										<input type="date" name="date_valid_to" class="form-control" value="<?php echo $user['date_valid_to'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>EMAIL</label>
										<input type="text" name="email" class="form-control" value="<?php echo $user['email'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>DIRECT SUPERIOR</label>
										<input type="text" name="direct_superior" class="form-control" value="<?php echo $user['direct_superior'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<label>NIK SUPERIOR</label>
										<input type="text" name="nik_superior" class="form-control" value="<?php echo $user['nik_superior'] ?>" required readonly> 
									</div>
									<div class="form-group">
										<input type="submit" name="ubah" class="btn btn-primary btn-block btn-lg" value="UBAH DATA" style="background: #9e6bff;">
									</div>
								</form>
							</div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>