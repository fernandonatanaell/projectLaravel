/*
SQLyog Community
MySQL - 10.4.20-MariaDB : Database - db_asiateknik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `carts` */

/*Data for the table `customers` */

insert  into `customers`(`customer_id`,`customer_name`,`customer_email`,`customer_address`,`customer_phone_number`,`customer_jk`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Shania Nababan','shania.nababan@gmail.com','Gg. Suniaraja No. 694','087281577274','P','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(2,'Argono Nasyiah','argono.nasyiah@gmail.com','Jln. Gotong Royong No. 435','089464393791','L','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(3,'Gantar Natsir','gantar.natsir@gmail.com','Jr. Bayan No. 414','085634918057','L','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(4,'Embuh Gunawan','embuh.gunawan@gmail.com','Gg. Bank Dagang Negara No. 113','086825806292','L','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(5,'Rahayu Palastri','rahayu.palastri@gmail.com','Gg. Perintis Kemerdekaan No. 752','081669195238','P','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(6,'Hana Santoso','hana.santoso@gmail.com','Gg. Industri No. 247','088403269033','P','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(7,'Amelia Saputra','amelia.saputra@gmail.com','Psr. Setiabudhi No. 943','082054872982','P','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(8,'Gatot Halimah','gatot.halimah@gmail.com','Ki. Basuki No. 509','082377340942','L','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(9,'Bahuwirya Ardianto','bahuwirya.ardianto@gmail.com','Jr. Bakhita No. 142','088267163456','L','2022-12-10 15:11:22','2022-12-10 15:11:22',NULL),
(10,'Diana Lailasari','diana.lailasari@gmail.com','Gg. Pasir Koja No. 23','088925142393','P','2022-12-10 15:11:22','2022-12-11 05:13:25',NULL);

/*Data for the table `dtrans` */

/*Data for the table `htrans` */

/*Data for the table `items` */

insert  into `items`(`item_id`,`item_name`,`item_brand`,`item_price`,`item_stock`,`item_image_name`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Aqua Japan AC (Air Conditioner) AQA-KCR5ANR 1/2 PK 1pc','Aqua',5400000,90,'1670519726 - ac.png','2022-12-08 17:15:26','2022-12-10 15:08:31',NULL),
(2,'ASPIRA Kabin Filter AC H4-80292-JAZ-1800 Jazz 1pc','Aspira',120000,70,'1670519787 - filter_ac.png','2022-12-08 17:16:27','2022-12-08 17:16:48',NULL),
(3,'Morris Refrigerant R134A Tabung Besar 1pc','Morris',1800000,200,'1670519867 - freon32.jpg','2022-12-08 17:17:47','2022-12-09 09:08:30',NULL),
(4,'WD-40 Multi-Use Product 6.5 fl oz/191ml/155g 1pc','WD-40',54000,140,'1670583413 - WD-40.png','2022-12-09 10:56:53','2022-12-09 10:56:53',NULL),
(5,'Lampu LED Bohlam Premium 20Watt Putih PANALED','Panaled',7000,20,'1670584214 - panaled.jpg','2022-12-09 11:10:14','2022-12-10 15:17:23',NULL),
(6,'Pompa galon elektrik tap otomatis 600ml dispenser air minum','Banmal',64000,110,'1670584671 - pompa_elektrik.jpg','2022-12-09 11:17:51','2022-12-09 11:17:51',NULL),
(7,'Obeng Magnet Amerika Bolak Balik Gagang Karet - 8 Inch - Obeng American 2 In 1 - High Quality','Amerika',7800,230,'1670584870 - obeng_amerika.png','2022-12-09 11:21:10','2022-12-10 15:17:53',NULL),
(8,'TANG AMPERE / DIGITAL CLAMP METER','Welt',80000,40,'1670585158 - tang_ampere.jpg','2022-12-09 11:25:58','2022-12-09 11:25:58',NULL),
(9,'1pcs MASKO TESPEN','Masko',13900,185,'1670585404 - tespen_masko.jpg','2022-12-09 11:30:04','2022-12-09 11:30:04',NULL),
(10,'Minyak Singer','Singer',8000,205,'1670585559 - minyak_singer.jpg','2022-12-09 11:32:39','2022-12-09 11:32:39',NULL);

/*Data for the table `services` */

/*Data for the table `services_items` */

/*Data for the table `services_users` */

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_name`,`user_username`,`user_password`,`user_dob`,`user_address`,`user_phone_number`,`user_jk`,`user_status`,`user_role`,`user_salary`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Fernando Natanael','fernandonatanaell','$2y$10$n2gk/7xPEslxl5XUFBTL6e5XObiFWI9LKty9PW4XP/6zFbqMAO2JK','2022-08-12','Jl. rumah nando','084957406827','L',1,0,0,'2022-12-08 15:12:32','2022-12-08 15:12:32',NULL),
(2,'Agnes Sisilia','agnessisilia','$2y$10$xTiLiDkJpVw401lF6hl2k.rGzQgia6SEIAmkrqcUUA7lBy44dSZt6','2023-01-08','di rumah agnes','082596425754','P',1,1,2080000,'2022-12-08 15:14:15','2022-12-10 15:48:18',NULL),
(3,'Windah Basudara','windahbasudara','$2y$10$6K8gmkRIMslqoRza8QIJb.M8xnyjNlG6ecgQhTpqDJ9xAtdMLuvzy','2023-02-08','Jl. rumah windah','082469543695','L',1,1,4280000,'2022-12-08 15:15:12','2022-12-10 15:49:22',NULL),
(4,'Wendy Walters','wendywalters','$2y$10$7y2vM7dkEW4LG0Vmh3H9KOE4o0/2VOYsHEXyySVR7fOfZA8S9dtI.','2023-03-08','Jl. rumah wendy','083546501467','P',1,1,0,'2022-12-08 15:15:52','2022-12-10 15:24:49',NULL),
(5,'Garit Dewana','garitdewana','$2y$10$IltiUOxVYN7455DQRs3cyOVMKyc6wIkOE97.JjbSSihlImhBVfcAm','2023-04-08','Jl. rumah garit','082356864567','L',1,2,0,'2022-12-08 15:17:06','2022-12-08 15:17:06',NULL),
(6,'Selena Gomez','selenagomez','$2y$10$2dktppinGdHnFTbPvtybiu0fBPD6XJCP1mVh0IhEi950Ol2b7HIA2','2023-05-08','Jl. rumah selena','082579432865','P',1,2,0,'2022-12-08 15:18:01','2022-12-08 15:18:01',NULL),
(7,'Mas Oddy','maumandi','$2y$10$Ec1H25Avhk/uSBCr.waKNOzb1wo9VZ83fbuoZMvlcen8ntl/wA83C','2023-06-08','Jl. rumah oddy','081559753294','L',1,2,0,'2022-12-08 15:18:42','2022-12-08 15:18:42',NULL),
(8,'Lesti Billar','lestibillar','$2y$10$1v2R8wJfuf9.9Y/VgikQCe.JKe3mnnwe8tZkdIzZQ0dD5FHhsrA/2','2023-08-09','Jl. rumah lesty','082468464936','P',1,3,0,'2022-12-09 08:27:28','2022-12-09 08:27:28',NULL),
(9,'Natasha Donabella','natashadonabella','$2y$10$kgzW3mgEpj5HLJLTcf7Ijuc8fuPjccnGeMkq0twxdvOQFzGUzjPGO','2023-02-10','Jl. rumah natasha','085697592467','P',1,3,0,'2022-12-10 15:42:27','2022-12-10 15:42:27',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
