<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=sub_parameter');
	}
	//dasar
	$table = "sub_parameter_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_sub_tbl)) = '$id'";
	$redirect = "?menu=sub_parameter";

	//untuk kebutuhan crud
	@$id_sub_tbl = $_POST['id_sub_tbl'];
    @$sub_par_name = $_POST['sub_par_name'];
    @$sub_par_score= $_POST['sub_par_score'];
    @$status_sub = $_POST['status_sub'];
    @$date_valid_from = $_POST['date_valid_from'];
    @$date_valid_to = $_POST['date_valid_to'];
	@$inserted_by = $_POST['inserted_by'];
    @$date_inserted = $_POST['date_inserted'];
	@$id_sub_par = $_POST['id_sub_par'];
	@$ko_status = $_POST['ko_status'];

	//tampung data
	$data = array(
		'id_sub_tbl'=>$id_sub_tbl,
        'sub_par_name'=>$sub_par_name,
        'sub_par_score'=>$sub_par_score,
        'status_sub'=>$status_sub,
        'date_valid_from'=>$date_valid_from,
        'date_valid_to'=>$date_valid_to,
		'inserted_by'=>$inserted_by,
        'date_inserted'=>$date_inserted,
		'id_sub_par'=>$id_sub_par,
		'ko_status'=>$ko_status,
        
	);

	$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl' AND id_sub_tbl != '$edit[id_sub_tbl]'");
		if 
		($cek > 0) {
			$aksi->pesan("Sub Parameter sudah ada");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO sub_parameter_tbl (sub_par_name, sub_par_score, status_sub, date_valid_from, date_valid_to, inserted_by, date_inserted, id_sub_par, ko_status) 
			value 
			('$sub_par_name','$sub_par_score','$status_sub','$date_valid_from','$date_valid_to','$inserted_by','$date_inserted','$id_sub_par','$ko_status')"); 
			$aksi->alert("Sub Parameter Berhasil Disimpan",$redirect);
		}
	}
	
	if (isset($_POST['bubah'])) {
		$id_sub_tbl = $_POST['id_sub_tbl'];
		@$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl' AND id_sub_tbl != '$edit[id_sub_tbl]'");
		if ($cek > 0) {
			$aksi->pesan("Sub Parameter sudah ada");
		}else{
			// mysqli_query($GLOBALS["___mysqli_ston"],"UPDATE sub_parameter_tbl set parameter='$parameter', par_desc='$par_desc', par_weight='$par_weight', id_sub_par='$id_sub_par', status_par='$status_par', date_valid_from='$date_valid_from', date_valid_to='$date_valid_to',date_inserted='$date_inserted', inserted_by='$inserted_by' WHERE id_sub_tbl = '$id_sub_tbl'");
			$aksi->update($table,$data,$where);
			$aksi->alert("Sub Parameter Berhasil Diubah",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Sub Parameter Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_sub_tbl LIKE '%$text%' OR sub_par_name LIKE '%$text%' OR sub_par_score LIKE '%$text%' OR id_sub_par LIKE '%$text%' OR ko_status LIKE '%$text%' OR inserted_by LIKE '%$text%'";
	}else{
		$cari="";
	}





?>
<!DOCTYPE html>
<html>
<head>
	<title>PATAMETER</title>
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
	<br>
	<br>
	<div class="table-responsive" style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="panel panel-default">
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">MASUKKAN SUB PARAMETER</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH SUB PARAMETER</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
									<div class="col-md-12">
									<!-- <div class="form-group">
										<label>ID PARAMETER</label>                
										<input type="text" name="id_sub_tbl" class="form-control" placeholder="Insert ID parameter Name" autocomplete="on" required onsubmit="this.setCustomValidity('')">
									</div>  -->
									<div class="form-group">
										<label>Sub Parameter Name</label>                
										<input type="text" name="sub_par_name" class="form-control" placeholder="Insert Sub Parameter Name" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Sub Parameter Score</label>                
										<input type="number" name="sub_par_score" class="form-control" placeholder="Insert Score Sub Parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Status</label>
										<select type="text" name="status_sub" class="form-control" autocomplete="off" required onsubmit="this.setCustomValidity('')">
											<!-- <option value=Null></option> -->
											<option value="a">a</option>
											<option value="n">n</option>
										</select>
									</div>
									
									<div class="form-group">
										<label>Date Valid From</label>                
										<input type="date" name="date_valid_from" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Date Valid To</label>                
										<input type="date" name="date_valid_to" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Insert By</label>                
										<input type="text" name="inserted_by" class="form-control" placeholder="Insert By" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Date Inserted</label>                
										<input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>ID Sub Parameter</label>                
										<input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div>

									<div class="form-group">
										<label>Knock Out Status</label>
										<select type="text" name="ko_status" class="form-control" autocomplete="off" required onsubmit="this.setCustomValidity('')">
											<!-- <option value=Null></option> -->
											<option value="n">n</option>
											<option value="a">a</option>
										</select>
									</div>

									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN"  style="background: #9e6bff;">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=sub_parameter" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR SUB PARAMETER</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Enter a search keyword...">
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
											<button type="submit" name="refresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
										<th class="text-center">ID Number</th>
										<th class="text-center">Sub Parameter Name</th>
										<th class="text-center">Sub Paramater Score</th>
										<th class="text-center">Status</th>	
										<th class="text-center">Date Valid From</th>
										<th class="text-center">Date Valid To</th>
										<th class="text-center">Inserted By</th>
										<th class="text-center">Date Inserted</th>	
										<th class="text-center">ID Sub parameter</th>									
										<th class="text-center">Knock Out Staus</th>
										<th colspan="2"><center>Option</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"");
												if ($data=="") {
													$aksi->no_record(7);
												}else{
													foreach ($data as $r) {
														$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$r[id_sub_tbl]'");
													$no++; ?>

													<tr>
													<td class="text-center"><?php echo $r['id_sub_tbl'];?></td>
													<td class="text-center"><?php echo $r['sub_par_name'];?></td>
													<td class="text-center"><?php echo $r['sub_par_score'];?></td>
													<td class="text-center"><?php echo $r['status_sub'];?></td>
													<td class="text-center"><?php echo $r['date_valid_from'];?></td>
													<td class="text-center"><?php echo $r['date_valid_to'];?></td>
													<td class="text-center"><?php echo $r['inserted_by'];?></td>
													<td class="text-center"><?php echo $r['date_inserted'];?></td>													
													<td class="text-center"><?php echo $r['id_sub_par'];?></td>
													<td class="text-center"><?php echo $r['ko_status'];?></td>
													<td align="center"><a href="?menu=sub_parameter&edit&id=<?php echo $r['id_sub_tbl']; ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
													<td align="center"><a href="?menu=sub_parameter&hapus&id=<?php echo md5(sha1($r['id_sub_tbl'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
													</tr>
											<?php } } ?>
										 </tbody>
									</table>
								</div>
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