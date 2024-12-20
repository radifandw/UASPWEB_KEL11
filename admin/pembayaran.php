<?php
$ambil = $koneksi->query("SELECT*FROM pemesanan JOIN pengguna
	ON pemesanan.id=pengguna.id
	WHERE pemesanan.idpenjualan='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>



<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h3>Pemesanan</h3>
						<hr>
						<strong>NO PEMESANAN: <?php echo $detail['idpenjualan']; ?></strong><br>
						Tanggal : <?= tanggal(date('Y-m-d', strtotime($detail['tanggalbeli']))) ?><br>
						Total Bayar : Rp. <?php echo number_format($detail['totalbeli']); ?><br>
					</div>
					<div class="col-md-6">
						<h3>Pelanggan</h3>
						<hr>
						<strong>NAMA : <?php echo $detail['nama']; ?></strong><br>
						Telepon : <?php echo $detail['telepon']; ?><br>
						Email : <?php echo $detail['email']; ?><br>
					</div>
				</div>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php $ambil = $koneksi->query("SELECT * FROM penjualan WHERE idpenjualan='$_GET[id]'"); ?>
						<?php while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
				<?php ?>
				<?php
				if ($detail['metodepengiriman'] == 'Same Day' || $detail['metodepengiriman'] == "Instant") {

				?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						Input Ongkir
					</button>

				<?php } ?>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="post">
								<div class="modal-body">
									<div class="form-group">
										<input type="hidden" name="idpenjualan" value="<?= $detail['idpenjualan'] ?>">
										<label>Ongkir (Rp)</label>
										<input type="number" class="form-control" name="ongkir" min="0" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php
$idpenjualan = $_GET['id'];

$am = $koneksi->query("SELECT*FROM pemesanan WHERE idpenjualan='$idpenjualan'");
$det = $am->fetch_assoc(); ?>
<div class="row">
	<?php if ($det['statusbeli'] != "Selesai") { ?>
		<div class="col-md-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<?php
							$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE idpenjualan='$idpenjualan'");
							$detail = $ambil->fetch_assoc();
							?>
							<?php if ($detail) : ?>
								<table class="table">
									<tr>
										<th>Nama</th>
										<th><?php echo $detail['nama'] ?></th>
									</tr>
									<tr>
										<th>Tanggal Transfer</th>
										<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggaltransfer']))) ?></th>
									</tr>
									<tr>
										<th>Tanggal Upload Bukti Pembayaran</th>
										<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggal']))) ?></th>
									</tr>
								</table>
							<?php endif; ?>
							<form method="post">
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="statusbeli">
										<option <?php if ($det['statusbeli'] == 'Belum di Konfirmasi') echo 'selected'; ?> value="Belum di Konfirmasi">Belum di Konfirmasi</option>
										<option <?php if ($det['statusbeli'] == 'Belum Bayar') echo 'selected'; ?> value="Belum Bayar">Belum Bayar</option>
										<option <?php if ($det['statusbeli'] == 'Pesanan Di Tolak') echo 'selected'; ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
									</select>
								</div>
								<button class=" btn btn-primary float-right pull-right" name="proses">Simpan</button>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="col-md-6 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<h4>Bukti Pembayaran</h4>
						<img width="80%" src="../foto/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST["proses"])) {
	$statusbeli = $_POST["statusbeli"];

	// Ambil status beli sebelumnya
	$statusSebelumnya = $koneksi->query("SELECT statusbeli FROM pemesanan WHERE idpenjualan='$idpenjualan'");
	$dataStatusSebelumnya = $statusSebelumnya->fetch_assoc();
	$statusSebelumnya = $dataStatusSebelumnya['statusbeli'];


	$koneksi->query("UPDATE pemesanan , statusbeli='$statusbeli'
		WHERE idpenjualan='$idpenjualan'");


	if ($statusbeli == "Pesanan Di Tolak" && $statusSebelumnya != "Pesanan Di Tolak") {
		$produk = $koneksi->query("SELECT * FROM penjualan WHERE idpenjualan='$idpeenjualan'");
		while ($data = $produk->fetch_assoc()) {
			$jumlah = $data['jumlah'];
			$idproduk = $data['idproduk'];

			// Ambil stok produk saat ini
			$stokProduk = $koneksi->query("SELECT stokproduk FROM produk WHERE idproduk='$idproduk'");
			$dataStok = $stokProduk->fetch_assoc();
			$stokSaatIni = $dataStok['stokproduk'];

			$stokBaru = $stokSaatIni + $jumlah;

			// Perbarui stokproduk
			$koneksi->query("UPDATE produk SET stokproduk = '$stokBaru' WHERE idproduk='$idproduk'");
		}
	}

	echo "<script>alert('Status Transaksi Berhasil Diupdate')</script>";
	echo "<script>location='index.php?halaman=pemesanan';</script>";
}

?>