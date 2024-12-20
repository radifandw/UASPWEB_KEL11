<?php
session_start();
include 'koneksi.php';

?>
<?php include 'header.php'; ?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
	<div class="container text-center pt-5 pb-3">
		<h1 class="display-4 text-white animated slideInDown mb-3">Daftar</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
				<li class="breadcrumb-item text-primary active" aria-current="page">Daftar</li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-xxl py-6">
	<div class="container">
		<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
			<p class="text-primary text-uppercase mb-2">Daftar Akun</p>
			<h1 class="display-6 mb-4">Silahkan Daftar</h1>
		</div>
		<div class="row g-0 justify-content-center">
			<div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
				<form method="post">
					<div class="row g-3">
						<div class="form-group">
							<label class="control-label mb-2">Nama</label>
							<input type="text" name="nama" class="form-control mb-2" required>
						</div>
						<div class="form-group">
							<label class="control-label mb-2">Email</label>
							<input type="email" name="email" class="form-control mb-2" required>
						</div>
						<div class="form-group">
							<label class="control-label mb-2">Password</label>
							<input type="password" name="password" class="form-control mb-2" required>
						</div>
						<div class="form-group">
							<label class="control-label mb-2">Alamat</label>
							<textarea class="form-control mb-2" name="alamat" required></textarea>
						</div>
						<div class="form-group">
							<label class="control-label mb-2">Telepon</label>
							<input type="text" name="telepon" class="form-control mb-2">
						</div>
						<div class="form-group">
							<div class="row">


							</div>
						</div>
						<div class="col-12 text-center">
							<button class="btn btn-primary rounded-pill py-3 px-5 w-100" name="daftar" type="submit">Daftar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran Gagal, email sudah ada')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna	(nama, email,  password, alamat, telepon, fotoprofil, level)
								VALUES('$nama','$email','$password','$alamat','$telepon', 'Untitled.png','Pelanggan')");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>

