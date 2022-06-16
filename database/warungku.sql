-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2022 pada 06.16
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dagangan`
--

CREATE TABLE `dagangan` (
  `id_barang` int(255) NOT NULL,
  `id_kategori` int(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `gambar_barang` varchar(255) NOT NULL,
  `deskripsi_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(255) NOT NULL,
  `harga_barang` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dagangan`
--

INSERT INTO `dagangan` (`id_barang`, `id_kategori`, `nama_barang`, `gambar_barang`, `deskripsi_barang`, `jumlah_barang`, `harga_barang`) VALUES
(1211, 121, 'Spotify FamPlan', '624fe326d2650.jpeg', 'Murah', 15, 17000),
(1221, 122, 'PSN Rp 200.000', '624ff85a1a4f2.jpeg', 'Cepat', 10, 198000),
(1231, 123, 'Robux 6000 fall', '624fe2ac05a01.jpg', 'Cepat', 100, 6000),
(1241, 124, 'Genshin 60 Cristal', '624fe37d59a04.jpeg', 'Murah', 15, 11000),
(1242, 124, 'Valorant', '624fef2188d75.jpeg', 'asdwasdwa', 10, 2500),
(1251, 125, 'By.U 3 Gb', '624ff9143563d.png', 'Termurah', 5, 14000),
(1271, 127, 'Steam IDR 60000', '624fe3b69713e.jpeg', 'Murah', 5, 60000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `icon`, `kategori`) VALUES
(121, 'apps.svg', 'Aplikasi'),
(122, 'console.svg', 'Console Game'),
(123, 'mobile.svg', 'Mobile Game'),
(124, 'pc.svg', 'PC Game'),
(125, 'pulsa.svg', 'Pulsa & Utilitas'),
(126, 'streaming.svg', 'Streaming Apps'),
(127, 'voucher.svg', 'Voucher');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `gambar_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(255) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `metode`, `gambar`) VALUES
(91, 'Alfamart', 'alfamart.png'),
(92, 'Bank Rakyat Indonesia', 'bank-bri.png'),
(93, 'Bank Central Asia', 'bca.png'),
(94, 'Bank Negara Idonesia', 'bni.png'),
(95, 'Gopay', 'gopay.png'),
(96, 'Indomaret', 'indomaret.png'),
(97, 'Jenius', 'jenius-2.png'),
(98, 'link Aja', 'logo-linkaja.png'),
(99, 'Mandiri', 'logo-mandiri.png'),
(100, 'OVO', 'ovo.png'),
(101, 'QRIS', 'QRIS.png'),
(102, 'ShopeePay', 'ShopeePay.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pembayaran`
--

CREATE TABLE `riwayat_pembayaran` (
  `id_bayar` int(255) NOT NULL,
  `list_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(255) NOT NULL,
  `total_bayar` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_pembayaran`
--

INSERT INTO `riwayat_pembayaran` (`id_bayar`, `list_barang`, `jumlah_barang`, `total_bayar`) VALUES
(15912, 'Genshin 60 Cristal', 5, 55000),
(15913, 'Robux 6000 fall', 7, 42000),
(15914, 'Spotify FamPlan', 1, 17000),
(15915, 'PSN Rp 200.000', 1, 198000),
(15916, 'By.U 3 Gb', 1, 14000),
(15917, '', 0, 0),
(15918, 'By.U 3 Gb', 1, 14000),
(15919, '', 0, 0),
(15920, 'By.U 3 Gb', 1, 14000),
(15921, '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `level` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `level`, `name`, `email`, `password`, `foto`) VALUES
(1, 0, 'Admin', 'admin@gmail.com', '7810ccd41bf26faaa2c4e1f20db70a71', ''),
(2, 1, 'Aldrich FCMW', 'aldrichmuktiwibiwo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dagangan`
--
ALTER TABLE `dagangan`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `nama_barang` (`nama_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `riwayat_pembayaran`
--
ALTER TABLE `riwayat_pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dagangan`
--
ALTER TABLE `dagangan`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122323;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pembayaran`
--
ALTER TABLE `riwayat_pembayaran`
  MODIFY `id_bayar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15922;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
