-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 10.129.76.12
-- Tempo de geração: 11/11/2017 às 15:41
-- Versão do servidor: 5.6.26-log
-- Versão do PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `db_dmt`
--
DROP DATABASE `db_dmt`;
CREATE DATABASE IF NOT EXISTS `db_dmt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_dmt`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `sp_add_pedal_carrinho`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_add_pedal_carrinho`(IN pedal INT, carrinho INT, qtd INT)
BEGIN
    	DECLARE oldqtd INT;
        DECLARE newqtd INT;
    	IF EXISTS(SELECT * FROM tb_pedal_carrinho WHERE cd_pedal = pedal AND cd_carrinho = carrinho) THEN
        	SET oldqtd = (SELECT qt_pedal FROM tb_pedal_carrinho WHERE cd_pedal = pedal AND cd_carrinho = carrinho);
            SET newqtd = oldqtd + qtd;
            UPDATE tb_pedal_carrinho SET qt_pedal = newqtd WHERE cd_pedal = pedal AND cd_carrinho = carrinho;
        ELSE
        	INSERT INTO tb_pedal_carrinho (cd_pedal, cd_carrinho, qt_pedal) VALUES (pedal, carrinho, qtd);
        END IF;
	END$$

DROP PROCEDURE IF EXISTS `sp_delete_artista`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_delete_artista`(IN artista INT)
BEGIN
	DELETE FROM tb_pedal_artista WHERE cd_artista = artista;
    DELETE FROM tb_artista WHERE cd_artista = artista;
END$$

DROP PROCEDURE IF EXISTS `sp_insert_pedal_estoque`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_insert_pedal_estoque`(IN nome VARCHAR(50), descricao TEXT, preco DECIMAL(9,2), instrumento CHAR(1), categoria VARCHAR(30))
BEGIN
    	INSERT INTO tb_pedal (nm_pedal, ds_pedal, vl_preco, ic_guitar_bass, nm_categoria, ic_ativo_inativo) VALUES (nome, descricao, preco, instrumento, categoria, TRUE);
        INSERT INTO tb_estoque (qt_estoque, dt_alteracao, cd_pedal)  VALUES (0, CURRENT_TIMESTAMP(), LAST_INSERT_ID());
    END$$

DROP PROCEDURE IF EXISTS `sp_insert_usuario`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_insert_usuario`(in nome VARCHAR(60), celular BIGINT(11), email VARCHAR(60), senha VARCHAR(32), cep INT(8), uf CHAR(2), cidade VARCHAR(30), bairro VARCHAR(30), rua VARCHAR(60), numero INT(10), comp INT(5))
BEGIN
    INSERT INTO tb_usuario (nm_usuario, cd_email, nm_senha, cd_celular) VALUES (nome, email, senha, celular);
    INSERT INTO tb_endereco (cd_cep, sg_uf, nm_cidade, nm_bairro, nm_rua, nm_numero, nm_comp, cd_usuario) VALUES (cep, uf, cidade, bairro, rua, numero, comp, LAST_INSERT_ID());
  END$$

DROP PROCEDURE IF EXISTS `sp_update_usuario`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_update_usuario`(in usuario INT(10), celular BIGINT(11), cep INT(8), uf CHAR(2), cidade VARCHAR(30), bairro VARCHAR(30), rua VARCHAR(60), numero INT(10), comp INT(5))
BEGIN
    UPDATE tb_usuario SET cd_celular = celular WHERE cd_usuario = usuario;
	UPDATE tb_endereco SET cd_cep = cep, sg_uf = uf, nm_cidade = cidade, nm_bairro = bairro, nm_rua = rua, nm_numero = numero, nm_comp = comp WHERE cd_usuario = usuario;
  END$$

DROP PROCEDURE IF EXISTS `sp_verificar_carrinho`$$
CREATE DEFINER=`admin_dmt`@`%` PROCEDURE `sp_verificar_carrinho`(IN `usuario` INT)
BEGIN
	DECLARE carrinho INT;
    IF NOT EXISTS(SELECT cd_carrinho FROM tb_carrinho WHERE cd_usuario = usuario AND ic_ativo_inativo = TRUE) THEN
      INSERT INTO tb_carrinho (dt_modificacao, ic_ativo_inativo, cd_usuario) VALUES (CURRENT_TIMESTAMP(), TRUE, usuario);
      INSERT INTO tb_venda (dt_venda, ic_estagio, cd_carrinho) VALUES (CURRENT_TIMESTAMP(), 0, LAST_INSERT_ID());
    ELSE
    	SET carrinho = (SELECT MAX(cd_carrinho) FROM tb_carrinho WHERE cd_usuario = usuario AND ic_ativo_inativo = TRUE);
    	IF NOT EXISTS(SELECT cd_venda FROM tb_venda WHERE cd_carrinho = carrinho) THEN
        	INSERT INTO tb_venda (dt_venda, ic_estagio, cd_carrinho) VALUES (CURRENT_TIMESTAMP(), 0, carrinho);
        END IF;
    END IF;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_artista`
