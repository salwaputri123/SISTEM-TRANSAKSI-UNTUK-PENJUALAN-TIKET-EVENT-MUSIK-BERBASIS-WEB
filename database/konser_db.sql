-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2024 pada 03.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konser_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `konser`
--

CREATE TABLE `konser` (
  `id_konser` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lokasi` bigint(20) UNSIGNED NOT NULL,
  `nama_konser` varchar(255) DEFAULT NULL,
  `tanggal_konser` date DEFAULT NULL,
  `jumlah_tiket` int(11) DEFAULT NULL,
  `harga` bigint(20) NOT NULL,
  `image` text DEFAULT NULL,
  `jenis_bank` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `rekening` bigint(20) NOT NULL,
  `status` enum('Setuju','Tidak') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konser`
--

INSERT INTO `konser` (`id_konser`, `id_user`, `id_lokasi`, `nama_konser`, `tanggal_konser`, `jumlah_tiket`, `harga`, `image`, `jenis_bank`, `atas_nama`, `rekening`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Black Pink', '2024-01-03', 990, 500000, '1704540657.ico', 'BNI', 'Salwa', 1234554321, 'Setuju', '2024-01-06 04:30:57', '2024-01-06 09:59:42'),
(2, 3, 1, 'Dhyo Haw', '2024-01-31', 4994, 300000, '1704540820.png', 'BCA', 'Audy', 54321123, 'Setuju', '2024-01-06 04:33:40', '2024-01-06 18:23:33'),
(8, 3, 3, 'Black Pink', '2024-12-04', 650, 500000, '1704590484.jpg', 'DANA', 'Audy', 887435359524, 'Setuju', '2024-01-06 18:21:24', '2024-01-06 18:34:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tiket` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `lokasi`, `tiket`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan', 5000, '2024-01-06 11:23:43', '2024-01-06 11:23:43'),
(2, 'Gedung', 1000, '2024-01-06 11:23:43', '2024-01-06 11:23:43'),
(3, 'Gedung Olahraga ULBI', 650, '2024-01-06 06:31:26', '2024-01-06 18:31:08'),
(4, 'Lapangan ULBI', 100, '2024-01-06 18:19:02', '2024-01-06 18:19:02'),
(5, 'Auditorium ULBI', 500, '2024-01-06 18:19:27', '2024-01-06 18:19:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_01_06_104650_create_lokasi_table', 1),
(4, '2024_01_06_110424_create_konser_table', 1),
(5, '2024_01_06_110436_create_transaksi_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_konser` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `transfer` varchar(100) NOT NULL,
  `qrcode` text NOT NULL,
  `keterangan` enum('Berhasil','Proses','Gagal') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_konser`, `qty`, `total`, `tanggal`, `transfer`, `qrcode`, `keterangan`, `created_at`, `updated_at`) VALUES
(11, 2, 2, 1, 300000, '2024-01-06', '1704562172.jpeg', '70490076468', 'Berhasil', '2024-01-06 10:29:32', '2024-01-06 10:29:32'),
(12, 2, 2, 2, 600000, '2024-01-06', '1704562412.jpeg', '88800743960', 'Berhasil', '2024-01-06 10:33:32', '2024-01-06 10:33:32'),
(13, 2, 2, 2, 600000, '2024-01-06', '1704567956.jpeg', '31329466318', 'Berhasil', '2024-01-06 12:05:56', '2024-01-06 12:57:46'),
(14, 2, 2, 1, 300000, '2024-01-07', '1704590613.jpg', '52067636328', 'Berhasil', '2024-01-06 18:23:33', '2024-01-06 18:24:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pembeli','penyelenggara') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin master', 'admin@gmail.com', '$2y$12$aTTun2nY/pQ6jn38JR.TTOrfT.j1Gb2.jB83hQq3pUaia3e9CBqQm', 'admin', '2024-01-06 04:12:08', '2024-01-06 04:12:08'),
(2, 'pembeli', 'putra@gmail.com', '$2y$12$k2rpxNeOQhENjZSdTnZhvexK45LrTDdmd/Wks423JSoko60rjVR..', 'pembeli', '2024-01-06 04:12:09', '2024-01-06 04:12:09'),
(3, 'penyelenggara', 'putri@gmail.com', '$2y$12$E4xxt2qwJW8o1uQvKL1pPu9g7azvxPGqbdjgEG3DT1y54t0zLOUAi', 'penyelenggara', '2024-01-06 04:12:09', '2024-01-06 04:12:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id_konser`),
  ADD KEY `konser_id_lokasi_foreign` (`id_lokasi`) USING BTREE,
  ADD KEY `konser_rekening_unique` (`rekening`) USING BTREE;

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_user_foreign` (`id_user`),
  ADD KEY `transaksi_id_konser_foreign` (`id_konser`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `konser`
--
ALTER TABLE `konser`
  ADD CONSTRAINT `konser_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_konser_foreign` FOREIGN KEY (`id_konser`) REFERENCES `konser` (`id_konser`),
  ADD CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
