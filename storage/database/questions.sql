-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: moodle
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions`
(
    `id`                    bigint                                                        NOT NULL AUTO_INCREMENT,
    `parent`                bigint                                                        NOT NULL DEFAULT '0',
    `name`                  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
    `questiontext`          longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     NOT NULL,
    `questiontextformat`    tinyint                                                       NOT NULL DEFAULT '0',
    `generalfeedback`       longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     NOT NULL,
    `generalfeedbackformat` tinyint                                                       NOT NULL DEFAULT '0',
    `defaultmark`           decimal(12, 7)                                                NOT NULL DEFAULT '1.0000000',
    `penalty`               decimal(12, 7)                                                NOT NULL DEFAULT '0.3333333',
    `qtype`                 varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  NOT NULL DEFAULT '',
    `length`                bigint                                                        NOT NULL DEFAULT '1',
    `stamp`                 varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
    `created_at`            timestamp                                                     NULL     DEFAULT NULL,
    `updated_at`            timestamp                                                     NULL     DEFAULT NULL,
    `deleted_at`            timestamp                                                     NULL     DEFAULT NULL,
    `createdby`             bigint                                                                 DEFAULT NULL,
    `modifiedby`            bigint                                                                 DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `ques_qty_ix` (`qtype`),
    KEY `ques_par_ix` (`parent`),
    KEY `ques_cre_ix` (`createdby`),
    KEY `ques_mod_ix` (`modifiedby`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci
  ROW_FORMAT = COMPRESSED COMMENT ='This table stores the definition of one version of a question';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions`
    DISABLE KEYS */;
INSERT INTO `questions`
VALUES (1, 0, 'What is Laravel SL',
        '<p dir=\"ltr\" style=\"text-align: left;\">A Web administration to support Second life Scripts </p>', 1, '', 1,
        1.0000000, 1.0000000, 'truefalse', 1, 'moodle.localhost+220518202241+6BEpWL', null, 1652905361,1652905361, 2, 2),
       (2, 0, 'What is Laravel SL?', '<p dir=\"ltr\" style=\"text-align: left;\">Is SLOODLE a Moodle Module?</p>', 1,
        '', 1, 1.0000000, 1.0000000, 'truefalse', 1, 'moodle.localhost+220518202509+BgN4PK', 1652905509, 1652905509,1652905509, 2,
        2),
       (3, 0, 'Is SLOODLE a Moodle Module?',
        '<p dir=\"ltr\" style=\"text-align: left;\">Is SLOODLE a Moodle Module?</p>', 1, '', 1, 1.0000000, 1.0000000,
        'truefalse', 1, 'moodle.localhost+220518202538+wvJobo', null, 1652905538,1652905538, 2, 2),
       (4, 0, 'What is SLOODLE?', '<p dir=\"ltr\" style=\"text-align: left;\">What is SLOODLE?<br></p>', 1, '', 1,
        1.0000000, 0.3333333, 'multichoice', 1, 'moodle.localhost+220518202707+QW56Eu', null, 1652905627,1652905627, 2, 2);
/*!40000 ALTER TABLE `questions`
    ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2022-05-21 13:11:19
