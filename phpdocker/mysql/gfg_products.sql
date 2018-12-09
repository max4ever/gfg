CREATE DATABASE  IF NOT EXISTS `gfg` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `gfg`;
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: gfg
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_index` (`brand`),
  KEY `products_price_index` (`price`),
  KEY `products_stock_index` (`stock`),
  KEY `products_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'damore.net','portorico',57.20,7),(2,'wunsch.com','architecto',0.00,3),(3,'sauer.info','repellat',1811.74,7),(4,'ritchiezulauf.biz','et',2457732.19,7),(5,'windler.biz','aut',0.00,6),(6,'botsforddare.com','aut',0.12,8),(7,'pacochahane.org','possimus',469968.32,1),(8,'kuhic.info','qui',8539012.35,9),(9,'hermann.com','quos',110585.82,2),(10,'boylestehr.biz','aut',710901.77,2),(11,'herzog.com','expedita',71245.29,3),(12,'tremblay.com','dolorem',94953540.00,4),(13,'fisherstoltenberg.com','aut',0.19,7),(14,'sipeswalsh.com','soluta',4.29,3),(15,'keelinghahn.biz','ea',220.22,1),(16,'hermann.org','nam',64016.46,4),(17,'pricemurazik.net','ea',0.80,7),(18,'wiegandryan.com','magni',1.64,1),(19,'parisian.org','eveniet',99999999.99,4),(20,'bartellkessler.com','et',0.00,8),(21,'walker.com','nesciunt',0.00,3),(22,'greenfelderbruen.net','rerum',2.49,2),(23,'walsh.com','autem',18.14,9),(24,'jast.com','sed',837.20,5),(25,'gutkowski.com','repudiandae',0.30,8),(26,'labadie.net','sint',99999999.99,8),(27,'jast.info','ut',10898.00,3),(28,'carroll.com','ratione',266.68,4),(29,'shanahan.info','sunt',1778026.64,2),(30,'bechtelar.org','omnis',12480.57,5),(31,'blanda.com','maiores',99999999.99,4),(32,'brekke.info','reprehenderit',666.46,4),(33,'effertzchristiansen.com','veniam',6.00,9),(34,'pacocha.com','quos',99999999.99,8),(35,'donnelly.com','quaerat',0.00,4),(36,'bailey.com','perspiciatis',1685713.40,9),(37,'hahnbarton.com','cum',0.33,6),(38,'sanford.biz','est',5465.52,4),(39,'heidenreich.com','eveniet',1.85,4),(40,'oberbrunnerbartell.com','doloremque',3.18,6),(41,'konopelski.com','atque',0.77,4),(42,'cormier.com','ex',385.53,8),(43,'runolfsson.org','aperiam',147.20,4),(44,'bins.com','fuga',99999999.99,3),(45,'weissnat.com','ut',7.00,8),(46,'mayerlarkin.biz','aspernatur',3480.90,1),(47,'kulas.com','harum',9504602.12,8),(48,'dach.com','autem',26826.10,1),(49,'runolfsdottir.net','eos',8800013.00,5),(50,'harvey.com','accusamus',0.00,4),(51,'heller.com','qui',74019539.00,3),(52,'leannon.com','ut',99999999.99,6),(53,'littel.com','assumenda',0.79,3),(54,'corkery.com','ipsa',5233516.46,2),(55,'stracke.info','officia',778.75,7),(56,'abernathy.com','ex',99999999.99,3),(57,'waelchi.com','nulla',15.07,2),(58,'vonbergstrom.com','et',0.00,7),(59,'hudson.org','sit',5893.89,1),(60,'colebogan.com','quia',6452.69,5),(61,'langosh.org','magnam',99999999.99,9),(62,'feest.net','eaque',8263670.00,5),(63,'quigleyfarrell.org','explicabo',33268.40,6),(64,'legros.com','quaerat',4426.59,6),(65,'oconnell.com','enim',4552974.70,9),(66,'leannonrau.com','aut',32296577.89,2),(67,'nader.com','et',8.58,9),(68,'beatty.com','ad',50300053.77,2),(69,'beier.info','similique',150493.52,9),(70,'dubuque.biz','consequuntur',2824.60,1),(71,'gulgowski.com','pariatur',47.06,1),(72,'homenick.org','accusantium',4602788.51,9),(73,'framiaufderhar.com','sunt',2409.62,1),(74,'brakus.com','ipsum',74519.10,8),(75,'haleywiza.com','omnis',158.60,6),(76,'collier.info','iure',10015737.01,9),(77,'greenfelderberge.org','non',3.57,3),(78,'runte.biz','non',43.97,9),(79,'romaguera.com','voluptas',3.62,2),(80,'barton.info','reiciendis',73.31,3),(81,'schmittkuphal.com','labore',269.49,2),(82,'cartwrightcummerata.com','consequatur',54468564.55,9),(83,'gutmann.net','culpa',0.65,1),(84,'schinnerhowell.com','qui',385185.00,4),(85,'kautzer.com','ullam',0.00,4),(86,'bins.org','voluptate',5483044.99,6),(87,'ziemann.biz','molestiae',708688.15,4),(88,'dare.com','eius',58123.38,4),(89,'frami.com','voluptatem',180.00,7),(90,'bogan.biz','quam',528.72,2),(91,'kuvalis.com','veniam',658.23,3),(92,'lowe.com','voluptatem',87607183.71,3),(93,'gutkowski.com','est',163450.43,8),(94,'moore.com','numquam',10.76,8),(95,'torp.info','debitis',16835843.87,9),(96,'larkin.info','consequatur',31.32,4),(97,'blick.com','eos',53954.98,2),(98,'buckridge.biz','necessitatibus',141936.50,1),(99,'schaefer.com','dolorum',24.07,2),(100,'gutkowskiaufderhar.info','a',1626.80,5);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-09 14:34:59
