-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 mars 2023 à 11:47
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kanabedb`
--

-- --------------------------------------------------------

--
-- Structure de la table `account_types`
--

CREATE TABLE `account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `classification_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `created_at`, `updated_at`, `classification_number`, `range`) VALUES
(1, 'Comptes de Ressources Durables', '2023-01-06 15:24:42', '2023-01-13 11:19:42', '06-2023-88', '10-19'),
(2, 'Comptes de tiers', '2023-01-06 15:41:19', '2023-01-13 11:24:15', '06-2023-81', '40-49'),
(3, 'Comptes de Stock', '2023-01-06 15:41:35', '2023-01-13 11:36:22', '06-2023-64', '30-39'),
(4, 'Comptes de Charges des Activités Ordinaires', '2023-01-06 15:41:50', '2023-01-13 11:26:07', '06-2023-69', '60-69'),
(7, 'Compte de Trésorerie', '2023-01-06 15:46:51', '2023-01-13 11:29:07', '06-2023-81', '50-59'),
(8, 'Comptes de Produits des Activités Ordinaires', '2023-01-06 15:56:26', '2023-01-13 11:27:30', '06-2023-62', '70-79'),
(11, 'Comptes d\'Activf Immobilisé', '2023-01-13 11:37:41', '2023-01-13 11:37:41', '13-2023-46', '20-29');

-- --------------------------------------------------------

--
-- Structure de la table `autre_recettes`
--

CREATE TABLE `autre_recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recette_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_recette_id` bigint(20) UNSIGNED DEFAULT NULL,
  `montant` double(8,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `autre_recettes`
--

INSERT INTO `autre_recettes` (`id`, `recette_number`, `type_recette_id`, `montant`, `description`, `date_creation`, `mois`, `annee`, `created_at`, `updated_at`) VALUES
(1, '22-68788', 2, 300.00, 'Frais de stage professionnel', '22-02-2023', 'Feb', '2023', '2023-02-22 10:18:53', '2023-02-22 10:50:27'),
(6, '3295-03-48', NULL, 12.00, 'School Fees', '08-03-2023', 'Mar', '2023', '2023-03-08 10:12:51', '2023-03-08 10:28:36');

-- --------------------------------------------------------

--
-- Structure de la table `bilan_classements`
--

CREATE TABLE `bilan_classements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classement_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bilan_classements`
--

INSERT INTO `bilan_classements` (`id`, `classement_number`, `classement`, `created_at`, `updated_at`) VALUES
(1, '13-453', 'Actifs immobilisés', '2023-01-13 09:50:36', '2023-01-13 09:50:36'),
(2, '13-712', 'Actifs circulants', '2023-01-13 09:51:13', '2023-01-13 09:51:13'),
(3, '13-879', 'Capitaux propres', '2023-01-13 09:51:29', '2023-01-13 09:51:29'),
(4, '13-266', 'Dettes (Emprunts)', '2023-01-13 10:11:46', '2023-01-13 10:11:46');

-- --------------------------------------------------------

--
-- Structure de la table `bilan_configs`
--

CREATE TABLE `bilan_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_comptable_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `bilan_classement_id` bigint(20) UNSIGNED NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bilan_config_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bilan_configs`
--

INSERT INTO `bilan_configs` (`id`, `plan_comptable_id`, `amount`, `bilan_classement_id`, `mois`, `annee`, `bilan_config_number`, `created_at`, `updated_at`) VALUES
(1, 1, 45500.00, 3, 'Jan', '2023', '2023-57-601', '2023-01-13 10:59:14', '2023-01-13 13:09:14'),
(2, 4, 300.00, 2, 'Jan', '2023', '2023-22-858', '2023-01-13 11:04:25', '2023-01-13 11:04:25'),
(3, 5, 600.00, 2, 'Jan', '2023', '2023-40-690', '2023-01-13 11:06:06', '2023-01-13 11:06:06'),
(4, 12, 800.00, 2, 'Jan', '2023', '2023-24-615', '2023-01-13 11:46:27', '2023-01-13 11:46:27'),
(5, 13, 59000.00, 3, 'Jan', '2023', '2023-85-742', '2023-01-13 11:47:08', '2023-01-13 11:47:08'),
(6, 8, 600.00, 4, 'Jan', '2023', '2023-35-818', '2023-01-13 11:47:29', '2023-01-13 11:47:29'),
(7, 15, 60000.00, 1, 'Jan', '2023', '2023-31-772', '2023-01-13 11:50:27', '2023-01-13 11:50:27');

-- --------------------------------------------------------

--
-- Structure de la table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `date_bonus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bonuses`
--

INSERT INTO `bonuses` (`id`, `price`, `quantity`, `production_id`, `date_bonus`, `mois`, `annee`, `bonus_number`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 59, 10, 129, '12-01-2023', 'Jan', '2023', '2023-01-1988', 1, '2023-01-12 08:43:29', '2023-01-12 08:43:29'),
(2, 35, 1, 123, '12-01-2023', 'Jan', '2023', '2023-01-2423', 3, '2023-01-12 10:13:20', '2023-01-12 10:13:20'),
(4, 20, 2, 130, '23-01-2023', 'Jan', '2023', '2023-01-2093', 3, '2023-01-23 12:01:02', '2023-01-23 12:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Liqueur A', '2022-12-22 13:01:57', '2022-12-22 13:01:57'),
(3, 'Liqueur B', '2022-12-22 13:02:27', '2022-12-22 13:02:27');

-- --------------------------------------------------------

--
-- Structure de la table `classement_bilans`
--

CREATE TABLE `classement_bilans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classement_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `client_number`, `name`, `email`, `address`, `tel`, `created_at`, `updated_at`) VALUES
(1, '12-2768', 'Patrique Mugisho', '', 'Goma Himbi', '0971234566', '2022-12-30 10:51:57', '2022-12-30 11:02:07'),
(3, '03-3029', 'Jodrack', 'joseph@gmail.com', 'Katoyi/Goma', '0963456794', '2022-12-30 11:14:54', '2023-03-08 10:42:06'),
(4, '01-7781', 'Philippe', '', 'Himbi/Goma', '0971122237', '2023-01-19 06:59:41', '2023-01-19 06:59:41'),
(5, '03-8209', 'John', 'johndoe@gmail.com', 'GOma Himbi', '+243971122237', '2023-03-08 10:42:36', '2023-03-08 10:42:36');

-- --------------------------------------------------------

--
-- Structure de la table `cout_productions`
--

