-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2018 at 06:02 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nilai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `level` enum('admin','operator','','') NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `foto`, `level`, `log`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '123', '', 'admin', '2018-01-20 02:19:25'),
(2, 'operator', '7815696ecbf1c96e6894b779456d330e', 'Operator Gantenk', '', 'operator', '2018-08-29 19:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(10) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `r_pass` varchar(50) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `email`, `nip`, `jenis_kelamin`, `foto`, `username`, `password`, `r_pass`, `log`) VALUES
(5, 'Ishar Halqi .SPd,Mkom', 'ee11cbb190', '94350138', 'L', 'nama1533922825.jpg', 'user', '202cb962ac59075b964b07152d234b70', 'user', '2018-08-12 07:06:49'),
(7, 'Zayeh El FehZahriD', '7815696ecb', 'asdasd', 'L', 'nama1533923616.jpg', 'adasd', '7815696ecbf1c96e6894b779456d330e', 'asd', '2018-08-12 06:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `ket` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `ket`) VALUES
(3, 'A', '10'),
(4, 'B', '10');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` int(5) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_kelas` varchar(100) NOT NULL,
  `id_guru` varchar(50) NOT NULL,
  `ta_akademik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `kode`, `nama_mapel`, `semester`, `id_kelas`, `id_guru`, `ta_akademik`) VALUES
(2, '1555', 'Teknik Analogikal Komputer ', '1', '3', '7', ''),
(3, '1515', 'KIMIA', '2', '3', '5', ''),
(4, '124', 'Listrik Dinamis', '2', '4', '5', ''),
(5, '566', 'Kimia', '2', '4', '5', ''),
(6, '3434', 'Ilmu Kealamiahan Dasar', '2', '4', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(5) NOT NULL,
  `ket_nilai` varchar(100) NOT NULL,
  `id_mata_pelajaran` varchar(30) NOT NULL,
  `nilai` varchar(30) NOT NULL,
  `id_siswa` int(30) NOT NULL,
  `id_guru` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status` enum('belum','sudah','','') NOT NULL,
  `nu` varchar(50) NOT NULL,
  `nj` varchar(50) NOT NULL,
  `nt` varchar(50) NOT NULL,
  `kkm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `ket_nilai`, `id_mata_pelajaran`, `nilai`, `id_siswa`, `id_guru`, `semester`, `id_kelas`, `status`, `nu`, `nj`, `nt`, `kkm`) VALUES
(1, 'Gagal', '3', '33.75', 7, '5', '2', 3, 'belum', '45', '45', '45', '45'),
(2, 'Gagal', '4', '33.75', 9, '5', '2', 4, 'belum', '45', '45', '45', '45'),
(3, 'KKM (Krikteria Ketuntasan Minimal)', '5', '56', 9, '5', '2', 4, 'belum', '53', '56', '56', '56'),
(4, 'KKM (Krikteria Ketuntasan Minimal)', '6', '56', 9, '5', '2', 4, 'belum', '56', '51', '53', '56');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `parameter` varchar(200) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`parameter`, `nilai`) VALUES
('nama_sekolah', 'SMK ADI KARIA RANAH PESISIR'),
('alamat_sekolah', 'Jl .Ranah Pesisir Kabupaten Pesisir Selatan'),
('misi_visi', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a,\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a,\r\n						<table>\r\n							<tbody>\r\n								<tr>\r\n									<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a,\r\n									<table>\r\n										<tbody>\r\n											<tr>\r\n												<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a,</td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('favicon', '_12.jpg'),
('gambar', '2018-08-29_12.png'),
('telp', '0852743266645'),
('sk_pendirian', 'SV/23-455/1989/2002');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(5) NOT NULL,
  `nama_s` varchar(30) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `nama_orang_tua` varchar(30) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_s`, `nisn`, `jk`, `nama_orang_tua`, `foto`, `kelas`, `semester`) VALUES
(7, 'Ismarianto', '121', 'L', 'eo', 'nama1533923757.jpg', '3', 2),
(8, 'Nabil El Ehzar', '1232131', 'L', 'Dahlia Fatria', 'nama1535368147.jpg', '3', 1),
(9, 'Syahwal L\' ', '23423', 'L', 'No Name', 'nama1535484734.jpg', '4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
