-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Mar 2024 pada 03.48
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(10) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_brg`, `nama_brg`, `kategori`, `merk`, `jumlah`) VALUES
(14, 'Z681', 'Sepatu', 'Pakaian', 'Nana', 90),
(22, 'K01', 'Kulkas', 'Furniture', 'Nana', 0),
(24, 'Y812', 'HP', 'Elektronik', 'Samsung', 19),
(25, 'Pi2', 'Baju', 'Pakaian', 'Nana', 89),
(27, 'MA2', 'Kasur', 'Furniture', 'Nana', 29),
(28, 'KAO8', 'Celana', 'Pakaian', 'Samsung', 70),
(29, 'MJA1', 'Kursi', 'Furniture', 'Bena', 140),
(30, 'JU0', 'Tas', 'Aksesoris', 'Kona', 99),
(31, 'L1', 'Gitar', 'Alat Musik', 'Hina', 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `no_identitas` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `keperluan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_login` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tgl_pinjam`, `tgl_kembali`, `no_identitas`, `kode_brg`, `jumlah`, `keperluan`, `status`, `id_login`) VALUES
(1, '2024-03-01', '2024-03-22', 'I93', 'Z6', 5, 'individu', 'Baru', 1),
(82, '2024-03-02', '2024-03-16', 'AS21', 'K1', 10, 'individu', 'baru', 1),
(83, '2024-03-09', '2024-03-23', 'I93', 'K1', 50, 'individu', 'baru', 1),
(84, '2024-03-01', '2024-03-15', 'I93', 'M343', 20, 'individu', 'baru', 1),
(85, '2024-03-29', '2024-03-22', 'I93', 'K01', 20, 'individu', 'baru', 1),
(86, '2024-03-08', '2024-03-23', 'I93', 'Y812', 13, 'individu', 'baru', 1),
(87, '2024-03-02', '2024-03-23', 'YG2', 'JU0', 2, 'individu', 'baru', 1),
(88, '2024-03-15', '2024-03-23', 'YG2', 'MA2', 1, 'individu', 'baru', 1),
(89, '2024-03-08', '2024-03-23', 'YG2', 'Pi2', 1, 'individu', 'baru', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `no_identitas` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `no_identitas`, `nama`, `status`, `username`, `password`, `role`) VALUES
(1, 'I93', 'Fiona', 'login', 'Fionahiji', 'Fiona123', 'member'),
(2, 'I12', 'Rena', 'Pelajar', 'Renadua', 'Rena111', 'admin'),
(13, 'L01', 'Hina', 'member', 'hina', 'hina123', 'admin'),
(14, 'YG2', 'Nera', 'member', 'Nera', 'Nera123', 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_brg` (`kode_brg`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_login` (`id_login`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_login`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
