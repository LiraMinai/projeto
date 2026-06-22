-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 22-Jun-2026 às 17:36
-- Versão do servidor: 5.7.25
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_questionario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoescolar`
--

CREATE TABLE `anoescolar` (
  `idAnoEscolar` int(11) NOT NULL,
  `nomeAnoEscolar` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo`
--

CREATE TABLE `conteudo` (
  `idConteudo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `nomeConteudo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `idMateria` int(11) NOT NULL,
  `idAnoEscolar` int(11) NOT NULL,
  `nomeMateria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem`
--

CREATE TABLE `personagem` (
  `idPersonagem` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nomePersonagem` varchar(50) DEFAULT NULL,
  `avatarPersonagem` varchar(255) DEFAULT NULL,
  `vidaAtualPersonagem` int(11) DEFAULT '50',
  `vidaMaximaPersonagem` int(11) DEFAULT '50',
  `xpPersonagem` int(11) DEFAULT '0',
  `nivelPersonagem` int(11) DEFAULT '1',
  `ultimaRecargaVidaPersonagem` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `idQuestao` int(11) NOT NULL,
  `idConteudo` int(11) NOT NULL,
  `enunciadoQuestao` text NOT NULL,
  `opcao1Questao` varchar(255) DEFAULT NULL,
  `opcao2Questao` varchar(255) DEFAULT NULL,
  `opcao3Questao` varchar(255) DEFAULT NULL,
  `opcao4Questao` varchar(255) DEFAULT NULL,
  `respostaCorretaQuestao` varchar(255) DEFAULT NULL,
  `statusQuestao` enum('ativa','desativada') DEFAULT 'ativa',
  `classificacaoQuestao` enum('facil','medio','dificil','impossivel') DEFAULT NULL,
  `xpQuestao` int(11) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario`
--

CREATE TABLE `questionario` (
  `idQuestionario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataHoraInicioQuestionario` datetime DEFAULT NULL,
  `dataHoraFimQuestionario` datetime DEFAULT NULL,
  `pontuacaoQuestionario` int(11) DEFAULT '0',
  `statusQuestionario` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarioquestao`
--

CREATE TABLE `questionarioquestao` (
  `idQuestionarioQuestao` int(11) NOT NULL,
  `idQuestionario` int(11) NOT NULL,
  `idQuestao` int(11) NOT NULL,
  `respostaUsuario` varchar(255) DEFAULT NULL,
  `acertouQuestao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuarioUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `tipoUsuario` enum('aluno','admin') DEFAULT 'aluno',
  `dataNascimentoUsuario` date DEFAULT NULL,
  `idAnoEscolar` int(11) DEFAULT NULL,
  `ultimoCheckinUsuario` date DEFAULT NULL,
  `sequenciaCheckinUsuario` int(11) DEFAULT '0',
  `melhorSequenciaUsuario` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anoescolar`
--
ALTER TABLE `anoescolar`
  ADD PRIMARY KEY (`idAnoEscolar`);

--
-- Indexes for table `conteudo`
--
ALTER TABLE `conteudo`
  ADD PRIMARY KEY (`idConteudo`),
  ADD KEY `idMateria` (`idMateria`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `idAnoEscolar` (`idAnoEscolar`);

--
-- Indexes for table `personagem`
--
ALTER TABLE `personagem`
  ADD PRIMARY KEY (`idPersonagem`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`idQuestao`),
  ADD KEY `idConteudo` (`idConteudo`);

--
-- Indexes for table `questionario`
--
ALTER TABLE `questionario`
  ADD PRIMARY KEY (`idQuestionario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `questionarioquestao`
--
ALTER TABLE `questionarioquestao`
  ADD PRIMARY KEY (`idQuestionarioQuestao`),
  ADD KEY `idQuestionario` (`idQuestionario`),
  ADD KEY `idQuestao` (`idQuestao`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `loginUsuario` (`nomeUsuarioUsuario`),
  ADD KEY `idAnoEscolar` (`idAnoEscolar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anoescolar`
--
ALTER TABLE `anoescolar`
  MODIFY `idAnoEscolar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conteudo`
--
ALTER TABLE `conteudo`
  MODIFY `idConteudo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personagem`
--
ALTER TABLE `personagem`
  MODIFY `idPersonagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questao`
--
ALTER TABLE `questao`
  MODIFY `idQuestao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario`
--
ALTER TABLE `questionario`
  MODIFY `idQuestionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionarioquestao`
--
ALTER TABLE `questionarioquestao`
  MODIFY `idQuestionarioQuestao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `conteudo`
--
ALTER TABLE `conteudo`
  ADD CONSTRAINT `conteudo_ibfk_1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`);

--
-- Limitadores para a tabela `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`idAnoEscolar`) REFERENCES `anoescolar` (`idAnoEscolar`);

--
-- Limitadores para a tabela `personagem`
--
ALTER TABLE `personagem`
  ADD CONSTRAINT `personagem_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `questao_ibfk_1` FOREIGN KEY (`idConteudo`) REFERENCES `conteudo` (`idConteudo`);

--
-- Limitadores para a tabela `questionario`
--
ALTER TABLE `questionario`
  ADD CONSTRAINT `questionario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Limitadores para a tabela `questionarioquestao`
--
ALTER TABLE `questionarioquestao`
  ADD CONSTRAINT `questionarioquestao_ibfk_1` FOREIGN KEY (`idQuestionario`) REFERENCES `questionario` (`idQuestionario`),
  ADD CONSTRAINT `questionarioquestao_ibfk_2` FOREIGN KEY (`idQuestao`) REFERENCES `questao` (`idQuestao`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idAnoEscolar`) REFERENCES `anoescolar` (`idAnoEscolar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
