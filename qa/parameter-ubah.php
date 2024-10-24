<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=parameter-ubah');
	}

	$user = $aksi->caridata("parameter_qa_tbl WHERE id_parameter = '$_SESSION[id_parameter]'");
	$field = array(
		'id_parameter'=>@$_POST['id_parameter'],
		'password'=>@$_POST['password'],
		'full_name'=>@$_POST['full_name'],
		'nik'=>@$_POST['nik'],
		'role'=>@$_POST['role'],
		'status'=>@$_POST['status'],
	);
	
	@$cek_user = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$_POST[id_parameter]' AND user != '$_SESSION[id_parameter]'");
	if (isset($_POST['ubah'])) {
		if ($cek_user > 0) {
			$aksi->pesan("user sudah ada !!!");
		}else{
			$aksi->update("parameter_qa_tbl",$field,"parameter_qa_tbl = '$_SESSION[parameter_qa_tbl]'");
			$aksi->alert("Data Berhasil diubah","?menu=parameter-ubah");
			$_SESSION['parameter']=@$_POST['parameter'];
			$_SESSION['par_desc']=@$_POST['par_desc'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Parameter</title>
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