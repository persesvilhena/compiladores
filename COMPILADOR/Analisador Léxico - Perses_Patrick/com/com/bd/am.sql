-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Abr-2018 às 22:56
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `am`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `gulosa`
--

CREATE TABLE `gulosa` (
  `id` int(11) NOT NULL,
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gulosa`
--

INSERT INTO `gulosa` (`id`, `json`) VALUES
(1, '{\"nodes\":[{\"id\":0,\"group\":1},{\"id\":1,\"group\":1},{\"id\":2,\"group\":2},{\"id\":3,\"group\":1},{\"id\":4,\"group\":2}],\"links\":[{\"source\":0,\"target\":1,\"value\":1},{\"source\":0,\"target\":2,\"value\":1},{\"source\":1,\"target\":0,\"value\":1},{\"source\":1,\"target\":3,\"value\":1},{\"source\":1,\"target\":2,\"value\":1},{\"source\":2,\"target\":1,\"value\":1},{\"source\":2,\"target\":3,\"value\":1},{\"source\":2,\"target\":0,\"value\":1},{\"source\":2,\"target\":4,\"value\":1},{\"source\":3,\"target\":1,\"value\":1},{\"source\":3,\"target\":2,\"value\":1},{\"source\":3,\"target\":4,\"value\":1},{\"source\":4,\"target\":2,\"value\":1},{\"source\":4,\"target\":3,\"value\":1}]}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `iris`
--

CREATE TABLE `iris` (
  `sepal_length` varchar(12) DEFAULT NULL,
  `sepal_width` varchar(11) DEFAULT NULL,
  `petal_length` varchar(12) DEFAULT NULL,
  `petal_width` varchar(11) DEFAULT NULL,
  `species` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `iris`
--

INSERT INTO `iris` (`sepal_length`, `sepal_width`, `petal_length`, `petal_width`, `species`) VALUES
('5.1', '3.5', '1.4', '0.2', 'Iris-setosa'),
('4.9', '3.0', '1.4', '0.2', 'Iris-setosa'),
('4.7', '3.2', '1.3', '0.2', 'Iris-setosa'),
('4.6', '3.1', '1.5', '0.2', 'Iris-setosa'),
('5.0', '3.6', '1.4', '0.2', 'Iris-setosa'),
('5.4', '3.9', '1.7', '0.4', 'Iris-setosa'),
('4.6', '3.4', '1.4', '0.3', 'Iris-setosa'),
('5.0', '3.4', '1.5', '0.2', 'Iris-setosa'),
('4.4', '2.9', '1.4', '0.2', 'Iris-setosa'),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa'),
('5.4', '3.7', '1.5', '0.2', 'Iris-setosa'),
('4.8', '3.4', '1.6', '0.2', 'Iris-setosa'),
('4.8', '3.0', '1.4', '0.1', 'Iris-setosa'),
('4.3', '3.0', '1.1', '0.1', 'Iris-setosa'),
('5.8', '4.0', '1.2', '0.2', 'Iris-setosa'),
('5.7', '4.4', '1.5', '0.4', 'Iris-setosa'),
('5.4', '3.9', '1.3', '0.4', 'Iris-setosa'),
('5.1', '3.5', '1.4', '0.3', 'Iris-setosa'),
('5.7', '3.8', '1.7', '0.3', 'Iris-setosa'),
('5.1', '3.8', '1.5', '0.3', 'Iris-setosa'),
('5.4', '3.4', '1.7', '0.2', 'Iris-setosa'),
('5.1', '3.7', '1.5', '0.4', 'Iris-setosa'),
('4.6', '3.6', '1.0', '0.2', 'Iris-setosa'),
('5.1', '3.3', '1.7', '0.5', 'Iris-setosa'),
('4.8', '3.4', '1.9', '0.2', 'Iris-setosa'),
('5.0', '3.0', '1.6', '0.2', 'Iris-setosa'),
('5.0', '3.4', '1.6', '0.4', 'Iris-setosa'),
('5.2', '3.5', '1.5', '0.2', 'Iris-setosa'),
('5.2', '3.4', '1.4', '0.2', 'Iris-setosa'),
('4.7', '3.2', '1.6', '0.2', 'Iris-setosa'),
('4.8', '3.1', '1.6', '0.2', 'Iris-setosa'),
('5.4', '3.4', '1.5', '0.4', 'Iris-setosa'),
('5.2', '4.1', '1.5', '0.1', 'Iris-setosa'),
('5.5', '4.2', '1.4', '0.2', 'Iris-setosa'),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa'),
('5.0', '3.2', '1.2', '0.2', 'Iris-setosa'),
('5.5', '3.5', '1.3', '0.2', 'Iris-setosa'),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa'),
('4.4', '3.0', '1.3', '0.2', 'Iris-setosa'),
('5.1', '3.4', '1.5', '0.2', 'Iris-setosa'),
('5.0', '3.5', '1.3', '0.3', 'Iris-setosa'),
('4.5', '2.3', '1.3', '0.3', 'Iris-setosa'),
('4.4', '3.2', '1.3', '0.2', 'Iris-setosa'),
('5.0', '3.5', '1.6', '0.6', 'Iris-setosa'),
('5.1', '3.8', '1.9', '0.4', 'Iris-setosa'),
('4.8', '3.0', '1.4', '0.3', 'Iris-setosa'),
('5.1', '3.8', '1.6', '0.2', 'Iris-setosa'),
('4.6', '3.2', '1.4', '0.2', 'Iris-setosa'),
('5.3', '3.7', '1.5', '0.2', 'Iris-setosa'),
('5.0', '3.3', '1.4', '0.2', 'Iris-setosa'),
('7.0', '3.2', '4.7', '1.4', 'Iris-versicolor'),
('6.4', '3.2', '4.5', '1.5', 'Iris-versicolor'),
('6.9', '3.1', '4.9', '1.5', 'Iris-versicolor'),
('5.5', '2.3', '4.0', '1.3', 'Iris-versicolor'),
('6.5', '2.8', '4.6', '1.5', 'Iris-versicolor'),
('5.7', '2.8', '4.5', '1.3', 'Iris-versicolor'),
('6.3', '3.3', '4.7', '1.6', 'Iris-versicolor'),
('4.9', '2.4', '3.3', '1.0', 'Iris-versicolor'),
('6.6', '2.9', '4.6', '1.3', 'Iris-versicolor'),
('5.2', '2.7', '3.9', '1.4', 'Iris-versicolor'),
('5.0', '2.0', '3.5', '1.0', 'Iris-versicolor'),
('5.9', '3.0', '4.2', '1.5', 'Iris-versicolor'),
('6.0', '2.2', '4.0', '1.0', 'Iris-versicolor'),
('6.1', '2.9', '4.7', '1.4', 'Iris-versicolor'),
('5.6', '2.9', '3.6', '1.3', 'Iris-versicolor'),
('6.7', '3.1', '4.4', '1.4', 'Iris-versicolor'),
('5.6', '3.0', '4.5', '1.5', 'Iris-versicolor'),
('5.8', '2.7', '4.1', '1.0', 'Iris-versicolor'),
('6.2', '2.2', '4.5', '1.5', 'Iris-versicolor'),
('5.6', '2.5', '3.9', '1.1', 'Iris-versicolor'),
('5.9', '3.2', '4.8', '1.8', 'Iris-versicolor'),
('6.1', '2.8', '4.0', '1.3', 'Iris-versicolor'),
('6.3', '2.5', '4.9', '1.5', 'Iris-versicolor'),
('6.1', '2.8', '4.7', '1.2', 'Iris-versicolor'),
('6.4', '2.9', '4.3', '1.3', 'Iris-versicolor'),
('6.6', '3.0', '4.4', '1.4', 'Iris-versicolor'),
('6.8', '2.8', '4.8', '1.4', 'Iris-versicolor'),
('6.7', '3.0', '5.0', '1.7', 'Iris-versicolor'),
('6.0', '2.9', '4.5', '1.5', 'Iris-versicolor'),
('5.7', '2.6', '3.5', '1.0', 'Iris-versicolor'),
('5.5', '2.4', '3.8', '1.1', 'Iris-versicolor'),
('5.5', '2.4', '3.7', '1.0', 'Iris-versicolor'),
('5.8', '2.7', '3.9', '1.2', 'Iris-versicolor'),
('6.0', '2.7', '5.1', '1.6', 'Iris-versicolor'),
('5.4', '3.0', '4.5', '1.5', 'Iris-versicolor'),
('6.0', '3.4', '4.5', '1.6', 'Iris-versicolor'),
('6.7', '3.1', '4.7', '1.5', 'Iris-versicolor'),
('6.3', '2.3', '4.4', '1.3', 'Iris-versicolor'),
('5.6', '3.0', '4.1', '1.3', 'Iris-versicolor'),
('5.5', '2.5', '4.0', '1.3', 'Iris-versicolor'),
('5.5', '2.6', '4.4', '1.2', 'Iris-versicolor'),
('6.1', '3.0', '4.6', '1.4', 'Iris-versicolor'),
('5.8', '2.6', '4.0', '1.2', 'Iris-versicolor'),
('5.0', '2.3', '3.3', '1.0', 'Iris-versicolor'),
('5.6', '2.7', '4.2', '1.3', 'Iris-versicolor'),
('5.7', '3.0', '4.2', '1.2', 'Iris-versicolor'),
('5.7', '2.9', '4.2', '1.3', 'Iris-versicolor'),
('6.2', '2.9', '4.3', '1.3', 'Iris-versicolor'),
('5.1', '2.5', '3.0', '1.1', 'Iris-versicolor'),
('5.7', '2.8', '4.1', '1.3', 'Iris-versicolor'),
('6.3', '3.3', '6.0', '2.5', 'Iris-virginica'),
('5.8', '2.7', '5.1', '1.9', 'Iris-virginica'),
('7.1', '3.0', '5.9', '2.1', 'Iris-virginica'),
('6.3', '2.9', '5.6', '1.8', 'Iris-virginica'),
('6.5', '3.0', '5.8', '2.2', 'Iris-virginica'),
('7.6', '3.0', '6.6', '2.1', 'Iris-virginica'),
('4.9', '2.5', '4.5', '1.7', 'Iris-virginica'),
('7.3', '2.9', '6.3', '1.8', 'Iris-virginica'),
('6.7', '2.5', '5.8', '1.8', 'Iris-virginica'),
('7.2', '3.6', '6.1', '2.5', 'Iris-virginica'),
('6.5', '3.2', '5.1', '2.0', 'Iris-virginica'),
('6.4', '2.7', '5.3', '1.9', 'Iris-virginica'),
('6.8', '3.0', '5.5', '2.1', 'Iris-virginica'),
('5.7', '2.5', '5.0', '2.0', 'Iris-virginica'),
('5.8', '2.8', '5.1', '2.4', 'Iris-virginica'),
('6.4', '3.2', '5.3', '2.3', 'Iris-virginica'),
('6.5', '3.0', '5.5', '1.8', 'Iris-virginica'),
('7.7', '3.8', '6.7', '2.2', 'Iris-virginica'),
('7.7', '2.6', '6.9', '2.3', 'Iris-virginica'),
('6.0', '2.2', '5.0', '1.5', 'Iris-virginica'),
('6.9', '3.2', '5.7', '2.3', 'Iris-virginica'),
('5.6', '2.8', '4.9', '2.0', 'Iris-virginica'),
('7.7', '2.8', '6.7', '2.0', 'Iris-virginica'),
('6.3', '2.7', '4.9', '1.8', 'Iris-virginica'),
('6.7', '3.3', '5.7', '2.1', 'Iris-virginica'),
('7.2', '3.2', '6.0', '1.8', 'Iris-virginica'),
('6.2', '2.8', '4.8', '1.8', 'Iris-virginica'),
('6.1', '3.0', '4.9', '1.8', 'Iris-virginica'),
('6.4', '2.8', '5.6', '2.1', 'Iris-virginica'),
('7.2', '3.0', '5.8', '1.6', 'Iris-virginica'),
('7.4', '2.8', '6.1', '1.9', 'Iris-virginica'),
('7.9', '3.8', '6.4', '2.0', 'Iris-virginica'),
('6.4', '2.8', '5.6', '2.2', 'Iris-virginica'),
('6.3', '2.8', '5.1', '1.5', 'Iris-virginica'),
('6.1', '2.6', '5.6', '1.4', 'Iris-virginica'),
('7.7', '3.0', '6.1', '2.3', 'Iris-virginica'),
('6.3', '3.4', '5.6', '2.4', 'Iris-virginica'),
('6.4', '3.1', '5.5', '1.8', 'Iris-virginica'),
('6.0', '3.0', '4.8', '1.8', 'Iris-virginica'),
('6.9', '3.1', '5.4', '2.1', 'Iris-virginica'),
('6.7', '3.1', '5.6', '2.4', 'Iris-virginica'),
('6.9', '3.1', '5.1', '2.3', 'Iris-virginica'),
('5.8', '2.7', '5.1', '1.9', 'Iris-virginica'),
('6.8', '3.2', '5.9', '2.3', 'Iris-virginica'),
('6.7', '3.3', '5.7', '2.5', 'Iris-virginica'),
('6.7', '3.0', '5.2', '2.3', 'Iris-virginica'),
('6.3', '2.5', '5.0', '1.9', 'Iris-virginica'),
('6.5', '3.0', '5.2', '2.0', 'Iris-virginica'),
('6.2', '3.4', '5.4', '2.3', 'Iris-virginica'),
('5.9', '3.0', '5.1', '1.8', 'Iris-virginica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `iris2`
--

CREATE TABLE `iris2` (
  `sepal_length` varchar(12) DEFAULT NULL,
  `sepal_width` varchar(11) DEFAULT NULL,
  `petal_length` varchar(12) DEFAULT NULL,
  `petal_width` varchar(11) DEFAULT NULL,
  `species` varchar(15) DEFAULT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `iris2`
--

INSERT INTO `iris2` (`sepal_length`, `sepal_width`, `petal_length`, `petal_width`, `species`, `d`) VALUES
('5.1', '3.5', '1.4', '0.2', 'Iris-setosa', 1),
('4.9', '3.0', '1.4', '0.2', 'Iris-setosa', 1),
('4.7', '3.2', '1.3', '0.2', 'Iris-setosa', 1),
('4.6', '3.1', '1.5', '0.2', 'Iris-setosa', 1),
('5.0', '3.6', '1.4', '0.2', 'Iris-setosa', 1),
('5.4', '3.9', '1.7', '0.4', 'Iris-setosa', 1),
('4.6', '3.4', '1.4', '0.3', 'Iris-setosa', 1),
('5.0', '3.4', '1.5', '0.2', 'Iris-setosa', 1),
('4.4', '2.9', '1.4', '0.2', 'Iris-setosa', 1),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa', 1),
('5.4', '3.7', '1.5', '0.2', 'Iris-setosa', 1),
('4.8', '3.4', '1.6', '0.2', 'Iris-setosa', 1),
('4.8', '3.0', '1.4', '0.1', 'Iris-setosa', 1),
('4.3', '3.0', '1.1', '0.1', 'Iris-setosa', 1),
('5.8', '4.0', '1.2', '0.2', 'Iris-setosa', 1),
('5.7', '4.4', '1.5', '0.4', 'Iris-setosa', 1),
('5.4', '3.9', '1.3', '0.4', 'Iris-setosa', 1),
('5.1', '3.5', '1.4', '0.3', 'Iris-setosa', 1),
('5.7', '3.8', '1.7', '0.3', 'Iris-setosa', 1),
('5.1', '3.8', '1.5', '0.3', 'Iris-setosa', 1),
('5.4', '3.4', '1.7', '0.2', 'Iris-setosa', 1),
('5.1', '3.7', '1.5', '0.4', 'Iris-setosa', 1),
('4.6', '3.6', '1.0', '0.2', 'Iris-setosa', 1),
('5.1', '3.3', '1.7', '0.5', 'Iris-setosa', 1),
('4.8', '3.4', '1.9', '0.2', 'Iris-setosa', 1),
('5.0', '3.0', '1.6', '0.2', 'Iris-setosa', 1),
('5.0', '3.4', '1.6', '0.4', 'Iris-setosa', 1),
('5.2', '3.5', '1.5', '0.2', 'Iris-setosa', 1),
('5.2', '3.4', '1.4', '0.2', 'Iris-setosa', 1),
('4.7', '3.2', '1.6', '0.2', 'Iris-setosa', 1),
('4.8', '3.1', '1.6', '0.2', 'Iris-setosa', 1),
('5.4', '3.4', '1.5', '0.4', 'Iris-setosa', 1),
('5.2', '4.1', '1.5', '0.1', 'Iris-setosa', 1),
('5.5', '4.2', '1.4', '0.2', 'Iris-setosa', 1),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa', 1),
('5.0', '3.2', '1.2', '0.2', 'Iris-setosa', 1),
('5.5', '3.5', '1.3', '0.2', 'Iris-setosa', 1),
('4.9', '3.1', '1.5', '0.1', 'Iris-setosa', 1),
('4.4', '3.0', '1.3', '0.2', 'Iris-setosa', 1),
('5.1', '3.4', '1.5', '0.2', 'Iris-setosa', 1),
('5.0', '3.5', '1.3', '0.3', 'Iris-setosa', 1),
('4.5', '2.3', '1.3', '0.3', 'Iris-setosa', 1),
('4.4', '3.2', '1.3', '0.2', 'Iris-setosa', 1),
('5.0', '3.5', '1.6', '0.6', 'Iris-setosa', 1),
('5.1', '3.8', '1.9', '0.4', 'Iris-setosa', 1),
('4.8', '3.0', '1.4', '0.3', 'Iris-setosa', 1),
('5.1', '3.8', '1.6', '0.2', 'Iris-setosa', 1),
('4.6', '3.2', '1.4', '0.2', 'Iris-setosa', 1),
('5.3', '3.7', '1.5', '0.2', 'Iris-setosa', 1),
('5.0', '3.3', '1.4', '0.2', 'Iris-setosa', 1),
('6.3', '3.3', '6.0', '2.5', 'Iris-virginica', -1),
('5.8', '2.7', '5.1', '1.9', 'Iris-virginica', -1),
('7.1', '3.0', '5.9', '2.1', 'Iris-virginica', -1),
('6.3', '2.9', '5.6', '1.8', 'Iris-virginica', -1),
('6.5', '3.0', '5.8', '2.2', 'Iris-virginica', -1),
('7.6', '3.0', '6.6', '2.1', 'Iris-virginica', -1),
('4.9', '2.5', '4.5', '1.7', 'Iris-virginica', -1),
('7.3', '2.9', '6.3', '1.8', 'Iris-virginica', -1),
('6.7', '2.5', '5.8', '1.8', 'Iris-virginica', -1),
('7.2', '3.6', '6.1', '2.5', 'Iris-virginica', -1),
('6.5', '3.2', '5.1', '2.0', 'Iris-virginica', -1),
('6.4', '2.7', '5.3', '1.9', 'Iris-virginica', -1),
('6.8', '3.0', '5.5', '2.1', 'Iris-virginica', -1),
('5.7', '2.5', '5.0', '2.0', 'Iris-virginica', -1),
('5.8', '2.8', '5.1', '2.4', 'Iris-virginica', -1),
('6.4', '3.2', '5.3', '2.3', 'Iris-virginica', -1),
('6.5', '3.0', '5.5', '1.8', 'Iris-virginica', -1),
('7.7', '3.8', '6.7', '2.2', 'Iris-virginica', -1),
('7.7', '2.6', '6.9', '2.3', 'Iris-virginica', -1),
('6.0', '2.2', '5.0', '1.5', 'Iris-virginica', -1),
('6.9', '3.2', '5.7', '2.3', 'Iris-virginica', -1),
('5.6', '2.8', '4.9', '2.0', 'Iris-virginica', -1),
('7.7', '2.8', '6.7', '2.0', 'Iris-virginica', -1),
('6.3', '2.7', '4.9', '1.8', 'Iris-virginica', -1),
('6.7', '3.3', '5.7', '2.1', 'Iris-virginica', -1),
('7.2', '3.2', '6.0', '1.8', 'Iris-virginica', -1),
('6.2', '2.8', '4.8', '1.8', 'Iris-virginica', -1),
('6.1', '3.0', '4.9', '1.8', 'Iris-virginica', -1),
('6.4', '2.8', '5.6', '2.1', 'Iris-virginica', -1),
('7.2', '3.0', '5.8', '1.6', 'Iris-virginica', -1),
('7.4', '2.8', '6.1', '1.9', 'Iris-virginica', -1),
('7.9', '3.8', '6.4', '2.0', 'Iris-virginica', -1),
('6.4', '2.8', '5.6', '2.2', 'Iris-virginica', -1),
('6.3', '2.8', '5.1', '1.5', 'Iris-virginica', -1),
('6.1', '2.6', '5.6', '1.4', 'Iris-virginica', -1),
('7.7', '3.0', '6.1', '2.3', 'Iris-virginica', -1),
('6.3', '3.4', '5.6', '2.4', 'Iris-virginica', -1),
('6.4', '3.1', '5.5', '1.8', 'Iris-virginica', -1),
('6.0', '3.0', '4.8', '1.8', 'Iris-virginica', -1),
('6.9', '3.1', '5.4', '2.1', 'Iris-virginica', -1),
('6.7', '3.1', '5.6', '2.4', 'Iris-virginica', -1),
('6.9', '3.1', '5.1', '2.3', 'Iris-virginica', -1),
('5.8', '2.7', '5.1', '1.9', 'Iris-virginica', -1),
('6.8', '3.2', '5.9', '2.3', 'Iris-virginica', -1),
('6.7', '3.3', '5.7', '2.5', 'Iris-virginica', -1),
('6.7', '3.0', '5.2', '2.3', 'Iris-virginica', -1),
('6.3', '2.5', '5.0', '1.9', 'Iris-virginica', -1),
('6.5', '3.0', '5.2', '2.0', 'Iris-virginica', -1),
('6.2', '3.4', '5.4', '2.3', 'Iris-virginica', -1),
('5.9', '3.0', '5.1', '1.8', 'Iris-virginica', -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gulosa`
--
ALTER TABLE `gulosa`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
