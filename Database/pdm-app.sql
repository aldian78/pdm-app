-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Jan 2023 pada 15.56
-- Versi server: 10.5.8-MariaDB-log
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdm-app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `error_application`
--

CREATE TABLE `error_application` (
  `error_id` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `error_date` varchar(3) NOT NULL,
  `modules` varchar(100) NOT NULL,
  `controller` varchar(200) NOT NULL,
  `function` varchar(200) NOT NULL,
  `error_line` varchar(30) NOT NULL,
  `error_mesagge` varchar(1000) NOT NULL,
  `status` varchar(30) NOT NULL,
  `param` varchar(300) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_mark` varchar(1) NOT NULL,
  `update_by` varchar(30) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Administrator', 'System', '2023-01-20 18:48:09', 'System', '2023-01-20 18:48:02'),
(2, 'Manager', 'System', '2023-01-20 18:48:13', 'System', '2023-01-20 18:48:10'),
(3, 'Staff', 'System', '2023-01-20 18:48:16', 'System', '2023-01-20 18:48:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `nik` int(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `alamat`, `nik`, `status`, `jabatan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(2, 'Aldian', 'surabaya', 2445446, 'Active', 3, 'System', '2023-01-20 17:03:25', 'admin', '2023-01-20 17:03:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(3) NOT NULL,
  `id_level` varchar(3) NOT NULL,
  `menu_name` varchar(300) NOT NULL,
  `menu_link` varchar(300) NOT NULL,
  `menu_icon` varchar(300) NOT NULL,
  `parent_id` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_mark` varchar(1) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `id_level`, `menu_name`, `menu_link`, `menu_icon`, `parent_id`, `is_active`, `created_by`, `created_date`, `deleted_mark`, `updated_by`, `updated_date`) VALUES
(1, '1', 'Data Karyawan', 'DataKaryawan', 'far fa-fw fa-circle nav-icon', '2', 1, 'System', '2023-01-21 04:49:04', 'N', 'System', '2023-01-21 04:00:37'),
(4, '1', 'Data Jabatan', 'DataJabatan', 'far fa-fw fa-circle nav-icon', '2', 1, 'System', '2023-01-21 06:21:25', 'N', 'System', '2023-01-21 04:05:06'),
(5, '1', 'Data Menu User', 'DataMenuUser', 'far fa-fw fa-circle nav-icon', '1', 1, 'System', '2023-01-21 04:49:04', 'N', 'System', '2023-01-21 04:00:37'),
(6, '1', 'Data Menu', 'DataMenu', 'far fa-fw fa-circle nav-icon', '1', 1, 'System', '2023-01-21 06:21:25', 'N', 'System', '2023-01-21 04:05:06'),
(7, '1', 'Data Parent', 'DataParent', 'far fa-fw fa-circle nav-icon', '1', 1, 'System', '2023-01-21 04:49:04', 'N', 'System', '2023-01-21 04:00:37'),
(11, '1', 'Data Level', 'DataLevel', 'far fa-fw fa-circle nav-icon', '1', 1, 'System', '2023-01-21 14:34:49', '', 'admin', '2023-01-21 07:34:49'),
(12, '1', 'Data Presensi', 'DataPresensi', 'far fa-fw fa-circle nav-icon', '6', 1, 'System', '2023-01-21 07:51:44', '', 'System', '2023-01-21 14:51:44'),
(13, '3', 'Absensi', 'Absensi', 'far fa-fw fa-circle nav-icon', '6', 1, 'System', '2023-01-21 15:40:38', '', 'System', '2023-01-21 15:39:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_level`
--

CREATE TABLE `menu_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(60) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_level`
--

INSERT INTO `menu_level` (`id_level`, `level`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Administrator', 'System', '2023-01-21 06:23:30', 'System', '2023-01-21 06:23:30'),
(2, 'HRD', 'System', '2023-01-21 06:23:30', 'System', '2023-01-21 06:23:30'),
(3, 'Staff', 'System', '2023-01-21 06:23:40', 'System', '2023-01-21 06:23:40'),
(4, 'Manager', 'System', '2023-01-21 07:36:27', 'System', '2023-01-21 14:36:27'),
(5, 'Direktur', 'System', '2023-01-21 14:38:26', 'admin', '2023-01-21 07:38:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_user`
--

CREATE TABLE `menu_user` (
  `no_setting` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_mark` varchar(1) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_user`
--

INSERT INTO `menu_user` (`no_setting`, `id_user`, `parent_id`, `menu_id`, `created_by`, `created_date`, `deleted_mark`, `updated_by`, `updated_date`) VALUES
(1, '3', 1, 0, 'System', '2023-01-21 07:28:12', 'N', 'System', '2023-01-21 07:28:12'),
(2, '3', 2, 0, 'System', '2023-01-21 08:01:36', 'N', 'System', '2023-01-21 07:28:12'),
(6, '3', 6, 0, 'System', '2023-01-21 07:55:30', '', 'System', '2023-01-21 14:55:30'),
(7, '12', 6, 0, 'System', '2023-01-21 08:24:54', '', 'System', '2023-01-21 15:24:54'),
(8, '13', 1, 0, 'System', '2023-01-21 08:25:01', '', 'System', '2023-01-21 15:25:01'),
(9, '13', 2, 0, 'System', '2023-01-21 08:25:08', '', 'System', '2023-01-21 15:25:08'),
(10, '13', 6, 0, 'System', '2023-01-21 08:25:13', '', 'System', '2023-01-21 15:25:13'),
(12, '15', 1, 0, 'System', '2023-01-21 08:28:17', '', 'System', '2023-01-21 15:28:17'),
(14, '15', 2, 0, 'System', '2023-01-21 08:28:34', '', 'System', '2023-01-21 15:28:34'),
(15, '15', 6, 0, 'System', '2023-01-21 08:28:39', '', 'System', '2023-01-21 15:28:39'),
(17, '14', 6, 13, 'System', '2023-01-21 08:50:02', '', 'System', '2023-01-21 15:50:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parent_menu`
--

CREATE TABLE `parent_menu` (
  `id_parent` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent_name` varchar(60) NOT NULL,
  `parent_icon` varchar(60) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_mark` varchar(1) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parent_menu`
--

INSERT INTO `parent_menu` (`id_parent`, `menu_id`, `parent_name`, `parent_icon`, `created_by`, `created_date`, `deleted_mark`, `updated_by`, `updated_date`) VALUES
(1, 5, 'Management Menu', 'nav-icon fas fa-fw fa-list', 'System', '2023-01-21 07:24:46', 'N', 'System', '2023-01-21 04:47:57'),
(2, 1, 'Managemen Karyawan', 'nav-icon fas fa-fw fa-tachometer-alt', 'System', '2023-01-21 07:24:42', 'N', 'System', '2023-01-21 04:47:57'),
(6, 0, 'Managemen Presensi', 'fas fa-fw fa-sticky-note', 'System', '2023-01-21 15:06:15', '', 'admin', '2023-01-21 08:06:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `wa` varchar(30) NOT NULL,
  `pin` varchar(30) NOT NULL,
  `id_jenis_user` varchar(3) NOT NULL COMMENT '1 admin, 2 hrd, 3 staff',
  `status_user` varchar(30) NOT NULL,
  `delete_mark` varchar(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `no_hp`, `wa`, `pin`, `id_jenis_user`, `status_user`, `delete_mark`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(3, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', '08174246873', '08174246873', '123456', '1', 'Active', 'N', 'System', '2023-01-19 09:28:33', 'System', '2023-01-19 16:28:33'),
(14, 'Staff', 'Staff', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'Staff@gmail.com', '5904540465474', '5904540465474', '34225', '3', 'Active', 'N', 'System', '2023-01-21 15:27:33', 'System', '2023-01-21 15:26:56'),
(15, 'HRD', 'HRD', 'ff2c93fdc08810c6189e9086905a8fbc1ad11404', 'hrd@gmail.com', '050409460555', '050409460555', '3252552', '2', 'Active', 'N', 'System', '2023-01-21 15:27:31', 'System', '2023-01-21 15:27:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_activity`
--

CREATE TABLE `user_activity` (
  `no_activity` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `discripsi` varchar(300) NOT NULL,
  `status` varchar(30) NOT NULL,
  `menu_id` varchar(3) NOT NULL,
  `delete_mark` varchar(1) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_foto`
--

CREATE TABLE `user_foto` (
  `no_foto` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_mark` varchar(1) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_foto`
--

INSERT INTO `user_foto` (`no_foto`, `id_user`, `foto`, `created_by`, `created_date`, `deleted_mark`, `updated_by`, `updated_date`) VALUES
(2, '12', 'default.jpg', 'System', '2023-01-20 20:09:01', 'N', 'System', '0000-00-00 00:00:00'),
(3, '13', 'default.jpg', 'System', '2023-01-20 20:09:51', 'N', 'System', '2023-01-21 03:09:51'),
(4, '3', 'default.jpg', 'System', '2023-01-21 04:29:47', 'N', 'System', '2023-01-21 04:29:25'),
(5, '14', 'default.jpg', 'System', '2023-01-21 08:26:56', 'N', 'System', '2023-01-21 15:26:56'),
(6, '15', 'default.jpg', 'System', '2023-01-21 08:27:19', 'N', 'System', '2023-01-21 15:27:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `error_application`
--
ALTER TABLE `error_application`
  ADD PRIMARY KEY (`error_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `jabatan` (`jabatan`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indeks untuk tabel `menu_level`
--
ALTER TABLE `menu_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `menu_user`
--
ALTER TABLE `menu_user`
  ADD PRIMARY KEY (`no_setting`);

--
-- Indeks untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  ADD PRIMARY KEY (`id_parent`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`no_activity`);

--
-- Indeks untuk tabel `user_foto`
--
ALTER TABLE `user_foto`
  ADD PRIMARY KEY (`no_foto`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `error_application`
--
ALTER TABLE `error_application`
  MODIFY `error_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `menu_level`
--
ALTER TABLE `menu_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `menu_user`
--
ALTER TABLE `menu_user`
  MODIFY `no_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  MODIFY `id_parent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `no_activity` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_foto`
--
ALTER TABLE `user_foto`
  MODIFY `no_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
