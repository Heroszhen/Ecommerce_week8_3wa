-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 23, 2020 at 08:51 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerceweek8`
--

-- --------------------------------------------------------

--
-- Table structure for table `carte`
--

CREATE TABLE `carte` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `photo`) VALUES
(1, 'légume', '10083754155f8ded5d910e67.23748912.jpg'),
(2, 'scooter', '10083754155f8ded5d910e67.23748912.jpg'),
(3, 'arme', '10083754155f8ded5d910e67.23748912.jpg'),
(4, 'meuble', '10083754155f8ded5d910e67.23748912.jpg'),
(5, 'fruit', '10083754155f8ded5d910e67.23748912.jpg'),
(6, 'vêtement', '10083754155f8ded5d910e67.23748912.jpg'),
(7, 'jeu', '10083754155f8ded5d910e67.23748912.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`id`, `product_id`, `user_id`, `quantity`, `price`, `created`) VALUES
(1, 2, 1, 2, 388, '2020-10-22 13:53:29'),
(2, 10, 1, 10, 182, '2020-10-22 13:53:29'),
(3, 12, 1, 12, 123, '2020-10-22 13:53:29'),
(4, 4, 1, 4, 864, '2020-10-22 13:53:29'),
(5, 13, 1, 13, 110, '2020-10-22 13:53:29'),
(6, 10, 1, 10, 182, '2020-10-22 13:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `created`, `message`) VALUES
(1, 1, 1, '2020-10-22 13:53:29', 'Quod quibusdam voluptatum consectetur id eos. Perferendis eos assumenda omnis enim.'),
(2, 1, 1, '2020-10-22 13:53:29', 'Nobis et temporibus minima aut quis esse. Nisi at laudantium delectus.'),
(3, 1, 1, '2020-10-22 13:53:29', 'Quis qui dolorem corporis placeat maiores molestias. Magnam ipsam molestiae maiores omnis vitae non. In quo quisquam vel dolore ut.'),
(4, 1, 1, '2020-10-22 13:53:29', 'Molestias veritatis ut consequuntur ut et non hic. Sit distinctio optio ut laborum culpa occaecati et. Facere non nihil omnis.'),
(5, 1, 1, '2020-10-22 13:53:29', 'Nemo voluptatem sequi repellat praesentium omnis fugit voluptatem. Quae numquam error quos iusto inventore et hic. Aut sunt aut et aut omnis qui.'),
(6, 1, 1, '2020-10-22 13:53:29', 'Sint sunt pariatur assumenda aut explicabo rerum numquam. Et dolorum soluta eos ab ea et animi minus.'),
(7, 1, 1, '2020-10-22 13:53:29', 'Qui placeat inventore non rerum nulla libero officia. Nihil consequatur repellat inventore ut qui.'),
(8, 1, 1, '2020-10-22 13:53:29', 'Aperiam optio dolorum non. Porro expedita ullam unde cupiditate quisquam. Adipisci quisquam molestiae unde mollitia aut. Nobis adipisci occaecati facere quasi natus.'),
(9, 1, 1, '2020-10-22 13:53:29', 'Illo facilis provident nulla earum minima et sequi. Est exercitationem nesciunt voluptatem natus. Id magni soluta vel natus.'),
(10, 1, 1, '2020-10-22 13:53:29', 'Sed suscipit temporibus harum voluptas repellat. Quod esse sit dolores. Sit ipsa eveniet earum voluptatum. Illum consequatur minus numquam et omnis pariatur.'),
(11, 1, 1, '2020-10-22 13:53:29', 'Cupiditate qui repudiandae soluta aliquam necessitatibus omnis nam fugiat. Deleniti qui eos quasi tempore corporis ut. Rem et fugiat iste atque sed sit rerum. Est asperiores ut est deserunt.');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `product_id`, `name`, `origin`) VALUES
(1, 1, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(2, 1, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(3, 1, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(4, 1, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(5, 1, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(6, 2, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(7, 2, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(8, 2, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(9, 2, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(10, 2, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(11, 3, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(12, 3, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(13, 4, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(14, 4, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(15, 4, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(16, 4, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(17, 5, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(18, 5, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(19, 5, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(20, 5, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(21, 5, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(22, 6, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(23, 6, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(24, 6, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(25, 7, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(26, 7, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(27, 8, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(28, 8, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(29, 8, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(30, 8, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(31, 9, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(32, 9, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(33, 9, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(34, 10, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(35, 10, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(36, 11, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(37, 11, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(38, 11, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(39, 11, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(40, 11, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(41, 12, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(42, 12, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(43, 12, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(44, 13, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(45, 13, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(46, 14, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(47, 14, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(48, 14, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(49, 14, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(50, 14, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(51, 15, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(52, 15, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(53, 15, '10083754155f8ded5d910e67.23748912.jpg', NULL),
(54, 15, '10083754155f8ded5d910e67.23748912.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `stock` int(11) DEFAULT NULL,
  `origin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `description`, `stock`, `origin`, `created`) VALUES
