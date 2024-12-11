<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=process');
	}
	//dasar
	$table = "population_tbl";
	$id = @$_GET['id'];
	$where = " sid = '$id'";
	$redirect = "?menu=process";

	if (isset($_POST['sid'])) {
		$sid = $_POST['sid'];
		$population = $aksi->caridata("population_tbl WHERE sid = '$sid'");
		if ($population == "") {
			$aksi->pesan('Data has been deleted');
		}
	}elseif(isset($_GET['hapus']) OR isset($_GET['edit'])){
		$population = $aksi->caridata("population_tbl WHERE sid = '$id'");
		$sid = $population['sid'];
	}
        //Population
		@$population = $aksi->caridata("population_tbl WHERE sid = '$sid'");
        @$sid = $population['sid'];
        @$contract_number = $population['contract_number'];
        @$source = $population['source'];
        @$full_name = $population['full_name'];
        @$type = $population['type'];
        @$subtype = $population['subtype'];
        @$sub_subtype = $population['sub_subtype'];
        @$note = $population['note'];
        @$result = $population['result'];
        @$date_input = $population['date_input'];
        @$agent_name = $population['agent_name'];
        @$agent_nik = $population['agent_nik'];
        @$media = $population['media'];

        //User
		@$user = $aksi->caridata("user_tbl WHERE id_user = '$id_user'");
        @$full_name_user = $user['full_name'];
        @$nik = $user['nik'];

        //Parameter and SubParameter
        @$parameter_tbl = $aksi->caridata("parameter_qa_tbl WHERE id_parameter = '$id_parameter'");
        @$sub_parameter = $aksi->caridata("sub_parameter_tbl WHERE id_sub_par = '$parameter_tbl[id_sub_par]'");
		@$parameter = $parameter_tbl['parameter'];
		@$par_desc = $parameter_tbl['par_desc'];
		@$par_weight = $parameter_tbl['par_weight'];
		@$id_sub_par = $parameter_tbl['id_sub_par'];

        @$sub_par_name = $sub_parameter['sub_par_name'];
        @$sub_par_score = $sub_parameter['sub_par_score'];
        @$ko_status = $sub_parameter['ko_status '];

		// if ($bulan==12) {
		// 	if($bulan<10){
		// 		$bln = ($bulan+1);
		// 		$next_bulan = "0".$bln;
		// 	}else{
		// 		$next_bulan = $bulan+1;
		// 	}
		// 		$next_tahun = $tahun+1;
		// }else{
		// 	if ($bulan<10) {
		// 		$bln = ($bulan+1);
		// 		$next_bulan = "0".$bln;
		// 	}else{
		// 		$next_bulan = $bulan+1;
		// 	}
		// 		$next_tahun = $tahun;
		// }
		// echo $next_tahun."-".$next_bulan."-".$mawal."-".@$id_pel."<br>";

	@$sid = $_POST['sid'];
	@$bulan = $_POST['bulan'];
	@$contract_number = $_POST['contract_number'];
	// @$meter_awal = $_POST['meter_awal'];
	// @$tgl_cek = $_POST['tgl_cek'];
        @$source = $_POST['source'];
        @$full_name = $_POST['full_name'];
        @$type = $_POST['type'];
        @$subtype = $_POST['subtype'];
        @$sub_subtype = $_POST['sub_subtype'];
        @$note = $_POST['note'];
        @$result = $_POST['result'];
        @$date_input = $_POST['date_input'];
        @$agent_name = $_POST['agent_name'];
        @$agent_nik = $_POST['agent_nik'];
        @$media = $_POST['media'];
	//@$jumlah_meter = ($meter_akhir-$meter_awal);
	@$jumlah_pembayaran = ($par_weight);
	@$id_user = $id_user.$nik;

	// echo $id_penggunaan_next."-".$tahun."-".$bulan;
	@$field_next = array(
		'id_user'=>$id_user,
		'sid'=>$sid,
		// 'bulan'=>$next_bulan,
		// 'tahun'=>$next_tahun,
		// 'meter_awal'=>$meter_akhir,
	);


	@$field = array(
		'meter_akhir'=>$meter_akhir,
		'tgl_cek'=>$tgl_cek,
		'id_manager'=>$_SESSION['id_manager'],
	);

	@$field_update = array('meter_awal'=>$meter_akhir,);

	@$field_tagihan = array(
		'sid'=>$sid,
		'bulan'=>$bulan,
		'tahun'=>$tahun,
		'jumlah_meter'=>$jumlah_meter,
		'tarif_perkwh'=>$tarif_perkwh,
		'jumlah_pembayaran'=>$jumlah_pembayaran,
		'status'=>"Belum Bayar",
		'id_manager'=>$_SESSION['id_manager'],
	);

	@$field_tagihan_update = array(
		'jumlah_meter'=>$jumlah_meter,
		'tarif_perkwh'=>$tarif_perkwh,
		'jumlah_pembayaran'=>$jumlah_pembayaran,
		'status'=>"Belum Bayar",
		'id_manager'=>$_SESSION['id_manager'],
	);

	if (isset($_POST['bsimpan'])) {
		if ($meter_akhir <= $meter_awal) {
			$aksi->pesan("Meter Akhir Tidak Mungkin Kurang dari Meter Awal");
		}else{
			$aksi->simpan("tagihan",$field_tagihan);
			$aksi->update($table,$field,"id_penggunaan = '$id_guna'");
			$aksi->simpan($table,$field_next);
			$aksi->alert("Data Berhasil Disimpan",$redirect);
		}
	}


	if (isset($_POST['bubah'])) {
		// echo "<br>".$id_penggunaan_next."-".$bulan."-".$tahun;
		$aksi->update($table,$field_update,"id_penggunaan = '$id_penggunaan_next'");
		$aksi->update("tagihan",$field_tagihan_update,"sid = '$id_pel' AND bulan = '$bulan' AND tahun = '$tahun'");
		$aksi->update($table,$field,$where);
		$aksi->alert("Data Berhasil Diubah",$redirect);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->update("penggunaan", 
						array(
							'meter_akhir'=>0,
							'tgl_cek'=>"",
							'id_manager'=>"",),
						$where);
		$aksi->hapus("penggunaan","id_penggunaan = '$id_penggunaan_next'");
		$aksi->hapus("tagihan","sid = '$id_pel' AND bulan = '$bulan' AND tahun = '$tahun'");
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE sid LIKE '%$text%' OR id_penggunaan LIKE '%$text%' OR meter_awal LIKE '%$text%' OR meter_akhir LIKE '%$text%' OR tahun LIKE '%$text%' OR nama_pelanggan LIKE '%$text%' OR nama_manager LIKE '%$text%'";
	}else{
		$cari=" WHERE meter_akhir != 0";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PELANGGAN</title>
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
	<div class="container-fluid"  style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">INPUT DATA PENGGUNAAN</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH DATA PENGGUNAAN - <?php echo @$id; ?></div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="form-group">
										<label>ID PELANGGAN</label>&nbsp;&nbsp;<span style="color:blue;font-size: 10px;">[TEKAN/KLIK TAB]</span>
										<input type="text" name="sid" class="form-control" placeholder="Masukan ID Pelanggan" onchange="submit()" required value="<?php if(@$_GET['id']==""){echo @$id_pel;}else{ echo @$edit['sid'];} ?>" list="id_pel" onkeypress='return event.charCode >=48 && event.charCode <=57' <?php if(@$_GET['id']){echo "readonly";} ?>>
										<datalist id="id_pel">
											<?php  
												$a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelanggan");
												while ($b = mysqli_fetch_array($a)) { ?>
													<option value="<?php echo $b['sid'] ?>"><?php echo $b['nama_plgn']; ?></option>
												<?php } ?>
										</datalist>
									</div>
									<div class="form-group">
										<label>BULAN PENGGUNAAN</label>
										<input type="text" name="no_seri" class="form-control" placeholder="Bulan penggunaan" required readonly value="<?php if(@$_GET['id']==""){ @$aksi->bulan(@$bulan);echo " ".@$tahun;}else{@$aksi->bulan(@$edit['bulan']);echo " ".@$edit['tahun'];} ?>">
									</div>
									<div class="form-group">
										<label>METER AWAL</label>
										<input type="text" name="meter_awal" class="form-control" placeholder="Meter Awal" required readonly value="<?php if(@$_GET['id']==""){echo @$mawal;}else{echo @$edit['meter_awal'];} ?>">
									</div>
									<div class="form-group">
										<label>METER AKHIR</label>
										<input type="text" name="meter_akhir" class="form-control" placeholder="Masukan Meter Akhir" required value="<?php echo @$edit['meter_akhir']; ?>" onkeypress='return event.charCode >=48 && event.charCode <=57'>
									</div>
									<div class="form-group">
										<label>TANGGAL PENGECEKAN</label>
										<input type="date" name="tgl_cek" class="form-control" placeholder="Masukan Nama" required value="<?php echo @$edit['tgl_cek'] ?>">
									</div>

									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN" style="background: #9e6bff;">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=penggunaan" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">DAFTAR PENGGUNAAN</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form method="post">
								<div class="input-group">
									<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Masukan Keyword Pencarian (Kode Penggunaan, ID Pelanggan, Bulan[contoh : 01,09,12], Tahun, Nama Pelanggan, Nama manager) ......">
									<div class="input-group-btn">
										<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
										<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
									</div>
								</div>
							</form>
						</div>
						
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<th><center>No.</center></th>
										<th>Sample ID</th>
										<th>Contract Number</th>
										<th>Source</th>
										<th>Full Name</th>
										<th>Type</th>
										<th>Subtype</th>
										<th>Sub Subtype</th>
										<th>Note</th>
                                        <th>Result</th>
                                        <th>Date Input</th>
                                        <th>Agent Name</th>
                                        <th>Agent Nik</th>
                                        <th>Name</th>
										<th colspan="1"><center>Aksi</center></th>
									</thead>
									<tbody>
										<?php  
											$no=0;
											$data = $aksi->tampil("v_penggunaan",$cari,"ORDER BY tgl_cek DESC");
											if ($data=="") {
												$aksi->no_record(8);
											}else{
												foreach ($data as $r) {
													$cek = $aksi->cekdata("tagihan WHERE sid = '$r[sid]' AND bulan = '$r[bulan]' AND tahun = '$r[tahun]' AND status = 'Belum pembayaran'");
												$no++; ?>

												<tr>
													<td align="center"><?php echo $no; ?>.</td>
													<td><?php echo $r['sid'] ?></td>
													<td><?php echo $r['contract_number'] ?></td>
													<td><?php echo $r['source'] ?></td>
                                                    <td><?php echo $r['full_name'] ?></td>
													<!-- <td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun'];?></td> -->
													<td><?php echo $r['type'] ?></td>
													<td><?php echo $r['subtype'] ?></td>
													<!-- <td><?php $aksi->format_tanggal($r['tgl_cek']); ?></td> -->
													<td><?php echo $r['sub_subtype'] ?></td>
                                                    <td><?php echo $r['note'] ?></td>
                                                    <td><?php echo $r['result'] ?></td>
                                                    <td><?php echo $r['date_input'] ?></td>
                                                    <td><?php echo $r['agent_name'] ?></td>
                                                    <td><?php echo $r['agent_nik'] ?></td>
                                                    <td><?php echo $r['media'] ?></td>
													<?php  
														if ($cek == 0) { ?>
															<td colspan="2"></td>
														<?php }else{?>
															<td align="center"><a href="?menu=process&hapus&id=<?php echo $r['sid']; ?>" ><span class="glyphicon glyphicon-trash"></span></a></td>
															<!-- <td align="center"><a href="?menu=penggunaan&edit&id=<?php echo $r['sid']; ?>" ><span class="glyphicon glyphicon-edit"></span></a></td> -->
														<?php } ?>
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
</body>
</html>