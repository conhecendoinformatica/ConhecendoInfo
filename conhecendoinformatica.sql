-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Set-2024 às 06:25
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `conhecendoinformatica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endereco` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `endereco`) VALUES
(5, '20240912062301pc.png'),
(6, '20240912062316pc.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaques`
--

CREATE TABLE `destaques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descricao` varchar(2500) NOT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaque_arquivo`
--

CREATE TABLE `destaque_arquivo` (
  `destaque` bigint(20) UNSIGNED NOT NULL,
  `arquivo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` varchar(2500) NOT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `nome`, `descricao`, `ano`) VALUES
(7, '', '', 0),
(8, '', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `membros`
--

CREATE TABLE `membros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `descricao` varchar(2500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `membros`
--

INSERT INTO `membros` (`id`, `nome`, `cargo`, `descricao`) VALUES
(1, 'pedro', 'aluno', NULL),
(2, 'jessica', 'aluno', NULL),
(8, 'Raquel Miranda', 'docente', ''),
(9, 'Raquel Miranda', 'docente', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro_arquivo`
--

CREATE TABLE `membro_arquivo` (
  `membro` bigint(20) UNSIGNED NOT NULL,
  `arquivo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `membro_arquivo`
--

INSERT INTO `membro_arquivo` (`membro`, `arquivo`) VALUES
(8, 5),
(9, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(350) NOT NULL,
  `descricao` varchar(2500) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ano_escolar` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `votos` int(11) DEFAULT 0,
  `link` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_arquivo`
--

CREATE TABLE `projeto_arquivo` (
  `projeto` bigint(20) UNSIGNED NOT NULL,
  `arquivo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_disciplina`
--

CREATE TABLE `projeto_disciplina` (
  `projeto` bigint(20) UNSIGNED NOT NULL,
  `disciplina` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_membro`
--

CREATE TABLE `projeto_membro` (
  `projeto` bigint(20) UNSIGNED NOT NULL,
  `membro` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `destaques`
--
ALTER TABLE `destaques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `destaque_arquivo`
--
ALTER TABLE `destaque_arquivo`
  ADD PRIMARY KEY (`destaque`,`arquivo`),
  ADD KEY `arquivo` (`arquivo`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `membro_arquivo`
--
ALTER TABLE `membro_arquivo`
  ADD PRIMARY KEY (`membro`,`arquivo`),
  ADD KEY `arquivo` (`arquivo`);

--
-- Índices para tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `projeto_arquivo`
--
ALTER TABLE `projeto_arquivo`
  ADD PRIMARY KEY (`projeto`,`arquivo`),
  ADD KEY `arquivo` (`arquivo`);

--
-- Índices para tabela `projeto_disciplina`
--
ALTER TABLE `projeto_disciplina`
  ADD PRIMARY KEY (`projeto`,`disciplina`),
  ADD KEY `disciplina` (`disciplina`);

--
-- Índices para tabela `projeto_membro`
--
ALTER TABLE `projeto_membro`
  ADD PRIMARY KEY (`projeto`,`membro`),
  ADD KEY `membro` (`membro`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `destaques`
--
ALTER TABLE `destaques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `membros`
--
ALTER TABLE `membros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `destaque_arquivo`
--
ALTER TABLE `destaque_arquivo`
  ADD CONSTRAINT `destaque_arquivo_ibfk_1` FOREIGN KEY (`arquivo`) REFERENCES `arquivos` (`id`),
  ADD CONSTRAINT `destaque_arquivo_ibfk_2` FOREIGN KEY (`destaque`) REFERENCES `destaques` (`id`);

--
-- Limitadores para a tabela `membro_arquivo`
--
ALTER TABLE `membro_arquivo`
  ADD CONSTRAINT `membro_arquivo_ibfk_1` FOREIGN KEY (`arquivo`) REFERENCES `arquivos` (`id`),
  ADD CONSTRAINT `membro_arquivo_ibfk_2` FOREIGN KEY (`membro`) REFERENCES `membros` (`id`);

--
-- Limitadores para a tabela `projeto_arquivo`
--
ALTER TABLE `projeto_arquivo`
  ADD CONSTRAINT `projeto_arquivo_ibfk_1` FOREIGN KEY (`arquivo`) REFERENCES `arquivos` (`id`),
  ADD CONSTRAINT `projeto_arquivo_ibfk_2` FOREIGN KEY (`projeto`) REFERENCES `projetos` (`id`);

--
-- Limitadores para a tabela `projeto_disciplina`
--
ALTER TABLE `projeto_disciplina`
  ADD CONSTRAINT `projeto_disciplina_ibfk_1` FOREIGN KEY (`disciplina`) REFERENCES `disciplinas` (`id`),
  ADD CONSTRAINT `projeto_disciplina_ibfk_2` FOREIGN KEY (`projeto`) REFERENCES `projetos` (`id`);

--
-- Limitadores para a tabela `projeto_membro`
--
ALTER TABLE `projeto_membro`
  ADD CONSTRAINT `projeto_membro_ibfk_1` FOREIGN KEY (`membro`) REFERENCES `membros` (`id`),
  ADD CONSTRAINT `projeto_membro_ibfk_2` FOREIGN KEY (`projeto`) REFERENCES `projetos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
