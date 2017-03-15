-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2017 at 05:46 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazoncompanies`
--
CREATE DATABASE IF NOT EXISTS `amazoncompanies` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `amazoncompanies`;

-- --------------------------------------------------------

--
-- Table structure for table `analise`
--

CREATE TABLE `analise` (
  `idanalise` int(11) NOT NULL,
  `texto` text,
  `status` tinyint(4) NOT NULL,
  `ano` int(4) NOT NULL,
  `investidor` int(1) NOT NULL,
  `credor` int(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `Empresa_idEmpresa` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `Comentario_idComentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conta`
--

CREATE TABLE `conta` (
  `idConta` int(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idDemonstracao` int(11) NOT NULL,
  `chave` varchar(30) NOT NULL,
  `obrigatorio` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `formato` int(1) NOT NULL,
  `pai` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `demonstracao`
--

CREATE TABLE `demonstracao` (
  `idDemonstracao` int(11) NOT NULL,
  `nomeDemonstracao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `fonte` varchar(45) NOT NULL,
  `logotipo` varchar(200) DEFAULT NULL,
  `tipo` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empresahasusuario`
--

CREATE TABLE `empresahasusuario` (
  `Empresa_idEmpresa` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empresa_conta`
--

CREATE TABLE `empresa_conta` (
  `id` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idConta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `statusValidacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indice`
--

CREATE TABLE `indice` (
  `idIndice` int(11) NOT NULL,
  `formula` varchar(45) NOT NULL,
  `idTipo_Indice` int(11) NOT NULL,
  `nomeIndice` varchar(100) DEFAULT NULL,
  `formato` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notificacao`
--

CREATE TABLE `notificacao` (
  `idNotificacao` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `idAnalise` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rodape`
--

CREATE TABLE `rodape` (
  `id` int(11) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_empresa`
--

CREATE TABLE `tipo_empresa` (
  `Nome` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_indice`
--

CREATE TABLE `tipo_indice` (
  `idTipo_indice` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `identificadorPessoa` tinyint(1) NOT NULL,
  `email` varchar(45) NOT NULL,
  `matricula` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `nome`, `senha`, `ativo`, `identificadorPessoa`, `email`, `matricula`) VALUES
(1, 'admin', 'André', '25d55ad283aa400af464c76d713c07ad', 1, 1, 'andrecosta@ufam.edu.br', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analise`
--
ALTER TABLE `analise`
  ADD PRIMARY KEY (`idanalise`),
  ADD UNIQUE KEY `un_empresa_ano` (`idEmpresa`,`ano`),
  ADD KEY `fk_idUsuario` (`Usuario_idUsuario`) USING BTREE,
  ADD KEY `fk_analise_1_idx` (`idEmpresa`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `Comentario_idComentario` (`Comentario_idComentario`),
  ADD KEY `Empresa_idEmpresa` (`Empresa_idEmpresa`);

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`idConta`),
  ADD KEY `fkDemonstracao` (`idDemonstracao`);

--
-- Indexes for table `demonstracao`
--
ALTER TABLE `demonstracao`
  ADD PRIMARY KEY (`idDemonstracao`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `fkTipo` (`tipo`);

--
-- Indexes for table `empresahasusuario`
--
ALTER TABLE `empresahasusuario`
  ADD PRIMARY KEY (`Empresa_idEmpresa`,`Usuario_idUsuario`),
  ADD KEY `fk_Empresa_has_Usuario_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_Empresa_has_Usuario_Empresa1_idx` (`Empresa_idEmpresa`);

--
-- Indexes for table `empresa_conta`
--
ALTER TABLE `empresa_conta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueBalancete` (`idEmpresa`,`ano`,`idConta`),
  ADD KEY `fkIdConta` (`idConta`),
  ADD KEY `fkIdEmpresa` (`idEmpresa`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `indice`
--
ALTER TABLE `indice`
  ADD PRIMARY KEY (`idIndice`) USING BTREE,
  ADD KEY `fk_Indice_Tipo_Indice1_idx` (`idTipo_Indice`);

--
-- Indexes for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`idNotificacao`,`Usuario_idUsuario`),
  ADD KEY `fk_Notificacao_Usuario_idx` (`Usuario_idUsuario`),
  ADD KEY `idAnalise` (`idAnalise`) USING BTREE;

--
-- Indexes for table `rodape`
--
ALTER TABLE `rodape`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_empresa`
--
ALTER TABLE `tipo_empresa`
  ADD PRIMARY KEY (`Nome`);

--
-- Indexes for table `tipo_indice`
--
ALTER TABLE `tipo_indice`
  ADD PRIMARY KEY (`idTipo_indice`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analise`
--
ALTER TABLE `analise`
  MODIFY `idanalise` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `idConta` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `demonstracao`
--
ALTER TABLE `demonstracao`
  MODIFY `idDemonstracao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `empresa_conta`
--
ALTER TABLE `empresa_conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indice`
--
ALTER TABLE `indice`
  MODIFY `idIndice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_indice`
--
ALTER TABLE `tipo_indice`
  MODIFY `idTipo_indice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analise`
--
ALTER TABLE `analise`
  ADD CONSTRAINT `fk_analise_1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`Comentario_idComentario`) REFERENCES `comentario` (`idComentario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`Empresa_idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `conta`
--
ALTER TABLE `conta`
  ADD CONSTRAINT `fkDemonstracao` FOREIGN KEY (`idDemonstracao`) REFERENCES `demonstracao` (`idDemonstracao`);

--
-- Constraints for table `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fkTipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_empresa` (`Nome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `empresahasusuario`
--
ALTER TABLE `empresahasusuario`
  ADD CONSTRAINT `fk_Empresa_has_Usuario_Empresa1` FOREIGN KEY (`Empresa_idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empresa_has_Usuario_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `empresa_conta`
--
ALTER TABLE `empresa_conta`
  ADD CONSTRAINT `fkIdConta` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkIdEmpresa` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkIdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `indice`
--
ALTER TABLE `indice`
  ADD CONSTRAINT `fk_idTipoIndice` FOREIGN KEY (`idTipo_Indice`) REFERENCES `tipo_indice` (`idTipo_indice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `fk_Notificacao_Usuario` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_analise` FOREIGN KEY (`idAnalise`) REFERENCES `analise` (`idanalise`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