CREATE TABLE `cout_productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `production_number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_production` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cout_productions`
--

INSERT INTO `cout_productions` (`id`, `production_number`, `libelle`, `montant`, `description`, `date_production`, `mois`, `annee`, `created_at`, `updated_at`) VALUES
(8, '24-02-2023-930-4', 'Cout De Production Numéro 24-02-2023-930-4', 340, 'Cout de Production de la quantité de 50 bouteille D\'emballages', '24-02-2023', 'Feb', '2023', '2023-02-24 14:13:53', '2023-02-26 17:43:24'),
(9, '24-02-2023-631-9', 'Cout De Production Numéro 24-02-2023-631-9', 1705, 'Cout de Production de la quantité de 100 bouteille D\'emballages', '24-02-2023', 'Feb', '2023', '2023-02-24 14:29:12', '2023-02-26 20:23:58'),
(10, '26-02-2023-784-0', 'Cout De Production Numéro 26-02-2023-784-0', 1440, 'Cout de Production de la quantité de 4 bouteille D\'emballages', '26-02-2023', 'Feb', '2023', '2023-02-26 17:54:30', '2023-02-26 18:04:41'),
(11, '28-02-2023-614-8', 'Cout De Production Numéro 28-02-2023-614-8', 215, 'Cout de Production de la quantité de 15 bouteille D\'emballages', '28-02-2023', 'Feb', '2023', '2023-02-28 08:23:08', '2023-02-28 08:59:29'),
(12, '08-03-2023-166-3', 'Cout De Production Numéro 08-03-2023-166-3', 200, 'Cout de Production de la quantité de 100 bouteille D\'emballages', '08-03-2023', 'Mar', '2023', '2023-03-08 10:53:20', '2023-03-08 10:53:20');

-- --------------------------------------------------------

--
-- Structure de la table `dettes`
--

CREATE TABLE `dettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dette_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `montant_paye` double DEFAULT NULL,
  `description` varchar(550) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_dette` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dettes`
--

INSERT INTO `dettes` (`id`, `dette_number`, `montant`, `quantity`, `montant_paye`, `description`, `mois`, `annee`, `date_dette`, `production_id`, `client_id`, `created_at`, `updated_at`) VALUES
(7, '3295-03-48', 20, 10, 12, 'School Fees', 'Mar', '2023', '08-03-2023', 13, 3, '2023-03-08 10:11:01', '2023-03-08 10:28:36');

-- --------------------------------------------------------

--
-- Structure de la table `emballages`
--

CREATE TABLE `emballages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_emballage_id` bigint(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_price` double NOT NULL,
  `date_emballage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emballage_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emballages`
--

INSERT INTO `emballages` (`id`, `name`, `type_emballage_id`, `quantity`, `unit_id`, `mois`, `annee`, `created_at`, `updated_at`, `purchase_price`, `date_emballage`, `emballage_number`) VALUES
(1, 'bouteille', 0, 82, 2, 'Dec', 2022, '2022-12-26 07:01:42', '2023-02-26 19:37:10', 10, '08-01-2023', '2023-53567'),
(6, 'Bouteille 10L', 0, 70, 2, 'Jan', 2023, '2023-01-09 15:20:50', '2023-02-26 18:04:32', 20, '09-01-2023', '2023-55613'),
(11, 'bouteille', 0, 170, 2, 'Jan', 2023, '2023-01-23 10:05:01', '2023-02-26 19:44:58', 20, '23-01-2023', '2023-69317'),
(12, 'Bouteille 10ml', 0, 100, 2, 'Jan', 2023, '2023-01-27 13:25:59', '2023-02-13 20:05:37', 20, '27-01-2023', '2023-36912'),
(13, 'bouteille', 1, 180, 2, 'Feb', 2023, '2023-02-24 11:18:16', '2023-03-08 10:53:19', 2, '24-02-2023', '2023-45129'),
(14, 'bouteille', 4, 80, 2, 'Feb', 2023, '2023-02-24 14:28:08', '2023-02-28 08:23:08', 1, '24-02-2023', '2023-64312'),
(15, 'Bouteille', 4, 280, 2, 'Mar', 2023, '2023-03-08 11:06:19', '2023-03-08 19:26:26', 0.5, '08-03-2023', '2023-59621');

-- --------------------------------------------------------

--
-- Structure de la table `emballage_casses`
--

CREATE TABLE `emballage_casses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emballage_id` bigint(20) UNSIGNED NOT NULL,
  `date_emballage_casse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emballage_casses`
--

INSERT INTO `emballage_casses` (`id`, `number`, `emballage_id`, `date_emballage_casse`, `mois`, `annee`, `created_at`, `updated_at`, `quantity`) VALUES
(5, '01-79114', 3, '23-01-2023', 'Jan', '2023', '2023-01-23 09:29:40', '2023-01-23 09:29:40', 2),
(11, '02-24261', 13, '24-02-2023', 'Feb', '2023', '2023-02-24 11:42:49', '2023-02-24 11:42:49', 500),
(12, '03-66190', 15, '08-03-2023', 'Mar', '2023', '2023-03-08 19:26:25', '2023-03-08 19:26:25', 20);

-- --------------------------------------------------------

--
-- Structure de la table `emballage_comptables`
--

