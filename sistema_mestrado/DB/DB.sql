-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/07/2024 às 03:16
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_mestrado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades_extracurriculares`
--

CREATE TABLE `atividades_extracurriculares` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `horas` int(11) NOT NULL,
  `certificado` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atribuicoes`
--

CREATE TABLE `atribuicoes` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `orientador_id` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` enum('graduação','pós-graduação') NOT NULL,
  `horas_extracurriculares` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orientacoes`
--

CREATE TABLE `orientacoes` (
  `id` int(11) NOT NULL,
  `orientador_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` text NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('administrador','aluno','orientador') NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `matricula` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `tipo_curso` varchar(255) DEFAULT NULL,
  `titulo_trabalho_cientifico` varchar(255) DEFAULT NULL,
  `descricao_trabalho_cientifico` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `criado_em`, `matricula`, `endereco`, `cpf`, `curso`, `tipo_curso`, `titulo_trabalho_cientifico`, `descricao_trabalho_cientifico`) VALUES
(1, 'Admin', 'admin@sistema.com', '$2y$10$4L68NduS9huffnNKZTXv..wVnzHnR0//EmQVUGDoK0JZg.es4DHpq', 'administrador', '2024-07-30 12:28:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'João Silva', 'joao.silva@sistema.com', '$2y$10$w2ZqlyeninO/wlAhRGUHJuLAAZ4h3GBNhH8zGDzEt7jLZgK4jwoca', 'aluno', '2024-07-30 12:28:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Maria Oliveira', 'maria.oliveira@sistema.com', '$2y$10$1IqdozDs4CXC8zJ0bIGQHu/I2CwoDd8OWnhHM19mzgTO8GVsBOvM6', 'orientador', '2024-07-30 12:28:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'marcos', 'ma@sistema.com', '$2y$10$Ddw3zVvkHIwBW.VdH1LgyeeOPAHYS3.P4d3J7.LX96bPvKgJYTOX.', 'aluno', '2024-07-30 14:45:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'jorge', 'jorge@sitema.com', '$2y$10$cmoVAyjy/Oqvdmzt4FjiIOelPrLCOL.7Gh1f7RSdyMOfV.uh.LAeq', 'aluno', '2024-07-30 18:56:49', '', '', '', '', NULL, '', ''),
(9, 'jose', 'jose@sistema.com', '$2y$10$Hq8wTWKivAaMSRpGmtT1Ae9kG1nWefQKc/1ML1jqiXV4Ye3kEWYG.', 'orientador', '2024-07-30 19:01:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'lucas', 'lucas@sistema.com', '$2y$10$Cs7jeEHqR.NoHhN41AAEuO2AJK6l9S3OGpJJ6E4YTogGIp/K5sui.', 'aluno', '2024-07-31 00:34:20', '555', NULL, NULL, 'engenharia', 'Graduacao', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades_extracurriculares`
--
ALTER TABLE `atividades_extracurriculares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `atribuicoes`
--
ALTER TABLE `atribuicoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `orientador_id` (`orientador_id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orientacoes`
--
ALTER TABLE `orientacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orientador_id` (`orientador_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades_extracurriculares`
--
ALTER TABLE `atividades_extracurriculares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atribuicoes`
--
ALTER TABLE `atribuicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orientacoes`
--
ALTER TABLE `orientacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades_extracurriculares`
--
ALTER TABLE `atividades_extracurriculares`
  ADD CONSTRAINT `atividades_extracurriculares_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atividades_extracurriculares_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `atribuicoes`
--
ALTER TABLE `atribuicoes`
  ADD CONSTRAINT `atribuicoes_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atribuicoes_ibfk_2` FOREIGN KEY (`orientador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `orientacoes`
--
ALTER TABLE `orientacoes`
  ADD CONSTRAINT `orientacoes_ibfk_1` FOREIGN KEY (`orientador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orientacoes_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
