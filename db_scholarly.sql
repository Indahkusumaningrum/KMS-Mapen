-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2024 pada 06.14
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_scholarly`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id` int(11) NOT NULL,
  `matkul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id`, `matkul`, `deskripsi`, `tanggal`, `file_path`) VALUES
(1, 'Pembelajaran Mesin', 'Pertemuan Ke-15 ANN', '2024-06-14', 'uploads/666af2eca0359.pdf'),
(5, 'Kecerdasan Buatan', 'Pertemuan ke 5', '2024-06-14', 'uploads/666b7be563cff.pdf'),
(6, 'Teori Informasi', 'Pertemuan 6 - Eror Detection and Correction', '2024-05-27', 'uploads/666b88417defc.pdf'),
(8, 'Pembelajaran Mesin', 'Pertemuan ke-8 DBSCAN', '2024-06-21', 'uploads/666ba44d39fc0.pdf'),
(9, 'Kecerdasan Buatan', 'Pertemuan ke-5 - SISTEM PAKAR\r\n', '2024-06-09', 'uploads/666ba4b5890f0.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id` int(11) NOT NULL,
  `mata_kuliah` varchar(100) NOT NULL,
  `dosen` varchar(100) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id`, `mata_kuliah`, `dosen`, `hari`, `jam_mulai`, `jam_selesai`, `ruang`) VALUES
(1, 'Internet og Things', 'Muhaqiqin', 'Rabu', '08:00:00', '10:00:00', 'GIK L1 C'),
(3, 'Manajemen Pengetahuan', 'Didik Kurniawan', 'Jumat', '14:30:00', '15:20:00', 'GIK L1 C'),
(4, 'Artificial Intelligence', 'Prof. Admi Syarif', 'Senin', '23:10:00', '12:50:00', 'GIK L1 C'),
(6, 'Pemrosesan Data Terdistribusi', 'Aristoteles', 'Selasa', '07:30:00', '09:10:00', 'GIK L1 C'),
(7, 'Pemrograman Deklaratif', 'Favorizen Rosyking Lumbanraja', 'Selasa', '09:20:00', '11:00:00', 'GIK L1 B'),
(8, 'Teknologi dan Aplikasi Mobile', 'Muhaqiqin', 'Kamis', '13:30:00', '15:10:00', 'GIK L2'),
(9, 'Pemrograman Web', 'Rizky Prabowo', 'Rabu', '07:30:00', '09:10:00', 'MIPA T L1B'),
(11, 'Internet og Things', 'pak muhaqiqin', 'Selasa', '07:30:00', '09:20:00', 'GIK L1 B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `nama_matkul` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `dosen_pengampu` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `nama_matkul`, `sks`, `dosen_pengampu`, `deskripsi`) VALUES
(9, 'Kecerdasan Buatan', 3, 'Admi Syarif, Dr.Eng.', 'Wajib'),
(10, 'Teori Informasi', 2, 'Favorisen Rosyking Lumbanraja, S.Kom, M.Si, Ph,D.', 'Wajib'),
(12, 'Pemrograman Deklaratif', 3, 'Favorisen Rosyking Lumbanraja, S.Kom, M.Si, Ph,D.', 'Peminatan'),
(13, 'Pembelajaran Mesin', 3, 'Dr. rer. nat. Akmal Junaidi, S.Si., M.Sc.', 'Wajib'),
(14, 'Teknologi dan Aplikasi Mobile', 3, 'Muhaqiqin, S.Kom., M.TI.', 'Wajib'),
(15, 'Pemrograman Web', 3, 'Rizky Prabowo, M.Kom', 'Wajib'),
(16, 'Internet of Things', 3, 'Rahman Taufik, M.Kom.', 'Peminatan'),
(17, 'Manajemen Pengetahuan', 2, 'Didik Kurniawan, M.T.', 'Peminatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres`
--

CREATE TABLE `progres` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `progres`
--

INSERT INTO `progres` (`id`, `tugas_id`, `deskripsi`, `file_path`, `tanggal`) VALUES
(1, 2, 'Progres 1 - Membuat Halaman Login Karyawan', 'uploads/loginKaryawan.php', '2024-06-21 03:26:46'),
(6, 2, 'Progres 2 - Membuat Halaman Login Admin', 'uploads/loginAdmin.php', '2024-06-21 03:27:42'),
(7, 2, 'Progres 3 - Membuat Halaman Dashboard Admin', 'uploads/dashboardAdmin.php', '2024-06-21 03:30:57'),
(8, 3, 'Progres 1 - Telah dibuat halaman login dan register', 'uploads/login.html', '2024-06-21 04:03:27'),
(9, 3, 'Progres 2 - Telah dibuat fungsi kolaborasi', 'uploads/Scholarly.zip', '2024-06-21 04:04:00'),
(10, 3, 'Progres 3 - Telah dibuat fungsi pencarian dan penemuan', 'uploads/Scholarly.zip', '2024-06-21 04:04:25'),
(11, 6, 'Progres 1 - Menganalisis studi kasus, membuat dataframe', '', '2024-06-21 04:09:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_pengumpulan` date DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `google_meet_link` varchar(255) DEFAULT NULL,
  `whatsapp_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id`, `nama_tugas`, `deskripsi`, `tanggal_pengumpulan`, `github_link`, `google_meet_link`, `whatsapp_link`) VALUES
(2, 'Pemograman Web Responsi', 'Project Akhir - Membuat sistem dengan minimal 4 tabel CRUD', '2024-07-06', 'https://github.com/Indahkusumaningrum/UAP-PrakWeb-Scholarly', 'https://meet.google.com/ssh-fvoc-ndn', 'https://t.me/+d6e4VFSm5gFkOGU1'),
(3, 'Manajemen Pengetahuan', 'Membuat Knowledge Manajemen Sistem (KMS)', '2024-08-01', 'https://github.com/Indahkusumaningrum/Perpustakaan-XYZ', 'https://meet.google.com/ssh-fvoc-ndn', 'https://t.me/+d6e4VFSm5gFkOGU1'),
(4, 'Teknologi dan Aplikasi Mobile', 'Membuat aplikasi mobile sederhana', '2024-09-01', 'https://github.com/Indahkusumaningrum/UASTAM-Tiny-Bite', 'https://meet.google.com/ssh-fvoc-ndn', 'https://t.me/+d6e4VFSm5gFkOGU1'),
(6, 'Artificial Intelligence', 'Mengimplementasikan study kasus fuzzy logic yang telah diberikan ke dalam kode python', '2024-06-16', '', '', 'https://colab.research.google.com/drive/1iPxN4OU38h3f7F7MHnGkvqYvQBsB5SrL?usp=sharing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Indah', 'indahkusumaningrum345@gmail.com', '$2y$10$ce7XYOM/r1MJ3a5QaGZR9eFka5fFRJNtudhUztP9F8YNW/e4w0uWS'),
(3, 'Kusuma', '2217051139@students.unila.ac.id', '$2y$10$HUYjih.EK/gzYmyLU3jCoOytr19HIvd3HgDyvjMpJzI59WVYR5mBG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD CONSTRAINT `progres_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
