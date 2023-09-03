/*
SQLyog Ultimate v8.55 
MySQL - 5.7.31-log : Database - hospital_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hospital_system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hospital_system`;

/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_no` varchar(250) NOT NULL,
  `p_email` varchar(250) NOT NULL,
  `d_id` int(11) NOT NULL,
  `d_name` varchar(250) NOT NULL,
  `avl_date` varchar(250) NOT NULL,
  `avl_time` varchar(250) NOT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `approve` int(11) DEFAULT '0',
  `done` int(11) DEFAULT '0',
  `cancel` int(11) DEFAULT '0',
  `d_cancel` int(11) DEFAULT '0',
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `appointments` */

/*Table structure for table `doctors` */

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `specialization` varchar(250) NOT NULL,
  `time_from` varchar(50) NOT NULL,
  `time_to` varchar(50) NOT NULL,
  `available_date` varchar(250) NOT NULL,
  `create_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `doctors` */

/*Table structure for table `prescriptions` */

DROP TABLE IF EXISTS `prescriptions`;

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(250) NOT NULL,
  `p_email` varchar(250) NOT NULL,
  `d_id` int(11) NOT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `upload_path` varchar(250) NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prescriptions` */

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`id`,`user_type`) values (1,'admin'),(2,'doctor'),(3,'patient');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `user_type` int(11) NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`name`,`nic`,`blood_group`,`gender`,`address`,`date_of_birth`,`user_type`,`create_datetime`) values (1,'admin','admin@admin.com','81dc9bdb52d04dc20036dbd8313ed055','admin','','A+','male','Hospital User','2023-02-11',1,'2023-02-11 12:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
