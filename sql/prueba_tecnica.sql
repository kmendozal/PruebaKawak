/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.4.3 : Database - bd_documentos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bd_documentos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bd_documentos`;

/*Table structure for table `doc_documento` */

DROP TABLE IF EXISTS `doc_documento`;

CREATE TABLE `doc_documento` (
  `DOC_ID` int NOT NULL AUTO_INCREMENT,
  `DOC_NOMBRE` varchar(60) DEFAULT NULL,
  `DOC_CODIGO` int DEFAULT NULL,
  `DOC_CONTENIDO` varchar(4000) DEFAULT NULL,
  `DOC_ID_TIPO` int DEFAULT NULL,
  `DOC_ID_PROCESO` int DEFAULT NULL,
  PRIMARY KEY (`DOC_ID`),
  KEY `DOC_PROCESO_IDX` (`DOC_ID_PROCESO`),
  KEY `DOC_TIPO_IDX` (`DOC_ID_TIPO`),
  CONSTRAINT `DOC_PROCESO_IDX` FOREIGN KEY (`DOC_ID_PROCESO`) REFERENCES `pro_proceso` (`PRO_ID`),
  CONSTRAINT `DOC_TIPO_IDX` FOREIGN KEY (`DOC_ID_TIPO`) REFERENCES `tip_tipo_doc` (`TIP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `doc_documento` */

/*Table structure for table `pro_proceso` */

DROP TABLE IF EXISTS `pro_proceso`;

CREATE TABLE `pro_proceso` (
  `PRO_ID` int NOT NULL AUTO_INCREMENT,
  `PRO_PREFIJO` varchar(20) DEFAULT NULL,
  `PRO_NOMBRE` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`PRO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pro_proceso` */

insert  into `pro_proceso`(`PRO_ID`,`PRO_PREFIJO`,`PRO_NOMBRE`) values 
(1,'ING','INGENIERIA'),
(2,'ADM','ADMINISTRACION'),
(3,'RRHH','RECURSOS HUMANOS'),
(4,'SIS','SISTEMAS'),
(5,'MER','MERCADEO');

/*Table structure for table `tip_tipo_doc` */

DROP TABLE IF EXISTS `tip_tipo_doc`;

CREATE TABLE `tip_tipo_doc` (
  `TIP_ID` int NOT NULL AUTO_INCREMENT,
  `TIP_NOMBRE` varchar(60) DEFAULT NULL,
  `TIP_PREFIJO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`TIP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tip_tipo_doc` */

insert  into `tip_tipo_doc`(`TIP_ID`,`TIP_NOMBRE`,`TIP_PREFIJO`) values 
(1,'INSTRUCTIVO','INS'),
(2,'PROCEDIMIENTO','PRO'),
(3,'MANUAL','MAN'),
(4,'POLITICA','POL'),
(5,'FORMATO','FOR');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
