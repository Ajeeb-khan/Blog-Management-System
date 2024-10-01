/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - 21516_ajeeb_khan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`21516_ajeeb_khan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `21516_ajeeb_khan`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(200) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,1,'Cricket',6,'10400926101104989925sports.jpg','Active','2024-09-24 22:40:54','0000-00-00 00:00:00'),
(2,1,'Newz',4,'1741659398Karachi1.jpg','Active','2024-09-24 23:45:58',NULL),
(3,1,'Technologies',4,'804919740imag.jpg','Active','2024-09-24 23:55:19',NULL),
(4,1,'Bollywood',3,'456473322bollywood.jpg','Active','2024-09-25 00:02:40',NULL),
(5,1,'lollywood',3,'1960914899images.png','Active','2024-09-25 00:05:09',NULL);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(1,'Sports','A human activity involving physical exertion and skill as the primary focus of the activity, with elements of competition or social participation where rules and patterns of behaviour governing the activity exist formally through organisations and is generally recognised as a sport.','Active','2024-09-24 22:36:34',NULL),
(2,'Technology','Technology is a body of knowledge used to create tools, process things, and extract materials. Technology may be described in the form of products, processes, or organizations. People use technology to expand their capabilities, and that makes people the most civilized members of the technological systems.','Active','2024-09-24 22:37:46',NULL),
(3,'Newz','News is information about current events. This may be provided through many different media: word of mouth, printing, postal systems, broadcasting, electronic communication, or through the testimony of observers and witnesses to events. News is sometimes called \"hard news\" to differentiate it from soft media.','Active','2024-09-24 22:38:20',NULL),
(4,'Entertainment','Entertainment refers to any activity, performance, or form of media that is designed to amuse, entertain, or engage an audience. It encompasses a wide range of experiences and content, including movies, television shows, music, theater, sports, video games, amusement parks, and live performances.','Active','2024-09-24 22:38:53',NULL),
(5,'Grosary','a store that sells perishable and nonperishable food supplies and certain nonedible household items, such as soaps and paper products. Usually groceries; especially British, grocery. food and other items sold at a grocery store or sold by a grocer. the business of a grocer.','Active','2024-09-24 22:39:53',NULL);

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`status`,`created_at`,`updated_at`) values 
(2,6,1,'Followed','2024-09-24 23:35:31',NULL),
(3,2,1,'Followed','2024-09-24 23:40:32',NULL);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT 'Active',
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(5,1,'Babar azam','Post Summary','Post Summary','1727243814524021933news (1).webp','Active',1,'2024-09-24 22:56:54','2024-09-24 22:56:54'),
(6,1,'Babar breaks Virat Kohli&#039;s record','Post Summary','Post Summary','971558206524021933news (1).webp','Active',1,'2024-09-24 23:33:03',NULL),
(7,1,'Trvis head','ravis Head, a left-handed batsman and wicketkeeper, is a successful and decorated cricketer.','ravis Head, a left-handed batsman and wicketkeeper, is a successful and decorated cricketer.','38604747head.jpg','Active',1,'2024-09-24 23:38:19',NULL),
(8,2,'Pakistan is growing day by day','Pakistan, officially the Islamic Republic of Pakistan, is a country in South Asia. It is the fifth-most populous country, with a population of over 241.5 million, having the second-largest Muslim population as of 2023. Islamabad is the nation&#039;s capital, while Karachi is its largest city and financial centre.','Pakistan, officially the Islamic Republic of Pakistan, is a country in South Asia. It is the fifth-most populous country, with a population of over 241.5 million, having the second-largest Muslim population as of 2023. Islamabad is the nation&#039;s capital, while Karachi is its largest city and financial centre.','644355761Karachi1.jpg','Active',1,'2024-09-24 23:47:57',NULL),
(9,2,'Imran khan','Imran Ahmed Khan Niazi is a Pakistani politician and former cricketer who served as the 22nd prime minister of Pakistan from August 2018 until April 2022.','Imran Ahmed Khan Niazi is a Pakistani politician and former cricketer who served as the 22nd prime minister of Pakistan from August 2018 until April 2022.','16731724141449267869306980725imran2.jpg','Active',1,'2024-09-24 23:50:49',NULL),
(10,1,'Virat performance','He&#039;s a right-handed batsman and an occasional unorthodox right arm medium bowler. Kohli is regarded as one of the greatest batsmen of all time and the greatest in the modern era. He holds the highest IPL run-scorer record, ranks third in T20I, third in ODI, and stands the fourth-highest in international cricket.','He&#039;s a right-handed batsman and an occasional unorthodox right arm medium bowler. Kohli is regarded as one of the greatest batsmen of all time and the greatest in the modern era. He holds the highest IPL run-scorer record, ranks third in T20I, third in ODI, and stands the fourth-highest in international cricket.','1214549601virat.webp','Active',1,'2024-09-24 23:52:33',NULL),
(11,1,'Pakistan','Post Summary','Post Description','2032729923fbr.jpg','Active',1,'2024-09-24 23:54:12',NULL),
(12,3,'Technology grow up','Technology is a body of knowledge used to create tools, process things, and extract materials. Technology may be described in the form of products, processes, or organizations. People use technology to expand their capabilities, and that makes people the most civilized members of the technological systems.','Technology is a body of knowledge used to create tools, process things, and extract materials. Technology may be described in the form of products, processes, or organizations. People use technology to expand their capabilities, and that makes people the most civilized members of the technological systems.','10070680820x0.webp','Active',1,'2024-09-24 23:57:00',NULL),
(13,3,'Ai is Growing','Technology is a body of knowledge used to create tools, process things, and extract materials. Technology may be described in the form of products, processes, or organizations. People use technology to expand their capabilities, and that makes people the most civilized members of the technological systems.','Technology is a body of knowledge used to create tools, process things, and extract materials. Technology may be described in the form of products, processes, or organizations. People use technology to expand their capabilities, and that makes people the most civilized members of the technological systems.','1094153121aj.jpg','Active',1,'2024-09-24 23:58:39',NULL),
(14,1,'Sofia robot','Sophia is a realistic humanoid robot capable of displaying humanlike expressions and interacting with people. It&#039;s designed for research, education, and entertainment, and helps promote public discussion about AI ethics and the future of robotics.','Sophia is a realistic humanoid robot capable of displaying humanlike expressions and interacting with people. It&#039;s designed for research, education, and entertainment, and helps promote public discussion about AI ethics and the future of robotics.','2111637818sofia.jpeg','Active',1,'2024-09-25 00:00:57',NULL),
(15,4,'salman khan','Post Summary','Post Description','1169194414salm.jpg','Active',1,'2024-09-25 00:03:53',NULL),
(16,5,'Pakistan darama craze','Post Summary','Post Summary','1727248754420001444entertain (4).jpg','Active',1,'2024-09-25 00:19:14','0000-00-00 00:00:00'),
(17,5,'daramas','Post Summary','Post Summary','1727248481420001444entertain (4).jpg','Active',1,'2024-09-25 00:14:41','2024-09-25 00:14:41');

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_atachment` */

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(4,5,'Babar','1537832143524021933news (1).webp','Active','2024-09-24 22:54:37',NULL),
(5,6,'Babar','1848243130524021933news (1).webp','Active','2024-09-24 23:33:03',NULL),
(6,7,'Trivis head','371235930head.jpg','Active','2024-09-24 23:38:19',NULL),
(7,8,'iamge','117214367217268927701042029409img-4.jpg','Active','2024-09-24 23:47:57',NULL),
(8,9,'image','154446789361086524imran2.jpg','Active','2024-09-24 23:50:49',NULL),
(9,10,'image','267601630about (2).jpg','Active','2024-09-24 23:52:33',NULL),
(10,11,'image','1698766068ali.jpg','Active','2024-09-24 23:54:12',NULL),
(11,12,'image','2052134137aj.jpg','Active','2024-09-24 23:57:00',NULL),
(12,13,'image','368708269ali.jpg','Active','2024-09-24 23:58:39',NULL),
(13,14,'sofia ','2111493562ali.jpg','Active','2024-09-25 00:00:57',NULL),
(14,15,'iamge','482582070ali.jpg','Active','2024-09-25 00:03:53',NULL),
(15,16,'image','1400285608aj.jpg','Active','2024-09-25 00:06:30',NULL),
(16,17,'image','1269112500aj.jpg','Active','2024-09-25 00:08:16',NULL);

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(2,6,1,'2024-09-24 23:33:03',NULL),
(3,7,1,'2024-09-24 23:38:19',NULL),
(4,8,3,'2024-09-24 23:47:57',NULL),
(5,9,3,'2024-09-24 23:50:49',NULL),
(6,10,1,'2024-09-24 23:52:33',NULL),
(7,11,3,'2024-09-24 23:54:12',NULL),
(8,12,2,'2024-09-24 23:57:00',NULL),
(9,13,2,'2024-09-24 23:58:39',NULL),
(10,14,2,'2024-09-25 00:00:57',NULL),
(11,15,4,'2024-09-25 00:03:53',NULL),
(12,16,4,'2024-09-25 00:06:30',NULL);

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,5,1,'good','Active','2024-09-24 22:55:07'),
(2,6,2,'Babar is a good player','Active','2024-09-24 23:40:06');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'admin','Active'),
(2,'user','Active');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'Ajeeb','Khan','ajeeb@gmail.com','Ajeeb123','Male','2002-09-24','15928185ajeeb khan.jpg','Jamshoro Phase One','Approved','Active','2024-09-24 21:45:07',NULL),
(2,2,'Zakir','Ali','zakir@gmail.com','Zakir123','Male','1998-09-24','16682370511260406784360141848IMG_20201113_175721.jpg','Sukker','Approved','Active','2024-09-24 22:30:59',NULL),
(3,2,'Kaleem','Junejo','kaleem@gmail.com','Kaleem','Male','2002-09-24','75725624645949939612644569251576667645o.jpg','Larkana','Pending','Active','2024-09-24 22:26:25',NULL),
(4,2,'Nadia','Ali','nadia@gmail.com','Nadia123','Female','2003-09-24','1116157907office (1).jpg','Karachi','Pending','Active','2024-09-24 22:27:34',NULL),
(5,2,'Waeem','Siyal','waseem@gmail.com','Waseem123','Male','2001-09-24','678118172office (2).jpg','Lahore','Approved','Active','2024-09-24 22:32:05',NULL),
(6,1,'Sumaira','Ali','sumaira@gmail.com','Sumaira123','Male','2002-01-01','1565216951office (1).jpg','Karachii','Approved','Active','2024-09-24 23:43:10',NULL);

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`) values 
(1,NULL,'Wjahat Hussain','wajahat@gmail.com','Keep it up','2024-09-24 22:58:19'),
(2,2,'Zakir Ali','zakir@gmail.com','Iam user this is good website','2024-09-24 23:42:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
