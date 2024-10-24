<!-- <h2 class="mb-4">ADD NEW parameter</h2> -->

<?php 

    include '../config/koneksi.php';
	include '../library/fungsi.php';

	session_start();

if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='tambah') {
        ?>

    <div class="panel panel-container" style="padding: 50px; box-shadow: 2px 2px 5px #888888;">
    <h2>parameter Data/Add New Parameter</h2>
        <form action="parameter-proses.php?proses=proses-tambah" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Parameter</label>                
                    <input type="text" name="parameter" class="form-control" placeholder="Insert parameter Name" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div>  

                <div class="form-group">
                    <label>Parameter Description</label>                
                    <input type="text" name="par_desc" class="form-control" placeholder="Insert Description of parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div> 

                <div class="form-group">
                    <label>Parameter Weight</label>                
                    <input type="number" name="par_weight" class="form-control" placeholder="Insert parameter Weight" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div> 

                <div class="form-group">
                    <label>ID Sub Parameter</label>                
                    <input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div> 

                <!-- <div class="form-group">
                    <label>Status</label>                
                    <input type="text" name="status_par" class="form-control" placeholder="Insert status a or n" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div>  -->

                <div class="form-group">
										<label>Status</label>
										<select type="text" name="status_par" class="form-control" autocomplete="off" required onsubmit="this.setCustomValidity('')">
											<option value=Null></option>
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
                    <label>Date Inserted</label>                
                    <input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div> 

                <div class="form-group">
                    <label>Insert By</label>                
                    <input type="text" name="inserted_by" class="form-control" placeholder="Insert By" autocomplete="off" required onsubmit="this.setCustomValidity('')">
                </div> 
                <br>
                <br>
                <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" value="Add New">
                        <br>
                        <br>
                        <a href="menu_utama.php?menu=parameter" type="cancel" class="btn btn-cancel"><b>Back</b></a>
                        <!-- <input type="submit" class="btn btn-danger" value="Submit"> -->
                </div>

        </form>


    </div>

<?php }elseif ($_GET['aksi']=='ubah') { ?>

    <div class="panel panel-container" style="padding: 50px; box-shadow: 2px 2px 5px #888888;">
        <h2> 
            Data Parameter/Ubah Data
        </h2>
        <?php
        
            // $id_alternatif = $_GET['id_parameter'];
            // $query = mysqli_query($conn,"SELECT * FROM parameter_qa_tbl WHERE id_parameter='$id_parameter'");
            // while ($result = mysqli_fetch_array($query)) {

                // if ($GLOBALS["___mysqli_ston"]) {
                //     $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM parameter_qa_tbl WHERE id_parameter='$id_parameter'");
                //     if (!$result) {
                //         die("Query failed: " . mysqli_error($GLOBALS["___mysqli_ston"]));
                //     }
                // } else {
                //     die("Database connection is null.");
                // }


            if (isset($_GET['id_parameter'])) {
                $id_parameter = $_GET['id_parameter'];
                // $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM parameter_qa_tbl WHERE id_parameter='$id_parameter'");
                $stmt = $GLOBALS["___mysqli_ston"]->prepare("SELECT * FROM parameter_qa_tbl WHERE id_parameter = '$id_parameter'");
                $stmt->bind_param("s", $id_parameter);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                // while ($result = mysqli_fetch_array($stmt)) {
                    // Your code to handle the result
                }
            } else {
                echo "id_parameter is not set.";
            }
        ?>
       

        <form action="parameter-proses.php?proses=proses-ubah" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_parameter" value="<?php echo $result['id_parameter'] ?>">

                <div class="form-group">
                    <label>Parameter</label>                
                    <input type="text" name="parameter" class="form-control" placeholder="Update PArameter" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['parameter'] ?>">
                </div>  

                <div class="form-group">
                    <label>Parameter Description</label>                
                    <input type="text" name="par_desc" class="form-control" placeholder="Insert Description of parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['par_desc'] ?>">
                </div> 

                <div class="form-group">
                    <label>Parameter Weight</label>                
                    <input type="number" name="par_weight" class="form-control" placeholder="Insert parameter Weight" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['par_weight'] ?>">
                </div> 

                <div class="form-group">
                    <label>ID Sub Parameter</label>                
                    <input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['id_sub_par'] ?>">
                </div> 

                <div class="form-group">
                    <label>Status</label>
                    <select type="text" name="status_par" class="form-control" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['status_par'] ?>">
											<option value=Null></option>
											<option value="a">a</option>
											<option value="n">n</option>
										</select>
                </div> 

                <div class="form-group">
                    <label>Date Valid From</label>                
                    <input type="date" name="date_valid_from" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['date_valid_from'] ?>">
                </div> 

                <div class="form-group">
                    <label>Date Valid To</label>                
                    <input type="date" name="date_valid_to" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['date_valid_to'] ?>">
                </div> 

                <div class="form-group">
                    <label>Date Inserted</label>                
                    <input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['date_inserted'] ?>">
                </div> 

                <div class="form-group">
                    <label>Insert By</label>                
                    <input type="text" name="inserted_by" class="form-control" placeholder="Insert By" autocomplete="off" required onsubmit="this.setCustomValidity('')" value="<?php echo $result['inserted_by'] ?>">
                </div> 
                <br>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-danger" value="Update">
                    <!-- <a href="menu_utama.php?menu=parameter" type="submit" class="btn btn-success"><b>Update</b></a> -->
                    <br>
                    <br>
                    <a href="menu_utama.php?menu=parameter" type="cancel" class="btn btn-cancel"><b>Back</b></a>
                        <!-- <input type="submit" class="btn btn-danger" value="Ubah"> -->
                </div>

        </form>

        <?php } }?>

    </div>


<a href="menu_utama.php?menu=parameter">
</div>
</div>