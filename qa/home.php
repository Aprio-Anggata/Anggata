<?php 
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=home');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<link rel="stylesheet" type="text/css"	href="css/style.css">
<style type="text/css">
  .middle {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	text-align: center;
  }
</style>
<body>
	<div style="color: black;font-family: Myriad Pro Light">
		<div class="middle" style="color: whitBlack light;font-size: 50px">
		<h1><b>SCORE CARD FORM </b></h1>
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<marquee><h3>Selamat Datang <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
				<strong style="color: Black light;font-family: Myriad Pro Light"><?php echo $_SESSION['full_name']; ?></strong>&nbsp;, di Aplikasi Score Card QA v.1.0.0</h3></marquee>
				<center><img src="../images/Quality-Assurance-02.png" width="30%"></center>
				
			</div>		
		</div> <hr>
		<p>PT. HOME CREDIT INDONESIA</p>
	  </div>
	  </div>
	</div>
</body>
</html>

