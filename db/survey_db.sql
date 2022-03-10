-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2021 pada 15.20
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_survey`
--

CREATE TABLE `detail_survey` (
  `id` int(11) NOT NULL,
  `survey_pertanyaan` text NOT NULL,
  `survey_opsi` text NOT NULL,
  `survey_siswa` text NOT NULL,
  `survey_induk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_survey`
--

INSERT INTO `detail_survey` (`id`, `survey_pertanyaan`, `survey_opsi`, `survey_siswa`, `survey_induk`) VALUES
(1, '5', '5', '30-10-2021-03-12-31', '2'),
(2, '5', '5', '30-10-2021-05-29-49', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `ket` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `judul`, `ket`, `gambar`) VALUES
(1, 'Slide 1', 'keterangan slide 1', '29-10-2021-21-11-46slide.jpg'),
(2, 'Slide 2', 'Keterangan Slide 2', '29-10-2021-21-12-07slide.jpg'),
(3, 'Slide 3', 'keterangan slide 3', '29-10-2021-21-12-23slide.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_induk`
--

CREATE TABLE `survey_induk` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `ket` text NOT NULL,
  `gambar` text NOT NULL,
  `kategori_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `survey_induk`
--

INSERT INTO `survey_induk` (`id`, `judul`, `ket`, `gambar`, `kategori_id`) VALUES
(2, 'Survey 2', 'keterangan survey kesatu', '29-10-2021-22-18-04ga7.PNG', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_kategori`
--

CREATE TABLE `survey_kategori` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `survey_kategori`
--

INSERT INTO `survey_kategori` (`id`, `nama`) VALUES
(2, 'Kategori satu'),
(3, 'Kategori dua');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_opsi`
--

CREATE TABLE `survey_opsi` (
  `id` int(11) NOT NULL,
  `survey_pertanyaan` text NOT NULL,
  `opsi` text NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `survey_opsi`
--

INSERT INTO `survey_opsi` (`id`, `survey_pertanyaan`, `opsi`, `nilai`) VALUES
(5, '5', 'Udin', '20'),
(6, '5', 'Angga', '50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_pertanyaan`
--

CREATE TABLE `survey_pertanyaan` (
  `id` int(11) NOT NULL,
  `survey_induk` text NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `survey_pertanyaan`
--

INSERT INTO `survey_pertanyaan` (`id`, `survey_induk`, `pertanyaan`) VALUES
(2, '1', 'Siapa nama kamu?'),
(4, '3', 'dimana saya tinggal?\r\n'),
(5, '2', 'Siapa nama saya?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `nama` text NOT NULL,
  `role` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nama`, `role`, `status`) VALUES
(1, 'admin@web.com', 'admin123', 'Admin Sanjaya', 'admin', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_survey`
--

CREATE TABLE `user_survey` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `kelas` text NOT NULL,
  `survey_induk` text NOT NULL,
  `tanggal` text NOT NULL,
  `identitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_survey`
--

INSERT INTO `user_survey` (`id`, `nama`, `kelas`, `survey_induk`, `tanggal`, `identitas`) VALUES
(5, 'Uci', '9', '2', '30-10-2021-05-29-49', '30-10-2021-05-29-49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `ket` text NOT NULL,
  `link` text NOT NULL,
  `kategori_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id`, `judul`, `ket`, `link`, `kategori_id`) VALUES
(1, 'Cara Belajar Integral', 'Berikut video tutorial belajar soal-soal integral', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_kategori`
--

CREATE TABLE `video_kategori` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `video_kategori`
--

INSERT INTO `video_kategori` (`id`, `nama`) VALUES
(2, 'Fisika'),
(3, 'Kimia'),
(4, 'Matematika');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_survey`
--
ALTER TABLE `detail_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_induk`
--
ALTER TABLE `survey_induk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_kategori`
--
ALTER TABLE `survey_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_opsi`
--
ALTER TABLE `survey_opsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_pertanyaan`
--
ALTER TABLE `survey_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_survey`
--
ALTER TABLE `user_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `video_kategori`
--
ALTER TABLE `video_kategori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_survey`
--
ALTER TABLE `detail_survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `survey_induk`
--
ALTER TABLE `survey_induk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `survey_kategori`
--
ALTER TABLE `survey_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `survey_opsi`
--
ALTER TABLE `survey_opsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `survey_pertanyaan`
--
ALTER TABLE `survey_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_survey`
--
ALTER TABLE `user_survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `video_kategori`
--
ALTER TABLE `video_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