CREATE TABLE `emballage_comptables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_emballage_id` bigint(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `date_emballage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emballage_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emballage_comptables`
--

INSERT INTO `emballage_comptables` (`id`, `name`, `type_emballage_id`, `quantity`, `unit_id`, `mois`, `annee`, `purchase_price`, `date_emballage`, `emballage_number`, `created_at`, `updated_at`) VALUES
(3, 'Bouteille 10ml', 0, 200, 2, 'Jan', 2023, 0.5, '11-01-2023', '2023-57525', '2023-01-11 11:10:24', '2023-01-11 11:10:24'),
(5, 'bouteille', 0, 250, 2, 'Jan', 2023, 20, '23-01-2023', '2023-69317', '2023-01-23 10:05:01', '2023-01-23 10:05:01'),
(6, 'Bouteille 10ml', 0, 100, 2, 'Jan', 2023, 20, '27-01-2023', '2023-36912', '2023-01-27 13:25:59', '2023-01-27 13:25:59'),
(7, 'bouteille', 1, 300, 2, 'Feb', 2023, 2, '24-02-2023', '2023-45129', '2023-02-24 11:18:17', '2023-02-26 12:59:38'),
(8, 'bouteille', 4, 200, 2, 'Feb', 2023, 1, '24-02-2023', '2023-64312', '2023-02-24 14:28:08', '2023-02-24 14:28:08'),
(9, 'Bouteille', 4, 300, 2, 'Mar', 2023, 0.5, '08-03-2023', '2023-59621', '2023-03-08 11:06:19', '2023-03-08 11:06:19');

-- --------------------------------------------------------

--
-- Structure de la table `emballage_production`
--

CREATE TABLE `emballage_production` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emballage_id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emballage_production`
--

INSERT INTO `emballage_production` (`id`, `emballage_id`, `production_id`, `created_at`, `updated_at`) VALUES
(1, 6, 12, NULL, NULL),
(2, 6, 12, NULL, NULL),
(3, 13, 12, NULL, NULL),
(4, 13, 12, NULL, NULL),
(5, 6, 14, NULL, NULL),
(6, 11, 14, NULL, NULL),
(7, 11, 14, NULL, NULL),
(8, 1, 13, NULL, NULL),
(9, 11, 13, NULL, NULL),
(10, 14, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `justifications`
--

CREATE TABLE `justifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `justification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `justification_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `justification_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `justifications`
--

INSERT INTO `justifications` (`id`, `justification`, `image`, `justification_date`, `mois`, `annee`, `justification_number`, `created_at`, `updated_at`) VALUES
(6, 'paiement du loyé', '/piece_justification/Capture.PNG', '08-03-2023', 'Mar', '2023', '373-03-74', '2023-03-08 11:33:39', '2023-03-08 11:33:39');

-- --------------------------------------------------------

--
-- Structure de la table `logistiques`
--

CREATE TABLE `logistiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logistique_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logistiques`
--

INSERT INTO `logistiques` (`id`, `logistique_number`, `name`, `quantity`, `office_id`, `created_at`, `updated_at`, `unit_id`, `purchase_price`) VALUES
(1, '509-2022', 'Tables', 5, 1, '2022-12-31 14:18:09', '2022-12-31 14:30:31', 2, 40),
(2, '202-2023', 'Computer', 2, 1, '2023-01-04 09:45:29', '2023-01-04 09:45:29', 2, 250),
(3, '573-2023', 'Table', 5, 2, '2023-01-19 07:05:28', '2023-01-19 07:05:28', 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  `date_matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matiere_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id`, `name`, `type`, `quantity`, `mois`, `annee`, `created_at`, `updated_at`, `unit_id`, `purchase_price`, `date_matiere`, `matiere_number`) VALUES
(3, 'Poudre', 'Solide', 42, 'Dec', 2022, '2022-12-21 14:23:11', '2023-02-24 15:49:05', 4, 10, '08-01-2022', '01-17479'),
(4, 'Banana', 'Solide', 42, 'Dec', 2022, '2022-12-26 07:00:52', '2023-02-26 14:37:14', 2, 10, '08-01-2022', '01-37842'),
(5, 'Eau', 'Liquide', 62, 'Jan', 2023, '2023-01-04 07:35:25', '2023-02-24 15:50:39', 3, 5, '08-01-2023', '01-35925'),
(6, 'Ananas', 'Solide', 52, 'Jan', 2023, '2023-01-08 08:56:26', '2023-02-28 08:59:29', 2, 20, '08-01-2023', '01-17945'),
(7, 'Fruits', 'Solide', 62, 'Jan', 2023, '2023-01-09 15:14:39', '2023-02-17 11:44:31', 2, 20, '09-01-2023', '01-17925'),
(11, 'huile', 'Liquide', 62, 'Jan', 2023, '2023-01-11 10:59:21', '2023-02-24 15:50:39', 2, 3, '11-01-2023', '01-20021'),
(12, 'Avocat', 'Solide', 300, 'Feb', 2023, '2023-01-27 13:25:38', '2023-02-26 13:00:33', 2, 2, '27-01-2023', '01-19820'),
(13, 'Eau', 'Liquide', 100, 'Feb', 2023, '2023-02-21 06:54:31', '2023-02-21 06:54:31', 3, 1, '21-02-2023', '02-17011'),
(14, 'avocat', 'Solide', 300, 'Mar', 2023, '2023-03-08 11:09:38', '2023-03-08 11:09:38', 2, 0.4, '08-03-2023', '03-34933');

-- --------------------------------------------------------

--
-- Structure de la table `matiere_comptables`
--

CREATE TABLE `matiere_comptables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_price` double NOT NULL,
  `date_matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matiere_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere_comptables`
--

INSERT INTO `matiere_comptables` (`id`, `name`, `type`, `quantity`, `mois`, `annee`, `unit_id`, `purchase_price`, `date_matiere`, `matiere_number`, `created_at`, `updated_at`) VALUES
(2, 'carotte', 'Solide', 100, 'Jan', 2023, 2, 1, '11-01-2023', '01-20021', '2023-01-11 10:59:21', '2023-01-11 10:59:21'),
(3, 'Avocat', 'Solide', 300, 'Feb', 2023, 2, 2, '27-01-2023', '01-19820', '2023-01-27 13:25:38', '2023-02-26 13:00:33'),
(4, 'Eau', 'Liquide', 100, 'Feb', 2023, 3, 1, '21-02-2023', '02-17011', '2023-02-21 06:54:32', '2023-02-21 06:54:32'),
(5, 'avocat', 'Solide', 300, 'Mar', 2023, 2, 0.4, '08-03-2023', '03-34933', '2023-03-08 11:09:39', '2023-03-08 11:09:39');

-- --------------------------------------------------------

--
-- Structure de la table `matiere_production`
--

CREATE TABLE `matiere_production` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matiere_id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere_production`
--

INSERT INTO `matiere_production` (`id`, `matiere_id`, `production_id`, `created_at`, `updated_at`) VALUES
(47, 3, 13, '2023-02-24 17:49:05', '2023-02-24 17:49:05'),
(48, 6, 13, '2023-02-24 17:49:16', '2023-02-24 17:49:16'),
(49, 4, 13, '2023-02-26 16:37:14', '2023-02-26 16:37:14'),
(50, 6, 15, '2023-02-28 10:59:28', '2023-02-28 10:59:28');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_20_110153_add_new_comolmn_to_users_table', 2),
(6, '2022_12_20_161355_add_new_colomn_password_confirmation_to_users_table', 3),
(7, '2022_12_21_115421_create_matieres_table', 4),
(8, '2022_12_21_123707_create_type_matieres_table', 5),
(9, '2022_12_21_152828_add_new_colomn_unite_to_matieres_tables', 6),
(10, '2022_12_21_153501_create_units_table', 6),
(11, '2022_12_21_172538_create_emballages_table', 7),
(12, '2022_12_21_181144_add_new_row_to_emballages_table', 8),
(13, '2022_12_21_203712_create_emballages_tables', 9),
(14, '2022_12_22_132433_create_productions_table', 10),
(15, '2022_12_22_140814_create_categories_table', 10),
(16, '2022_12_23_155947_add_new_colomn_to_matieres_tables', 11),
(17, '2022_12_23_160054_add_new_colomn_to_emballages_tables', 11),
(18, '2022_12_23_160427_add_new_colomn_to_productions_tables', 12),
(19, '2022_12_26_082000_add_new_colomn_to_matieres_tables', 13),
(20, '2022_12_26_082128_add_new_colomn_to_emballages_table', 13),
(21, '2022_12_28_113911_create_sales_table', 14),
(22, '2022_12_29_132012_add_new_column_date_sale_to_sales_table', 15),
(23, '2022_12_29_160418_add_new_column_number__to_sales_table', 16),
(24, '2022_12_30_112000_add_new_column_dale_production_to_productions_table', 17),
(25, '2022_12_30_121316_add_new_column_client_id_to_sales_table', 18),
(26, '2022_12_30_122150_create_clients_tables', 19),
(27, '2022_12_31_133740_create_offices_table', 20),
(28, '2022_12_31_134031_create_logistiques_table', 21),
(29, '2022_12_31_140635_create_offices_table', 22),
(30, '2022_12_31_141038_create_offices_table', 23),
(31, '2022_12_31_152403_add_new_column_to_logistiques_table', 23),
(32, '2022_12_31_161521_add_new_column_purchase_price_to_logistiques_table', 24),
(33, '2023_01_02_122218_create_sorties_table', 25),
(34, '2023_01_02_125428_add_new_column_sorte_number_to_sortie_tables', 26),
(35, '2023_01_02_133732_create_table_production_provisoires', 27),
(36, '2023_01_03_094505_create_recettes_table', 28),
(37, '2023_01_03_120552_create_cout_productions_table', 29),
(38, '2023_01_03_121039_create_cout_productions_table', 30),
(39, '2023_01_03_145019_create_dettes_table', 31),
(40, '2023_01_03_150158_add_new_coloumn_to_dettes_table', 32),
(41, '2023_01_03_151704_add_new_coloumn_dette_number_to_dettes_table', 33),
(42, '2023_01_04_125726_create_dettes_table', 34),
(43, '2023_01_04_132313_create_dettes_table', 35),
(44, '2023_01_04_132522_create_dettes_table', 36),
(45, '2023_01_06_150545_create_plan_comptables_table', 37),
(46, '2023_01_06_162026_create_account_types_table', 38),
(47, '2023_01_06_171101_add_new_column_classification_number_to_account_types_table', 39),
(48, '2023_01_06_173231_add_new_column_account_type_id_to_plan_comptables_table', 40),
(49, '2023_01_06_174741_add_new_column_range_to_account_types_table', 41),
(50, '2023_01_07_074503_create_operations_table', 42),
(51, '2023_01_07_093203_create_transactions_table', 42),
(52, '2023_01_08_104942_add_new_column_to_matieres_table', 43),
(53, '2023_01_08_104956_add_new_column_to_emballages_table', 43),
(54, '2023_01_09_165005_add_new_column_to_matieres_table', 44),
(55, '2023_01_09_165038_add_new_column_to_emballages_table', 44),
(56, '2023_01_11_105759_create_matiere_comptables_table', 45),
(57, '2023_01_11_105903_create_emballage_comptables_table', 45),
(58, '2023_01_11_154350_create_production_comptables_table', 46),
(59, '2023_01_12_094822_create_bonuses_table', 47),
(60, '2023_01_13_091229_create_bilan_configs_table', 48),
(61, '2023_01_13_094832_create_bilan_configs_table', 49),
(62, '2023_01_13_111203_add_new_column_to_bilan_configs_table', 50),
(63, '2023_01_13_111958_create_classement_bilans_table', 51),
(64, '2023_01_13_114509_create_bilan_classements_table', 52),
(65, '2023_01_13_122337_create_bilan_configs_table', 53),
(66, '2023_01_13_123244_add_new_column_to_bilan_configs_table', 54),
(67, '2023_01_13_124350_create_bilan_configs_table', 55),
(68, '2023_01_13_175204_create_justifications_table', 56),
(69, '2023_01_16_105002_create_user_tokens_table', 57),
(70, '2023_01_16_121908_create_user_types_table', 58),
(71, '2023_01_16_123934_add_new_column_image_to_users_table', 59),
(72, '2023_01_16_124424_add_new_column_image_to_users_table', 60),
(73, '2023_01_23_093157_add_new_row_broken_quantity_to_emballages_table', 61),
(74, '2023_01_23_095349_create_emballage_casses_table', 62),
(75, '2023_01_23_101026_add_new_row__quantity_to_emballage_casses_table', 63),
(76, '2023_01_28_104928_create_academic_years_table', 64),
(77, '2023_01_28_105604_create_user_roles_table', 64),
(78, '2023_01_28_110152_create_parents_table', 64),
(79, '2023_02_06_120906_create_matieres_poductions_table', 65),
(80, '2023_02_06_133213_create_poduction_matieres_table', 66),
(81, '2023_02_08_233752_create_matiere_production_provisoire_table', 67),
(82, '2023_02_13_113741_create_production_matiere_quantities_table', 68),
(83, '2023_02_22_094155_create_type_recettes_table', 69),
(84, '2023_02_22_105858_create_autre_recettes_table', 70),
(85, '2023_02_22_112501_create_autre_recettes_table', 71),
(86, '2023_02_24_112515_create_price_configs_table', 72),
(87, '2023_02_24_121135_create_type_emballages_table', 72),
(88, '2023_02_26_151946_create_production_emballage_quantities_table', 73),
(89, '2023_02_26_152208_create_emballage_productions_table', 73);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `name`) VALUES
(1, 'Jan'),
(2, 'Feb'),
(3, 'Mar'),
(4, 'Apr'),
(5, 'May'),
(6, 'Jun'),
(7, 'Jul'),
(8, 'Aug'),
(9, 'Sep'),
(10, 'Oct'),
(11, 'Nov'),
(12, 'Dec');

