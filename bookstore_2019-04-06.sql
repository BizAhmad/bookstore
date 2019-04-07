# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: bookstore
# Generation Time: 2019-04-07 00:25:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Address`;

CREATE TABLE `Address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civic_number` varchar(11) NOT NULL DEFAULT '',
  `city` varchar(15) NOT NULL DEFAULT '',
  `province` varchar(45) NOT NULL DEFAULT '',
  `postal_code` varchar(9) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Address` WRITE;
/*!40000 ALTER TABLE `Address` DISABLE KEYS */;

INSERT INTO `Address` (`id`, `civic_number`, `city`, `province`, `postal_code`)
VALUES
	(1,'123','mtl','qc','hhhhhr');

/*!40000 ALTER TABLE `Address` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Book
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Book`;

CREATE TABLE `Book` (
  `isbn` varchar(45) NOT NULL DEFAULT '',
  `title` varchar(45) NOT NULL DEFAULT '',
  `edition` varchar(5) DEFAULT '',
  `price` double NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `total_quantity_sold` int(11) DEFAULT NULL,
  `author` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Book` WRITE;
/*!40000 ALTER TABLE `Book` DISABLE KEYS */;

INSERT INTO `Book` (`isbn`, `title`, `edition`, `price`, `available_quantity`, `total_quantity_sold`, `author`)
VALUES
	('1234567','book1','2',23,2,0,'ahmad'),
	('12345672','book3','2',43,1,0,'ahmad'),
	('4342123','book2','2',22,2,0,'ahmad');

/*!40000 ALTER TABLE `Book` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table BookOrders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `BookOrders`;

CREATE TABLE `BookOrders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `is_received` tinyint(1) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `book_isbn` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `book_isbn` (`book_isbn`),
  CONSTRAINT `BookOrders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Order` (`id`),
  CONSTRAINT `BookOrders_ibfk_2` FOREIGN KEY (`book_isbn`) REFERENCES `Book` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Branches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Branches`;

CREATE TABLE `Branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `branch_name` varchar(45) NOT NULL DEFAULT '',
  `manager` varchar(45) NOT NULL DEFAULT '',
  `phone_number` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `publisher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `Branches_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `Address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Branches_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `Publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Customer`;

CREATE TABLE `Customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT '',
  `phone_number` varchar(15) DEFAULT '',
  `email` varchar(45) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT '',
  `password` varchar(45) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Employee`;

CREATE TABLE `Employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(45) DEFAULT '',
  `SSN` int(11) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT '',
  `email` varchar(45) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT '',
  `password` varchar(45) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `SSN` (`SSN`),
  KEY `employee_address` (`address_id`),
  CONSTRAINT `employee_address` FOREIGN KEY (`address_id`) REFERENCES `Address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;

INSERT INTO `Employee` (`id`, `full_name`, `SSN`, `phone_number`, `email`, `address_id`, `username`, `password`)
VALUES
	(12,'ahmad',2341234,'1231241','email',1,'name','pw'),
	(13,'',NULL,'',NULL,NULL,'admin','8fe4c11451281c094a6578e6ddbf5eed'),
	(14,'',NULL,'',NULL,NULL,'admin','8fe4c11451281c094a6578e6ddbf5eed'),
	(15,'',NULL,'',NULL,NULL,'ahmad','1a1dc91c907325c69271ddf0c944bc72'),
	(16,'',NULL,'',NULL,NULL,'admin','e529a9cea4a728eb9c5828b13b22844c');

/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Order`;

CREATE TABLE `Order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publisher_id` (`publisher_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `Publisher` (`id`),
  CONSTRAINT `Order_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `Branches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Publisher
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Publisher`;

CREATE TABLE `Publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL DEFAULT '',
  `phone_number` varchar(11) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `address_id` int(11) NOT NULL,
  `publisher_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `Publisher_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `Address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Purchases
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Purchases`;

CREATE TABLE `Purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `book_isbn` varchar(45) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_purchase` (`customer_id`),
  KEY `purchased_book` (`book_isbn`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `Purchases_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customer_purchase` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `purchased_book` FOREIGN KEY (`book_isbn`) REFERENCES `Book` (`isbn`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
