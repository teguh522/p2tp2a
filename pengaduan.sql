-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Feb 2021 pada 10.07
-- Versi server: 8.0.23-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id_auth` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `status_auth` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id_auth`, `email`, `password`, `level`, `status_auth`) VALUES
(1, 'teguhf522@gmail.com', '$2y$10$rdof2HSCda8Le3NyFN2kueuMTni56/33JS/0veKGApDsP572Rmdi6', 'user', 1),
(2, 'admin@gmail.com', '$2y$10$rdof2HSCda8Le3NyFN2kueuMTni56/33JS/0veKGApDsP572Rmdi6', 'admin', 1),
(5, 'testing@gmail.com', '$2y$10$/KAJYV5oHDf7V2RXW2tGgO8FCNajdtKbldQQqK6.ffRrXNW1H0ZX6', 'user', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `datautama`
--

CREATE TABLE `datautama` (
  `id_datautama` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `ka_upt` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `datautama`
--

INSERT INTO `datautama` (`id_datautama`, `id_user`, `nama`, `ka_upt`, `foto`) VALUES
(1, 1, 'Srilulasti', 26, 'user.png'),
(3, 5, 'TESTING', 37, 'user.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_kasus`
--

CREATE TABLE `tbl_jenis_kasus` (
  `id_kasus` int NOT NULL,
  `nama_kasus` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_jenis_kasus`
--

INSERT INTO `tbl_jenis_kasus` (`id_kasus`, `nama_kasus`) VALUES
(1, 'KDRT'),
(2, 'Traffiking'),
(3, 'Kekerasan Fisik'),
(4, 'Penelantaran'),
(5, 'Kekerasan Terhadap Anak'),
(6, 'Penganiayaan/Bullying'),
(7, 'Pelecehan Seksual'),
(8, 'Kekerasan Psikis'),
(9, 'Hak Asuh Anak'),
(10, 'Hak Anak (Tunjangan Anak)'),
(11, 'Bencana'),
(12, 'Perlindungan Perempuan'),
(13, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `nama_kecamatan`, `latitude`, `longitude`) VALUES
(1, 'Arjawinangun', '-6.631241094929867', '108.38468049912139'),
(2, 'Astanajapura', '-6.791748860502454', '108.62385214064219'),
(3, 'Babakan', '-6.878436005098216', '108.71872812166616'),
(4, 'Beber', '-6.816837347873049', '108.51670991534311'),
(5, 'Ciledug', '-6.897050719643986', '108.74633750774657'),
(6, 'Ciwaringin', '-6.682106275181945', '108.38493544950528'),
(7, 'Depok', '-6.732859055130433', '108.4477716559783'),
(8, 'Dukupuntang', '-6.76891094789981', '108.4062331350016'),
(9, 'Gebang', '-6.823325971937996', '108.72572985735717'),
(10, 'Gegesik', '-6.5907376707460426', '108.42151175157353'),
(11, 'Gempol', '-6.702667230253549', '108.40568476426428'),
(12, 'Greged', '-6.81005333010443', '108.56061837578677'),
(13, 'Gunungjati', '-6.6682008998644', '108.54104303127036'),
(14, 'Jamblang', '-6.664850999264161', '108.47379173303862'),
(15, 'Kaliwedi', '-6.57420936869766', '108.38741971715608'),
(16, 'Kapetakan', '-6.58215975024776', '108.5122201559783'),
(17, 'Karangsembung', '-6.849306492098458', '108.64458770821096'),
(18, 'Karangwareng', '-6.861863380212597', '108.64399758095595'),
(19, 'Kedawung', '-6.71820763801185', '108.53333357220555'),
(20, 'Klangenan', '-6.679861578988023', '108.45290971264603'),
(21, 'Lemahabang', '-6.8326806250301075', '108.61261690554416'),
(22, 'Losari', '-6.823117090826482', '108.80434904764762'),
(23, 'Mundu', '-6.776193798272402', '108.58380264701879'),
(24, 'Pabedilan', '-6.863757500751785', '108.77278658735395'),
(25, 'Pabuaran', '-6.901811729691139', '108.71967826985318'),
(26, 'Palimanan', '-6.719141191786037', '108.42903694421638'),
(27, 'Pangenan', '-6.796427421254064', '108.66250105539419'),
(28, 'Panguragan', '-6.62099174465549', '108.45376299186401'),
(29, 'Pasaleman', '-6.95405774673396', '108.73706176950847'),
(30, 'Plered', '-6.698749582866218', '108.50930188053624'),
(31, 'Plumbon', '-6.701986262087712', '108.47361261911905'),
(32, 'Sedong', '-6.855426944259293', '108.56504575970955'),
(33, 'Sumber', '-6.758809654538648', '108.48690496102776'),
(34, 'Suranenggala', '-6.62769907621551', '108.52753092872325'),
(35, 'Susukan', '-6.620354885811955', '108.35901949764761'),
(36, 'Susukan Lebak', '-6.867051054533815', '108.62260364304814'),
(37, 'Talun', '-6.766346276675984', '108.51149465362593'),
(38, 'Tengahtani', '-6.7060256769075135', '108.52124813735396'),
(39, 'Waled', '-6.908810050000004', '108.6839403942164'),
(40, 'Weru', '-6.713340683794821', '108.49920028828282');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaduan`
--

CREATE TABLE `tbl_pengaduan` (
  `id_pengaduan` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `no_kk` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('pria','wanita') NOT NULL,
  `alamat_tinggal` text NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `ibu_kandung` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `jenis_kasus` int NOT NULL,
  `kronologi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_kejadian` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_pengaduan`
--

INSERT INTO `tbl_pengaduan` (`id_pengaduan`, `id_kecamatan`, `no_kk`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jk`, `alamat_tinggal`, `agama`, `pendidikan`, `pekerjaan`, `ibu_kandung`, `alamat`, `hp`, `jenis_kasus`, `kronologi`, `tgl_kejadian`, `keterangan`, `created_at`) VALUES
(2, 16, '232oiuo', 'tes', 'tes', '2021-02-01', 'wanita', 'tes', 'tes', 'ted', 'tes', 'eer', 'ert', '098080', 3, 'tes', '2021-02-01', 'Laporan Terkirm', '2021-01-31 08:33:31'),
(3, 1, '12312', 'TES', 'tes', '2021-03-08', 'pria', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', '34534', 4, 'terter', '2021-02-28', 'Laporan Terkirm', '2021-02-02 01:30:10'),
(4, 26, '234', 'TE', 'ter', '2021-02-05', 'pria', 'ter', 'ter', 'ert', 'ter', 'ert', 'ter', '234234', 3, 'ertert', '2021-02-28', 'Laporan Terkirm', '2021-02-05 01:33:45');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `totalpertahun`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `totalpertahun` (
`id_kecamatan` int
,`tahun` int
,`totalpengaduan` bigint
);

-- --------------------------------------------------------

--
-- Struktur untuk view `totalpertahun`
--
DROP TABLE IF EXISTS `totalpertahun`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalpertahun`  AS  select `a`.`id_kecamatan` AS `id_kecamatan`,year(`a`.`tgl_kejadian`) AS `tahun`,count(`a`.`id_kecamatan`) AS `totalpengaduan` from `tbl_pengaduan` `a` group by `a`.`id_kecamatan`,year(`a`.`tgl_kejadian`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indeks untuk tabel `datautama`
--
ALTER TABLE `datautama`
  ADD PRIMARY KEY (`id_datautama`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `ka_upt` (`ka_upt`);

--
-- Indeks untuk tabel `tbl_jenis_kasus`
--
ALTER TABLE `tbl_jenis_kasus`
  ADD PRIMARY KEY (`id_kasus`);

--
-- Indeks untuk tabel `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indeks untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `jenis_kasus` (`jenis_kasus`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id_auth` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `datautama`
--
ALTER TABLE `datautama`
  MODIFY `id_datautama` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_kasus`
--
ALTER TABLE `tbl_jenis_kasus`
  MODIFY `id_kasus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `id_kecamatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `datautama`
--
ALTER TABLE `datautama`
  ADD CONSTRAINT `datautama_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `auth` (`id_auth`) ON UPDATE CASCADE,
  ADD CONSTRAINT `datautama_ibfk_2` FOREIGN KEY (`ka_upt`) REFERENCES `tbl_kecamatan` (`id_kecamatan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD CONSTRAINT `tbl_pengaduan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tbl_kecamatan` (`id_kecamatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pengaduan_ibfk_2` FOREIGN KEY (`jenis_kasus`) REFERENCES `tbl_jenis_kasus` (`id_kasus`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
