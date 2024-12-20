-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 02:33 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungnasgor`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(11, ' Nasi Goreng'),
(17, 'Spesial'),
(18, 'Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `idpenjualan` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tanggaltransfer` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `idpenjualan` int(11) NOT NULL,
  `notransaksi` text NOT NULL,
  `id` int(11) NOT NULL,
  `tanggalbeli` date NOT NULL,
  `totalbeli` text NOT NULL,
  `alamatpengiriman` text NOT NULL,
  `metodepengiriman` text NOT NULL,
  `totalberat` varchar(255) NOT NULL,
  `kota` text NOT NULL,
  `ekspedisi` text NOT NULL,
  `layanan` text NOT NULL,
  `ongkir` text NOT NULL,
  `statusbeli` text NOT NULL,
  `resipengiriman` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `fotoprofil` varchar(255) NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `alamat`, `telepon`, `fotoprofil`, `level`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', 'Palembang', '0812345678', '', '', 'Untitled.png', 'Admin'),
(3, 'Pemilik', 'pemilik@gmail.com', 'pemilik', 'Jl. Palembang', '08952185912', 'Sumatera Selatan', 'Palembang', 'Untitled.png', 'Pemilik'),
(19, 'Budi doremi', 'budi@gmail.com', 'budi', 'Jl. Sunan Ampel 3 No.5, Dinoyo, Kec. Lowokwaru, Kota Malang', '081334344989', 'Kalimantan Tengah', 'Seruyan', 'Untitled.png', 'Pelanggan'),
(20, 'Sugeng Pratama', 'sugeng@gmail.com', 'sugeng', 'Palembang', '089604074477', 'Sumatera Selatan', 'Palembang', 'Untitled.png', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idpenjualandetail` int(11) NOT NULL,
  `idpenjualan` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `nama` text NOT NULL,
  `harga` text NOT NULL,
  `berat` text NOT NULL,
  `subberat` text NOT NULL,
  `subharga` text NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` text NOT NULL,
  `hargaproduk` text NOT NULL,
  `beratproduk` text NOT NULL,
  `stokproduk` text NOT NULL,
  `fotoproduk` text NOT NULL,
  `deskripsiproduk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `hargaproduk`, `beratproduk`, `stokproduk`, `fotoproduk`, `deskripsiproduk`) VALUES
(39, 17, 'NASI GORENG SPESIAL', '40000', '50', '10', 'images.jpg', '<p>Nasi Goreng Spesial adalah kreasi nasi goreng klasik dengan tambahan topping yang melimpah, menjadikannya lebih lezat dan memuaskan. Dibuat dari nasi yang digoreng dengan campuran bumbu tradisional dan kecap manis, kemudian dipadukan dengan irisan daging ayam, sosis, bakso, atau seafood</p>\r\n'),
(40, 18, 'NASI GORENG BIASA', '35000', '100', '10', '12333.jpeg', '<p>Nasi Goreng Biasa disajikan dengan telur dadar atau ceplok, irisan mentimun, tomat segar, dan kerupuk renyah, nasi goreng ini cocok dinikmati kapan saja. Dengan porsi yang pas dan harga terjangkau</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(41, 11, 'NASI GORENG', '30000', '100', '10', '0de51dc8-6f6e-4987-beb3-678a6ea84184.webp', '<p>Nasi Goreng&nbsp;pilihan tepat bagi Anda yang menginginkan cita rasa klasik khas Indonesia. Dibuat dari nasi yang digoreng dengan bumbu-bumbu tradisional seperti bawang putih, bawang merah, kecap manis, dan rempah pilihan, hidangan ini menghadirkan rasa gurih yang autentik.</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `idbeli` (`idpenjualan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`idpenjualan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idpenjualandetail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `id_kategori` (`idkategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `idpenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idpenjualandetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `pemesanan` (`idpenjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
