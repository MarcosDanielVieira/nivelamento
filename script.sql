-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para nivelamento
CREATE DATABASE IF NOT EXISTS `nivelamento` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nivelamento`;

-- Copiando estrutura para tabela nivelamento.enderecos
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado_id` int NOT NULL,
  `cep` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `endereco` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `numero` char(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_enderecos_estados` (`estado_id`),
  CONSTRAINT `FK_enderecos_estados` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela nivelamento.enderecos: ~1 rows (aproximadamente)
DELETE FROM `enderecos`;
INSERT INTO `enderecos` (`id`, `estado_id`, `cep`, `endereco`, `numero`) VALUES
	(8, 11, '39644-000', 'Rua Rodrigues Araújo', '60');

-- Copiando estrutura para tabela nivelamento.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uf` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nome` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela nivelamento.estados: ~27 rows (aproximadamente)
DELETE FROM `estados`;
INSERT INTO `estados` (`id`, `uf`, `nome`) VALUES
	(1, 'AC', 'Acre'),
	(2, 'AL', 'Alagoas'),
	(3, 'AM', 'Amazonas'),
	(4, 'AP', 'Amapá'),
	(5, 'BA', 'Bahia'),
	(6, 'CE', 'Ceará'),
	(7, 'DF', 'Distrito Federal'),
	(8, 'ES', 'Espírito Santo'),
	(9, 'GO', 'Goiás'),
	(10, 'MA', 'Maranhão'),
	(11, 'MG', 'Minas Gerais'),
	(12, 'MS', 'Mato Grosso do Sul'),
	(13, 'MT', 'Mato Grosso'),
	(14, 'PA', 'Pará'),
	(15, 'PB', 'Paraíba'),
	(16, 'PE', 'Pernambuco'),
	(17, 'PI', 'Piauí'),
	(18, 'PR', 'Paraná'),
	(19, 'RJ', 'Rio de Janeiro'),
	(20, 'RN', 'Rio Grande do Norte'),
	(21, 'RO', 'Rondônia'),
	(22, 'RR', 'Roraima'),
	(23, 'RS', 'Rio Grande do Sul'),
	(24, 'SC', 'Santa Catarina'),
	(25, 'SE', 'Sergipe'),
	(26, 'SP', 'São Paulo'),
	(27, 'TO', 'Tocantins');

-- Copiando estrutura para tabela nivelamento.pessoas
CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `endereco_id` int NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rg` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pessoas_enderecos` (`endereco_id`),
  CONSTRAINT `FK_pessoas_enderecos` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela nivelamento.pessoas: ~1 rows (aproximadamente)
DELETE FROM `pessoas`;
INSERT INTO `pessoas` (`id`, `endereco_id`, `nome`, `cpf`, `rg`, `data_nascimento`, `data_cadastro`, `data_atualizacao`, `data_exclusao`) VALUES
	(5, 8, 'Marcos Daniel', '137.293.956-37', 'MG20117076', '1997-05-12', '2022-10-26 21:10:23', NULL, NULL);

-- Copiando estrutura para tabela nivelamento.telefones
CREATE TABLE IF NOT EXISTS `telefones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pessoa_id` int NOT NULL,
  `telefone` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_telefones_pessoas` (`pessoa_id`),
  CONSTRAINT `FK_telefones_pessoas` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela nivelamento.telefones: ~1 rows (aproximadamente)
DELETE FROM `telefones`;
INSERT INTO `telefones` (`id`, `pessoa_id`, `telefone`) VALUES
	(1, 5, '(33) 98752-5222');

-- Copiando estrutura para tabela nivelamento.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela nivelamento.usuarios: ~1 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
	(10, 'badamarcos2@hotmail.com', '69c5fcebaa65b560eaf06c3fbeb481ae44b8d618');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
