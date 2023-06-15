-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para inadimanager
CREATE DATABASE IF NOT EXISTS `inadimanager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `inadimanager`;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela inadimanager.promissoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `promissoria` DISABLE KEYS */;
INSERT INTO `promissoria` (`cod`, `descricao`, `valor`, `data_compra`, `data_vencimento`, `cod_cliente`, `status`) VALUES
	(3, 'lknçnlk', 5345, '2023-06-01', '2023-07-01', 6, 2),
	(7, 'carro', 90000, '2023-06-01', '2023-07-01', 7, 1),
	(8, 'calota', 0, '2023-06-01', '2023-07-01', 7, 3),
	(9, 'roda', 847651, '2023-06-01', '2023-07-01', 7, 2);
/*!40000 ALTER TABLE `promissoria` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