-- --------------------------------------------------------

--
-- Structure de la table `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chef` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offices`
--

INSERT INTO `offices` (`id`, `office_number`, `name`, `chef`, `created_at`, `updated_at`) VALUES
(1, '2022-869', 'Finance', 'Philippe', '2022-12-31 14:07:05', '2022-12-31 14:07:05'),
(2, '2022-473', 'Comptabilité', 'Patrique', '2022-12-31 14:07:30', '2022-12-31 14:07:30');

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE `operations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operation_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `actif_account` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passif_account` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `operations`
--

INSERT INTO `operations` (`id`, `operation_number`, `transaction_id`, `actif_account`, `passif_account`, `created_at`, `updated_at`) VALUES
(3, '2023-08-1384', 1, '60.2 Achat Matières Premières', '40.1 Fournisseur', '2023-01-08 12:58:45', '2023-01-08 12:59:10'),
(4, '2023-08-4123', 2, '60.8 Achat d\'emballages', '40.1 Fournisseur', '2023-01-08 13:00:32', '2023-01-08 13:00:32'),
(5, '2023-08-3972', 3, '40.1 Fournisseur', '70.1 Vente Marchandises', '2023-01-08 13:00:48', '2023-01-19 06:41:48'),
(6, '2023-08-2135', 4, '65 Autres Charges', '40.1 Fournisseur', '2023-01-08 13:01:15', '2023-01-08 13:01:15');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plan_comptables`
--

