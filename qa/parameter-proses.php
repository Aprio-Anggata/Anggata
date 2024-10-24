<?php
include '../config/koneksi.php';
$current_date = date("Y-m-d");

if(isset($_GET['proses'])) {
    if($_GET['proses']=='proses-tambah') {
        $parameter = $_POST['parameter'];
        $par_desc= $_POST['par_desc'];
        $par_weight= $_POST['par_weight'];
        $id_sub_par= $_POST['id_sub_par'];
        $status_par= $_POST['status_par'];
        $date_valid_from= $_POST['date_valid_from'];
        $date_valid_to= $_POST['date_valid_to'];
        $date_inserted= $_POST['date_inserted'];
        $inserted_by= $_POST['inserted_by'];

        mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO parameter_qa_tbl (parameter, par_desc, par_weight, id_sub_par, status_par, date_valid_from, date_valid_to, date_inserted, inserted_by) 
        value 
        ('$parameter','$par_desc','$par_weight','$id_sub_par','$status_par','$date_valid_from','$date_valid_to','$date_inserted','$inserted_by')");        
        header("location:parameter.php");

    }elseif ($_GET['proses']=='proses-ubah') {
        $id_parameter = $_POST['id_parameter'];
        $parameter = $_POST['parameter'];
        $par_desc= $_POST['par_desc'];
        $par_weight= $_POST['par_weight'];
        $id_sub_par= $_POST['id_sub_par'];
        $status_par= $_POST['status_par'];
        $date_valid_from= $_POST['date_valid_from'];
        $date_valid_to= $_POST['date_valid_to'];
        $date_inserted= $_POST['date_inserted'];
        $inserted_by= $_POST['inserted_by'];

        mysqli_query($GLOBALS["___mysqli_ston"],"UPDATE parameter_qa_tbl set parameter='$parameter', par_desc='$par_desc', par_weight='$par_weight', id_sub_par='$id_sub_par', status_par='$status_par', date_valid_from='$date_valid_from', date_valid_to='$date_valid_to',date_inserted='$date_inserted', inserted_by='$inserted_by' WHERE id_parameter='$id_parameter'");
        header("location:parameter.php");

    }elseif ($_GET['proses']=='proses-hapus') {
        $id_kriteria = $_GET['id_parameter'];
        mysqli_query($GLOBALS["___mysqli_ston"],"DELETE FROM parameter_qa_tbl WHERE id_parameter='$id_parameter'");
        header("location:parameter.php");
    }
}
?>