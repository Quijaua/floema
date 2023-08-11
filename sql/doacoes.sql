-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Ago-2023 às 07:17
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
-- Estrutura da tabela `tb_cards`
--

CREATE TABLE `tb_cards` (
  `id` int(11) NOT NULL,
  `icone` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cards`
--

INSERT INTO `tb_cards` (`id`, `icone`, `titulo`, `descricao`) VALUES
(1, '1691640386.png', 'Transformamos', 'vidas através da educação');

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
  `titulo` varchar(255) NOT NULL,
  `conteudo` varchar(255) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `privacidade` varchar(255) NOT NULL,
  `faq` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `cor_primaria` varchar(255) NOT NULL,
  `cor_secundaria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_checkout`
--

INSERT INTO `tb_checkout` (`id`, `nome`, `logo`, `title`, `descricao`, `titulo`, `conteudo`, `razao_social`, `privacidade`, `faq`, `contato`, `cor_primaria`, `cor_secundaria`) VALUES
(1, 'Floema', 'disu.png', 'Ajude o Intercept Brasil | The Intercept Brasil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec ultricies ipsum. In rhoncus vestibulum mi, ac lobortis velit finibus porta. Proin venenatis mollis metus sed dictum. Sed egestas elit non justo accumsan porttitor. Nam vitae feugiat urna. Phasellus maximus mauris non purus varius tincidunt. Donec ultricies mauris in lacus commodo, sed dictum lorem lacinia. Aliquam tortor mauris, auctor vel arcu quis, consequat lacinia enim. ', 'Grupo fechado', 'Precisamos de você para seguir independentes e fortes. Faça acontecer agora o jornalismo que muda vidas. Apoie o jornalismo dedo na ferida do TIB!', 'First Look Media Brasil Agência de Notícias, Ltda', 'https://seusite.com.br/politica-de-privacidade/', 'https://seusite.com.br/perguntas-frequentes/', 'suainstitucao@email.org.br', '#f6a026', '#101010');

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
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_cards`
--
ALTER TABLE `tb_cards`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `tb_parametros`
--
ALTER TABLE `tb_parametros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cards`
--
ALTER TABLE `tb_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT de tabela `tb_parametros`
--
ALTER TABLE `tb_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
