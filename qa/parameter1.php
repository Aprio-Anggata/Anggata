<?php
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=parameter');
	}
	//dasar
	$table = "parameter_qa_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_parameter)) = '$id'";
	$redirect = "?menu=parameter";

	//kode auto
	$id_pel = date("YmdHis");
	if (date('z') < 10) {
		$no_met = "00".date("zymNHs");
	}elseif (date('z') < 100 ) {
		$no_met ="0".date("zymNHs");
	}else{
		$no_met=date("zymNHs");
	}

	//untuk kebutuhan crud
	// @$batas_waktu = date("d");
	@$id_parameter = $_POST['id_parameter'];
    @$parameter = $_POST['parameter'];
    @$par_desc= $_POST['par_desc'];
    @$par_weight = $_POST['par_weight'];
    @$id_sub_par = $_POST['id_sub_par'];
    @$status_par = $_POST['status_par'];
    @$date_valid_from = $_POST['date_valid_from'];
    @$date_valid_to = $_POST['date_valid_to'];
    @$date_inserted = $_POST['date_inserted'];
    @$inserted_by = $_POST['inserted_by'];
	// @$no_seri = $_POST['no_seri'];
	// @$nama_plgn = $_POST['nama_plgn'];
	// @$alamat_plgn = $_POST['alamat_plgn'];
	// @$id_tarif = $_POST['id_tarif'];
    
	//tampung data
	$simpan_pelanggan = array(
		'id_parameter'=>$id_parameter,
        'parameter'=>$parameter,
        'par_desc'=>$par_desc,
        'par_weight'=>$par_weight,
        'id_sub_par'=>$id_sub_par,
        'status_par'=>$status_par,
        'date_valid_from'=>$date_valid_from,
        'date_valid_to'=>$date_valid_to,
        'date_inserted'=>$date_inserted,
        'inserted_by'=>$inserted_by,

		// 'no_seri'=>$no_seri,
		// 'nama_plgn'=>$nama_plgn,
		// 'alamat_plgn'=>$alamat_plgn,
		// 'batas_waktu'=>$batas_waktu,
		// 'id_tarif'=>$id_tarif,
	);

	$ubah_pelanggan = array(
		'id_parameter'=>$id_parameter,
        'parameter'=>$parameter,
        'par_desc'=>$par_desc,
        'par_weight'=>$par_weight,
        'id_sub_par'=>$id_sub_par,
        'status_par'=>$status_par,
        'date_valid_from'=>$date_valid_from,
        'date_valid_to'=>$date_valid_to,
        'date_inserted'=>$date_inserted,
        'inserted_by'=>$inserted_by,
	);

	//untuk penggunaan default meter awal
	if (date("d") > 25) {
		if(date("m") <10){
			$bln = date("m")+1;
			$bulan = "0".$bln;
		}else{
			$bulan = date("m")+1;
		}
		$tahun = date("Y");
	}elseif(date("d") > 25 && date("m")==12 ){
		$bln = date("m")+1;
		$bulan = "0".$bln;
		$tahun = date("Y")+1;
	}else{
		$bulan = date("m");
		$tahun = date("Y");
	}

	$simpan_penggunaan = array(
		'id_parameter'=>$id_parameter.$bulan.$tahun,
		'id_parameter'=>$id_parameter,
		'bulan'=>$bulan,
		'tahun'=>$tahun,
		'meter_awal'=>0,
	); 

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan("penggunaan",$simpan_penggunaan);
		$aksi->simpan($table,$simpan_pelanggan);
		$aksi->alert("Data Berhasil Disimpan",$redirect);
	}

	if (isset($_POST['bubah'])) {
		$aksi->update($table,$ubah_pelanggan,$where);
		$aksi->alert("Data Berhasil Diubah",$redirect);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus("penggunaan","id_pelanggan = '$id'");
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_pelanggan LIKE '%$text%' OR nama_plgn LIKE '%$text%' OR no_seri LIKE '%$text%' OR alamat_plgn LIKE '%$text%' OR batas_waktu LIKE '%$text%'";
	}else{
		$cari="";
	}





?>


<br>
<br>

<h2 class="mb-4"><b>Parameter</b></h2>

<div class="panel panel-container" style="padding: 40px; box-shadow: 2px 2px 5px #888888;">
    <h3> Parameter Data</h3>

    <a href="parameter-aksi.php?aksi=tambah" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&emsp;
    Tambah Data</a>
    <br>
    <br>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th class="text-center">No</th> -->
                    <th class="text-center">ID Parameter</th>
                    <th class="text-center">Parameter Name</th>
                    <th class="text-center">Parameter Description</th>
                    <th class="text-center">Parameter Weight</th>
                    <th class="text-center">ID Sub parameter</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Date Valid From</th>
                    <th class="text-center">Date Valid To</th>
                    <th class="text-center">Date Inserted</th>
                    <th class="text-center">Inserted By</th>
                    <th class="text-center">Add Sub Parameter</th>
                    <th class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($GLOBALS["___mysqli_ston"],"SELECT * FROM parameter_qa_tbl order by id_parameter");
                    $no=1;
                    while ($result = mysqli_fetch_array($query)) { ?>
                    
                        <tr>
                            <!-- <td class="text-center"><?php echo $no++ ?></td>   -->
                            <td class="text-center"><?php echo $result['id_parameter'];?></td>
                            <td class="text-center"><?php echo $result['parameter'];?></td>
                            <td class="text-center"><?php echo $result['par_desc'];?></td>
                            <td class="text-center"><?php echo $result['par_weight'];?></td>
                            <td class="text-center"><?php echo $result['id_sub_par'];?></td>
                            <td class="text-center"><?php echo $result['status_par'];?></td>
                            <td class="text-center"><?php echo $result['date_valid_from'];?></td>
                            <td class="text-center"><?php echo $result['date_valid_to'];?></td>
                            <td class="text-center"><?php echo $result['date_inserted'];?></td>
                            <td class="text-center"><?php echo $result['inserted_by'];?></td>

                            <td class="text-center">
                                <a href="sub-parameter.php?id_parameter=<?php echo $result['id_parameter'] 
                                ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                            </td>

                            <td class="text-center">
                                <a href="parameter-aksi.php?aksi=ubah=<?php echo $result['id_parameter'] ?>&
                                aksi=ubah" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>

                                <a href="parameter-proses.php?proses=hapus=<?php echo $result['id_parameter'] 
                                ?>&proses=proses-hapus" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        
                    <?php } ?>
            </tbody>
        </table>
</div>
</div>
</div>