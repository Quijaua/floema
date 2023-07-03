-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jun-2023 às 20:32
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sw_clientes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `cep` char(10) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(255) NOT NULL,
  `asaas_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_doacoes`
--

CREATE TABLE `tb_doacoes` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `payment_id` varchar(100) NOT NULL,
  `cycle` varchar(20) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `forma_pagamento` varchar(50) NOT NULL,
  `link_pagamento` longtext DEFAULT NULL,
  `link_boleto` longtext DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `data_vencimento` date DEFAULT NULL,
  `data_criacao` date NOT NULL DEFAULT curdate(),
  `data_pagamento` date DEFAULT NULL,
  `pix_encodedImage` longtext DEFAULT NULL,
  `pix_payload` longtext DEFAULT NULL,
  `pix_expirationDate` datetime DEFAULT NULL,
  `boleto_barCode` varchar(255) DEFAULT NULL,
  `boleto_nossoNumero` varchar(255) DEFAULT NULL,
  `boleto_identificationField` varchar(255) DEFAULT NULL,
  `cartao_numero` int(4) DEFAULT NULL,
  `cartao_bandeira` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_parametros`
--

CREATE TABLE `tb_parametros` (
  `id` int(11) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_parametros`
--

INSERT INTO `tb_parametros` (`id`, `chave`, `valor`) VALUES
(1, 'asaas_api_key', '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTczMDU6OiRhYWNoXzUwNDliOTg5LTUxZGItNDRmZS1hNDcwLTljOGJmODdmOWYxOQ=='),
(2, 'asaas_api_url', 'https://sandbox.asaas.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_doacoes`
--
ALTER TABLE `tb_doacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_parametros`
--
ALTER TABLE `tb_parametros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_doacoes`
--
ALTER TABLE `tb_doacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_parametros`
--
ALTER TABLE `tb_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
