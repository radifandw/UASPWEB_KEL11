<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>

<?php include 'header.php'; ?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
	<div class="container text-center pt-5 pb-3">
		<h1 class="display-4 text-white animated slideInDown mb-3">Checkout</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
				<li class="breadcrumb-item text-primary active" aria-current="page">Checkout</li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-xxl py-6">
	<div class="container">
		<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
			<p class="text-primary text-uppercase mb-2">Checkout</p>
			<h1 class="display-6 mb-4">Checkout</h1>
		</div>
		<div class="row g-0 justify-content-center">
			<div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
				<table class="table">
					<thead class="bg-primary text-white">
						<tr class="text-center">
							<th>No</th>
							<th>Produk</th>
							<th>Harga</th>
							<th>Jumlah Beli</th>
							<th>SubHarga</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor = 1;
						$totalbelanja = 0;
						$totalberat = 0;
						foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
							<?php
							$ambil = $koneksi->query("SELECT * FROM produk 
								WHERE idproduk='$idproduk'");
							$pecah = $ambil->fetch_assoc();
							$totalharga = $pecah["hargaproduk"] * $jumlah;
							$ += $PPN;
							$PPN = $PPN / 1000;
							?>
							<tr class="text-center">
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['namaproduk']; ?></td>
								<td>Rp <?php echo number_format($pecah['hargaproduk']); ?></td>
								<td><?php echo $jumlah; ?></td>
								<td>Rp <?php echo number_format($totalharga); ?></td>
							</tr>
							<?php $nomor++; ?>
							<?php $totalbelanja += $totalharga; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="container-xxl">
	<div class="container">
		<div class="row g-0 justify-content-center">
			<div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
				<form method="post">
					<div class="row g-3">
						<div class="">
							<div class="row">
							<div class="form-group col">
								<label class="mb-2">Nama Pelanggan</label>
								<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['nama'] ?>" class="form-control mb-2" name="namapelanggan">
							</div>
							<div class="form-group col">
								<label class="mb-2">No. Handphone Pelanggan</label>
								<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['telepon'] ?>" class="form-control mb-2">
							</div>
							</div>
						<div class="row">
						<div class="col">
							<input type="hidden" id="totalbelanja" name="totalbelanja" value="<?php echo $totalbelanja ?>" required>
							<div class="col-md-12 form-group p_star">
								<label>Total Belanja</label>
								<input class="form-control valid mb-3" type="number" readonly required value="<?= $totalbelanja ?>">
							</div>

						</div>
							<button class="btn btn-primary pull-right w-100 mt-4" name="checkout">Selesaikan Pembayaran</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST["checkout"])) {
	$notransaksi = '#INV-' . date("Ymdhis");
	$id = $_SESSION["pengguna"]["id"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$totalbeli = $totalbelanja;
	if ($metodepengiriman == '') {

		$koneksi->query(
			"INSERT INTO pemesanan(notransaksi,
				id, tanggalbeli, totalbeli, totalberat, statusbeli, waktu)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli','$totalberat', 'Belum Bayar', '$waktu')"
		) or die(mysqli_error($koneksi));
		$idpenjualan_barusan = $koneksi->insert_id;
		foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
			$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
			$perproduk = $ambil->fetch_assoc();
			$nama = $perproduk['namaproduk'];
			$harga = $perproduk['hargaproduk'];
			$subharga = $perproduk['hargaproduk'] * $jumlah;
			$stok_sekarang = $perproduk['stokproduk'] - $jumlah;
			$koneksi->query("UPDATE produk SET stokproduk='$stok_sekarang' WHERE idproduk='$idproduk'");

			$koneksi->query("INSERT INTO penjualan (idpenjualan, idproduk, nama, harga, subharga, jumlah)
					VALUES ('$idpenjualan_barusan','$idproduk', '$nama','$harga','$subharga','$jumlah')") or die(mysqli_error($koneksi));
		}
	} else {
		$ekspedisi = strtoupper($_POST["nama_ekspedisi2"]);
		$layanan = $_POST["nama_ekspedisi2"];
		$ongkir = 0;

		$koneksi->query(
			"INSERT INTO pemesanan(notransaksi,
				id, tanggalbeli, totalbeli, alamatpengiriman,totalberat, kota, ekspedisi, layanan, ongkir, statusbeli, waktu, metodepengiriman)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli','$alamatpengiriman','$totalberat', '$kota','$ekspedisi','$layanan','$ongkir', 'Belum di Konfirmasi', '$waktu','$metodepengiriman')"
		) or die(mysqli_error($koneksi));
		$idpenjualan_barusan = $koneksi->insert_id;
		foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
			$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
			$perproduk = $ambil->fetch_assoc();
			$nama = $perproduk['namaproduk'];
			$harga = $perproduk['hargaproduk'];

			$stok_sekarang = $perproduk['stokproduk'] - $jumlah;
			$koneksi->query("UPDATE produk SET stokproduk='$stok_sekarang' WHERE idproduk='$idproduk'");

			$subharga = $perproduk['hargaproduk'] * $jumlah;
			$koneksi->query("INSERT INTO penjualan (idpenjualan, idproduk, nama, harga, subharga, jumlah)
					VALUES ('$idpenjualan_barusan','$idproduk', '$nama','$harga','$subharga','$jumlah')") or die(mysqli_error($koneksi));
		}
	}

	unset($_SESSION["keranjang"]);
	echo "<script> alert('Pembelian Sukses');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>

<!-- <script>
	function check() {
		var val = document.getElementById('kota').value;
		if (val == 'Medan') {
			document.getElementById('ongkir').value = "5000";
		} else if (val == 'Palembang') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Jakarta') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Bandung') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Surabaya') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Yogyakarta') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Bali') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Cirebon') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Tanjung Enim') {
			document.getElementById('Tanjung Enim').value = "12000";
		}
		var num1 = document.getElementById("ongkir").value;
		var num2 = document.getElementById("totalbelanja").value;
		result = parseInt(num1) + parseInt(num2);
		document.getElementById("grandtotal").value = result;

	}
</script> -->
