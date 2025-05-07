-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Ago-2023 às 09:32
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `home_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `nome`, `email`, `number`, `message`) VALUES
('iJbqUVzNtydHIdhhLADZ', 'virgilio', 'virgilio@gmail.com', '872282214', 'Como faco para obter o imovel?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `property`
--

CREATE TABLE `property` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `nome_imovel` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `localizacao` varchar(50) NOT NULL,
  `tipo_de_imovel` varchar(20) NOT NULL,
  `service` varchar(20) NOT NULL,
  `quartos` varchar(10) NOT NULL,
  `banheiros` varchar(10) NOT NULL,
  `garragem` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `varanda` varchar(3) NOT NULL,
  `terraco` varchar(3) NOT NULL,
  `escritorio` varchar(3) NOT NULL,
  `piscina` varchar(3) NOT NULL,
  `churrasqueira` varchar(3) NOT NULL,
  `salao_de_festas` varchar(3) NOT NULL,
  `img1` varchar(50) NOT NULL,
  `img2` varchar(50) NOT NULL,
  `img3` varchar(50) NOT NULL,
  `img4` varchar(50) NOT NULL,
  `img5` varchar(50) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `property`
--

INSERT INTO `property` (`id`, `user_id`, `nome_imovel`, `preco`, `tamanho`, `localizacao`, `tipo_de_imovel`, `service`, `quartos`, `banheiros`, `garragem`, `status`, `descricao`, `varanda`, `terraco`, `escritorio`, `piscina`, `churrasqueira`, `salao_de_festas`, `img1`, `img2`, `img3`, `img4`, `img5`, `data`) VALUES
('aAoIGqfOwKw2BdCsDIEK', 'gCtm7L7IhKaLPky9P3G0', 'Casa em aluguer', '9500', '700 a 1500', 'Quelimane, bairro sampene', 'casa', 'alugar', '4', '2', '1', 'disponivel', 'A bom preco', 'no', 'no', 'yes', 'no', 'yes', 'no', 'Y6BP6etlHvAcEroqkk8e.jpg', 'jqrqGMBMPrqP2XOqYhCt.jpg', '6k3LaOoKi7Fanw18qyfb.jpg', 'wLyySg2O3e3lfmZgnCCC.jpg', 'ZK7nE7FhsXEKrbFde45B.jpg', '2023-08-01'),
('mHnJYTeDVn4SjY9rmcS5', 'gCtm7L7IhKaLPky9P3G0', 'Casa a venda', '10000000', '700 a 1500', 'Quelimane, bairro sagrada', 'casa', 'vender', '5', '4', '2', 'disponivel', 'acessivel', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '0j2hxhxNsvgM1r5bZTFK.jpg', '7YkA3t5wOX6hjMydw2Wx.jpg', 'B9ZoV7N7DeFPAw49is9d.png', '8WDu4eKUUmOy5KDjVwKt.jpg', 'TxmHoJNe2ZMpPKhr9r7V.jpg', '2023-08-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requests`
--

CREATE TABLE `requests` (
  `id` varchar(20) NOT NULL,
  `property_id` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `requests`
--

INSERT INTO `requests` (`id`, `property_id`, `sender`, `receiver`, `data`) VALUES
('ZynAJb5tBcPzOjoycKSh', 'mHnJYTeDVn4SjY9rmcS5', 'gCtm7L7IhKaLPky9P3G0', 'gCtm7L7IhKaLPky9P3G0', '2023-08-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `saved`
--

CREATE TABLE `saved` (
  `id` varchar(20) NOT NULL,
  `property_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `saved`
--

INSERT INTO `saved` (`id`, `property_id`, `user_id`) VALUES
('Ui6S1w7ACY0YPeItmNsM', 'aAoIGqfOwKw2BdCsDIEK', 'gCtm7L7IhKaLPky9P3G0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `number`, `email`, `password`) VALUES
('gCtm7L7IhKaLPky9P3G0', 'userA', '842108471', 'vir@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('KmJGZtDnzG80MANmU2vy', 'Eduardo', '866027677', 'edu@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('77jqcpvIudlvhHPDrzLL', 'Bruno', '842108471', 'bruno@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
