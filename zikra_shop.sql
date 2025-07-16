-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for zikra_shop
CREATE DATABASE IF NOT EXISTS `zikra_shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `zikra_shop`;

-- Dumping structure for table zikra_shop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table zikra_shop.admin: ~2 rows (approximately)
INSERT INTO `admin` (`id`, `username`, `password`) VALUES
	(3, 'admin', 'admin123'),
	(4, 'admin', 'admin123');

-- Dumping structure for table zikra_shop.kontak
CREATE TABLE IF NOT EXISTS `kontak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zikra_shop.kontak: ~0 rows (approximately)
INSERT INTO `kontak` (`id`, `nama`, `email`, `pesan`, `tanggal`) VALUES
	(1, 'firsila zikra irwani', 'firsila@gmail.com', 'toko ini sangat bagus', '2025-05-24 21:33:37'),
	(2, 'isan', 'isan@gmail.com', 'tokonya luar biasa', '2025-06-19 22:51:30'),
	(3, 'niaa', 'nia@gmail.com', 'saya suka belanja disini karena pemiliknya sangat ramah', '2025-06-20 12:51:34');

-- Dumping structure for table zikra_shop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int DEFAULT NULL,
  `alamat` text,
  `metode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zikra_shop.orders: ~22 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `tanggal`, `total`, `alamat`, `metode`) VALUES
	(1, 6, '2025-05-21 07:02:48', 233000, 'padang', 'COD'),
	(12, 6, '2025-05-21 07:03:54', 155000, 'bali', 'DANA'),
	(13, 6, '2025-05-21 07:05:09', 133000, 'jakarta', 'Transfer Bank'),
	(14, 6, '2025-05-21 07:06:01', 100000, 'korea', 'COD'),
	(15, 6, '2025-05-23 17:22:47', 288000, 'lubus', 'ShopeePay'),
	(16, 6, '2025-05-24 14:21:45', 695000, 'bali', 'OVO'),
	(17, 6, '2025-05-31 03:48:16', 138000, 'jambi', 'ShopeePay'),
	(18, 6, '2025-05-31 05:01:23', 923000, 'bukittinggi', 'DANA'),
	(19, 8, '2025-05-31 05:09:08', 138000, 'pesisir', 'COD'),
	(20, 8, '2025-05-31 05:17:49', 499000, 'cirebon', 'Transfer Bank'),
	(21, 9, '2025-05-31 05:39:34', 515000, 'jaksel', 'Transfer Bank'),
	(22, 6, '2025-06-01 12:10:06', 824000, 'korea selatan', 'ShopeePay'),
	(23, 6, '2025-06-01 12:14:15', 155000, 'bandung', 'DANA'),
	(24, 10, '2025-06-01 16:11:26', 288000, 'sungai penuh', 'Transfer Bank'),
	(25, 11, '2025-06-18 06:45:18', 4371000, 'tabing', 'ShopeePay'),
	(26, 7, '2025-06-20 04:42:43', 138000, 'lubuk basung', 'DANA'),
	(27, 7, '2025-06-20 04:46:19', 227000, 'bali', 'OVO'),
	(28, 7, '2025-06-20 04:47:42', 537000, 'jepang', 'ShopeePay'),
	(29, 7, '2025-06-20 04:48:18', 6135000, 'jakarta', 'DANA'),
	(30, 7, '2025-06-20 05:31:30', 155000, 'bali', 'COD'),
	(31, 7, '2025-06-20 05:36:16', 2990000, 'bali', 'ShopeePay'),
	(32, 7, '2025-06-20 05:38:19', 227000, 'lubus', 'DANA'),
	(33, 7, '2025-06-20 05:39:47', 5980000, 'cirebon', 'Transfer Bank'),
	(34, 12, '2025-06-20 05:47:31', 3547000, 'amerika serikat', 'COD'),
	(35, 13, '2025-06-25 06:41:09', 3969000, 'inggris', 'COD'),
	(36, 13, '2025-06-25 06:42:42', 520000, 'paris', 'Transfer Bank'),
	(37, 6, '2025-07-05 14:17:28', 499000, 'lubuk basung', 'ShopeePay'),
	(38, 14, '2025-07-16 08:21:43', 9049000, 'daegu, korea selatan', 'COD');

-- Dumping structure for table zikra_shop.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zikra_shop.order_details: ~47 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `produk_id`, `qty`, `harga`) VALUES
	(13, 1, 1, 1, 100000),
	(14, 1, 3, 1, 133000),
	(15, 12, 2, 1, 155000),
	(16, 13, 3, 1, 133000),
	(17, 14, 1, 1, 100000),
	(18, 15, 2, 1, 155000),
	(19, 15, 3, 1, 133000),
	(20, 16, 6, 1, 138000),
	(21, 16, 5, 1, 557000),
	(22, 17, 6, 1, 138000),
	(23, 18, 4, 1, 228000),
	(24, 18, 6, 1, 138000),
	(25, 18, 5, 1, 557000),
	(26, 19, 6, 1, 138000),
	(27, 20, 6, 1, 138000),
	(28, 20, 3, 1, 133000),
	(29, 20, 4, 1, 228000),
	(30, 21, 3, 1, 133000),
	(31, 21, 2, 1, 155000),
	(32, 21, 1, 1, 227000),
	(33, 22, 7, 1, 267000),
	(34, 22, 5, 1, 557000),
	(35, 23, 2, 1, 155000),
	(36, 24, 3, 1, 133000),
	(37, 24, 2, 1, 155000),
	(38, 25, 7, 1, 267000),
	(39, 25, 5, 2, 557000),
	(40, 25, 8, 1, 2990000),
	(41, 26, 6, 1, 138000),
	(42, 27, 1, 1, 227000),
	(43, 28, 1, 1, 227000),
	(44, 28, 2, 2, 155000),
	(45, 29, 2, 1, 155000),
	(46, 29, 8, 2, 2990000),
	(47, 30, 2, 1, 155000),
	(48, 31, 8, 1, 2990000),
	(49, 32, 1, 1, 227000),
	(50, 33, 8, 2, 2990000),
	(51, 34, 8, 1, 2990000),
	(52, 34, 5, 1, 557000),
	(53, 35, 8, 1, 2990000),
	(54, 35, 5, 1, 557000),
	(55, 35, 2, 1, 155000),
	(56, 35, 7, 1, 267000),
	(57, 36, 1, 1, 227000),
	(58, 36, 6, 1, 138000),
	(59, 36, 2, 1, 155000),
	(60, 37, 2, 1, 499000),
	(61, 38, 19, 1, 550000),
	(62, 38, 20, 1, 799000),
	(63, 38, 13, 1, 1200000),
	(64, 38, 16, 1, 5000000),
	(65, 38, 11, 1, 1500000);

-- Dumping structure for table zikra_shop.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zikra_shop.produk: ~10 rows (approximately)
INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `deskripsi`, `stok`) VALUES
	(1, 'Celana Jeans Kulot Loose High Waist', 634000, 'gambar8.jpg', 'Deskripsi Produk: Denim Jeans Pria/Wanita\r\nTampil Kasual dan Stylish dengan Denim Jeans Terbaik!\r\nJeans denim ini dirancang untuk kamu yang ingin tampil trendi tanpa mengorbankan kenyamanan. Terbuat dari bahan denim berkualitas tinggi yang kuat namun tetap lentur, celana ini cocok digunakan untuk aktivitas harian, hangout, hingga semi-formal.', 18),
	(2, 'Cardigan Rajut Merah Marun dengan Detail Renda', 499000, 'gambar7.jpg', 'Deskripsi Produk: Cardigan Rajut Stylish & Nyaman\r\nLengkapi Gayamu dengan Cardigan Rajut Kekinian!\r\nCardigan rajut ini adalah pilihan sempurna untuk kamu yang ingin tampil modis, hangat, dan tetap nyaman di segala suasana. Desain simpel namun elegan membuatnya mudah dipadukan dengan berbagai outfit, mulai dari kasual hingga semi-formal.\r\n', 3),
	(3, 'Celana Pants High Waist Two-Tone', 256000, 'gambar5.jpg', 'Deskripsi Produk: Celana Pants Wanita – Nyaman, Stylish & Serbaguna\r\nTampil percaya diri setiap hari dengan Celana Pants yang pas di badan dan cocok untuk segala suasana!\r\nCelana pants ini didesain untuk kamu yang aktif dan ingin tetap tampil rapi tanpa mengorbankan kenyamanan. Terbuat dari bahan berkualitas tinggi yang ringan dan fleksibel, cocok digunakan untuk ke kantor, hangout, atau aktivitas sehari-hari.', 76),
	(4, 'Korean Style Formal Dress', 1899000, 'gambar1.jpg', 'Deskripsi Produk: Elegant Casual Dress\r\nTampil Cantik & Anggun Setiap Saat\r\nTunjukkan pesona dan keanggunanmu dengan Casual Dress yang dirancang khusus untuk menambah kesan feminim dan stylish. Dress ini cocok dipakai untuk acara santai, kerja, hingga hangout bareng teman!\r\n', 15),
	(5, 'Elegant Wool Winter Coat', 1479000, 'gambar3.jpg', 'Deskripsi Produk: Mantel Salju Pria/Wanita\r\nHangat dan Stylish Melawan Dingin dengan Mantel Salju Premium!\r\nMantel salju ini dirancang khusus untuk kamu yang ingin tetap hangat dan tampil keren saat musim dingin. Terbuat dari bahan tahan air dan windproof berkualitas tinggi, mantel ini menjaga tubuh tetap kering dan terlindungi dari angin dingin dan salju. Dengan desain modern dan fit yang nyaman, mantel ini cocok dipakai untuk aktivitas outdoor maupun sehari-hari.\r\n', 3),
	(6, 'StripeLine Pants', 250000, '1748095849_e5539e421d.jpg', 'Deskripsi Produk: StripeLine Pants\r\nTampil Trendy dan Nyaman dengan Celana Garis-Garis Kekinian!\r\nCelana StripeLine dirancang untuk kamu yang suka tampil beda namun tetap mengutamakan kenyamanan. Dengan motif garis vertikal yang memberi kesan ramping dan tinggi, celana ini cocok untuk berbagai suasana — mulai dari santai hingga semi-formal. Bahannya lembut dan ringan, membuat kamu bebas bergerak sepanjang hari.\r\n', 54),
	(7, 'Outer Pink', 399000, 'gambar6.jpg', 'Deskripsi Produk - Outer Pink\r\nTambahkan sentuhan feminim dalam gayamu dengan outer ini – nyaman, cantik, dan effortless!\r\nTampil modis dan feminin dengan Outer Pink yang elegan ini. Terbuat dari bahan katun premium yang ringan dan nyaman dipakai sepanjang hari. Desainnya yang simple namun stylish sangat cocok dipadukan dengan berbagai outfit, baik untuk acara santai maupun formal.', 7),
	(8, 'Gaun Ruffle One Shoulder Cream', 3999000, 'gambar9.jpg', 'Deskripsi Produk - Gaun Ruffle One Shoulder Cream\r\nDengan tampilan berlapis yang dramatis dan siluet anggun, gaun ini akan menjadikan siapa pun pusat perhatian dalam setiap momen istimewa.\r\nTampil anggun dan memikat dalam Gaun Ruffle One Shoulder berwarna cream elegan ini. Didesain dengan potongan satu bahu (one shoulder) yang unik dan aksen layer ruffle bertingkat, gaun ini menghadirkan kesan mewah dan romantis dalam satu balutan.', 2),
	(9, 'Rok Midi A-Line Kancing Depan', 149999, '1752391009_71e8756a1c.jpeg', 'Tampil anggun dan feminin dengan rok midi A-line ini yang hadir dalam warna mint yang lembut dan menenangkan. Desainnya yang simpel namun elegan menampilkan potongan A-line yang mengalir indah, cocok untuk berbagai bentuk tubuh. Bagian depan rok dilengkapi dengan deretan kancing berlapis kain senada yang memberikan sentuhan klasik.\r\n\r\nSabuk hitam dengan buckle segitiga metalik memberikan aksen modern yang kontras, menonjolkan garis pinggang dan menambah karakter pada keseluruhan tampilan. Terbuat dari bahan berkualitas yang ringan dan nyaman dipakai, rok ini sempurna untuk gaya kasual maupun semi-formal.', 53),
	(10, 'Celana Jeans Highwaist Kulot Wanita', 467000, '1752391206_00d11ad67d.jpeg', 'Tampil bold dan stylish dengan celana kulot jeans highwaist ini! Desain baggy loose cut yang lebar memberikan kesan retro yang sedang tren, terinspirasi dari gaya Korean street style. Celana ini hadir dengan aksen faded wash di bagian depan, menambah kesan vintage dan edgy.\r\n\r\nBagian pinggang highwaist dengan kancing dan karet elastis di belakang menjamin kenyamanan maksimal sekaligus menonjolkan bentuk pinggang. Cocok dipadukan dengan atasan crop, oversized tee, atau jaket denim untuk look kasual yang standout.\r\n\r\n', 21),
	(11, 'Dress Midi Lengan Puff Warna Soft Pink', 1500000, '1752391416_6ef5e55e27.jpeg', 'Tampilkan sisi anggunmu dengan dress midi berkerah V ini, didesain dengan sentuhan klasik dan feminin. Warna soft pink yang lembut memberikan kesan manis dan elegan, cocok dikenakan untuk acara formal maupun santai.\r\n\r\nModel lengan pendek puff sleeve memberi kesan vintage yang modis, sementara potongan fit & flare dengan aksen belt di pinggang membantu membentuk siluet tubuh yang ramping dan proporsional. Kancing depan full memberikan detail klasik yang mempermanis tampilan.\r\n\r\n', 8),
	(12, 'Rok Ruffle Asimetris Warna Putih', 200000, '1752391513_f78aa33a55.jpeg', 'Tampil memesona dengan rok ruffle asimetris berwarna putih ini yang memancarkan pesona feminim dan playful. Didesain dengan potongan layer bertingkat dan detail kerut di pinggang, rok ini memberikan efek mengembang yang elegan saat bergerak.\r\n\r\nModelnya high-low hemline (bagian depan lebih pendek) memberi sentuhan dinamis dan menonjolkan bentuk kaki dengan anggun. Cocok untuk dipadukan dengan blouse atau crop top favoritmu untuk tampilan kasual manis atau semi-formal stylish.\r\n\r\n', 42),
	(13, 'Cardigan Rajut Cape Vintage', 1200000, '1752649321_552a93b93c.jpeg', 'Tampil anggun dan hangat dengan cape cardigan rajut bergaya vintage ini. Dibalut warna beige lembut dengan motif rajut klasik, item ini hadir dengan sentuhan romantis ala Sweet Lolita Jepang.\r\n\r\nDetail kerah bulu putih yang fluffy, pita coklat manis di bagian leher, serta renda halus di sekitar tepian menambah nuansa feminin yang elegan. Potongannya model cape (jubah melebar) yang memberikan siluet flowy dan cozy, cocok untuk cuaca dingin atau sekadar tampil chic.', 77),
	(14, 'Blouse Stripe Peplum Wanita', 350000, '1752649398_b11fa53dec.jpeg', 'Tampil chic dan elegan dengan blouse peplum bergaris vertikal ini! Kombinasi motif stripe biru-putih memberi kesan fresh dan klasik, sementara potongan fit di bagian pinggang dan lipit bawah model peplum menonjolkan siluet tubuh agar tampak ramping dan anggun.\r\n\r\nDidesain dengan kerah kemeja dan kancing depan, blouse ini cocok untuk gaya kasual rapi maupun formal santai. Cocok dipadukan dengan celana bahan, rok A-line, atau jeans untuk look profesional maupun semi-formal.', 89),
	(15, 'Cardigan Rajut Renda Vintage', 400000, '1752649551_fb77d2e029.jpeg', 'Lengkapi gayamu dengan cardigan rajut yang feminin dan klasik ini. Hadir dalam warna soft pink yang lembut, cardigan ini menampilkan motif rajut berpola berlian dan kabel twist, dihiasi dengan aksen renda bunga putih transparan dan layer ruffle di bagian bawah yang memberikan nuansa vintage dan girly yang khas.\r\n\r\nPotongan longgar dan bahan rajut yang lembut membuat cardigan ini nyaman digunakan sepanjang hari, cocok untuk gaya santai maupun acara spesial dengan nuansa manis dan anggun.', 143),
	(16, 'Dress Tweed Lengan Pendek Biru Muda', 5000000, '1752651328_8d83ba86e7.jpeg', 'Tampil classy dan berkarakter dengan dress tweed berwarna biru muda ini. Terinspirasi dari gaya preppy yang chic, dress ini hadir dengan desain kemeja lengan cap, kancing emas berornamen, dan kerah klasik yang memberi kesan mewah namun tetap girly.\r\n\r\nBagian bawah dress memiliki detail rok lipit (pleats) yang menambah volume dan kesan dinamis, sementara belt senada di pinggang membantu membentuk siluet tubuh lebih ramping. Sangat cocok untuk kamu yang ingin tampil rapi dan fashionable di acara semi-formal atau hangout elegan.', 21),
	(17, 'Rok Mini Hitam Asimetris dengan Belt', 499000, '1752651395_20c6d8dfb9.jpeg', 'Tampil edgy dan elegan dengan rok mini asimetris berwarna hitam ini. Potongannya yang unik dengan detail lipatan silang (wrap effect) memberikan kesan modern dan dinamis. Dilengkapi dengan belt metal ring yang stylish, rok ini mampu mempertegas siluet pinggang dan menambah statement pada outfit-mu.\r\n\r\nWarna hitam netral membuatnya mudah dipadupadankan dengan berbagai atasan, cocok untuk gaya formal, semi-formal, hingga kasual chic.', 75),
	(18, 'Celana Panjang High Waist Two-Tone', 223000, '1752651460_f3d282dc2e.jpeg', 'Tampil beda dan berani dengan celana high waist two-tone ini! Desainnya yang unik menampilkan pinggang kontras warna putih berbentuk V terbalik, memberi ilusi pinggang lebih ramping dan efek visual yang menarik.\r\n\r\nPotongan wide-leg menjadikan celana ini nyaman sekaligus trendi untuk berbagai kesempatan – dari gaya kasual chic, ke kantor, sampai hangout stylish.', 157),
	(19, 'Shorts High Waist Cream dengan Ikat Pinggang', 550000, '1752651526_989c2b20e0.jpeg', 'Tampil chic dan effortless dengan short pants high waist berwarna cream ini. Potongannya yang mengembang ringan di bagian kaki memberikan kesan anggun dan tidak ketat, ideal untuk kenyamanan sehari-hari. Dilengkapi dengan belt serut senada yang bisa diikat sesuai gaya, menjadikan celana ini fleksibel untuk berbagai tampilan.\r\n\r\nWarna cream yang netral membuat celana ini mudah dipadukan dengan atasan apapun — cocok untuk gaya kasual santai hingga semi-formal minimalis.', 44),
	(20, 'Lightweight Fashion Jacket', 799000, '1752653963_b3897de929.jpeg', 'Tampil kece dan tetap nyaman dengan jaket wanita kekinian ini. Didesain untuk gaya kasual hingga semi-formal, jaket ini hadir dengan potongan yang modis dan bahan yang ringan namun tetap hangat. Cocok dipadukan dengan celana jeans, rok, atau dress untuk tampilan harian yang effortless.', 66);

-- Dumping structure for table zikra_shop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zikra_shop.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(6, 'zikra', '$2y$10$pKTonIaZKYE2Hwoqx4MDW.Y8tPWhvjb9lDiN7lsxTtZHaEhigCzNC', 'user'),
	(7, 'admin', '$2y$10$GD0dCR0yahc8RRBlcan7TuHO8r0iIXnuaTDBCsExVJhqmWdSRD7na', 'admin'),
	(8, 'piaa', '$2y$10$uEFC9LG3UOgYw8QBgmr/le/H2W/BnuA2VREDFwGjTC.MCJpd4PXHu', 'user'),
	(9, 'nadiya', '$2y$10$SQV8QRc31h0YjarTQtnBluJxStOX/nXA0/uJ6IiRRVRd6ftHzCz3i', 'user'),
	(10, 'isan', '$2y$10$mgofAn2LEY0kuByQWViCPuge8C6xt/lHBzrNz50vRkhYkEwCOg1Tq', 'user'),
	(11, 'aldo', '$2y$10$KtQ8Jb9MgkCazYzmj97lj.nRWfWUfp4nFPhaMyoryScew3qMBe0xm', 'user'),
	(12, 'niaa', '$2y$10$4gnlzDHDP2YQROuR7so4hOCkCFTUyxJ1z8pdcE2ZG3ouQjmNPKa1e', 'user'),
	(13, 'upiak bele', '$2y$10$68sfvnFqwP35eFunrZvM1OgY3oAsDPM0mBBwFD8BmXRD1eajR9HA2', 'user'),
	(14, 'jungkook', '$2y$10$11id1ARg34o0pGIJHU.YBO3/OmltWtYhKQ3jNEgGwqDD8xktg/xN6', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
