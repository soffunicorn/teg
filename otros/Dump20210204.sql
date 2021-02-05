-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: teg_laravel
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Xerxes','COMERCIAL LEE c.a','J-12345-5','11e8072ec0201cpmsr45092Xax1cd6o','73','siwatom@mailinator.com','23:58:00','15:04:00','Est quo et deleniti','2021-02-05 05:05:08','2021-02-05 05:05:08',4),(2,'xeres food','Tempor minima harum','J-5433O4-5','0a e302fom12op2db520158s088ecr6xdoc','12334','xeres@mail.com','22:15:00','23:22:00','poopop','2021-02-05 05:20:51','2021-02-05 05:20:51',4);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `company_locals`
--

LOCK TABLES `company_locals` WRITE;
/*!40000 ALTER TABLE `company_locals` DISABLE KEYS */;
INSERT INTO `company_locals` VALUES (1,NULL,NULL,1,1),(2,NULL,NULL,2,3);
/*!40000 ALTER TABLE `company_locals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Informatica','+1 (189) 892-1428','informatica@gmail.com','10:24:00','19:24:00','Disponible','locales','2021-02-05 04:24:52','2021-02-05 04:24:52'),(2,'Mantenimientos','+1 (946) 316-2469','togovecys@mailinator.com','14:36:00','01:22:00','Disponible','Laborum mollit ut it','2021-02-05 04:25:40','2021-02-05 04:25:40');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `incidents`
--

LOCK TABLES `incidents` WRITE;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
/*!40000 ALTER TABLE `incidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `locals`
--

LOCK TABLES `locals` WRITE;
/*!40000 ALTER TABLE `locals` DISABLE KEYS */;
INSERT INTO `locals` VALUES (1,'L-145','2021-02-05 05:04:35','2021-02-05 05:05:08',6),(2,'L-230','2021-02-05 05:19:14','2021-02-05 05:19:14',4),(3,'L-12','2021-02-05 05:19:19','2021-02-05 05:20:51',6),(4,'L-11','2021-02-05 05:19:25','2021-02-05 05:19:25',4);
/*!40000 ALTER TABLE `locals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2021_01_04_174456_create_rol_table',1),(4,'2021_01_04_184131_create_departments_table',1),(5,'2021_01_06_013835_create_states_tables',1),(6,'2021_01_06_195102_create_locals_table',1),(7,'2021_01_06_235112_create_companies_table',1),(8,'2021_01_08_192122_create_types_table',1),(9,'2021_01_09_000000_create_users_table',1),(10,'2021_01_09_215440_create_incidents_table',1),(11,'2021_01_12_165941_create_comments_table',1),(12,'2021_01_12_195537_create_company_locals_table',1),(13,'2021_11_05_170253_create_user_companies_table',1),(14,'2021_11_06_170333_create_users__departments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Administrador','super_admin',NULL,NULL),(2,'Administrador','admin',NULL,NULL),(3,'Locatario','local',NULL,NULL),(4,'Empleado del Sambil','empleado',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Por hacer','todo',NULL,NULL),(2,'En proceso','process',NULL,NULL),(3,'Hecho','done',NULL,NULL),(4,'Disponible','available',NULL,NULL),(5,'No disponible','unavailable',NULL,NULL),(6,'Ocupado','busy',NULL,NULL),(7,'Deshabilitado','disabled',NULL,NULL);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Supervisor','boss',NULL,NULL),(2,'Trabajador','worker',NULL,NULL),(3,'Dueño','owner',NULL,NULL),(4,'Supervisor Local','boss_local',NULL,NULL),(5,'Trabajador Local','worker_local',NULL,NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_company`
--

LOCK TABLES `user_company` WRITE;
/*!40000 ALTER TABLE `user_company` DISABLE KEYS */;
INSERT INTO `user_company` VALUES (1,NULL,NULL,2,2);
/*!40000 ALTER TABLE `user_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sofia','','sofia@mail.com',NULL,'$2y$10$wAojsJ3/34681thTiCBLD.tUogQYWK4Q0jjVTFLvRHYx6or/XeTJe','eto2ce1u0bn6f49fi66m0050I2a1rc12as0r',NULL,NULL,'2021-02-05 04:24:52','2021-02-05 04:24:52',4,1),(2,'Edwin','Mogollon','edwin@mail.com',NULL,'$2y$10$ymA0SfOjPiEz2yDe0rSHIeZd6W20rEl22OmoGVtje56mp8evGi33.','3Er0n2d86su1w1dd50e2b2eci0a031',NULL,NULL,'2021-02-05 05:20:51','2021-02-05 05:20:51',3,3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_departments`
--

LOCK TABLES `users_departments` WRITE;
/*!40000 ALTER TABLE `users_departments` DISABLE KEYS */;
INSERT INTO `users_departments` VALUES (1,NULL,NULL,1,1),(2,NULL,NULL,2,1);
/*!40000 ALTER TABLE `users_departments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-04 23:22:19
