-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 15.30
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `idkeluar` int(11) NOT NULL,
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `keluar` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `gambarPenerima` varchar(255) NOT NULL,
  `tanggalKeluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`idkeluar`, `idmasuk`, `idbarang`, `keluar`, `penerima`, `gambarPenerima`, `tanggalKeluar`) VALUES
(15, 43, 8, '10', 'Bima', '6475f9ebd2a5a.png', '2023-05-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `idbarang` int(11) NOT NULL,
  `namaJenisBarang` varchar(255) NOT NULL,
  `tgl` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`idbarang`, `namaJenisBarang`, `tgl`) VALUES
(6, 'Ban', '2023-05-28 02:13:35'),
(7, 'Seal Karet', '2023-05-28 02:13:43'),
(8, 'Oli Mesin', '2023-05-28 02:13:53'),
(9, 'Rantai Motor atau V-Belt', '2023-05-28 02:14:10'),
(10, 'Kampas Rem', '2023-05-28 02:14:21'),
(11, 'Busi', '2023-05-28 02:14:25'),
(12, 'Kampas Kopling', '2023-05-28 02:14:37'),
(13, 'Filter atau Saringan Udara', '2023-05-28 02:14:58'),
(14, 'Aki', '2023-05-28 02:15:07'),
(15, 'Lampu', '2023-05-28 02:15:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'audy@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `ubah` date DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `ubah`, `gambar`, `ukuran`, `merk`, `keterangan`, `qty`) VALUES
(43, 8, '2023-05-30 12:58:50', NULL, '6475f30a7d093.png', '800 ml', 'Yamalube', 'Kinerja Mesin', 90),
(44, 14, '2023-05-30 13:00:43', NULL, '6475f37b33fad.png', 'Panjang 113mm, Lebar 70mm', 'GS', 'Komponen utama motor', 70),
(46, 15, '2023-05-30 13:07:17', NULL, '6475f50506dd1.png', '8 Watt', 'Philips Tyto M5', 'Penambah penerangan', 120),
(47, 6, '2023-05-30 13:09:43', NULL, '6475f59753fa7.png', '12', 'FDR', 'Komponen Utama Motor', 200);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
