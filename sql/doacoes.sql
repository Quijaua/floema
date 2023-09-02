-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Ago-2023 às 06:26
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
-- Banco de dados: `doacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_checkout`
--

CREATE TABLE `tb_checkout` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `privacidade` varchar(255) NOT NULL,
  `faq` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `cep` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `hover` varchar(255) NOT NULL,
  `progress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_checkout`
--

INSERT INTO `tb_checkout` (`id`, `nome`, `logo`, `title`, `descricao`, `privacidade`, `faq`, `facebook`, `instagram`, `linkedin`, `youtube`, `website`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `telefone`, `email`, `color`, `hover`, `progress`) VALUES
(1, 'Floema', 'floema-logo.png', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus tortor nec gravida pretium. Vestibulum ipsum diam, lacinia a est sit amet, tempor elementum odio. Phasellus vel eros sit amet dolor mollis ultricies id eu lectus. Nunc mattis magna id augue malesuada luctus. Donec sit amet diam id diam interdum sollicitudin.', 'https://seusite.com.br/politica-de-privacidade/', 'https://seusite.com.br/perguntas-frequentes/', 'https://facebook.com/seufacebook', 'https://facebook.com/seuinstagram', NULL, NULL, NULL, '11111-222', 'Rua Exemplo Nome da Rua', '999', 'Centro', 'São Paulo', 'SP', '(11) 9999-9999', 'suainstitucao@email.org.br', '#ffc107', '#212529', '0, 204, 255');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL,
  `roles` tinyint(1) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `recup_password` varchar(255) DEFAULT NULL,
  `magic_link` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `cep` char(10) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(255) DEFAULT NULL,
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
-- Estrutura da tabela `tb_imagens`
--

CREATE TABLE `tb_imagens` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_imagens`
--

INSERT INTO `tb_imagens` (`id`, `imagem`) VALUES
(11, '1691640386.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_checkout`
--
ALTER TABLE `tb_checkout`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `tb_imagens`
--
ALTER TABLE `tb_imagens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_checkout`
--
ALTER TABLE `tb_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT de tabela `tb_imagens`
--
ALTER TABLE `tb_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
