CREATE DATABASE IF NOT EXISTS `inadimanager`
USE `inadimanager`;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cliente` (`cod`, `nome`, `cpf`, `email`, `endereco`, `numero`, `bairro`, `cidade`, `telefone`) VALUES
	(6, 'jose', '88888888888', 'jose@jose', 'joseruadzfgjhzdfjhfdgjfgjghdkgfhkhjkljçkjlç', '16', 'mjknkm', 'tiagolandia', '(35) 88888-8888'),
	(7, 'tiago', '12345678998', 'afasfsf@gfdgdfg.com', 'tiagorua', '5', 'tiagobairro', 'tiagolandia', '(35) 88888-8888');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `promissoria` (`cod`, `descricao`, `valor`, `data_compra`, `data_vencimento`, `cod_cliente`, `status`) VALUES
	(3, 'lknçnlk', 5345, '2023-06-01', '2023-06-01', 6, 2),
	(4, '500', 0, '2023-06-01', '2023-07-01', 6, NULL);
s
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `status` (`id`, `nome`) VALUES
	(1, 'Pago'),
	(2, 'Não Pago'),
	(3, 'Vencido');

CREATE TABLE IF NOT EXISTS `usuario` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`) VALUES
	(1, 'marcos', 'm@m', '6f8f57715090da2632453988d9a1501b');

