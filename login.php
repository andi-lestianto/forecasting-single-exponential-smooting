<?php

include_once ("koneksi.php");

$username ="";
$password = "";
$pesan_login = "";

if (isset($_POST["submit"])) {
	$username = htmlentities(strip_tags(trim($_POST["username"])));
	$password = htmlentities(strip_tags(trim($_POST["password"])));

	$querylogin = "select * from tb_admin where username='$username' and password='$password'";
	$resultquery = mysqli_query($koneksi,$querylogin);

	$count = mysqli_num_rows($resultquery);

	if ($count === 0) {
		$pesan_login = "Username atau password salah!";
	}

	mysqli_free_result($resultquery);
	mysqli_close($koneksi);

	if ($pesan_login === "") {
		session_start();
		$_SESSION["username"] = $username;
		header("Location: index.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="my-login-page">

	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<?php
							if ($pesan_login !== "") {
								echo "<div class='alert alert-danger alert-dismissible'>
								<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Gagal!</strong> ".$pesan_login.
								"</div>";
							}
							?>
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="login.php">
								<div class="form-group">
									<label for="email">username</label>
									<input type="text" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Username belum di isi!
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password belum di isi!
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; Forecasting CV Samudra Group Indonesia 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