CREATE TABLE `plan_comptables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_number` float NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plan_comptables`
--

INSERT INTO `plan_comptables` (`id`, `account_number`, `account_name`, `created_at`, `updated_at`, `account_type_id`) VALUES
(1, 10, 'Capital', '2023-01-06 13:59:56', '2023-01-13 11:14:48', 1),
(4, 41.1, 'Client', '2023-01-06 16:06:10', '2023-01-08 12:44:35', 2),
(5, 52, 'Banque', '2023-01-06 16:06:26', '2023-01-06 16:06:26', 7),
(6, 60.1, 'Achat Marchandises', '2023-01-07 12:25:54', '2023-01-08 12:39:57', 4),
(7, 70.1, 'Vente Marchandises', '2023-01-07 12:26:27', '2023-01-08 12:39:40', 5),
(8, 40.1, 'Fournisseur', '2023-01-07 13:13:05', '2023-01-08 12:44:19', 2),
(9, 60.2, 'Achat Matières Premières', '2023-01-08 12:38:19', '2023-01-08 12:38:19', 4),
(10, 65, 'Autres Charges', '2023-01-08 12:45:00', '2023-01-08 12:45:00', 4),
(11, 60.8, 'Achat d\'emballages', '2023-01-08 13:00:09', '2023-01-08 13:00:09', 4),
(12, 31, 'Marchandises', '2023-01-13 11:09:47', '2023-01-13 11:10:07', 3),
(13, 13, 'Résultats', '2023-01-13 11:13:32', '2023-01-13 11:13:32', 1),
(14, 16, 'Emprunts et Dettes Assimilées', '2023-01-13 11:21:02', '2023-01-13 11:21:02', 1),
(15, 22, 'Terrains', '2023-01-13 11:21:57', '2023-01-13 11:40:41', 11),
(16, 57, 'Caisse', '2023-01-13 11:22:48', '2023-01-13 11:22:48', 7),
(17, 34, 'operation', '2023-01-19 06:52:37', '2023-01-19 06:52:37', 3);

-- --------------------------------------------------------

--
-- Structure de la table `price_configs`
--

CREATE TABLE `price_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_emballage_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_min` int(11) NOT NULL,
  `quantity_max` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `price_configs`
--

INSERT INTO `price_configs` (`id`, `type_emballage_id`, `quantity_min`, `quantity_max`, `price`, `created_at`, `updated_at`) VALUES
(2, 1, 0, 25, 5, '2023-02-24 13:32:42', '2023-02-24 13:32:42'),
(3, 4, 0, 25, 3, '2023-02-24 13:32:59', '2023-02-24 13:32:59'),
(4, 1, 25, 50, 10, '2023-02-26 16:07:48', '2023-02-26 16:07:48'),
(5, 4, 25, 50, 6, '2023-02-28 11:17:46', '2023-02-28 11:17:46');

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

CREATE TABLE `productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `emballage_id` bigint(20) NOT NULL,
  `emballage_quantity` double NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_production` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `productions`
--

INSERT INTO `productions` (`id`, `number`, `quantity`, `mois`, `annee`, `category_id`, `emballage_id`, `emballage_quantity`, `unit_id`, `created_at`, `updated_at`, `date_production`) VALUES
(12, '24-02-2023-930-4', 8, 'Feb', 2023, 2, 0, 0, 2, '2023-02-24 14:13:53', '2023-03-08 10:32:17', '24-02-2023'),
(13, '24-02-2023-631-9', 42, 'Feb', 2023, 3, 13, 0, 2, '2023-02-24 14:29:12', '2023-03-08 10:11:02', '24-02-2023'),
(14, '26-02-2023-784-0', 200, 'Feb', 2023, 2, 13, 0, 2, '2023-02-26 17:54:30', '2023-02-26 17:54:30', '26-02-2023'),
(15, '28-02-2023-614-8', 55, 'Feb', 2023, 3, 14, 15, 2, '2023-02-28 08:23:08', '2023-02-28 08:23:08', '28-02-2023'),
(16, '08-03-2023-166-3', 100, 'Mar', 2023, 2, 13, 100, 2, '2023-03-08 10:53:19', '2023-03-08 10:53:19', '08-03-2023');

-- --------------------------------------------------------

--
-- Structure de la table `production_emballage_quantities`
--

CREATE TABLE `production_emballage_quantities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `emballage_quantity` int(11) NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `production_emballage_quantities`
--

