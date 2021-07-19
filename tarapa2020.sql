-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2021 pada 12.46
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarapa2020`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `judul_absen` varchar(100) DEFAULT NULL,
  `tgl_absen` varchar(20) DEFAULT NULL,
  `tgl_buat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `judul_absen`, `tgl_absen`, `tgl_buat`) VALUES
(1, 'Pertemuan 1 Materi Pernafasan', '23 Feb 2021', NULL),
(3, 'Pengumpulan tugas video pernafasan', '22 Feb 2021', 1614069623);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_absen` int(11) DEFAULT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_absen`, `id_peserta`, `status`, `keterangan`) VALUES
(1, 1, 1, 0, NULL),
(2, 1, 7, 0, NULL),
(5, 3, 1, 2, 'Masuk'),
(6, 3, 7, 2, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas_materi`
--

CREATE TABLE `berkas_materi` (
  `id_berkas_materi` int(11) NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `berkas_materi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berkas_materi`
--

INSERT INTO `berkas_materi` (`id_berkas_materi`, `id_materi`, `berkas_materi`) VALUES
(6, 1, 'GAUDEAMUS_IGITUR.pdf'),
(8, 1, 'PRAKATA_PENULIS.docx'),
(9, 1, 'cover_dalam.pdf'),
(10, 1, 'TRAPARA_2019.pdf'),
(11, 1, 'TRAPARA-2014.docx'),
(12, 1, 'TRAPARA_2019_REVISI.docx'),
(13, 1, 'TRAPARA_2019.docx'),
(16, 1, 'PPT_Study_Banding_-_Copy.pptx'),
(18, 5, 'IMG_3460.jpg'),
(23, 2, 'IMG_3460.jpg'),
(24, 2, 'cover_dalam.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_pemateri` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `tgl_jadwal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_pemateri`, `id_kelas`, `id_materi`, `tgl_jadwal`) VALUES
(2, 1, 2, 1, 1613814282),
(3, 1, 2, 2, 1613814356),
(4, 2, 1, 2, 1613814382),
(5, 2, 1, 1, 1613975070);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `link_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `link_kelas`) VALUES
(1, 'TRAPARA 01', 'http://instagram.com/asnanmtakim/'),
(2, 'TRAPARA 02', 'http://instagram.com/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koreksi`
--

CREATE TABLE `koreksi` (
  `id_koreksi` int(11) NOT NULL,
  `id_pemateri` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `tgl_koreksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `koreksi`
--

INSERT INTO `koreksi` (`id_koreksi`, `id_pemateri`, `id_kelas`, `id_tugas`, `tgl_koreksi`) VALUES
(1, 2, 1, 1, NULL),
(2, 1, 2, 1, 1613984759);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(100) DEFAULT NULL,
  `deskripsi_materi` varchar(1000) DEFAULT NULL,
  `tgl_materi` varchar(50) DEFAULT NULL,
  `tgl_buat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `judul_materi`, `deskripsi_materi`, `tgl_materi`, `tgl_buat`) VALUES
(1, 'Solvogio 1', 'Berikut dasar dasar teori musik', '02 Mar 2021 19:00 - 02 Mar 2021 21:00', NULL),
(2, 'Pernafasan', 'Ini materi pernafasan', '01 Mar 2021 19:00 - 01 Mar 2021 21:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemateri`
--

CREATE TABLE `pemateri` (
  `id_pemateri` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_hp_pemateri` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemateri`
--

INSERT INTO `pemateri` (`id_pemateri`, `id_user`, `no_hp_pemateri`) VALUES
(1, 13, '08966743576'),
(2, 14, '08123234353');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengtugas`
--

CREATE TABLE `pengtugas` (
  `id_pengtugas` int(11) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `berkas_peng` varchar(255) DEFAULT NULL,
  `tgl_peng` varchar(30) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `komentar` varchar(1000) DEFAULT NULL,
  `berkas_revisi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengtugas`
--

INSERT INTO `pengtugas` (`id_pengtugas`, `id_tugas`, `id_peserta`, `berkas_peng`, `tgl_peng`, `nilai`, `komentar`, `berkas_revisi`) VALUES
(2, 1, 1, '2017_SK_BAN_PT_ILKOM1.docx', '1613938251', 80, 'Sudah bagus. Semangat!!!', NULL),
(3, 1, 7, '20201004200311.mp4', '1613982978', 90, 'Bagus sekali', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nim` varchar(12) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `suara` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nim`, `id_user`, `id_kelas`, `suara`) VALUES
(1, 'H06216015', 2, 1, 'Bass'),
(7, 'A97312313', 18, 2, 'Alto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pj`
--

CREATE TABLE `pj` (
  `id_pj` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `no_hp_pj` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pj`
--

INSERT INTO `pj` (`id_pj`, `id_user`, `id_kelas`, `no_hp_pj`) VALUES
(1, 11, 1, '0852576107896'),
(3, 19, 2, '085257610789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Administrator'),
(2, 'Penanggung Jawab'),
(3, 'Pemateri'),
(4, 'Peserta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `judul_tugas` varchar(100) DEFAULT NULL,
  `deskripsi_tugas` varchar(1000) DEFAULT NULL,
  `batas_tgl` varchar(30) DEFAULT NULL,
  `tgl_tugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `judul_tugas`, `deskripsi_tugas`, `batas_tgl`, `tgl_tugas`) VALUES
(1, 'Video Solvigio 1', 'Upload video silvigio 1 setiap peserta', '21 Feb 2021 23:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `password_user` varchar(100) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `tgl_token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `password_user`, `id_role`, `foto`, `token`, `tgl_token`) VALUES
(1, 'AsnanmTakim', 'asnanmustakim126@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '35.JPG', NULL, NULL),
(2, 'M Asnan Mustakim', 'h06216015@uinsby.ac.id', 'e10adc3949ba59abbe56e057f20f883e', 4, 'default.jpg', NULL, NULL),
(11, 'Zulham Alimuddin', 'zulham@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '86.jpg', NULL, NULL),
(13, 'Firdan', 'firdan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '75.JPG', NULL, NULL),
(14, 'Hakim', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, 'default.jpg', NULL, NULL),
(16, 'Zuliatus S', 'zuliatus@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'default.jpg', NULL, NULL),
(18, 'Entus', 'zainab@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 4, '55.jpg', NULL, NULL),
(19, 'Zuliatus S', 'zuliatuss@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 'default.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `berkas_materi`
--
ALTER TABLE `berkas_materi`
  ADD PRIMARY KEY (`id_berkas_materi`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `koreksi`
--
ALTER TABLE `koreksi`
  ADD PRIMARY KEY (`id_koreksi`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `pemateri`
--
ALTER TABLE `pemateri`
  ADD PRIMARY KEY (`id_pemateri`);

--
-- Indeks untuk tabel `pengtugas`
--
ALTER TABLE `pengtugas`
  ADD PRIMARY KEY (`id_pengtugas`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `pj`
--
ALTER TABLE `pj`
  ADD PRIMARY KEY (`id_pj`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `berkas_materi`
--
ALTER TABLE `berkas_materi`
  MODIFY `id_berkas_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `koreksi`
--
ALTER TABLE `koreksi`
  MODIFY `id_koreksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemateri`
--
ALTER TABLE `pemateri`
  MODIFY `id_pemateri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengtugas`
--
ALTER TABLE `pengtugas`
  MODIFY `id_pengtugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pj`
--
ALTER TABLE `pj`
  MODIFY `id_pj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
