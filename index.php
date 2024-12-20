<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" style="height: 800px;object-fit: cover;" src="home/img/bg3.png" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang Di Website</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Warung Ampiran</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Nasi Goreng Terbaik, Lezat Dan Menggugah Selera.</p>
                            <a href="produk.php" class="btn btn-primary rounded-pill py-3 px-5">Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" style="height: 800px;object-fit: cover;" src="home/img/bg3.png" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">Selamat Datang Di Website</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Warung Ampiran</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Nasi Goreng Terbaik, Lezat Dan Menggugah Selera.</p>
                            <a href="produk.php" class="btn btn-primary rounded-pill py-3 px-5">Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row">
                    <div class="col-12 align-self-end">
                        <img class="img-fluid rounded" src="home/img/bg2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <p class="text-primary text-uppercase mb-2">Tentang</p>
                    <h1 class="display-6 mb-4">Warung Ampiran</h1>
                    <p>Selamat datang di Warung Ampiran, tempat terbaik untuk menikmati hidangan nasi goreng yang menggugah selera!

                        Kami adalah warung makan lokal yang berdedikasi untuk menghadirkan cita rasa khas Indonesia melalui nasi goreng yang autentik dan inovatif. Dengan menggunakan bahan-bahan segar berkualitas tinggi dan bumbu pilihan, setiap piring nasi goreng yang kami sajikan dibuat dengan penuh cinta dan keahlian.</p>
                    <p>Mengapa Memilih Warung Ampiran?</p>
                    <ol>
                        <li>Ragam Menu Pilihan: Dari nasi goreng klasik hingga kreasi spesial dengan topping unik, kami menawarkan berbagai pilihan yang cocok untuk semua selera.</li>
                        <li>Rasa Otentik: Resep kami terinspirasi dari tradisi kuliner Indonesia yang kaya, diracik untuk memanjakan lidah Anda.</li>
                        <li>Harga Terjangkau: Nikmati hidangan berkualitas tanpa perlu merogoh kocek terlalu dalam.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">Menu</p>
            <h1 class="display-6 mb-4">Menu</h1>
        </div>
        <div class="row g-4">
            <?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
            <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="foto/<?php echo $perproduk['fotoproduk'] ?>" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5><?php echo $perproduk["namaproduk"] ?></h5>
                                <span>Rp <?php echo number_format($perproduk['hargaproduk']) ?></span>
                            </div>
                            <div class="team-social">
                                <a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>" class="btn btn-primary rounded-pill py-3 px-5 w-100">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>