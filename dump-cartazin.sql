-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: cartazeando
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `id_produto` bigint NOT NULL,
  `produto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `estoque` bigint DEFAULT NULL,
  `prazo_inicial` bigint DEFAULT NULL,
  `prazo_final` bigint DEFAULT NULL,
  `preco_partida` decimal(10,2) DEFAULT NULL,
  `preco_a_prazo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rotina_produtos`
--


UNLOCK TABLES;

--
-- Table structure for table `tipo_cartaz`
--

DROP TABLE IF EXISTS `tipo_cartaz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_cartaz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_cartaz` varchar(50) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `dimensao_inicial` float NOT NULL,
  `dimensao_final` float NOT NULL,
  `qtd_folhas` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cartaz`
--

LOCK TABLES `tipo_cartaz` WRITE;
/*!40000 ALTER TABLE `tipo_cartaz` DISABLE KEYS */;
INSERT INTO `tipo_cartaz` VALUES (1,'A4','Cartaz tamanho A4',21,29.7,1),(2,'A3','Cartaz tamanho A3',29.7,42,2);
/*!40000 ALTER TABLE `tipo_cartaz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_formato`
--

--
-- Table structure for table `tipo_pagamento`
--

DROP TABLE IF EXISTS `tipo_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_pagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pagamento`
--

LOCK TABLES `tipo_pagamento` WRITE;
/*!40000 ALTER TABLE `tipo_pagamento` DISABLE KEYS */;
INSERT INTO `tipo_pagamento` VALUES (1,'Cartão'),(2,'Carteira'),(3,'A vista');
/*!40000 ALTER TABLE `tipo_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_permissao`
--

DROP TABLE IF EXISTS `tipo_permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_permissao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_permissao`
--

LOCK TABLES `tipo_permissao` WRITE;
/*!40000 ALTER TABLE `tipo_permissao` DISABLE KEYS */;
INSERT INTO `tipo_permissao` VALUES (1,'Administrativo'),(2,'Padrão');
/*!40000 ALTER TABLE `tipo_permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_permissao` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UN` (`usuario`),
  KEY `tipo_permissao_FK` (`id_tipo_permissao`),
  CONSTRAINT `tipo_permissao_FK` FOREIGN KEY (`id_tipo_permissao`) REFERENCES `tipo_permissao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=361 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cartazeando'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-10 20:48:00