INSERT INTO `production_emballage_quantities` (`id`, `production_id`, `emballage_quantity`, `number`, `unit`, `created_at`, `updated_at`) VALUES
(1, 12, 10, '24-02-2023-930-4', 'Pc', '2023-02-26 17:38:04', '2023-02-26 17:38:04'),
(2, 12, 15, '24-02-2023-930-4', 'Pc', '2023-02-26 17:41:32', '2023-02-26 17:41:32'),
(3, 12, 5, '24-02-2023-930-4', 'Pc', '2023-02-26 17:43:24', '2023-02-26 17:43:24'),
(4, 14, 10, '26-02-2023-784-0', 'Pc', '2023-02-26 18:04:32', '2023-02-26 18:04:32'),
(5, 14, 30, '26-02-2023-784-0', 'Pc', '2023-02-26 18:04:41', '2023-02-26 18:04:41'),
(6, 14, 30, '26-02-2023-784-0', 'Pc', '2023-02-26 18:04:41', '2023-02-26 18:04:41'),
(7, 13, 20, '24-02-2023-631-9', 'Pc', '2023-02-26 19:37:10', '2023-02-26 19:37:10'),
(8, 13, 20, '24-02-2023-631-9', 'Pc', '2023-02-26 19:44:58', '2023-02-26 19:44:58'),
(9, 13, 5, '24-02-2023-631-9', 'Pc', '2023-02-26 20:23:57', '2023-02-26 20:23:57');

-- --------------------------------------------------------

--
-- Structure de la table `production_matiere_quantities`
--

CREATE TABLE `production_matiere_quantities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `matiere_quantity` int(11) NOT NULL,
  `number` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `production_matiere_quantities`
--

INSERT INTO `production_matiere_quantities` (`id`, `production_id`, `matiere_quantity`, `number`, `unit`, `created_at`, `updated_at`) VALUES
(45, 13, 20, '24-02-2023-631-9', 'Pc', '2023-02-24 15:49:06', '2023-02-24 15:49:06'),
(46, 13, 30, '24-02-2023-631-9', 'Pc', '2023-02-24 15:49:16', '2023-02-24 15:49:16'),
(47, 13, 20, '24-02-2023-631-9', 'Pc', '2023-02-26 14:37:14', '2023-02-26 14:37:14'),
(48, 15, 10, '28-02-2023-614-8', 'Pc', '2023-02-28 08:59:29', '2023-02-28 08:59:29');

-- --------------------------------------------------------

--
-- Structure de la table `production_provisoires`
--

CREATE TABLE `production_provisoires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_production` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `emballage_id` bigint(20) NOT NULL,
  `emballage_quantity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `production_provisoires`
--

INSERT INTO `production_provisoires` (`id`, `number`, `category_id`, `quantity`, `mois`, `annee`, `date_production`, `unit_id`, `emballage_id`, `emballage_quantity`, `created_at`, `updated_at`) VALUES
(9, '24-02-2023-930-4', 2, 50, 'Feb', '2023', '2023-02-24', 2, 0, 0, '2023-02-24 14:13:53', '2023-02-24 14:13:53'),
(10, '24-02-2023-631-9', 3, 100, 'Feb', '2023', '2023-02-24', 2, 0, 0, '2023-02-24 14:29:12', '2023-02-24 14:29:12'),
(11, '26-02-2023-784-0', 2, 240, 'Feb', '2023', '2023-02-26', 2, 0, 0, '2023-02-26 17:54:30', '2023-02-26 17:54:30'),
(12, '28-02-2023-614-8', 3, 100, 'Feb', '2023', '2023-02-28', 2, 14, 15, '2023-02-28 08:23:08', '2023-02-28 08:23:08'),
(13, '08-03-2023-166-3', 2, 100, 'Mar', '2023', '2023-03-08', 2, 13, 100, '2023-03-08 10:53:19', '2023-03-08 10:53:19');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recette_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recette` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `recette_number`, `libelle`, `montant`, `description`, `date_recette`, `mois`, `annee`, `created_at`, `updated_at`) VALUES
(1, '01-2023-5211', 'Vente 01-2023-5211', 225, 'Vente de 5 produit au prix de 45', '03-01-2023', 'Jan', '2023', '2023-01-03 08:43:56', '2023-01-03 08:43:56'),
(2, '01-2023-6239', 'Vente 01-2023-6239', 350, 'Vente de 10 produit au prix de 35$', '03-01-2023', 'Jan', '2023', '2023-01-03 08:48:07', '2023-01-03 08:48:07'),
(3, '01-2023-3549', 'Vente 01-2023-3549', 58, 'Vente de 2 produit au prix de 29$', '03-01-2023', 'Jan', '2023', '2023-01-03 08:48:34', '2023-01-03 08:48:34'),
(4, '01-2023-5926', 'Vente 01-2023-5926', 50, 'Vente de 2 produit au prix de 25$', '03-01-2023', 'Jan', '2023', '2023-01-03 09:28:03', '2023-01-03 09:28:03');

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `price`, `quantity`, `production_id`, `mois`, `annee`, `created_at`, `updated_at`, `date_sale`, `sale_number`, `client_id`) VALUES
(1, 35, 20, 118, 'Dec', '2022', '2022-12-29 11:07:32', '2022-12-29 11:07:32', '2022-12-29', '12-2022-3421', 1),
(5, 50, 3, 117, 'Dec', '2022', '2022-12-30 11:18:57', '2022-12-30 11:18:57', '2022-12-30', '12-2022-9714', 3),
(6, 45, 2, 120, 'Dec', '2022', '2022-12-30 11:35:47', '2022-12-30 11:35:47', '2022-12-30', '12-2022-8400', 1),
(21, 55, 10, 11, 'Feb', '2023', '2023-02-21 06:51:56', '2023-02-21 06:51:56', '21-02-2023', '02-2023-1317', 3),
(22, 30, 20, 13, 'Feb', '2023', '2023-02-24 14:56:55', '2023-02-24 14:56:55', '24-02-2023', '02-2023-2456', 1),
(23, 3, 28, 13, 'Feb', '2023', '2023-02-24 14:57:32', '2023-02-24 14:57:32', '24-02-2023', '02-2023-6122', 1),
(24, 5, 45, 12, 'Feb', '2023', '2023-02-24 14:58:17', '2023-02-24 14:58:17', '24-02-2023', '02-2023-3613', 1),
(25, 3, 5, 15, 'Feb', '2023', '2023-02-28 11:16:49', '2023-02-28 11:16:49', '28-02-2023', '02-2023-8612', 1),
(26, 6, 30, 15, 'Feb', '2023', '2023-02-28 11:18:05', '2023-02-28 11:18:05', '28-02-2023', '02-2023-1907', 4),
(27, 10, 40, 14, 'Feb', '2023', '2023-02-28 12:03:50', '2023-02-28 12:03:50', '28-02-2023', '02-2023-4009', 1),
(28, 3, 10, 15, 'Mar', '2023', '2023-03-08 10:45:41', '2023-03-08 10:45:41', '08-03-2023', '03-2023-7501', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

CREATE TABLE `sorties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sortie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sortie_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sorties`
--

INSERT INTO `sorties` (`id`, `libelle`, `montant`, `description`, `date_sortie`, `mois`, `annee`, `created_at`, `updated_at`, `sortie_number`) VALUES
(1, 'Paiement du Loyer', 200, 'Paiement  du Loyer', '02-01-2023', 'Jan', '2023', '2023-01-02 10:44:55', '2023-01-02 10:51:59', '2023-452-01'),
(6, 'Achat nourrriture du personnel', 45, 'Achat nourrriture du personnel', '03-01-2023', 'Jan', '2023', '2023-01-03 07:24:01', '2023-01-03 07:24:01', '2023-149-01'),
(7, 'paiement loyer', 150, 'paiement loyer', '04-01-2023', 'Jan', '2023', '2023-01-04 08:11:14', '2023-01-04 08:11:14', '2023-123-01'),
(9, 'paiement loyer', 200, 'paiement loyer', '27-01-2023', 'Jan', '2023', '2023-01-27 13:25:07', '2023-01-27 13:25:07', '2023-983-01'),
(10, 'paiement loyer', 200, 'paiement loyer', '17-02-2023', 'Feb', '2023', '2023-02-17 14:04:53', '2023-02-17 14:04:53', '2023-236-02'),
(11, 'paiment du personnel', 50, 'paiment du personnel', '21-02-2023', 'Feb', '2023', '2023-02-21 06:56:28', '2023-02-21 06:56:28', '2023-725-02'),
(12, 'paiemrent du courant', 20, 'paiemrent du courant', '08-03-2023', 'Mar', '2023', '2023-03-08 10:49:35', '2023-03-08 10:49:35', '2023-152-03');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_number`, `name`, `created_at`, `updated_at`) VALUES
(1, '07-2023-49-61', 'Achat Matières Premières', '2023-01-07 10:58:35', '2023-01-08 12:56:29'),
(2, '07-2023-31-73', 'Achat d\'emballages', '2023-01-07 11:05:28', '2023-01-08 12:57:14'),
(3, '07-2023-23-87', 'Ventes de Marchandises', '2023-01-07 11:05:42', '2023-01-08 12:58:01'),
(4, '08-2023-47-80', 'Charges', '2023-01-08 12:58:20', '2023-01-08 12:58:20');