(1, 5, 'pomme', 527, 'Culpa et qui sint vitae nostrum voluptas. Distinctio deleniti unde in rerum facere. Ratione voluptas architecto dicta occaecati totam quia et debitis. Perferendis laboriosam sed at incidunt rerum saepe aliquid. Harum beatae nostrum est deserunt. Quos est dolore fugiat et excepturi sed placeat. Quia suscipit veritatis voluptatem quam molestiae est voluptatem. Modi magnam consequuntur rerum.', 7370, 'Mozambique', '2020-10-22 13:53:29'),
(2, 5, 'orange', 388, 'Modi est eius alias perspiciatis labore maiores at. Quia eaque ipsam maiores aut quia. Vitae deleniti doloremque fugit. Ipsa at dolorem ipsa iusto et magni. Assumenda qui nostrum quaerat veniam rerum.', 691, 'Afghanistan', '2020-10-22 13:53:29'),
(3, 5, 'pasteque', 545, 'Veniam nobis ex error qui et adipisci necessitatibus. Vel eveniet molestias accusantium. Quidem dolor voluptate reiciendis in ea. In autem qui neque in. Quia minima fuga dolorem aliquid sed unde. Enim corrupti a quas est quasi sunt vitae.', 1194, 'Pérou', '2020-10-22 13:53:29'),
(4, 5, 'cerise', 864, 'Blanditiis quae et incidunt dolorem. Officiis aliquam beatae velit. Distinctio ut tempora soluta. Amet ipsum quo et ab. Maxime beatae perferendis animi facilis qui. Accusamus aliquam architecto beatae. Praesentium ea perspiciatis dicta nihil id eos voluptas dolor. Quia doloremque animi nostrum.', 1172, 'République Dominicaine', '2020-10-22 13:53:29'),
(5, 5, 'pamplemousse', 522, 'Iure et vel fugiat qui et velit. Et quaerat molestias nam maxime error labore veritatis. Unde atque et odit quos cum voluptatum in cum. Et mollitia non et magni. Et suscipit omnis quisquam id. Aut est beatae aut temporibus provident ut. Fugiat quo dignissimos consequatur aut nemo rem et enim. Ratione et minima non autem et. Quia pariatur vitae id consequatur.', 8350, 'Christmas (Île)', '2020-10-22 13:53:29'),
(6, 6, 't-short', 4, 'Aut rerum est sed debitis quia iusto maxime. Et voluptatum quos quaerat magni voluptatem fugiat. Sequi recusandae aut voluptas.', 3, 'Pologne', '2020-10-22 13:53:29'),
(7, 6, 'jean', 86, 'Mollitia nemo reprehenderit neque laboriosam consequatur. Eos corporis id quia unde. Sed enim qui voluptate soluta incidunt. Nesciunt minima ipsum aspernatur omnis autem officiis sit.', 39, 'Pérou', '2020-10-22 13:53:29'),
(8, 6, 'chapeau', 182, 'Harum nihil cumque veniam dignissimos. Vero soluta quia dolores dicta hic blanditiis. Sint et quas dolores consectetur eaque explicabo. Ut non dolor a quis sint id amet.', 141, 'Laos', '2020-10-22 13:53:29'),
(9, 6, 'manteau', 49, 'Repellendus eos possimus sunt repudiandae rerum quis omnis. Facere temporibus enim earum consequatur quis. Est id sit pariatur impedit inventore sit aut illum. Ipsam magni est sed velit officiis at.', 88, 'Togo', '2020-10-22 13:53:29'),
(10, 6, 'gants', 182, 'Omnis recusandae culpa temporibus accusamus consequatur animi ut. Culpa voluptatem sint nisi. Porro sunt est enim. Laudantium eius quod porro et.', 126, 'Grenade', '2020-10-22 13:53:29'),
(11, 7, 'warcarft', 25, 'Aut exercitationem eos totam neque aut illum. Odio aut deleniti accusantium velit neque enim officia. Nemo ex pariatur omnis quis.', 60, 'Albanie', '2020-10-22 13:53:29'),
(12, 7, 'diablo', 123, 'Modi itaque voluptatibus non similique expedita. Porro voluptas voluptatem mollitia sit. Enim rem culpa occaecati tempora eaque.', 166, 'Groenland', '2020-10-22 13:53:29'),
(13, 7, 'starcarft', 110, 'Velit architecto ab eos architecto saepe blanditiis repudiandae. Excepturi id tempora nulla sit dolorem. Quos labore quibusdam qui cumque fuga totam rem.', 32, 'Guyane', '2020-10-22 13:53:29'),
(14, 7, 'country-strik', 88, 'Sunt enim et minima molestiae sint ipsa. Laborum perspiciatis harum quia commodi et. Et iure dignissimos est occaecati placeat. Repudiandae est mollitia quia.', 166, 'Croatie', '2020-10-22 13:53:29'),
(15, 7, 'Silent Hill', 46, 'Suscipit ut minus eligendi sint. Architecto consequatur id in sit. Sunt maxime ab minima odit nostrum possimus.', 26, 'Cambodge', '2020-10-22 13:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `created`) VALUES
(1, 'zhen@gmail.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$hJy67f11H5jrIqfZdLZ08Q$gMl4LezW6kRNQe2oAddOiLPBt0p5VEOZUfwNqlsL+DQ', 'Héros', 'zhen', '2020-10-22 13:52:50'),
(2, 'oferreira@carpentier.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$QkwULHpzYLoD0CK1plVu9Q$mWjLZLIfKq/8pDSyMoeva5b3GAXpaOf6XWeejvgALrI', 'Gimenez', 'Chantal', '2020-10-22 13:52:51'),
(3, 'lucas.dacosta@tiscali.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$eo9LZIf4Rj2+fkVdTN4iBg$dnCYHQQTzYI//W7AO3SgCLfXOnccdM2/H+BeQWSelog', 'Torres', 'Dorothée', '2020-10-22 13:52:53'),
(4, 'genevieve20@wanadoo.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$KLhqL43bfKZvgxa5E50LBA$mltVaD6y2aYkHhnOXW+RcS1J4uA0xruhBVqsMeWw1AM', 'Blin', 'Jean', '2020-10-22 13:52:54'),
(5, 'kremy@delattre.net', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$JbnSLgs9KmJF5SfoaTCv+w$oHeAPErL97f2H879T75EveCUOhtzyijpi03uvY2fFFc', 'Menard', 'Thérèse', '2020-10-22 13:52:55'),
(6, 'denise48@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$fgGb1a0OAB1VMaXMcbxP/w$Lj/n5c2DFibfmwbmaBO041qKbsWyS868TTsNUjRLbUU', 'Maurice', 'Adrienne', '2020-10-22 13:52:56'),
(7, 'guillaume07@vallet.org', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Jg8mXvL5tJGMH7cEqfW4Ng$7ufkdvNtHpGhD2botaN5IbInqMPEAcbldmyJy8yAOO8', 'Bernier', 'Charles', '2020-10-22 13:52:58'),
(8, 'hoarau.alexandre@evrard.org', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$nrFFF7+1UXLviFxgyLVElw$YKDG1ipbuVKNlv5cWRJv47Z1kVuwjGuqALr8s/V/8tU', 'Georges', 'Gérard', '2020-10-22 13:52:59'),
(9, 'patricia.lejeune@toussaint.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$31XcxbA8brkVco1uwya8Iw$z2cnKpBi4nV3Ag0Gkl25oXOZSWEnBDAdk/ZafPdFLcg', 'Benard', 'Stéphane', '2020-10-22 13:53:00'),
(10, 'henriette57@allain.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$jNXmK3rSJOV0vhxEO7wRIw$HIkMhvrEH4UuA5XgZcqEcoVqrcLQyn2AIO2ZGPLRO5s', 'Paul', 'Charles', '2020-10-22 13:53:02'),
(11, 'henri.rodrigues@pierre.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$xr3qqKaXDmw1yMly5B3ftA$1OdlPvtvYLbm5Sf8Qd1DD+j8O75ws8mKB42PjV2fgI4', 'Texier', 'Sylvie', '2020-10-22 13:53:03'),
(12, 'diaz.philippine@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$fguZbE8O06BQDtgqvdweWQ$jG45p7rIwz6sJSDAty3//djb+phY6VKqri81r64AIIc', 'Dufour', 'Thomas', '2020-10-22 13:53:04'),
(13, 'jvoisin@blanchet.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$kWDb0/1u8NSKAJ44SCJkRg$sR6Hj1qc+rMRO2CXARNSv+IFrTXj9FMPs+vl0JlQAkU', 'Mathieu', 'Philippine', '2020-10-22 13:53:05'),
(14, 'emmanuelle31@dupuy.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$aBdC2Vqqs3FNcHLdC5G6Ww$HbQi6A8Iwk7SoRRLfjbEGVhPgbR5uD7hQ1qu3V0C5r8', 'Guilbert', 'Adèle', '2020-10-22 13:53:07'),
(15, 'ines.perrot@yahoo.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$orb9EG6Y1YxA7Fmt2+svEQ$hTYI+4BH8iDnvifgBtgAu3NZiRNayUDBZSNYC0kxnVk', 'Ollivier', 'Gilbert', '2020-10-22 13:53:08'),
(16, 'alves.capucine@ifrance.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$s0xHOyM/fSX2g/93R/k6tA$yS864IYN7TTFu/uWmlLl0VZs00lheNpQkqqSMLYN1mY', 'Leger', 'Jules', '2020-10-22 13:53:09'),
(17, 'clemence82@noel.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$DXe2N2OwbXxmgurGVHILWg$7rb6VMgLwemnFDMC6ZXU4U/GKCXvKv8k6y3kE4skAeE', 'Duval', 'Pierre', '2020-10-22 13:53:11'),
(18, 'martel.adele@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ouw8h1j0MJ9lhpRA+DThZA$tsyxqPRbf59XkdjF7NdTE19D+W7GWi/GY6bD2nHDmEg', 'Allain', 'Anouk', '2020-10-22 13:53:12'),
(19, 'collin.luc@noos.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$+tNTUdV6EGX3FJPc9ZenEg$FeANF0THB9D+zt4DV0yYuLsdud0idavMGbNPG/1Cs2Q', 'Regnier', 'Thibault', '2020-10-22 13:53:13'),
(20, 'benoit75@toussaint.net', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$9wUbmEiZ2b7fJJWaD0unxw$SaBvKupMqFP/AgKmVLDi0bahYNfHf8ho1KVV9Xg20V4', 'Rousset', 'Marcel', '2020-10-22 13:53:14'),
(21, 'oceane.langlois@delannoy.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$LC7IsifEzlF6zIIsvisktQ$nZlv/blmqEoGdErxNDZweBq8P6j15jPo41ShDvLbhOI', 'Cordier', 'Denise', '2020-10-22 13:53:16'),
(22, 'robert.guilbert@poulain.org', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$xyeh7knUlrDAmbnvjqHO+w$Xwqni70+QKwsLqm1QRyVFlpmwAZ3E7mTAWR0AGf6FL8', 'Poulain', 'Thibault', '2020-10-22 13:53:17'),
(23, 'qlemaire@lamy.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$0Bikmwat3WYsxKLJQVcOaA$MH5991gAv3XhAnfIcHCd8E35jFiqC6TWtlxB9wMokCA', 'Boulay', 'Claude', '2020-10-22 13:53:18'),
(24, 'alves.claudine@levy.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$KcvF46U2STCr6UZtC2rgjQ$CV5WmGuaZQG/584PFpTbxN4OPPNEsvHnNIxZaUYiJWA', 'Levy', 'Émilie', '2020-10-22 13:53:19'),
(25, 'corinne92@jacquet.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$zlabXWX2O0PGqvE80loiJw$639wqVPEUZHl55hllIcfIpMJW4vDnyVvE57z2i+7uS4', 'Petit', 'Timothée', '2020-10-22 13:53:21'),
(26, 'rodrigues.gilles@sfr.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ziroKqPRMLzI/ShUTgcNHQ$UiMxIY+uPaGVzTdpiPSJfHfCFcl+CD7DrUrQ8wTEaIA', 'Maury', 'Émilie', '2020-10-22 13:53:22'),
(27, 'michele.poirier@hotmail.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$aLw/8CUQ8lrZBe2yJidYsw$WkyNbDYXMDY+0bepolfxDbvbc/T6uUkDFwWBR2qhWmQ', 'Dupre', 'Denis', '2020-10-22 13:53:23'),
(28, 'alex.chauvet@ifrance.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$xYU+pOGvg7EpfqzrAiQRIg$6CmbyLtcazv422yyy5KpDPuC9QMI8Cvu84hIYI4BTwc', 'Deschamps', 'Alex', '2020-10-22 13:53:24'),
(29, 'frederique.francois@arnaud.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$1/Vs9Gw/pa/d9rqv7X3iTg$qU0pH4bJE1dPsmlUlaC9wuY5tF8tvYMnfKEBuxaQFw0', 'Moulin', 'Arthur', '2020-10-22 13:53:26'),
(30, 'xavier68@lebrun.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$upGmxP8Qfsad6m6n3WyWSw$I5gDpGXeB8/HlseqBBZco1W+2xVL6uq6euR9Tdec2rE', 'Nicolas', 'Chantal', '2020-10-22 13:53:27'),
(31, 'jules.dacosta@gaudin.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$OSh8LttYyV24ove3NuLMyQ$NMvV49F+C7O6iyiWVR/KNz+h9jpODQ8KL4Az2b6Y63Q', 'Meunier', 'Maggie', '2020-10-22 13:53:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BAD4FFFDA76ED395` (`user_id`),
  ADD KEY `IDX_BAD4FFFD4584665A` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8ECAEAD44584665A` (`product_id`),
  ADD KEY `IDX_8ECAEAD4A76ED395` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`),
  ADD KEY `IDX_9474526C4584665A` (`product_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_14B784184584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carte`
--
ALTER TABLE `carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `FK_BAD4FFFD4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_BAD4FFFDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `FK_8ECAEAD44584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_8ECAEAD4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B784184584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
