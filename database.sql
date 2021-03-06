-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: monitor
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `tor_proxies`
--

DROP TABLE IF EXISTS `tor_proxies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tor_proxies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `config_file` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `disabled_at` datetime DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tor_proxies`
--

LOCK TABLES `tor_proxies` WRITE;
/*!40000 ALTER TABLE `tor_proxies` DISABLE KEYS */;
INSERT INTO `tor_proxies` VALUES (1,'socks5://127.0.0.1:9061','/etc/tor/torrc.1',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (2,'socks5://127.0.0.1:9063','/etc/tor/torrc.2',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (3,'socks5://127.0.0.1:9065','/etc/tor/torrc.3',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (4,'socks5://127.0.0.1:9067','/etc/tor/torrc.4',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (5,'socks5://127.0.0.1:9069','/etc/tor/torrc.5',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (6,'socks5://127.0.0.1:9071','/etc/tor/torrc.6',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (7,'socks5://127.0.0.1:9073','/etc/tor/torrc.7',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (8,'socks5://127.0.0.1:9075','/etc/tor/torrc.8',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (9,'socks5://127.0.0.1:9077','/etc/tor/torrc.9',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (10,'socks5://127.0.0.1:9079','/etc/tor/torrc.10',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (11,'socks5://127.0.0.1:9081','/etc/tor/torrc.11',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (12,'socks5://127.0.0.1:9083','/etc/tor/torrc.12',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (13,'socks5://127.0.0.1:9085','/etc/tor/torrc.13',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (14,'socks5://127.0.0.1:9087','/etc/tor/torrc.14',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
INSERT INTO `tor_proxies` VALUES (15,'socks5://127.0.0.1:9089','/etc/tor/torrc.15',0,'1970-01-01 00:00:00','1970-01-01 00:00:00');
/*!40000 ALTER TABLE `tor_proxies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-14 16:06:12
