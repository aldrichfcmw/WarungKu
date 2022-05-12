-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Bulan Mei 2022 pada 21.18
-- Versi server: 10.3.34-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytelkom_warungku`
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
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
