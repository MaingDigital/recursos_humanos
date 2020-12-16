-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Dez-2020 às 22:53
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome_cargo` varchar(100) NOT NULL,
  `descricao_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `num_funcionario` varchar(10) DEFAULT NULL,
  `nome_funcionario` varchar(100) NOT NULL,
  `local_nasimento` varchar(100) DEFAULT NULL,
  `data_nascimento` varchar(100) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `morada` varchar(100) NOT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `movel` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bilhete` varchar(15) NOT NULL,
  `data_validade` date DEFAULT NULL,
  `nif` varchar(15) NOT NULL,
  `nss` varchar(15) NOT NULL,
  `grau` varchar(50) DEFAULT NULL,
  `entidade_formadora` varchar(100) DEFAULT NULL,
  `nome_banco` varchar(100) DEFAULT NULL,
  `num_conta` varchar(100) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `tipo_contrato` varchar(20) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `cargo` varchar(50) NOT NULL,
  `salario_base` varchar(50) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `num_funcionario`, `nome_funcionario`, `local_nasimento`, `data_nascimento`, `sexo`, `morada`, `cidade`, `estado_civil`, `telefone`, `movel`, `email`, `bilhete`, `data_validade`, `nif`, `nss`, `grau`, `entidade_formadora`, `nome_banco`, `num_conta`, `iban`, `tipo_contrato`, `data_admissao`, `departamento`, `cargo`, `salario_base`, `turno`) VALUES
(1, 'DZE2735460', 'Dialungana Paulo de Oliveira', NULL, NULL, NULL, 'Rua Joaquim Rocha Cabral 22', NULL, NULL, NULL, '924533000', 'dpaulo24@hotmail.com', '000123928LA029', NULL, '000123928LA029', '000123928LA029', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrador', NULL, NULL),
(2, 'IDT6147830', 'Vivalda Maingue Afonso Pedro de Oliveira', NULL, NULL, NULL, 'Rua Joaquim Rocha Cabral 22', NULL, NULL, NULL, '924533000', 'vivaldaoliveira@hotmail.com', '000123928LA030', NULL, '000123928LA030', '000123928LA030', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrador', NULL, NULL),
(3, 'AIH3927548', 'Dialungana Oliveira', NULL, NULL, NULL, 'R. Joaquim Rocha Cabral 22, 2ºDT', NULL, NULL, NULL, '911000001', 'dioliveira@portalbanda.com', '00192022020', NULL, '00192022020', '00192022020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nif` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `nif`, `email`, `senha`, `nivel`) VALUES
(1, 'Paulo Oliveira', '0000000', 'geral@maisrh.com', '123', 'Administrador'),
(2, 'Dialungana Paulo de Oliveira', '000123928LA029', 'dpaulo24@hotmail.com', 'DZE273546089', 'Administrador'),
(3, 'Vivalda Maingue Afonso Pedro de Oliveira', '000123928LA030', 'vivaldaoliveira@hotmail.com', 'IDT614783052', 'Administrador'),
(4, 'Dialungana Oliveira', '00192022020', 'dioliveira@portalbanda.com', 'AIH392754860', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
