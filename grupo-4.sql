-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for grupo-4
CREATE DATABASE IF NOT EXISTS `grupo-4` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `grupo-4`;

-- Dumping structure for table grupo-4.carrinho
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `qtty` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `size` float DEFAULT NULL,
  `comprado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table grupo-4.carrinho: ~18 rows (approximately)
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;

-- Dumping structure for table grupo-4.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` tinyint(4) NOT NULL,
  `Categoria` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table grupo-4.categorias: ~4 rows (approximately)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`idCategoria`, `Categoria`) VALUES
	(1, 'Sapatilha'),
	(2, 'Sapato'),
	(3, 'Chinelo'),
	(4, 'Bota');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Dumping structure for table grupo-4.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `marca` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `modelo` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `genero` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `cor` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `preco` float NOT NULL DEFAULT '0',
  `img1g` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `img2g` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `img3g` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `img1m` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `img2m` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `destaque` binary(1) NOT NULL DEFAULT '0',
  `novoArtigo` binary(1) NOT NULL DEFAULT '0',
  `descricao` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table grupo-4.produtos: ~12 rows (approximately)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `categoria`, `marca`, `modelo`, `genero`, `cor`, `preco`, `img1g`, `img2g`, `img3g`, `img1m`, `img2m`, `destaque`, `novoArtigo`, `descricao`) VALUES
	(1, 1, 'Nike', 'Air Force', 'Mulher', 'Amarelo', 150, '1-g-pr.png', '1-g-cm.png', '1-g-bx.png', '1-m-pr.png', '1-m-cm.png', _binary 0x31, _binary 0x30, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Force continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Force clássicas.'),
	(2, 1, 'Nike', 'Air Force', 'Homem', 'Vermelho', 160, '2-g-pr.png', '2-g-cm.png', '2-g-bx.png', '2-m-pr.png', '2-m-cm.png', _binary 0x31, _binary 0x30, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Force continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Force clássicas.'),
	(3, 1, 'Nike', 'Air Force', 'Mulher', 'Rosa', 150, '3-g-pr.png', '3-g-cm.png', '3-g-bx.png', '3-m-pr.png', '3-m-cm.png', _binary 0x31, _binary 0x31, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Force continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Force clássicas.'),
	(4, 2, 'Nike', 'Air Force', 'Homem', 'Verde', 130, '4-g-pr.png', '4-g-cm.png', '4-g-bx.png', '4-m-pr.png', '4-m-cm.png', _binary 0x31, _binary 0x30, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Force continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Force clássicas.'),
	(5, 1, 'Nike', 'Air Max', 'Mulher', 'Amarelo', 100, '5-g-pr.png', '5-g-cm.png', '5-g-bx.png', '5-m-pr.png', '5-m-cm.png', _binary 0x30, _binary 0x31, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Max continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Max clássicas.'),
	(6, 1, 'Nike', 'Air Force', 'Mulher', 'Branco', 90, '6-g-pr.png', '6-g-cm.png', '6-g-bx.png', '6-m-pr.png', '6-m-cm.png', _binary 0x30, _binary 0x31, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Force continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Force clássicas.'),
	(7, 1, 'Nike', 'Air Max', 'Rapaz', 'Azul', 80, '7-g-pr.png', '7-g-cm.png', '7-g-bx.png', '7-m-pr.png', '7-m-cm.png', _binary 0x31, _binary 0x30, 'Um modelo robusto preparado para te dar energia em todos os quilómetros da corrida, as Nike Air Max continuam a dar impulso à tua passada com a mesma espuma reativa do modelo anterior. A malha na parte superior combina o conforto e a durabilidade que pretendes com um ajuste que remete para as Air Max clássicas.'),
	(8, 4, 'Nike', 'Jordan 1 Mid', 'Rapariga', 'Rosa', 50, '8-g-pr.png', '8-g-cm.png', '8-g-bx.png', '8-m-pr.png', '8-m-cm.png', _binary 0x31, _binary 0x30, 'Inspiradas nas Air Jordan originais, as sapatilhas Jordan 1 Mid mostram aos mais pequenos uma parte da história das sapatilhas com um ajuste e uma sensação aperfeiçoados para proporcionar conforto, sendo concebidas para acompanhar as suas brincadeiras frenéticas.'),
	(9, 4, 'Nike', 'High Utility 2.0', 'Mulher', 'Preto', 120, '9-g-pr.png', '9-g-cm.png', '9-g-bx.png', '9-m-pr.png', '9-m-cm.png', _binary 0x31, _binary 0x31, 'Criadas para te permitir ir mais além, as Nike High Utility 2.0 exibem uma inspiração robusta tipo militar ao estilo AF1. A parte superior em pele polida robusta com revestimento foi concebida para ajudar a manter a secura. Na sola exterior, as saliências grandes e preparadas para o inverno oferecem tração sem criar maior altura. A tira inclui um gancho em metal elegante que é emblemático do vestuário militar tradicional.'),
	(10, 4, 'Nike', 'Goaterra 2.0', 'Homem', 'Castanho', 140, '10-g-pr.png', '10-g-cm.png', '10-g-bx.png', '10-m-pr.png', '10-m-cm.png', _binary 0x30, _binary 0x30, 'Mantém um estilo robusto com as Nike Goaterra 2.0.Fabricadas em pele premium com um brilho perfeito, exibem um acabamento concebido para ajudar a manter a secura.Robustas e preparadas para as ruas, estas botas podem ser combinadas com um estilo mais formal ou mais descontraído dependendo do teu estado de espírito.A boca extremamente almofadada e o amortecimento Air no calcanhar asseguram conforto.'),
	(11, 4, 'Nike', 'Borough Mid 2', 'Rapaz', 'Preto', 40, '11-g-pr.png', '11-g-cm.png', '11-g-bx.png', '11-m-pr.png', '11-m-cm.png', _binary 0x30, _binary 0x31, 'As Nike Borough Mid 2 apresentam um ajuste estruturado e sustentado num design retro de basquetebol para garantir aos mais novos um look de estrela fora de campo. O isolamento felpudo no interior ajuda a manter os pés dos mais pequenos confortáveis e quentes.'),
	(12, 3, 'Nike', 'Jordan Break', 'Rapaz', 'Vermelho', 30, '12-g-pr.png', '12-g-cm.png', '12-g-bx.png', '12-m-pr.png', '12-m-cm.png', _binary 0x31, _binary 0x30, 'Com uma tira fixa na parte de cima do pé, os chinelos Jordan Break contam com pele sintética resistente e amortecimento em espuma leve para garantir conforto por baixo do pé.');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Dumping structure for table grupo-4.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `nome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sobrenome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `numero` int(11) NOT NULL DEFAULT '0',
  `endereco` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `codigoPostal` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `localidade` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `cidade` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `palavraChave` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table grupo-4.utilizadores: ~2 rows (approximately)
/*!40000 ALTER TABLE `utilizadores` DISABLE KEYS */;
INSERT INTO `utilizadores` (`id`, `email`, `nome`, `sobrenome`, `numero`, `endereco`, `codigoPostal`, `localidade`, `cidade`, `palavraChave`) VALUES
	(1, 'rui@gmail.com', 'Rui', 'Araújo', 911234567, 'rua da cheda', '4000-400', 'Coimbra', 'Coimbra', '750379b5926e9f728aa6c253d37e3792'),
	(2, 'alberto@gmail.com', 'Alberto', 'Varandas', 912234123, 'rua do peixe', '2000-100', 'Santarém', 'Santarém', '0c23a8bf29a191f18aee814737e2a6ec');
/*!40000 ALTER TABLE `utilizadores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
