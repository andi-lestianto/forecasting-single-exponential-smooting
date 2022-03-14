<?php

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

include_once("koneksi.php");

if (isset($_POST["submit"])) {
	if ($_POST["submit"]=="Edit") {

		$id = htmlentities(strip_tags(trim($_POST["id"])));
		$id = mysqli_real_escape_string($koneksi,$id);

		$querytampilid = "select * from tb_admin where id ='$id'";
		$resultquery = mysqli_query($koneksi,$querytampilid);

		if (!$resultquery) {
			die("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}

		$data = mysqli_fetch_assoc($resultquery);

		$id=$data["id"];
		$username = $data["username"];
		$password = $data["password"];

		mysqli_free_result($resultquery);

	}

	else if ($_POST["submit"]=="Update Data") {

		$id = htmlentities(strip_tags(trim($_POST["id"])));
		$username = htmlentities(strip_tags(trim($_POST["username"])));
		$password = htmlentities(strip_tags(trim($_POST["password"])));

	}

	$pesan_error = array();

	if (empty($username)) {
		$pesan_error[]= "Username belum di isi!";
	}

	if (empty($password)) {
		$pesan_error[]= "Password belum di isi!";
	}


	if ((!$pesan_error) AND ($_POST["submit"]=="Update Data")) {

		$id = mysqli_real_escape_string($koneksi,$id);
		$username = mysqli_real_escape_string ($koneksi,$username);
		$password = mysqli_real_escape_string ($koneksi,$password);

		$queryupdate = "update tb_admin set ";
		$queryupdate .= "username = '$username', password = '$password' ";
		$queryupdate .= "where id = '$id'";

		$resultquery = mysqli_query($koneksi,$queryupdate);

		if ($resultquery) {
			$pesan_sukses = "Data admin \"<b>$username</b>\" berhasil diupdate!";
			$pesan_sukses = urlencode($pesan_sukses);
			header("Location: data_admin.php?pesan_sukses={$pesan_sukses}");
		}
		else {
			die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}
		mysqli_free_result($resultquery);
	}
	mysqli_close($koneksi);
}
else {
	header("Location: data_admin.php");
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Edit Data Admin - SB Group</title>
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
				<h2 style="margin-bottom: 25px;">Edit Data Admin</h2>
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
				<form action="edit_admin.php" method="post" name="update_data">
					<div>
						<input type="hidden" name="id" value="<?php echo $id;?>">
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input class="form-control" type="text" name="username" value="<?php echo $username;?>">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input class="form-control" type="text" name="password" value="<?php echo $password;?>">
					</div>
					<div style="display: flex;">
						<div style="margin-top:20px;">
							<input class="btn btn-primary" type="submit" name="submit" value="Update Data">
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