<?php

include_once("koneksi.php");

$bulan = "";
$tahun = "";
$d_aktual = "";
$pesan_error = array();

	// Check If form submitted, insert form data into users table.
if(isset($_POST["submit"])) {
	$bulan = htmlentities(strip_tags(trim($_POST['bulan'])));
	$tahun = htmlentities(strip_tags(trim($_POST['tahun'])));
	$d_aktual = htmlentities(strip_tags(trim($_POST['d_aktual'])));

	$pesan_error = array();

	if ($bulan === "Bulan") {
		$pesan_error[]= "Bulan belum dipilih!";
	}

	if ($tahun === "Tahun") {
		$pesan_error[]= "Tahun belum dipilih!"; 
	}

	if (empty($d_aktual)) {
		$pesan_error[]= "Data aktual belum di isi!";
	}

	$bln_thn = $bulan." ".$tahun;


	if (!$pesan_error) {
		$bln_thn = mysqli_real_escape_string($koneksi,$bln_thn);
		$d_aktual = mysqli_real_escape_string($koneksi,$d_aktual);

		$querytambah = "INSERT INTO tb_penjualan(bln_thn,d_aktual) ";
		$querytambah .= "VALUES('$bln_thn','$d_aktual')";

		$resultquery = mysqli_query($koneksi,$querytambah);

		if ($resultquery) {
			$pesan_sukses = "Data penjualan bulan \"<b>$bln_thn</b>\" berhasil ditambahkan!";
			$pesan_sukses = urlencode($pesan_sukses);
			header("Location: data.php?pesan_sukses={$pesan_sukses}");
		}
		else {
			die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}
		mysqli_free_result($resultquery);
		mysqli_close($koneksi);
	}
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Tambah Data Penjualan - SB Group</title>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<!-- partial:index.partial.html -->
	<?php
	include_once 'sidebar.php';
	?>

	<div class="content-container">

		<div class="container-fluid">

			<!-- Main component for a primary marketing message or call to action -->
			<div class="jumbotron">
				<h2 style="margin-bottom: 25px;">Tambah Data Penjualan</h2>
				<?php
				if ($pesan_error !=="") {
					foreach ($pesan_error as $per) {
						echo "<div class='alert alert-danger alert-dismissible'>
						<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<strong>Gagal!</strong> ".$per.
						"</div>";
					}
				}
				?>
				<form action="tambah.php" method="post" name="form1">
					<div class="row">
					<div class="form-group col">
						<label for="bulan">Bulan</label>
						<select name="bulan" class="form-control">
							<option selected="selected">Bulan</option>
							<?php
							$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
							$jlh_bln=count($bulan);
							for($c=0; $c<$jlh_bln; $c+=1){
								echo"<option value=$bulan[$c]> $bulan[$c] </option>";
							}
							?>
						</select>
					</div>
					<div class="form-group col">
						<label for="tahun">Tahun</label>
						<?php
						$now=date("Y");
						echo "<select name='tahun' class='form-control'>
						<option>Tahun</option>";
						for ($a=2012;$a<=$now;$a++)
						{
							echo "<option value='$a'>$a</option>";
						}
						echo "</select>";
						?>
					</div>
				</div>
					<div class="form-group">
						<label for="d_aktual">Data Aktual</label>
						<input class="form-control" type="text" name="d_aktual">
					</div>
					<div style="display: flex;">
						<div style="margin-top:20px;">
							<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						</div>
						<div style="margin: 20px 0px 0px 20px;">
							<a class="btn btn-danger" href="data.php">Batal</a>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
	<!-- partial -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</body>
</html>