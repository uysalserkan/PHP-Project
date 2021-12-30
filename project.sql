-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Ara 2021, 12:55:54
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `apply`
--

CREATE TABLE `apply` (
  `id` int(11) NOT NULL COMMENT 'application id',
  `job_id` int(11) NOT NULL COMMENT 'job id',
  `name` varchar(255) NOT NULL COMMENT 'user name',
  `surname` varchar(255) NOT NULL COMMENT 'user surname',
  `email` varchar(255) NOT NULL COMMENT 'user email address',
  `cv_link` varchar(1024) NOT NULL,
  `applied_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'user application date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='applied jobs';

--
-- Tablo döküm verisi `apply`
--

INSERT INTO `apply` (`id`, `job_id`, `name`, `surname`, `email`, `cv_link`, `applied_date`) VALUES
(13, 1, 'Zeynep', 'Serkan', 'zs@25.com', '25.com/zs', '2021-12-30'),
(14, 1, 'Serkan', 'UYSAL', 'uysalserkan08@gmail.com', 'https://github.com/uysalserkan', '2021-12-30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `company_logo_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `apply_url` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) NOT NULL,
  `publish_date` date NOT NULL DEFAULT current_timestamp(),
  `tag` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Jobs and informations';

--
-- Tablo döküm verisi `jobs`
--

INSERT INTO `jobs` (`id`, `company`, `company_logo_url`, `title`, `description`, `apply_url`, `publisher`, `publish_date`, `tag`, `status`) VALUES
(1, 'UYS.AL a', 'https://logos-world.net/wp-content/uploads/2021/11/Meta-Symbol.png', 'Scientist 1', 'Bomboş bir description', '---', 'admin', '2021-12-15', 'scientist 2121', 1),
(2, 'UYS.AL', 'https://www.adobe.com/content/dam/cc/us/en/creativecloud/design/discover/mascot-logo-design/mascot-logo-design_fb-img_1200x800.jpg', 'Best ML Engineer 2', 'We\'re hiring a best ML engineer!! (Remote)', 'https://uys.al/hire/ml-engineer', 'admin', '2021-12-15', 'Machine Learning Engineer ', 0),
(25, 'UYS.AL', 'https://thumbs.dreamstime.com/b/vector-logos-collection-most-famous-fashion-brands-world-format-available-illustrator-ai-nike-logo-119869268.jpg', 'Best Data Scientist', 'We\'re hiring a best DATA SCIENTIST!! (Remote)', 'https://uys.al/hire/data-scientist', 'admin', '2021-12-15', 'Data Scientist', 1),
(250, 'UYS.AL', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToppz55Pdmw3ijkiuOuiOkmDZvMIxPSh6ZGg&usqp=CAU', 'Best ML Engineer', 'We\'re hiring a best ML engineer!! (Remote)', 'https://uys.al/hire/ml-engineer', 'S-UYS.AL', '2021-12-15', 'Machine Learning Engineer ', 1),
(251, 'UYS.AL', 'https://thumbs.dreamstime.com/b/vector-logos-collection-most-famous-fashion-brands-world-format-available-illustrator-ai-nike-logo-119869268.jpg', 'Scientist 2', 'best scientist ever', 'https://uys.al/hire/scientist', 'admin', '2021-12-15', 'bestie', 0),
(252, 'UYS.AL', 'https://logos-world.net/wp-content/uploads/2020/05/Fanta-Logo.png', 'Scientist 2', 'best scientist ever', 'https://uys.al/hire/scientist', 'admin', '2021-12-15', 'bestie', 1),
(253, 'UYS.AL', 'https://logos-world.net/wp-content/uploads/2020/05/Fanta-Logo.png', 'Scientist 2', 'best scientist ever', 'https://uys.al/hire/scientist', 'admin', '2021-12-15', 'bestie', 1),
(254, 'UYS.AL', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToppz55Pdmw3ijkiuOuiOkmDZvMIxPSh6ZGg&usqp=CAU', 'Scientist 2', 'best scientist ever', 'https://uys.al/hire/scientist', 'admin', '2021-12-15', 'bestie', 1),
(256, 'Bir iş', 'https://thumbs.dreamstime.com/b/apple-logo-19106337.jpg', 'Machine Learning Eng.', 'bişiler bişiler', '---', 'admin', '2021-12-30', 'ML', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `apply`
--
ALTER TABLE `apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'application id', AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
