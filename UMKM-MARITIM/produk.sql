-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 08:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_imk_tes`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `deskripsi`, `gambar`) VALUES
(1, 'Kerupuk Atom', 15000, 'Kerupuk renyah yang dibuat dari ikan laut segar, seperti tenggiri atau kakap, dipadukan dengan bumbu khas untuk menghasilkan rasa gurih yang lezat. Cocok sebagai camilan atau pelengkap hidangan.', 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/Kerupuk_Atom.png'),
(2, 'Otak-Otak', 10000, 'Olahan ikan yang dibungkus dengan daun pisang dan dipanggang, menghasilkan cita rasa khas yang gurih dan lezat. Cocok dinikmati dengan sambal kacang atau saus spesial.', 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/otak-otak.png'),
(3, 'Abon Ikan', 12000, 'Dibuat dari ikan segar pilihan, abon ikan kami menghadirkan cita rasa gurih khas laut yang cocok untuk lauk, taburan nasi, atau camilan. Praktis, tahan lama, dan kaya protein – solusi lezat dan sehat untuk setiap hidangan!', 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/Abon.png'),
(4, 'Kerupuk Rumput Laut', 10000, 'Nikmati sensasi renyah dan gurihnya Keripik Rumput Laut , camilan sehat yang diolah dari rumput laut pilihan segar langsung dari lautan Indonesia. Dengan proses pengolahan yang higienis dan tanpa bahan pengawet, keripik ini kaya akan nutrisi seperti serat, vitamin, dan mineral alami yang baik untuk tubuh.', 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/Keripik_rumput_laut.png'),
(5, 'Kepiting goreng', 12000, '\nDDibuat dari kepiting segar pilihan, Kepiting Goreng kami menyajikan cita rasa gurih dan renyah yang menggoda selera. Dibalut bumbu rempah khas, setiap gigitannya menghadirkan kenikmatan laut yang autentik. Cocok disantap sebagai lauk istimewa, menu jamuan, atau camilan mewah. Praktis, lezat, dan penuh gizi – sempurna untuk pecinta seafood sejati!', 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/Kepiting_goreng.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
