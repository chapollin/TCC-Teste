-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para inadimanager
CREATE DATABASE IF NOT EXISTS `inadimanager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `inadimanager`;

-- Copiando estrutura para evento inadimanager.atualizar_status_promissoria
DELIMITER //
CREATE EVENT `atualizar_status_promissoria` ON SCHEDULE EVERY 1 DAY STARTS '2023-06-01 08:03:36' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE promissoria
    SET status = 3 
    WHERE status <> 1 
    AND DATEDIFF(CURDATE(), data_compra) >= 30;
END//
DELIMITER ;

-- Copiando estrutura para tabela inadimanager.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela inadimanager.cliente: ~2 rows (aproximadamente)
INSERT INTO `cliente` (`cod`, `nome`, `cpf`, `email`, `endereco`, `numero`, `bairro`, `cidade`, `telefone`) VALUES
	(6, 'jose', '88888888888', 'jose@jose', 'joseruadzfgjhzdfjhfdgjfgjghdkgfhkhjkljçkjlç', '16', 'mjknkm', 'tiagolandia', '(35) 88888-8888'),
	(7, 'tiago', '12345678998', 'afasfsf@gfdgdfg.com', 'tiagorua', '5', 'tiagobairro', 'tiagolandia', '(35) 88888-8888'),
	(18, 'Marcos Daniel ', '79865212532', 'm1@gmail.com', 'marcos isso mesmo', '80', 'marcobairro', 'marcoslovakia', '(35) 99874-4566'),
	(19, 'TESTE', '11111111111', 'TESTE@TESTE', 'TESTE', '9', 'TESTO', 'TESTOLANDIA', '(11) 11111-1111');

-- Copiando estrutura para tabela inadimanager.promissoria
CREATE TABLE IF NOT EXISTS `promissoria` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `data_compra` date NOT NULL,
  `data_vencimento` date NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `foreign_key_cod_cliente` (`cod_cliente`),
  KEY `fk_status_promissoria` (`status`),
  CONSTRAINT `fk_divida_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`) ON DELETE CASCADE,
  CONSTRAINT `fk_status_promissoria` FOREIGN KEY (`status`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela inadimanager.promissoria: ~9 rows (aproximadamente)
INSERT INTO `promissoria` (`cod`, `descricao`, `valor`, `data_compra`, `data_vencimento`, `cod_cliente`, `status`) VALUES
	(3, 'lknçnlk', 5345, '2023-06-01', '2023-07-01', 6, 1),
	(7, 'carro', 90000, '2023-06-01', '2023-07-01', 7, 1),
	(8, 'calota', 8, '2023-06-01', '2023-07-01', 7, 3),
	(9, 'roda', 847651, '2023-06-01', '2023-07-01', 7, 3),
	(11, 'TESTE3', 78, '2023-06-21', '2023-07-21', 6, 2),
	(12, 'roda', 80, '2023-06-21', '2023-07-21', 18, 2),
	(13, 'TESTE3', 98, '2023-06-21', '2023-07-21', 18, 1),
	(14, 'TESTE1000', 100, '2023-06-25', '2023-07-25', 18, 2),
	(15, 'trocou o pneu', 500, '2023-06-26', '2023-07-26', 19, 3),
	(16, 'nota', 5000, '2023-06-28', '2023-07-28', 18, 2);

-- Copiando estrutura para tabela inadimanager.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela inadimanager.status: ~3 rows (aproximadamente)
INSERT INTO `status` (`id`, `nome`) VALUES
	(1, 'Pago'),
	(2, 'Não Pago'),
	(3, 'Vencido');

-- Copiando estrutura para tabela inadimanager.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela inadimanager.usuario: ~2 rows (aproximadamente)
INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`) VALUES
	(1, 'marcos', 'm@m', '6f8f57715090da2632453988d9a1501b'),
	(2, 'Antonio', 'a@a', '0cc175b9c0f1b6a831c399e269772661');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