--

DROP TABLE IF EXISTS `tb_artista`;
CREATE TABLE IF NOT EXISTS `tb_artista` (
`cd_artista` int(5) NOT NULL,
  `nm_artista` varchar(50) DEFAULT NULL,
  `nm_caminho` varchar(20) DEFAULT NULL,
  `nm_site` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Fazendo dump de dados para tabela `tb_artista`
--

INSERT INTO `tb_artista` (`cd_artista`, `nm_artista`, `nm_caminho`, `nm_site`) VALUES
(4, 'Kerry King', '22122015203849.jpg', 'http://www.slayer.net/'),
(6, 'James Papahet Hetfield', '6.jpg', 'https://metallica.com/'),
(11, 'Dave Mustaine', '11.jpg', 'http://dystopia.megadeth.com/'),
(13, 'Tom Araya', '22122015175513.jpg', 'http://www.slayer.net/ '),
(14, 'Dimitri', '24122015105344.jpg', 'http://projetocarolina.com.br/');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carousel`
--

DROP TABLE IF EXISTS `tb_carousel`;
CREATE TABLE IF NOT EXISTS `tb_carousel` (
`cd_carousel` int(10) NOT NULL,
  `nm_titulo` varchar(100) DEFAULT NULL,
  `nm_subtitulo` varchar(100) DEFAULT NULL,
  `nm_caminho` varchar(20) DEFAULT NULL,
  `nm_link` varchar(100) DEFAULT NULL,
  `ic_ativo_inativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Fazendo dump de dados para tabela `tb_carousel`
--

INSERT INTO `tb_carousel` (`cd_carousel`, `nm_titulo`, `nm_subtitulo`, `nm_caminho`, `nm_link`, `ic_ativo_inativo`) VALUES
(3, 'Dracarys', 'High Gain Distortion', '02012016203915.png', 'http://projetocarolina.com.br/teste/dmt/single.php?p=1', 1),
(4, 'Plexi Distortion', 'High Gain Distortion', '02012016221018.jpg', '', 1),
(6, 'Slayer Distortion', 'High Gain Distortion', '02012016211456.jpg', '', 1),
(9, 'TESTE 1', 'TESTE DO TESTE ', '05012016010645.jpg', '', 1),
(10, 'Brown Sound', ' Distortion', '05012016011006.jpg', 'https://www.instagram.com/dmtpedais/', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carrinho`
--

DROP TABLE IF EXISTS `tb_carrinho`;
CREATE TABLE IF NOT EXISTS `tb_carrinho` (
`cd_carrinho` int(5) NOT NULL,
  `dt_modificacao` datetime DEFAULT NULL,
  `ic_ativo_inativo` tinyint(1) DEFAULT NULL,
  `cd_usuario` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Fazendo dump de dados para tabela `tb_carrinho`
--

INSERT INTO `tb_carrinho` (`cd_carrinho`, `dt_modificacao`, `ic_ativo_inativo`, `cd_usuario`) VALUES
(3, '2015-12-08 17:18:52', 1, 7),
(4, '2015-12-08 17:19:02', 1, 6),
(6, '2015-12-10 02:15:49', 1, 9),
(7, '2016-01-26 01:51:25', 0, 10),
(8, '2015-12-18 01:45:53', 1, 12),
(9, '2015-12-18 02:01:18', 1, 13),
(10, '2015-12-23 00:58:20', 1, 14),
(11, '2016-01-26 01:58:48', 0, 15),
(12, '2016-01-05 17:09:36', 1, 16),
(13, '2016-01-26 01:40:07', 0, 5),
(14, '2016-01-26 01:46:04', 0, 5),
(15, '2016-01-27 14:26:49', 0, 5),
(16, '2016-01-26 01:51:25', 1, 10),
(17, '2016-01-26 01:58:48', 1, 15),
(18, '2016-01-30 21:06:27', 0, 5),
(19, '2016-01-30 21:09:05', 0, 5),
(20, '2016-01-30 21:11:06', 0, 5),
(21, '2016-01-30 21:14:12', 0, 5),
(22, '2016-01-30 21:19:38', 0, 5),
(23, '2016-01-30 22:03:59', 0, 5),
(24, '2016-01-31 00:33:03', 0, 5),
(25, '2016-02-03 22:42:26', 0, 5),
(26, '2016-02-03 22:42:26', 1, 5),
(27, '2017-10-07 13:51:56', 1, 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_endereco`
--

DROP TABLE IF EXISTS `tb_endereco`;
CREATE TABLE IF NOT EXISTS `tb_endereco` (
`cd_endereco` int(5) NOT NULL,
  `cd_cep` int(8) DEFAULT NULL,
  `sg_uf` char(2) DEFAULT NULL,
  `nm_cidade` varchar(30) DEFAULT NULL,
  `nm_bairro` varchar(30) DEFAULT NULL,
  `nm_rua` varchar(60) DEFAULT NULL,
  `nm_numero` char(10) DEFAULT NULL,
  `nm_comp` char(5) DEFAULT NULL,
  `cd_usuario` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Fazendo dump de dados para tabela `tb_endereco`
--

INSERT INTO `tb_endereco` (`cd_endereco`, `cd_cep`, `sg_uf`, `nm_cidade`, `nm_bairro`, `nm_rua`, `nm_numero`, `nm_comp`, `cd_usuario`) VALUES
(5, 11320140, 'SP', 'Santos', 'Gonzaga', 'Av. Ana Costa', '21', '0', 5),
(6, 13320140, 'SP', 'Salto', 'Centro', 'Rua Marechal Deodoro', '55', '0', 6),
(7, 13300100, 'SP', 'Itu', 'Centro', 'Rua Bom Jesus', '65503', '23', 7),
(9, 11320100, 'SP', 'São Vicente', 'Centro', 'Rua Marechal Floriano Peixoto', '300', '0', 9),
(10, 12312312, 'PI', 'Piauibana', 'Centro', 'Rua 7 ', '123', '0', 10),
(12, 11320140, 'PI', 'São Paulo', 'Tijuca', 'Av. Brasil', '123', '0', 12),
(13, 11320140, 'SP', 'São Vicente', 'Itararé', 'Rua Pero Correa', '123', '0', 13),
(14, 11234140, 'AL', 'Alagoana ', 'Centro', 'Rua 7', '123', '0', 14),
(15, 13249123, 'MT', 'Caxias', 'Centro', 'Rua 4', '330', '0', 15),
(16, 11320140, 'SP', 'Santos', 'Gonzaga', 'Av. Ana Costa', '345', '33', 16),
(17, 11320140, 'SP', 'Santos', 'Embaré', 'Conselheiro ', '123', '2', 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_entrada`
--

DROP TABLE IF EXISTS `tb_entrada`;
CREATE TABLE IF NOT EXISTS `tb_entrada` (
`cd_entrada` int(5) NOT NULL,
  `qt_entrada` int(5) DEFAULT NULL,
  `dt_entrada` datetime DEFAULT NULL,
  `cd_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Fazendo dump de dados para tabela `tb_entrada`
--

INSERT INTO `tb_entrada` (`cd_entrada`, `qt_entrada`, `dt_entrada`, `cd_pedal`) VALUES
(3, 10, '2015-12-05 19:36:35', 1),
(4, 5, '2015-12-05 19:45:23', 1),
(5, 10, '2015-12-05 19:49:37', 6),
(6, 8, '2015-12-05 19:59:54', 2),
(7, 15, '2015-12-05 21:03:46', 5),
(8, 10, '2015-12-05 21:11:10', 1),
(9, 28, '2015-12-05 21:12:00', 2),
(10, 28, '2015-12-05 21:12:04', 2),
(11, 1000, '2015-12-05 21:13:21', 4),
(12, 1, '2015-12-05 21:31:07', 2),
(13, 5, '2015-12-05 22:02:36', 11),
(14, 1, '2015-12-05 23:26:14', 11),
(15, 3, '2015-12-10 18:09:53', 11),
(16, 5, '2015-12-22 18:23:30', 13),
(17, 1, '2016-01-02 17:53:33', 11),
(18, 10, '2016-01-22 15:24:20', 14),
(19, 10, '2016-01-22 17:31:19', 2),
(20, 5, '2016-01-24 15:38:32', 3);

--
-- Gatilhos `tb_entrada`
--
DROP TRIGGER IF EXISTS `tr_entrada_estoque`;
DELIMITER //
CREATE TRIGGER `tr_entrada_estoque` AFTER INSERT ON `tb_entrada`
 FOR EACH ROW BEGIN 
		declare qtd int;
        declare total int;
        
        set qtd = new.qt_entrada;
        set total = (select qt_estoque from tb_estoque where cd_pedal = new.cd_pedal);
        
        set total = total + qtd;
        
        update tb_estoque set qt_estoque = total where cd_pedal = new.cd_pedal;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estoque`
--

DROP TABLE IF EXISTS `tb_estoque`;
CREATE TABLE IF NOT EXISTS `tb_estoque` (
`cd_estoque` int(5) NOT NULL,
  `qt_estoque` int(5) DEFAULT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `cd_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Fazendo dump de dados para tabela `tb_estoque`
--

INSERT INTO `tb_estoque` (`cd_estoque`, `qt_estoque`, `dt_alteracao`, `cd_pedal`) VALUES
(5, 8, '2015-12-05 16:52:21', 1),
(6, 10, '2015-12-05 16:52:21', 2),
(7, 9, '2015-12-05 16:52:21', 3),
(8, 10, '2015-12-05 16:52:21', 4),
(9, 10, '2015-12-05 16:52:21', 5),
(10, 9, '2015-12-05 16:52:21', 6),
(11, 10, '2015-12-05 21:53:00', 11),
(13, 9, '2015-12-18 16:35:40', 13),
(14, 10, '2015-12-24 10:50:28', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_imagem`
--

DROP TABLE IF EXISTS `tb_imagem`;
CREATE TABLE IF NOT EXISTS `tb_imagem` (
`cd_imagem` int(5) NOT NULL,
  `nm_caminho` varchar(20) DEFAULT NULL,
  `cd_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Fazendo dump de dados para tabela `tb_imagem`
--

INSERT INTO `tb_imagem` (`cd_imagem`, `nm_caminho`, `cd_pedal`) VALUES
(1, '1/1.png', 1),
(2, '1/2.png', 1),
(5, '2/1.png', 2),
(6, '2/2.png', 2),
(7, '2/3.png', 2),
(8, '2/4.png', 2),
(9, '3/1.png', 3),
(10, '3/2.png', 3),
(11, '3/3.png', 3),
(12, '3/4.png', 3),
(13, '4/1.jpg', 4),
(14, '5/1.png', 5),
(15, '5/2.png', 5),
(16, '5/3.png', 5),
(17, '5/4.png', 5),
(18, '6/1.jpg', 6),
(19, '6/2.jpg', 6),
(20, '6/3.jpg', 6),
(21, '6/4.jpg', 6),
(28, '11/1.jpg', 11),
(29, '11/2.jpg', 11),
(35, '11/35.jpg', 11),
(36, '11/36.jpg', 11),
(42, '13/37.jpg', 13),
(44, '13/43.jpg', 13),
(45, '13/45.jpg', 13),
(48, '13/46.jpg', 13),
(49, '14/49.jpg', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_notificacao`
--

DROP TABLE IF EXISTS `tb_notificacao`;
CREATE TABLE IF NOT EXISTS `tb_notificacao` (
  `cd_notificacao` int(5) NOT NULL,
  `nm_comprador` varchar(100) DEFAULT NULL,
  `nm_referencia` varchar(100) DEFAULT NULL,
  `ic_status` int(5) DEFAULT NULL,
  `vl_preco` decimal(9,2) DEFAULT NULL,
  `dt_transacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedal`
--

DROP TABLE IF EXISTS `tb_pedal`;
CREATE TABLE IF NOT EXISTS `tb_pedal` (
`cd_pedal` int(5) NOT NULL,
  `nm_pedal` varchar(50) DEFAULT NULL,
  `ds_pedal` text,
  `nm_categoria` varchar(50) DEFAULT NULL,
  `vl_preco` decimal(9,2) DEFAULT NULL,
  `vl_taxa` decimal(9,2) DEFAULT NULL,
  `ic_guitar_bass` char(1) DEFAULT NULL,
  `ic_ativo_inativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Fazendo dump de dados para tabela `tb_pedal`
--

INSERT INTO `tb_pedal` (`cd_pedal`, `nm_pedal`, `ds_pedal`, `nm_categoria`, `vl_preco`, `vl_taxa`, `ic_guitar_bass`, `ic_ativo_inativo`) VALUES
(1, 'Dracarys', 'Descrição do dracarys aqui etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc etc.', 'Distorção', 400.00, 4.75, 'g', 1),
(2, 'Octave Fuzz', 'Description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description description.', 'Fuzz', 380.00, 4.75, 'g', 1),
(3, 'Egito', 'Eu n sei o que esses camelos fazem, mas deve ter um efeito legal. etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc  etc .', 'Tube Screamer', 600.00, 4.75, 'b', 1),
(4, 'BATATINHA', 'QDO NASCE ESPARRAMA PELO CHAO ', 'Chorus', 200.00, 4.75, 'b', 0),
(5, 'Classic Compressor', 'Compressor do Marty McFly', 'Compressor', 350.00, 4.75, 'g', 1),
(6, 'Slayer Distortion', 'Descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição.', 'Distorção', 560.00, 4.75, 'g', 1),
(11, 'Little Ass Kicker', 'Pedal que vai chutar a bunda de todo mundo.', 'Overdrive', 370.00, 4.75, 'b', 1),
(13, 'Plexi Distortion', 'Descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição ', 'Distorção', 400.00, 4.75, 'g', 1),
(14, 'Teste de pedal 01', 'Teste de pedal 01 \r\nTeste de pedal 01', 'Compressor', 100.00, 4.75, 'b', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedal_artista`
--

DROP TABLE IF EXISTS `tb_pedal_artista`;
CREATE TABLE IF NOT EXISTS `tb_pedal_artista` (
  `cd_pedal` int(5) DEFAULT NULL,
  `cd_artista` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_pedal_artista`
--

INSERT INTO `tb_pedal_artista` (`cd_pedal`, `cd_artista`) VALUES
(1, 11),
(4, 11),
(5, 11),
(13, 11),
(1, 4),
(6, 4),
(13, 4),
(11, 13),
(1, 6),
(1, 14),
(2, 14),
(3, 14),
(5, 14),
(6, 14),
(11, 14),
(13, 14),
(14, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedal_carrinho`
--

DROP TABLE IF EXISTS `tb_pedal_carrinho`;
CREATE TABLE IF NOT EXISTS `tb_pedal_carrinho` (
  `cd_pedal` int(5) DEFAULT NULL,
  `cd_carrinho` int(5) DEFAULT NULL,
  `qt_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_pedal_carrinho`
--

INSERT INTO `tb_pedal_carrinho` (`cd_pedal`, `cd_carrinho`, `qt_pedal`) VALUES
(13, 8, 1),
(3, 10, 3),
(11, 11, 1),
(6, 12, 3),
(1, 13, 1),
(3, 13, 1),
(6, 14, 1),
(5, 15, 1),
(11, 7, 3),
(2, 15, 1),
(1, 18, 1),
(2, 18, 2),
(3, 18, 2),
(1, 19, 1),
(2, 19, 1),
(3, 19, 1),
(1, 20, 1),
(1, 21, 1),
(2, 21, 2),
(1, 22, 1),
(2, 22, 2),
(6, 23, 1),
(5, 23, 1),
(11, 23, 1),
(1, 24, 2),
(6, 24, 1),
(3, 24, 1),
(13, 25, 1),
(13, 27, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_saida`
--

DROP TABLE IF EXISTS `tb_saida`;
CREATE TABLE IF NOT EXISTS `tb_saida` (
`cd_saida` int(5) NOT NULL,
  `qt_saida` int(5) DEFAULT NULL,
  `dt_saida` datetime DEFAULT NULL,
  `cd_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Fazendo dump de dados para tabela `tb_saida`
--

INSERT INTO `tb_saida` (`cd_saida`, `qt_saida`, `dt_saida`, `cd_pedal`) VALUES
(2, 3, '2015-12-05 19:37:47', 1),
(3, 20, '2015-12-05 19:45:07', 1),
(4, 110, '2015-12-05 20:07:23', 1),
(5, 4, '2015-12-05 21:07:36', 5),
(6, 1, '2015-12-05 21:09:56', 5),
(7, 65, '2015-12-05 21:12:18', 2),
(8, 1, '2015-12-05 22:12:13', 11),
(9, 7, '2015-12-10 17:59:43', 11),
(10, 5, '2016-01-22 15:12:15', 2),
(11, 10, '2016-01-22 15:25:32', 14),
(12, 100, '2016-01-22 15:31:30', 1),
(13, 35345, '2016-01-22 17:31:36', 2),
(14, 3, '2016-01-24 15:38:50', 3),
(15, 1, '2016-01-30 21:19:38', 1),
(16, 2, '2016-01-30 21:19:38', 2),
(17, 1, '2016-01-30 22:03:57', 6),
(18, 1, '2016-01-30 22:03:57', 5),
(19, 2, '2016-01-30 22:03:57', 11),
(20, 2, '2016-01-31 00:33:02', 1),
(21, 1, '2016-01-31 00:33:02', 6),
(22, 1, '2016-01-31 00:33:02', 3),
(23, 1, '2016-02-03 22:42:25', 13);

--
-- Gatilhos `tb_saida`
--
DROP TRIGGER IF EXISTS `tr_saida_estoque`;
DELIMITER //
CREATE TRIGGER `tr_saida_estoque` AFTER INSERT ON `tb_saida`
 FOR EACH ROW BEGIN 
		declare qtd int;
        declare total int;
        
        set qtd = new.qt_saida;
        set total = (select qt_estoque from tb_estoque where cd_pedal = new.cd_pedal);
        
        set total = total - qtd;
        
        if(total < 1) then
        	update tb_estoque set qt_estoque = 0 where cd_pedal = new.cd_pedal;
        else
        	update tb_estoque set qt_estoque = total where cd_pedal = new.cd_pedal;
        end if;
        
        
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
`cd_usuario` int(5) NOT NULL,
  `nm_usuario` varchar(60) DEFAULT NULL,
  `cd_email` varchar(60) DEFAULT NULL,
  `nm_senha` varchar(32) DEFAULT NULL,
  `cd_celular` bigint(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Fazendo dump de dados para tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `cd_email`, `nm_senha`, `cd_celular`) VALUES
(5, 'Dimitri Leandro de Oliveira Silva', 'dimitri.leandro@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11986924362),
(6, 'Lohan Nimai de Oliveira Silva', 'lohan@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11912341231),
(7, 'Fabio Leandro da Silva', 'fabio@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11912341234),
(9, 'James Hetfield', 'james@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11912312312),
(10, 'Tom Araya', 'tom@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11111111111),
(12, 'João Silva', 'joao@gmail.com', 'a4cf432438ac438635d5982035e3b21c', 11111111111),
(13, 'Teste da Silva', 'teste@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 11986924362),
(14, 'Dave Mustaine', 'dave@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 13993131231),
(15, 'Maria da Silva', 'maria@gmail.com', '2e99bf4e42962410038bc6fa4ce40d97', 41987900911),
(16, 'Dimitri Leandro', 'dimitri.leandro@outlook.com', '2e99bf4e42962410038bc6fa4ce40d97', 11986924362),
(17, 'Xuliana da Silva', 'testexuliana@teste.com', '579646aad11fae4dd295812fb4526245', 11231231231);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_venda`
--

DROP TABLE IF EXISTS `tb_venda`;
CREATE TABLE IF NOT EXISTS `tb_venda` (
`cd_venda` int(5) NOT NULL,
  `dt_venda` datetime DEFAULT NULL,
  `nm_endereco` text,
  `vl_pac` decimal(9,2) DEFAULT NULL,
  `vl_sedex` decimal(9,2) DEFAULT NULL,
  `qt_prazo_pac` int(5) DEFAULT NULL,
  `qt_prazo_sedex` int(5) DEFAULT NULL,
  `vl_total` decimal(9,2) DEFAULT NULL,
  `ic_pac_sedex` char(5) DEFAULT NULL,
  `ic_estagio` tinyint(1) DEFAULT NULL,
  `cd_carrinho` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Fazendo dump de dados para tabela `tb_venda`
--

INSERT INTO `tb_venda` (`cd_venda`, `dt_venda`, `nm_endereco`, `vl_pac`, `vl_sedex`, `qt_prazo_pac`, `qt_prazo_sedex`, `vl_total`, `ic_pac_sedex`, `ic_estagio`, `cd_carrinho`) VALUES
(2, '2016-01-26 01:40:02', '11740000-SP-Itanhaem-Praia do Sonho-Leopoldo Diz-671-0', 35.00, 37.00, 4, 1, 1047.50, 'Sedex', 1, 13),
(3, '2016-01-26 01:51:13', '12312312-PI-Piauibana-Centro-Rua 7 -123-0', 38.00, 41.00, 3, 1, 1162.73, 'Sedex', 1, 7),
(4, '2016-01-26 01:58:37', '13249123-MT-Caxias-Centro-Rua 4-330-0', 25.00, 27.00, 4, 1, 387.58, 'Sedex', 1, 11),
(5, '2016-01-22 22:48:32', '11320140 - SP - Santos - Gonzaga - Av. Ana Costa, 345/33', 47.00, 50.00, NULL, NULL, 1759.80, NULL, 0, 12),
(6, '2016-01-26 01:45:35', '11740000-SP-Itanhaem-Praia do Sonho-Leopoldo Diz-671-0', 28.00, 30.00, 4, 1, 586.60, 'Pac', 1, 14),
(7, '2016-01-27 14:26:14', '11320140-SP-São Vicente-Itararé-Pero Correa-113-94', 30.00, 33.00, 3, 1, 764.68, 'Sedex', 1, 15),
(8, '2016-01-26 01:51:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 16),
(9, '2016-01-26 01:58:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 17),
(10, '2016-01-30 21:06:17', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-', 60.00, 62.00, 3, 1, 2472.10, 'Sedex', 1, 18),
(11, '2016-01-30 21:08:59', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 43.00, 45.00, 3, 1, 1445.55, 'Sedex', 1, 19),
(12, '2016-01-30 21:11:02', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 25.00, 27.00, 3, 1, 419.00, 'Sedex', 1, 20),
(13, '2016-01-30 21:14:06', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 39.00, 41.00, 3, 1, 1215.10, 'Sedex', 1, 21),
(14, '2016-01-30 21:19:32', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 39.00, 41.00, 3, 1, 1215.10, 'Sedex', 1, 22),
(15, '2016-01-31 00:17:28', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 41.00, 43.00, 3, 1, 1340.80, 'Sedex', 1, 23),
(16, '2016-01-31 00:32:52', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 52.00, 54.00, 3, 1, 2053.10, 'Sedex', 1, 24),
(17, '2016-02-03 22:42:20', '11320140-SP-Santos-Gonzaga-Av. Ana Costa-21-0', 25.00, 27.00, 3, 1, 419.00, 'Sedex', 1, 25),
(18, '2016-02-03 22:42:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 26),
(19, '2017-10-07 13:53:20', '11320140-SP-Santos-Embaré-Conselheiro -123-2', 26.00, 27.00, 5, 1, 419.00, NULL, 0, 27);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_video`
--

DROP TABLE IF EXISTS `tb_video`;
CREATE TABLE IF NOT EXISTS `tb_video` (
`cd_video` int(5) NOT NULL,
  `nm_link` varchar(60) DEFAULT NULL,
  `cd_pedal` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Fazendo dump de dados para tabela `tb_video`
--

INSERT INTO `tb_video` (`cd_video`, `nm_link`, `cd_pedal`) VALUES
(43, 'https://www.youtube.com/watch?v=k0gsuJdQnl4', 3),
(44, 'https://www.youtube.com/watch?v=k0gsuJdQnl4', 3),
(45, 'https://www.youtube.com/watch?v=k0gsuJdQnl4', 3),
(46, 'https://www.youtube.com/watch?v=k0gsuJdQnl4', 3),
(50, 'https://www.youtube.com/watch?v=yjb0j9l1sz4', 6),
(51, 'https://www.youtube.com/watch?v=yjb0j9l1sz4', 6),
(75, 'https://www.youtube.com/watch?v=kzOkza_u3Z8', 4),
(76, 'https://www.youtube.com/watch?v=kzOkza_u3Z8', 4),
(77, 'https://www.youtube.com/watch?v=kzOkza_u3Z8', 4),
(78, 'https://www.youtube.com/watch?v=kzOkza_u3Z8', 4),
(84, 'https://www.youtube.com/watch?v=af59U2BRRAU', 5),
(85, 'https://www.youtube.com/watch?v=af59U2BRRAU', 5),
(86, 'https://www.youtube.com/watch?v=af59U2BRRAU', 5),
(87, 'https://www.youtube.com/watch?v=af59U2BRRAU', 5),
(90, 'https://www.youtube.com/watch?v=IxuEtL7gxoM', 2),
(91, 'https://www.youtube.com/watch?v=IxuEtL7gxoM', 2),
(92, 'https://www.youtube.com/watch?v=IxuEtL7gxoM', 2),
(93, 'https://www.youtube.com/watch?v=IxuEtL7gxoM', 2),
(101, 'https://www.youtube.com/watch?v=0P9rwoGOSPQ', 13),
(102, 'https://www.youtube.com/watch?v=Ol87N0nxfVs', 13),
(103, 'https://www.youtube.com/watch?v=nn8a8Mwyz08', 11),
(104, 'https://www.youtube.com/watch?v=nn8a8Mwyz08', 11),
(105, 'https://www.youtube.com/watch?v=nn8a8Mwyz08', 11),
(106, 'https://www.youtube.com/watch?v=nn8a8Mwyz08', 11),
(107, 'https://www.youtube.com/watch?v=1M4ADcMn3dA', 1),
(108, 'https://www.youtube.com/watch?v=1M4ADcMn3dA', 1),
(109, 'https://www.youtube.com/watch?v=1M4ADcMn3dA', 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_estoque`
--
DROP VIEW IF EXISTS `vw_estoque`;
CREATE TABLE IF NOT EXISTS `vw_estoque` (
`cod` int(5)
,`nome` varchar(50)
,`entrada` varchar(31)
,`saida` varchar(31)
,`qtd` int(5)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_pedal`
--
DROP VIEW IF EXISTS `vw_pedal`;
CREATE TABLE IF NOT EXISTS `vw_pedal` (
`codigo` int(5)
,`nome` varchar(50)
,`categoria` varchar(50)
,`instrumento` char(1)
,`caminho` varchar(20)
);
-- --------------------------------------------------------

--
-- Estrutura para view `vw_estoque`
--
DROP TABLE IF EXISTS `vw_estoque`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_dmt`@`%` SQL SECURITY DEFINER VIEW `vw_estoque` AS select `tb_pedal`.`cd_pedal` AS `cod`,`tb_pedal`.`nm_pedal` AS `nome`,(select concat(`tb_entrada`.`dt_entrada`,'*',`tb_entrada`.`qt_entrada`) from (`tb_entrada` join `tb_pedal`) where ((`tb_pedal`.`cd_pedal` = `tb_entrada`.`cd_pedal`) and (`tb_entrada`.`cd_pedal` = `cod`)) order by `tb_entrada`.`cd_entrada` desc limit 1) AS `entrada`,(select concat(`tb_saida`.`dt_saida`,'*',`tb_saida`.`qt_saida`) from (`tb_saida` join `tb_pedal`) where ((`tb_pedal`.`cd_pedal` = `tb_saida`.`cd_pedal`) and (`tb_saida`.`cd_pedal` = `cod`)) order by `tb_saida`.`cd_saida` desc limit 1) AS `saida`,`tb_estoque`.`qt_estoque` AS `qtd` from (`tb_pedal` join `tb_estoque`) where (`tb_pedal`.`cd_pedal` = `tb_estoque`.`cd_pedal`);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_pedal`
--
DROP TABLE IF EXISTS `vw_pedal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_dmt`@`%` SQL SECURITY DEFINER VIEW `vw_pedal` AS select `tb_pedal`.`cd_pedal` AS `codigo`,`tb_pedal`.`nm_pedal` AS `nome`,`tb_pedal`.`nm_categoria` AS `categoria`,`tb_pedal`.`ic_guitar_bass` AS `instrumento`,(select `tb_imagem`.`nm_caminho` from `tb_imagem` where (`tb_imagem`.`cd_pedal` = `codigo`) limit 1) AS `caminho` from `tb_pedal` where (`tb_pedal`.`ic_ativo_inativo` = 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_artista`
--
ALTER TABLE `tb_artista`
 ADD PRIMARY KEY (`cd_artista`);

--
-- Índices de tabela `tb_carousel`
--
ALTER TABLE `tb_carousel`
 ADD PRIMARY KEY (`cd_carousel`);

--
-- Índices de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
 ADD PRIMARY KEY (`cd_carrinho`), ADD KEY `fk_carrinho_usuario` (`cd_usuario`);

--
-- Índices de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
 ADD PRIMARY KEY (`cd_endereco`), ADD KEY `fk_endereco_usuario` (`cd_usuario`);

--
-- Índices de tabela `tb_entrada`
--
ALTER TABLE `tb_entrada`
 ADD PRIMARY KEY (`cd_entrada`), ADD KEY `fk_entrada_pedal` (`cd_pedal`);

--
-- Índices de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
 ADD PRIMARY KEY (`cd_estoque`), ADD KEY `fk_estoque_pedal` (`cd_pedal`);

--
-- Índices de tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
 ADD PRIMARY KEY (`cd_imagem`), ADD KEY `fk_imagem_pedal` (`cd_pedal`);

--
-- Índices de tabela `tb_notificacao`
--
ALTER TABLE `tb_notificacao`
 ADD PRIMARY KEY (`cd_notificacao`);

--
-- Índices de tabela `tb_pedal`
--
ALTER TABLE `tb_pedal`
 ADD PRIMARY KEY (`cd_pedal`);

--
-- Índices de tabela `tb_pedal_artista`
--
ALTER TABLE `tb_pedal_artista`
 ADD KEY `fk_pedal_artista_pedal` (`cd_pedal`), ADD KEY `fk_pedal_artista_artista` (`cd_artista`);

--
-- Índices de tabela `tb_pedal_carrinho`
--
ALTER TABLE `tb_pedal_carrinho`
 ADD KEY `fk_pedal_carrinho_pedal` (`cd_pedal`), ADD KEY `fk_pedal_carrinho_carrinho` (`cd_carrinho`);

--
-- Índices de tabela `tb_saida`
--
ALTER TABLE `tb_saida`
 ADD PRIMARY KEY (`cd_saida`), ADD KEY `fk_saida_pedal` (`cd_pedal`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
 ADD PRIMARY KEY (`cd_usuario`);

--
-- Índices de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
 ADD PRIMARY KEY (`cd_venda`), ADD KEY `fk_venda_carrinho` (`cd_carrinho`);

--
-- Índices de tabela `tb_video`
--
ALTER TABLE `tb_video`
 ADD PRIMARY KEY (`cd_video`), ADD KEY `fk_video_pedal` (`cd_pedal`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_artista`
--
ALTER TABLE `tb_artista`
MODIFY `cd_artista` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de tabela `tb_carousel`
--
ALTER TABLE `tb_carousel`
MODIFY `cd_carousel` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
MODIFY `cd_carrinho` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
MODIFY `cd_endereco` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `tb_entrada`
--
ALTER TABLE `tb_entrada`
MODIFY `cd_entrada` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
MODIFY `cd_estoque` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
MODIFY `cd_imagem` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de tabela `tb_pedal`
--
ALTER TABLE `tb_pedal`
MODIFY `cd_pedal` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de tabela `tb_saida`
--
ALTER TABLE `tb_saida`
MODIFY `cd_saida` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
MODIFY `cd_usuario` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
MODIFY `cd_venda` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de tabela `tb_video`
--
ALTER TABLE `tb_video`
MODIFY `cd_video` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=110;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
ADD CONSTRAINT `fk_carrinho_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

--
-- Restrições para tabelas `tb_endereco`
--
ALTER TABLE `tb_endereco`
ADD CONSTRAINT `fk_endereco_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

--
-- Restrições para tabelas `tb_entrada`
--
ALTER TABLE `tb_entrada`
ADD CONSTRAINT `fk_entrada_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_estoque`
--
ALTER TABLE `tb_estoque`
ADD CONSTRAINT `fk_estoque_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_imagem`
--
ALTER TABLE `tb_imagem`
ADD CONSTRAINT `fk_imagem_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_pedal_artista`
--
ALTER TABLE `tb_pedal_artista`
ADD CONSTRAINT `fk_pedal_artista_artista` FOREIGN KEY (`cd_artista`) REFERENCES `tb_artista` (`cd_artista`),
ADD CONSTRAINT `fk_pedal_artista_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_pedal_carrinho`
--
ALTER TABLE `tb_pedal_carrinho`
ADD CONSTRAINT `fk_pedal_carrinho_carrinho` FOREIGN KEY (`cd_carrinho`) REFERENCES `tb_carrinho` (`cd_carrinho`),
ADD CONSTRAINT `fk_pedal_carrinho_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_saida`
--
ALTER TABLE `tb_saida`
ADD CONSTRAINT `fk_saida_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

--
-- Restrições para tabelas `tb_venda`
--
ALTER TABLE `tb_venda`
ADD CONSTRAINT `fk_venda_carrinho` FOREIGN KEY (`cd_carrinho`) REFERENCES `tb_carrinho` (`cd_carrinho`);

--
-- Restrições para tabelas `tb_video`
--
ALTER TABLE `tb_video`
ADD CONSTRAINT `fk_video_pedal` FOREIGN KEY (`cd_pedal`) REFERENCES `tb_pedal` (`cd_pedal`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
