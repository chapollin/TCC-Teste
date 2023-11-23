CREATE DATABASE IF NOT EXISTS `inadimanager`/;
USE `inadimanager`;

DELIMITER //
CREATE EVENT `atualizar_status_promissoria` ON SCHEDULE EVERY 1 DAY STARTS '2023-06-01 08:03:36' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE promissoria
    SET status = 3 
    WHERE status <> 1 
    AND DATEDIFF(CURDATE(), data_compra) >= 30;
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` (`cod`, `nome`, `cpf`, `email`, `endereco`, `numero`, `bairro`, `cidade`, `telefone`) VALUES
	(20, 'Marcos Daniel ', '12312312312', 'marcos@vomoto.com', '.', '5', '.', '.', '(35) 99965-6565'),
	(21, 'Kleber Moreira', '12312312365', 'kleber@vomoto.com', '.', '1', '.', '.', '(35) 99925-1412'),
	(22, 'Marcos Cardoso', '11111111111', 'danielsinho487@gmail.com', 'sd', '60', 'sdf', 'Machado', '(25) 25252-5252'),
	(23, 'Teste', '123.123.123.88', 'TESTE@TESTE', 't', '60', 't', 'Machado', '(25) 25252-5252');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `promissoria` (`cod`, `descricao`, `valor`, `data_compra`, `data_vencimento`, `cod_cliente`, `status`) VALUES
	(22, 'Pneu', 400, '2023-10-10', '2023-11-10', 20, 3),
	(24, 'carro', 25000, '2023-11-12', '2023-12-14', 22, 1),
	(25, 'roda', 200, '2023-11-14', '2023-12-14', 23, 2),
	(26, 'Balancemento', 100, '2023-11-14', '2023-12-14', 23, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`) VALUES
	(1, 'marcos', 'm@m', '6f8f57715090da2632453988d9a1501b'),
	(2, 'Antonio', 'a@a', '0cc175b9c0f1b6a831c399e269772661'),
	(3, 'teste', 'teste@teste', 'e358efa489f58062f10dd7316b65649e'),
	(4, 'Fabio', 'f@f', '');