-- --------------------------------------------------------

--
-- Structure de la table `type_emballages`
--

CREATE TABLE `type_emballages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_emballages`
--

INSERT INTO `type_emballages` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'STAMP Bingi Whisky 750ml', 'pour toutes les bouteilles de 750ml', '2023-02-24 10:42:48', '2023-02-24 11:54:32'),
(4, 'STAMP Bingi Whisky 300ml', 'Pour toutes les bouteilles de 300ml', '2023-02-24 10:51:08', '2023-02-24 11:54:49');

-- --------------------------------------------------------

--
-- Structure de la table `type_matieres`
--

CREATE TABLE `type_matieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_matieres`
--

INSERT INTO `type_matieres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Solide', '2022-12-21 11:16:43', '2022-12-21 13:22:39'),
(2, 'Liquide', '2023-01-04 07:33:49', '2023-01-04 07:33:49');

-- --------------------------------------------------------

--
-- Structure de la table `type_recettes`
--

CREATE TABLE `type_recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_recettes`
--

INSERT INTO `type_recettes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Frais de stage professionnel', '2023-02-22 08:43:12', '2023-02-22 08:43:31');

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Pc', '2022-12-21 14:07:03', '2022-12-21 14:07:03'),
(3, 'Litre', '2022-12-21 14:07:28', '2022-12-21 14:07:28'),
(4, 'Douzaine', '2022-12-21 14:07:48', '2022-12-21 14:07:48');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type_id` bigint(11) NOT NULL,
  `password_confirmation` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type_id`, `password_confirmation`, `image`) VALUES
