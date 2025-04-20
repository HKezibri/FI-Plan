-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 05:06 PM
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
-- Database: `financeplan`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `month`, `amount`, `created_at`) VALUES
(1, 1, '2025-04', 400.00, '2025-04-20 14:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('expense','income') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`) VALUES
(1, 'Logement', 'expense'),
(2, 'Alimentation', 'expense'),
(3, 'Transport', 'expense'),
(4, 'Loisirs', 'expense'),
(5, 'Abonnements', 'expense'),
(10, 'Alternance', 'income'),
(11, 'Job étudiant', 'income'),
(12, 'Virement', 'income'),
(13, 'Bourse', 'income'),
(14, 'Autre', 'income');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `message`, `created_at`) VALUES
(1, 'Suivez vos dépenses chaque semaine pour éviter les surprises.', '2025-04-19 15:19:31'),
(2, 'Préparez vos repas à la maison pour réduire les frais de restauration.', '2025-04-19 15:19:31'),
(3, 'Fixez un budget mensuel et respectez-le autant que possible.', '2025-04-19 15:19:31'),
(4, 'Évitez les achats impulsifs en prenant 24h avant de décider.', '2025-04-19 15:19:31'),
(5, 'Privilégiez les abonnements utiles et supprimez les superflus.', '2025-04-19 15:19:31'),
(6, 'Utilisez les transports en commun pour économiser sur l’essence.', '2025-04-19 15:19:31'),
(7, 'Planifiez vos dépenses importantes à l’avance.', '2025-04-19 15:19:31'),
(8, 'Économisez automatiquement une partie de vos revenus chaque mois.', '2025-04-19 15:19:31'),
(9, 'Utilisez une liste de courses pour éviter les achats non essentiels.', '2025-04-19 15:19:31'),
(10, 'Comparez les prix avant d’acheter pour trouver la meilleure offre.', '2025-04-19 15:19:31'),
(11, 'Achetez en promotion ou en gros pour réduire vos dépenses mensuelles.', '2025-04-19 15:19:31'),
(12, 'Consultez vos relevés bancaires régulièrement pour rester informé.', '2025-04-19 15:19:31'),
(13, 'Définissez des objectifs d’épargne à court et long terme.', '2025-04-19 15:19:31'),
(14, 'Utilisez des applications de gestion de budget pour garder le contrôle.', '2025-04-19 15:19:31'),
(15, 'Réfléchissez à deux fois avant de payer avec une carte de crédit.', '2025-04-19 15:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `category_name`, `type`, `amount`, `payment_method`, `comment`, `transaction_date`, `created_at`) VALUES
(5, 2, 'Transport', 'expense', 50.00, 'Carte bancaire', 'Carte Navigo', '2024-04-03', '2025-04-19 15:21:16'),
(6, 2, 'Alimentation', 'expense', 180.00, 'Espèces', 'Courses du mois', '2024-04-10', '2025-04-19 15:21:16'),
(7, 2, 'Job étudiant', 'income', 950.00, NULL, 'Salaire', '2024-04-01', '2025-04-19 15:21:16'),
(8, 3, 'Abonnements', 'expense', 30.00, 'Carte bancaire', 'Netflix + Spotify', '2024-04-02', '2025-04-19 15:21:16'),
(9, 3, 'Bourse', 'income', 500.00, NULL, 'Bourse avril', '2024-04-01', '2025-04-19 15:21:16'),
(10, 3, 'Loisirs', 'expense', 75.00, 'Espèces', 'Shopping', '2024-04-18', '2025-04-19 15:21:16'),
(11, 3, 'Alimentation', 'expense', 90.00, 'Carte bancaire', 'Courses week-end', '2024-04-08', '2025-04-19 15:21:16'),
(12, 3, 'Autre', 'income', 200.00, NULL, 'Aide parentale', '2024-04-15', '2025-04-19 15:21:16'),
(22, 1, 'Alimentation', 'expense', 100.00, 'Carte bancaire', '', '2025-04-19', '2025-04-20 14:50:08'),
(23, 1, 'Logement', 'expense', 200.00, 'Carte bancaire', '', '2025-04-16', '2025-04-20 14:51:02'),
(24, 1, 'Job étudiant', 'income', 250.00, NULL, '', '2025-04-13', '2025-04-20 14:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `avatar`, `created_at`) VALUES
(1, 'Alice Dupont', 'alice@example.com', 'hashed_password_1', 'user', NULL, '2025-04-19 15:21:16'),
(2, 'Jean Morel', 'jean@example.com', 'hashed_password_2', 'user', NULL, '2025-04-19 15:21:16'),
(3, 'Sophie Lambert', 'sophie@example.com', 'hashed_password_3', 'user', NULL, '2025-04-19 15:21:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_budget` (`user_id`,`month`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_transaction_date` (`transaction_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
