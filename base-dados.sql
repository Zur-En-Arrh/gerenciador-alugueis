-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_projeto
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `username` varchar(100) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES ('Ulisses','projetofinal');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patrimonio` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `especificacao` varchar(100) DEFAULT NULL,
  `status` enum('disponível','emprestado','esgotado','em manutenção','avariado','alienado') DEFAULT NULL,
  `observacoes` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamentos`
--

LOCK TABLES `equipamentos` WRITE;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
INSERT INTO `equipamentos` VALUES (1,'3295296','Arduino',1,'Especificação 101','disponível','Observações iniciais. Modificação 3. Lorem ipsum dolor sit amet, cbcaecati deleniti architecto maiores distinctio ipsam harum quae dolor voluptatem, id magni numquam odio suscipit, eos ut voluptate totam!'),(2,'','Cabo de rede',1,'Alguma descrição','disponível','Cabo RJ-45 JACK.'),(6,'42984192','Roteador',5,'Especificação 105','disponível','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, explicabo? Vel quasi quod architecto inventore soluta nesciunt. Iste maiores eligendi, alias voluptas ullam soluta quasi, omnis accusamus perspiciatis nobis exercitationem.'),(8,'ABDS49520','Monitor',5,'Especificação 205','disponível','Observações de teste.'),(9,'48354819','Multímetro',4,'Especificação 6.','disponível','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fringilla pellentesque tortor, et ullamcorper elit volutpat at. Cras tincidunt orci ac nisi lacinia, quis cursus est molestie. Duis sit amet ante elit. In urna est, tincidunt eget ultrices sed, accumsan vitae quam. Vestibulum tincidunt felis semper magna commodo convallis. Duis ac nulla dignissim, lobortis orci a.'),(10,'42492105','Crimpador de Cabo',10,'Especificação 7.','em manutenção','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fringilla pellentesque tortor, et ullamcorper elit volutpat at. Cras tincidunt orci ac nisi lacinia, quis cursus est molestie. Duis sit amet ante elit. In urna est, tincidunt eget ultrices sed, accumsan vitae quam. Vestibulum tincidunt felis semper magna commodo convallis. Duis ac nulla dignissim, lobortis orci a, tincidunt metus. Cras euismod, sem dictum ornare venenatis, velit urna fermentum mauris, et convallis ipsum magna sed ante. Nullam ac efficitur turpis, et semper justo.'),(11,'32FKU8342','Testador de Cabo de Rede',13,'Especificação 8.','disponível','Phasellus interdum egestas commodo. In mollis risus vulputate tellus varius pretium. Donec placerat ipsum porta, rutrum mi et, condimentum metus. Suspendisse blandit justo vel vestibulum mattis. Morbi id lectus rutrum, bibendum purus et, sodales velit. Morbi tempor blandit turpis, sit amet sodales ante gravida a. Praesent eu nunc dictum, egestas orci sit amet, tempus orci. Phasellus viverra tellus nec lacus ultrices interdum. '),(12,'941HASJ','Raspberry Pi',9,'Especificação 8.','disponível','Morbi tempor blandit turpis, sit amet sodales ante gravida a. Praesent eu nunc dictum, egestas orci sit amet, tempus orci. Phasellus viverra tellus nec lacus ultrices interdum. ');
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER desejo_cumprido AFTER UPDATE ON equipamentos FOR EACH ROW
BEGIN
 if (NEW.status <> Old.status and new.status = 'Disponível') THEN
 delete from wishlists where id_equipamento = new.id;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_requisicao` date DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `progresso` enum('Aberto','Concluído','Em Espera','Cancelado') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_equipamento` (`id_equipamento`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (6,1,1,7,'2018-11-28','2018-12-20','2018-12-04','Concluído'),(2,3,1,2,'2018-11-25','2018-11-28','2018-11-28','Concluído'),(15,3,2,1,'2018-12-11','2018-12-23','2018-12-11','Concluído'),(14,3,1,1,'2018-12-11','2018-12-18','2018-12-11','Concluído'),(12,3,11,3,'2018-12-11','2018-12-20','2018-12-11','Concluído');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER aluguel BEFORE INSERT ON pedidos FOR EACH ROW
BEGIN
select estoque into @total from equipamentos where id = new.id_equipamento;
 if (new.progresso = 'Aberto') THEN
	call subtrair_estoque(new.id_equipamento, @total, new.quantidade);
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER muda_aluguel AFTER UPDATE ON pedidos FOR EACH ROW
BEGIN
select estoque into @total from equipamentos where id = new.id_equipamento;
 if ((new.progresso <> old.progresso) and (new.progresso = 'Concluído' or new.progresso = 'Cancelado')) THEN
	call somar_estoque(new.id_equipamento, @total, new.quantidade);
 END IF;
 
 if((new.progresso <> old.progresso) and new.progresso <> 'Concluído' and new.progresso <> 'Cancelado') THEN
    call subtrair_estoque(new.id_equipamento, @total, new.quantidade);
 END IF;
 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sala` varchar(30) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `matricula` varchar(16) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'3INFO','Matheus','15608406761','matheuszache2@gmail.com','1600431INFI','21985676244'),(2,'3INFO','João Undefined Paulo','18411259701','jptinirjbrlate@gmail.com','1600426INFI','219967539522'),(3,'3TEL','Niuan','090909','tracerow@hotmail.com','1500657ELME','00 0000-00000'),(5,'3INFO','Leonardo Sasse','18783580735','leonardosasse2@gmail.com','1600429INFI','21971424389'),(6,'3INFO','joao pedro de assis oliveira','18774336754','joaopedrodeassis02@gmail.com','1600567INFI','021976954297');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id_equipamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_equipamento`),
  KEY `id_equipamento` (`id_equipamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_projeto'
--

--
-- Dumping routines for database 'db_projeto'
--
/*!50003 DROP PROCEDURE IF EXISTS `somar_estoque` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `somar_estoque`(id_equipamento integer, total integer, quantidade integer)
Begin
if(total > 0) then
update equipamentos set estoque = (total + quantidade) where id = id_equipamento;
end if;

if(total = 0) then
update equipamentos set estoque = (total + quantidade), status = 'disponível' where id = id_equipamento;
end if;
End ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `subtrair_estoque` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `subtrair_estoque`(id_equipamento integer, total integer, quantidade integer)
begin
	if((total-quantidade) = 0) then
		update equipamentos set estoque = (total - quantidade), status = 'esgotado' where id = id_equipamento;
	END IF;

	if ((total-quantidade) > 0) then
		update equipamentos set estoque = (total - quantidade) where id = id_equipamento;
	end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-11 23:11:12
