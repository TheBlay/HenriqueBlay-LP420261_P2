-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/05/2026 às 01:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_publicacoes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_autores`
--

CREATE TABLE `tb_autores` (
  `idAutor` int(11) NOT NULL,
  `nomeAutor` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `idClassificacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_autores`
--

INSERT INTO `tb_autores` (`idAutor`, `nomeAutor`, `email`, `idClassificacao`) VALUES
(1, 'Fernando Cevice Santos', 'fernando23@email.com', 5),
(2, 'Fabio Ferreira de Pedroso', 'fabiofe.ilustra@gmail.com', 4),
(3, 'Henrique Barboza', 'henrique.barboza@fatec.sp.gov.br', 1),
(4, 'Patricia Serrano', 'patiserrano.contato@email.com', 1),
(5, 'Armaldo Frunt', 'fruntposters1@gmail.com', 4),
(6, 'Fulano Barroso', 'barroso.escritor@email.com', 1),
(22, 'Fabricio Mesas', 'mesas.ilustra@email.com', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_classificacao`
--

CREATE TABLE `tb_classificacao` (
  `idClassificacao` int(11) NOT NULL,
  `tipoClassificacao` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_classificacao`
--

INSERT INTO `tb_classificacao` (`idClassificacao`, `tipoClassificacao`, `descricao`) VALUES
(1, 'Autor', 'Criador principal'),
(2, 'Coautor', 'Criador de apoio'),
(3, 'Revisor', 'Responsável pela revisão'),
(4, 'Ilustrador', 'Criador das ilustrações ou parte delas'),
(5, 'Orientador', 'Mentor que auxilou o autor no projeto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_convidados`
--

CREATE TABLE `tb_convidados` (
  `idConvidado` int(11) NOT NULL,
  `nomeConvidado` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_convidados`
--

INSERT INTO `tb_convidados` (`idConvidado`, `nomeConvidado`, `email`, `telefone`) VALUES
(1, 'Editora Lagrima', 'lagrimaeditora.social@email.com', NULL),
(2, 'Cristina dos Santos Có', 'cristinaco.docente@fatec.sp.gov.br', NULL),
(3, 'Jonatas Cerqueira Dias', 'jonatas.dias3@fatec.sp.gov.br', NULL),
(4, 'Paula Ricarda', NULL, '11967279900'),
(5, 'Simone Laraia Mendes', NULL, NULL),
(6, 'Alonsio Armando', 'armando33@email.com', NULL),
(7, 'Amanda Semanas', 'semanas1.games@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_divulgacao`
--

CREATE TABLE `tb_divulgacao` (
  `idDivulgacao` int(11) NOT NULL,
  `dataEvento` date DEFAULT NULL,
  `local` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_divulgacao`
--

INSERT INTO `tb_divulgacao` (`idDivulgacao`, `dataEvento`, `local`, `descricao`) VALUES
(1, '2026-02-18', 'Site Editora Lagrima', 'Lançamento de E-Book'),
(2, '2026-06-09', 'FATEC Praia Grande', 'Apresentação de TCC'),
(3, '2026-03-10', 'Praça XXV de Julho', 'IV Bienal dos Estudantes'),
(4, '2026-05-18', 'Site Alegria Racing', 'Publicação de Poster'),
(5, NULL, 'Redes Sociais', 'Divulgação de Conteúdo Promocional nas Redes Sociais');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_divulgacao_convidado`
--

CREATE TABLE `tb_divulgacao_convidado` (
  `idDivulgacao` int(11) NOT NULL,
  `idConvidado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_divulgacao_convidado`
--

INSERT INTO `tb_divulgacao_convidado` (`idDivulgacao`, `idConvidado`) VALUES
(1, 1),
(1, 4),
(1, 7),
(2, 2),
(2, 3),
(2, 5),
(3, 4),
(3, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_publicacao`
--

CREATE TABLE `tb_publicacao` (
  `idPublicacao` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `dataPublicacao` date DEFAULT NULL,
  `resumo` text DEFAULT NULL,
  `idDivulgacao` int(11) DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `idTipoPublicacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_publicacao`
--

INSERT INTO `tb_publicacao` (`idPublicacao`, `titulo`, `dataPublicacao`, `resumo`, `idDivulgacao`, `idAutor`, `idTipoPublicacao`) VALUES
(9, 'Ensaio sobre a Fala', '2026-05-20', 'Lançamento do E-Book \"Ensaio sobre a Fala\"; de BARROSO, Fulano.', 1, 1, 5),
(10, 'Apresentação de TCCs ADS', '2026-06-10', 'Evento de Trabalhos de Conclusão de Curso', 2, 5, 1),
(11, 'Descobrindo o Saber', '2026-05-07', 'Revista Tecnológica e Acadêmica', 1, 3, 5),
(12, 'Cartuns O\' Plenty!', '2026-05-19', 'Publicação do pôster colorido de cartuns!', 4, 22, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_tipopublicacao`
--

CREATE TABLE `tb_tipopublicacao` (
  `idTipoPublicacao` int(11) NOT NULL,
  `nomeTipo` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_tipopublicacao`
--

INSERT INTO `tb_tipopublicacao` (`idTipoPublicacao`, `nomeTipo`, `descricao`) VALUES
(1, 'Artigo', 'Publicação de trabalho de Artigo Científico'),
(2, 'Dissertação', 'Publicação de um trabalho de dissertação'),
(3, 'Pôster', 'Publicação via poster'),
(4, 'Livro', 'Publicação de livro'),
(5, 'E-Book', 'Publicação de Livro Digital');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_autores`
--
ALTER TABLE `tb_autores`
  ADD PRIMARY KEY (`idAutor`),
  ADD KEY `fk_autor_classificacao` (`idClassificacao`);

--
-- Índices de tabela `tb_classificacao`
--
ALTER TABLE `tb_classificacao`
  ADD PRIMARY KEY (`idClassificacao`),
  ADD UNIQUE KEY `tipoClassificacao` (`tipoClassificacao`);

--
-- Índices de tabela `tb_convidados`
--
ALTER TABLE `tb_convidados`
  ADD PRIMARY KEY (`idConvidado`);

--
-- Índices de tabela `tb_divulgacao`
--
ALTER TABLE `tb_divulgacao`
  ADD PRIMARY KEY (`idDivulgacao`);

--
-- Índices de tabela `tb_divulgacao_convidado`
--
ALTER TABLE `tb_divulgacao_convidado`
  ADD PRIMARY KEY (`idDivulgacao`,`idConvidado`),
  ADD KEY `fk_convidado` (`idConvidado`);

--
-- Índices de tabela `tb_publicacao`
--
ALTER TABLE `tb_publicacao`
  ADD PRIMARY KEY (`idPublicacao`),
  ADD KEY `fk_publicacao_divulgacao` (`idDivulgacao`),
  ADD KEY `fk_publicacao_autores` (`idAutor`),
  ADD KEY `fk_publicacao_tipoPublicacao` (`idTipoPublicacao`);

--
-- Índices de tabela `tb_tipopublicacao`
--
ALTER TABLE `tb_tipopublicacao`
  ADD PRIMARY KEY (`idTipoPublicacao`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_autores`
--
ALTER TABLE `tb_autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tb_classificacao`
--
ALTER TABLE `tb_classificacao`
  MODIFY `idClassificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_convidados`
--
ALTER TABLE `tb_convidados`
  MODIFY `idConvidado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_divulgacao`
--
ALTER TABLE `tb_divulgacao`
  MODIFY `idDivulgacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_publicacao`
--
ALTER TABLE `tb_publicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_tipopublicacao`
--
ALTER TABLE `tb_tipopublicacao`
  MODIFY `idTipoPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_autores`
--
ALTER TABLE `tb_autores`
  ADD CONSTRAINT `fk_autor_classificacao` FOREIGN KEY (`idClassificacao`) REFERENCES `tb_classificacao` (`idClassificacao`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_divulgacao_convidado`
--
ALTER TABLE `tb_divulgacao_convidado`
  ADD CONSTRAINT `fk_convidado` FOREIGN KEY (`idConvidado`) REFERENCES `tb_convidados` (`idConvidado`),
  ADD CONSTRAINT `fk_divulgacao` FOREIGN KEY (`idDivulgacao`) REFERENCES `tb_divulgacao` (`idDivulgacao`);

--
-- Restrições para tabelas `tb_publicacao`
--
ALTER TABLE `tb_publicacao`
  ADD CONSTRAINT `fk_publicacao_autores` FOREIGN KEY (`idAutor`) REFERENCES `tb_autores` (`idAutor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publicacao_divulgacao` FOREIGN KEY (`idDivulgacao`) REFERENCES `tb_divulgacao` (`idDivulgacao`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publicacao_tipoPublicacao` FOREIGN KEY (`idTipoPublicacao`) REFERENCES `tb_tipopublicacao` (`idTipoPublicacao`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