(1, 'Philippe', 'philippetsongo90@gmail.com', NULL, '$2y$10$9rVIyJx9pFGcWvsbdsWbYOClquYPOoMCzeNEGJCM/Txy6N62D6oMu', NULL, '2023-01-16 10:45:15', '2023-01-16 10:45:15', 1, '$2y$10$9Xz4TuOVQEX0qLhZSqY6neBR5pZj8U7C8JW9YsR.h7grozmHWX69u', '/IMAGES/profile/BYYD0021.JPG'),
(2, 'phil', 'philtsongo90@gmail.com', NULL, '$2y$10$mPI//dL/TsLrh9srfelg6uON3KvRLYlPqk1.nVsS90C69SQXXpoDG', NULL, '2023-01-16 11:11:17', '2023-01-16 11:11:17', 2, '$2y$10$Ip4/ZIqETFBWjpSe/Cb1yO2JPSRcQBYuURsr8JkZb0vxz9JbbMIfi', '/IMAGES/profile/ELSA6982.JPG'),
(3, 'Patrick', 'patrickmugisho@gmail.com', NULL, '$2y$10$cv5ER6LVzWLxdLMajEBEquLq05HgV0WTfo9YbL8kD8UE4EgXfzoFK', NULL, '2023-01-16 11:21:39', '2023-01-16 11:21:39', 4, '$2y$10$4fWxVBrcZ1r1z/yD84.yvO0Jd4GPUP4Iy0f1n7mjBCw/YTRQ941rO', '/IMAGES/profile/IMG_2011 (3).JPG'),
(4, 'John', 'johndoe@gmail.com', NULL, '$2y$10$KIRT3Vf.5k1tIpkZEYBFHOeuNjrAWqKRixv.fSOzDWV.tzMK1RN5i', NULL, '2023-01-16 11:23:04', '2023-01-16 11:23:04', 5, '$2y$10$hms8Yxt9sC/MOpRA52NubeqdKNOxJhKPkL0pQKPmks5IyKi5nwrNu', '/IMAGES/profile/IMG_3459.JPG'),
(5, 'Producer', 'producer@gmail.com', NULL, '$2y$10$0XANszV7X3vMR2e3nfqcxOsJksC54XzqVM9VfJ3Q3cB9NgtkjG3cq', NULL, '2023-01-16 11:25:04', '2023-01-16 11:25:04', 3, '$2y$10$kmtG23vTDd/nLldMQpM.beUOr/Y1JUhKVjY6qu21KwcM9GorPEWm.', '/IMAGES/profile/IMG_2456.JPG'),
(6, 'Vendeur', 'vendeur@gmail.com', NULL, '$2y$10$7h0yauCIYfPvBlMwOmPaZO0WUXVmWR17TojQAtxYEYgLr4cRV3fs6', NULL, '2023-01-27 13:18:15', '2023-01-27 13:19:40', 6, '$2y$10$tRRbfy5QTjMZLAOsCNjO1uIwRAnnSv1ShREz/j.0VgO7dOOpZT80W', '/IMAGES/profile/20.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `token_name`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(83, 'user_token', 1, 'qOiIlGL9654lk6h1x0HrDsgNYYBn6MR5JMKs5v2Ehdjow', '2023-02-22 12:44:21', '2023-02-22 12:44:21'),
(85, 'user_token', 1, 'MPboPnJL4SsfB9nE0Jy2ZoZGMsJh7gM3RygKnazl5BDLg', '2023-02-22 12:55:10', '2023-02-22 12:55:10'),
(86, 'user_token', 1, 'Dg8n3o4g8bww6FvtDItN26MKDs1aLJKTxCNVHfuYS4XA0', '2023-02-24 09:24:12', '2023-02-24 09:24:12'),
(87, 'user_token', 1, 'SZw7l5WFqETM4jVBaIHkYfPvBggNRXh6rhdRNWYQbAxpo', '2023-02-24 18:57:05', '2023-02-24 18:57:05'),
(90, 'user_token', 2, 'B161wf4NerCIgSVEBRVFcAqZT9eY9C0pmznJLwIiQqkfq', '2023-02-24 20:00:48', '2023-02-24 20:00:48'),
(91, 'user_token', 1, 'XO4uX5UdpimaIrXqFgCfmjKusttijuI8CUPodT6MqRSOF', '2023-02-26 12:49:20', '2023-02-26 12:49:20'),
(93, 'user_token', 1, 'bVcSt4Uzd1TFd4BDkQLMwtQ4wYD4VJHzUTaY7FepEf1Aa', '2023-02-26 16:01:16', '2023-02-26 16:01:16'),
(94, 'user_token', 1, '700JYaejmzYjNYHDuMnowe70FwFppLi9RTLA5Lvfp3jsP', '2023-02-28 06:53:10', '2023-02-28 06:53:10'),
(95, 'user_token', 1, 'uz4RreTFPBezhxEShPjoih12F8jvEMueugiK1FLlWMP03', '2023-03-01 06:53:49', '2023-03-01 06:53:49'),
(96, 'user_token', 1, 'OZ1TjUiexnP9M87LvKX1SKthfzxvIQreWENlQfxNkFyPj', '2023-03-08 06:17:49', '2023-03-08 06:17:49'),
(97, 'user_token', 1, 'hzdgS0w3226dJluj6m7ghaGbPkBKItV5vb2Qc1TDieVgp', '2023-03-08 14:16:30', '2023-03-08 14:16:30'),
(99, 'user_token', 1, 'kOY3wHd7ZNujwedSsrMEJ5hg5oon7152O87ZEktUcRa4Y', '2023-03-08 16:19:28', '2023-03-08 16:19:28'),
(100, 'user_token', 1, 't0Kgi7Hc1ds4dFwb8vS54OeF6aR7FHVeTcg7tc3FQBI5O', '2023-03-09 04:57:50', '2023-03-09 04:57:50');

-- --------------------------------------------------------

--
-- Structure de la table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', NULL, NULL),
(2, 'Entrepreneur', NULL, NULL),
(3, 'Producteur', NULL, NULL),
(4, 'Financier', NULL, NULL),
(5, 'Comptable', NULL, NULL),
(6, 'Vendeur', '2023-01-25 15:04:30', '2023-01-25 15:04:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autre_recettes`
--
ALTER TABLE `autre_recettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bilan_classements`
--
ALTER TABLE `bilan_classements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bilan_configs`
--
ALTER TABLE `bilan_configs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classement_bilans`
--
ALTER TABLE `classement_bilans`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cout_productions`
--
ALTER TABLE `cout_productions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dettes`
--
ALTER TABLE `dettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emballages`
--
ALTER TABLE `emballages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emballage_casses`
--
ALTER TABLE `emballage_casses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emballage_comptables`
--
ALTER TABLE `emballage_comptables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emballage_production`
--
ALTER TABLE `emballage_production`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `justifications`
--
ALTER TABLE `justifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logistiques`
--
ALTER TABLE `logistiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere_comptables`
--
ALTER TABLE `matiere_comptables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere_production`
--
ALTER TABLE `matiere_production`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `plan_comptables`
--
ALTER TABLE `plan_comptables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `price_configs`
--
ALTER TABLE `price_configs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `production_emballage_quantities`
--
ALTER TABLE `production_emballage_quantities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `production_matiere_quantities`
--
ALTER TABLE `production_matiere_quantities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `production_provisoires`
--
ALTER TABLE `production_provisoires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_emballages`
--
ALTER TABLE `type_emballages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_matieres`
--
ALTER TABLE `type_matieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_recettes`
--
ALTER TABLE `type_recettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `autre_recettes`
--
ALTER TABLE `autre_recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `bilan_classements`
--
ALTER TABLE `bilan_classements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `bilan_configs`
--
ALTER TABLE `bilan_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `classement_bilans`
--
ALTER TABLE `classement_bilans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `cout_productions`
--
ALTER TABLE `cout_productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `dettes`
--
ALTER TABLE `dettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `emballages`
--
ALTER TABLE `emballages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `emballage_casses`
--
ALTER TABLE `emballage_casses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `emballage_comptables`
--
ALTER TABLE `emballage_comptables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `emballage_production`
--
ALTER TABLE `emballage_production`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `justifications`
--
ALTER TABLE `justifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `logistiques`
--
ALTER TABLE `logistiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `matiere_comptables`
--
ALTER TABLE `matiere_comptables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `matiere_production`
--
ALTER TABLE `matiere_production`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `plan_comptables`
--
ALTER TABLE `plan_comptables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `price_configs`
--
ALTER TABLE `price_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `production_emballage_quantities`
--
ALTER TABLE `production_emballage_quantities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `production_matiere_quantities`
--
ALTER TABLE `production_matiere_quantities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `production_provisoires`
--
ALTER TABLE `production_provisoires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `sorties`
--
ALTER TABLE `sorties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_emballages`
--
ALTER TABLE `type_emballages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_matieres`
--
ALTER TABLE `type_matieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_recettes`
--
ALTER TABLE `type_recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
