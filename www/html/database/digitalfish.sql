-- --------------------------------------------------------
-- Host:                         192.168.0.23
-- Server version:               10.1.23-MariaDB-9+deb9u1 - Raspbian 9.0
-- Server OS:                    debian-linux-gnueabihf
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for jayfish
DROP DATABASE IF EXISTS `jayfish`;
CREATE DATABASE IF NOT EXISTS `jayfish` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jayfish`;

-- Dumping structure for table jayfish.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `setting` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.admin: ~6 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `setting`, `value`) VALUES
  (0, 'wallpaper', 'wallpaper.jpg'),
  (3, 'passcode', '123'),
  (4, 'feed', '0'),
  (5, 'webcam-int', '192.168.0.14:9999'),
  (6, 'webcam-ext', '70.79.91.189:9999'),
  (7, 'webcam-sub', '192');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table jayfish.alert
DROP TABLE IF EXISTS `alert`;
CREATE TABLE IF NOT EXISTS `alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection` longtext,
  `category` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `message` longtext,
  `dateset_timeset` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sendmessage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.alert: ~0 rows (approximately)
DELETE FROM `alert`;
/*!40000 ALTER TABLE `alert` DISABLE KEYS */;
/*!40000 ALTER TABLE `alert` ENABLE KEYS */;

-- Dumping structure for table jayfish.ato_relay
DROP TABLE IF EXISTS `ato_relay`;
CREATE TABLE IF NOT EXISTS `ato_relay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT '0',
  `value` varchar(50) NOT NULL DEFAULT '0',
  `gpio` varchar(50) NOT NULL DEFAULT '0',
  `switchgpio` varchar(50) NOT NULL DEFAULT '0',
  `ml` int(11) NOT NULL DEFAULT '0',
  `polarity` int(11) NOT NULL DEFAULT '0',
  `failswitchgpio` int(11) NOT NULL DEFAULT '0',
  `resevoirgpio` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.ato_relay: ~1 rows (approximately)
DELETE FROM `ato_relay`;
/*!40000 ALTER TABLE `ato_relay` DISABLE KEYS */;
INSERT INTO `ato_relay` (`id`, `type`, `value`, `gpio`, `switchgpio`, `ml`, `polarity`, `failswitchgpio`, `resevoirgpio`) VALUES
  (1, 'ato', '1', '0', '0', 2, 1, 0, 0);
/*!40000 ALTER TABLE `ato_relay` ENABLE KEYS */;

-- Dumping structure for table jayfish.chem
DROP TABLE IF EXISTS `chem`;
CREATE TABLE IF NOT EXISTS `chem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortname` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `measurement` varchar(45) NOT NULL,
  `threshold` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shortname` (`shortname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.chem: ~0 rows (approximately)
DELETE FROM `chem`;
/*!40000 ALTER TABLE `chem` DISABLE KEYS */;
/*!40000 ALTER TABLE `chem` ENABLE KEYS */;

-- Dumping structure for table jayfish.classification
DROP TABLE IF EXISTS `classification`;
CREATE TABLE IF NOT EXISTS `classification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classification` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.classification: ~0 rows (approximately)
DELETE FROM `classification`;
/*!40000 ALTER TABLE `classification` DISABLE KEYS */;
/*!40000 ALTER TABLE `classification` ENABLE KEYS */;

-- Dumping structure for table jayfish.codes
DROP TABLE IF EXISTS `codes`;
CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.codes: ~4 rows (approximately)
DELETE FROM `codes`;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` (`id`, `code`, `state`) VALUES
  (2, 'relaypolarity', '0'),
  (5, 'thermtype', '1'),
  (6, 'threshold', '0'),
  (7, 'lddreboot', '0');
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;

-- Dumping structure for table jayfish.event
DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(50) NOT NULL DEFAULT '0',
  `dateset` date DEFAULT NULL,
  `timeset` time DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `filterid` int(11) DEFAULT NULL,
  `chemid` int(11) DEFAULT NULL,
  `value_1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3293 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.event: ~167 rows (approximately)
DELETE FROM `event`;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `event`, `dateset`, `timeset`, `value`, `filterid`, `chemid`, `value_1`) VALUES
  (7, 'waterchange', '2018-06-27', '21:26:04', '11', NULL, NULL, NULL),
  (125, 'Sponge', '2017-01-01', '21:11:25', 'Added', 100, NULL, NULL),
  (126, 'Sponge', '2017-01-01', '21:11:45', 'Clean', 100, NULL, NULL),
  (130, 'Sponge', '2017-01-08', '13:07:13', 'Clean', 100, NULL, NULL),
  (134, 'Sponge', '2017-02-05', '16:21:27', 'Clean', 100, NULL, NULL),
  (137, 'Sponge', '2017-02-05', '16:23:36', 'Clean', 100, NULL, NULL),
  (138, 'Sponge', '2017-02-06', '20:06:14', 'Clean', 100, NULL, NULL),
  (139, 'Sponge', '2017-03-12', '10:14:35', 'Clean', 100, NULL, NULL),
  (196, 'Sponge', '2017-04-09', '20:26:00', 'Clean', 100, NULL, NULL),
  (2074, 'Sponge', '2017-06-06', '15:47:32', 'Clean', 100, NULL, NULL),
  (2337, 'Sponge', '2017-06-16', '22:03:55', 'Clean', 100, NULL, NULL),
  (3126, 'Sponge', '2018-01-05', '09:23:29', 'Clean', 100, NULL, NULL),
  (3270, 'Sponge', '2018-05-20', '18:46:26', 'Clean', 100, NULL, NULL),
  (3274, 'CArbon', '2018-05-24', '19:29:44', 'Added', 101, NULL, NULL),
  (3276, 'Sponge', '2018-05-31', '20:40:07', 'Clean', 100, NULL, NULL),
  (3283, 'Filter extra', '2018-06-04', '09:30:12', 'Added', 102, NULL, NULL),
  (3284, 'Sponge Filter', '2018-06-04', '10:50:23', 'Clean', 100, NULL, NULL),
  (3285, 'Sponge Filter', '2018-06-04', '10:51:40', 'Clean', 100, NULL, NULL),
  (3286, 'Sponge Filter', '2018-06-04', '10:51:56', 'Clean', 100, NULL, NULL),
  (3287, 'Macro Filter', '2018-06-04', '10:52:03', 'Renew', 103, NULL, NULL),
  (3288, 'Carbon Filter', '2018-06-04', '10:52:07', 'Renew', 101, NULL, NULL),
  (3289, 'Macro Filter', '2018-06-04', '10:54:09', 'Renew', 103, NULL, NULL),
  (3290, 'Chemtest', '2018-06-29', '18:26:55', 'Added', 104, NULL, NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;

-- Dumping structure for table jayfish.filter
DROP TABLE IF EXISTS `filter`;
CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortname` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `expiry` int(11) DEFAULT NULL,
  `dateset` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.filter: ~4 rows (approximately)
DELETE FROM `filter`;
/*!40000 ALTER TABLE `filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter` ENABLE KEYS */;

-- Dumping structure for table jayfish.generic_devices
DROP TABLE IF EXISTS `generic_devices`;
CREATE TABLE IF NOT EXISTS `generic_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `gpio` int(11) DEFAULT '0',
  `ledgpio` int(11) DEFAULT '0',
  `state` varchar(50) DEFAULT NULL,
  `polarity` int(11) DEFAULT '0',
  `pulse` int(11) DEFAULT '0',
  `pulsetime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.generic_devices: ~2 rows (approximately)
DELETE FROM `generic_devices`;
/*!40000 ALTER TABLE `generic_devices` DISABLE KEYS */;
INSERT INTO `generic_devices` (`id`, `device`, `description`, `gpio`, `ledgpio`, `state`, `polarity`, `pulse`, `pulsetime`) VALUES
  (1, 'feed', 'Feed Button', 0, 0, NULL, 1, 0, 0),
  (2, 'feedrelay', 'Feed Relay', 0, 0, NULL, 1, 1, 1);
/*!40000 ALTER TABLE `generic_devices` ENABLE KEYS */;

-- Dumping structure for table jayfish.help
DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) DEFAULT NULL,
  `object` varchar(50) DEFAULT NULL,
  `message` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.help: ~5 rows (approximately)
DELETE FROM `help`;
/*!40000 ALTER TABLE `help` DISABLE KEYS */;
INSERT INTO `help` (`id`, `page`, `object`, `message`) VALUES
  (1, 'temperature.php', 'all', '<h4>Thermal Graph</h4>\r\n<hr>\r\n<ol>\r\n<li>The following graph displays thermal data.</li>\r\n<li>The most recent data is on the LEFT for easy matching.  So you are viewing the data from RIGHT to LEFT.</li>\r\n<li>Data columns are currently limited to 24 points from RIGHT to LEFT.</li>\r\n<li>Each label indicates Day / Month / TIME.</li>\r\n<li>Hovering over the labels at the bottom for temperature indicators allows you to switch them on and off for view purposes.</li>\r\n<li>Although the default is set to show the last 10 minutes, you can easily increase that to see larger intervals.  For example 120 minutes will show you 24 instances of data two hours apart each.</li>\r\n<li>Hot links above the graph will provide you with quick adjustements to common intervals.</li>\r\n</ol>'),
  (2, 'temperature_table.php', 'all', '<h4>Thermal Tables</h4>\r\n<hr>\r\n<ol>\r\n<li>The following table displays thermal data.</li>\r\n<li>Data rows are currently limited to 50 rows from TOP TO BOTTOM.</li>\r\n<li>Although the default is set to show the last 50 entries in 10 minute intervals, you can easily increase that to see larger intervals.  For example 120 minutes will show you 50 instances of data two hours apart each.</li>\r\n<li>Hot links above the table will provide you with quick adjustements to common intervals.</li>\r\n</ol>'),
  (3, 'ato.php', 'all', '<h4>ATO Basics</h4>\r\n<h4>\r\nDispense Duration In Seconds\r\n</h4>\r\n<ol>\r\n<li>\r\n<strong>Dispense Duration In Seconds: </strong>sHow long you would like water to despense.\r\n</li>\r\n<li>\r\n<strong>Gpio:</strong> Gpio pin number (Board Mode).\r\n</li>\r\n<li>\r\n<strong>Switch Gpio:</strong> Gpio pin number for the float switch (Board Mode).\r\n</li>\r\n<li>\r\n<strong>Millilitre Estimate</strong>:</strong> Measure you single dispense to determine this value.\r\n</li>\r\n<li>\r\n<strong>Polarity:</strong> This can be use to revers the action of relays that are on by default. TEST THIS make sure your polarity is the right way around. ONLY 0 or 1 is acceptable.\r\n</li>\r\n</ol>\r\n<p>\r\nATO is compatable with either a pair of float switches or 1 float switch and 1 water pump.  Please refer to website for schematics and design requirements.\r\n</p>'),
  (4, 'feeder.php', 'all', '<h4>Feeder</h4>\r\n<hr>\r\n<p>\r\n<h4>The feeder serves two possible purposes.</h4>\r\n</p>\r\n\r\n<ol>\r\n<li>When the feed button is pressed, it will record that feed into your database for feed metrics.  It also helps record guest feeds by family or friends.  The feed is written to the alerts\r\nrss table.  This means that your RSS notifier would respond when someone presses the button.  The button can be linked to an LED which will flash if desired, to indicate actuation. </li>\r\n<br>\r\n<li>\r\nThe second abiltity would be to enter a GPio relay number.  What this does is bind the button to a relay, allowing you to connect this to your DIY feeder if you have one.  Rememsber \r\nthat relays can be used to control DC (Battery or low voltage) based devices too.\r\n</li>\r\n\r\n\r\n</ol>\r\n\r\n<h4>Options</h4>\r\n<ol>\r\n<li>Feed Button GPio : The actual button GPio.</li>\r\n<li>Feed LED GPio: The Gpio that will light up a standard 3.3v LED</li>\r\n<li>Feed Relay GPio: The relay GPio that you would like to trigger. This would be connected to a relay that will trigger your DIY Feeder.</li>\r\n<li>Polarity: Some relay\'s work backwards, this allows you to rectify that.</li>\r\n<li>Pulse Relay Amount: How many pulses to the relay or turns.</li>\r\n<li>Pulse Relay Duration (seconds): For how long must the relay run for in each pulse.</li>\r\n</ol>\r\n<p><strong>Drastic changes to GPio config and relay might require a reboot.  If it\'s not actuating correctly.  Reboot then test.</strong></p>'),
  (5, 'webcamconfig.php', 'all', '<h4>Webcam Config</h4>\r\n<hr>\r\n<p>\r\nWebcam config is based on webcam streaming, essentially this page will frame in any web cam streaming service that provides alistening  IP and PORT.  Many poopular IP webcams\r\nofer this functionality. If you do not own a IP webcam you can use yawcam which will allow you to use a standard webcam on any pc. NOTE: This does not support the pi camera.\r\nThis design is only for IP webcams.\r\n</p>\r\n<ol>\r\n<p><strong>Internal Subnet ID</strong></p>\r\n<p>Enter the first digits of your ip address, this is important.  This is required for the page to figure out if your accessing the stream from outside your network or from the inside. If your local\r\nip address is 192.168.1.20 then the subnet id needed is 192</p>\r\n\r\n<p><strong>Webcam internal Ip:Port</strong></p>\r\n<p>This ip will be the ipaddres and the port of your webcam streaming camera or webcam attached to a pc.</p>\r\n\r\n<p><strong>Webcam External Ip:Port</strong></p>\r\n<p>This will be the external Ip address, if you would like to access your webcam from behind your router you will need to setup port forwarding.</p>\r\n\r\n<p>If you are not familiar on how to do this, google port forwarding.</p>\r\n<p><strong>TIP</strong></p>\r\n<p>To access your Jayfish from the internet, you should have two rules in your port forwarding overall.</p>\r\n<p>If you had the following setup ...</p>\r\n192.168.0.12 (Raspberry Pi)<br>\r\n192.168.0.100 (IP Webcam or PC Webcam with yawcam.)<br><br>\r\n\r\nPort forwarding on router would be ...<br>\r\n<table class="table">\r\n<th>Port Forward ext</th><th>To IP</th><th>On Port</th><tr>\r\n<td>8080</td><td>192.168.0.12</td><td>80</td><tr>\r\n<td>9999</td><td>192.168.0.100</td><td> 9999</td><tr>\r\n</table>\r\n\r\nThe above would mean that my Raspberry pi can be accesed from the outside on my external ip and port 8080 so if my external ip 50.20.11.12 then I would enter http://50.20.11.12:8080\r\n\r\n<p></p>');
/*!40000 ALTER TABLE `help` ENABLE KEYS */;

-- Dumping structure for table jayfish.inhab_category
DROP TABLE IF EXISTS `inhab_category`;
CREATE TABLE IF NOT EXISTS `inhab_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.inhab_category: ~4 rows (approximately)
DELETE FROM `inhab_category`;
/*!40000 ALTER TABLE `inhab_category` DISABLE KEYS */;
INSERT INTO `inhab_category` (`id`, `category`) VALUES
  (1, 'Fish'),
  (2, 'Coral'),
  (3, 'Inverts'),
  (4, 'Plants');
/*!40000 ALTER TABLE `inhab_category` ENABLE KEYS */;

-- Dumping structure for table jayfish.inhab_species
DROP TABLE IF EXISTS `inhab_species`;
CREATE TABLE IF NOT EXISTS `inhab_species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateset` timestamp NULL DEFAULT NULL,
  `inhab_category_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `latin` varchar(50) DEFAULT NULL,
  `description` longtext,
  `image` varchar(50) DEFAULT NULL,
  `date_introduced` timestamp NULL DEFAULT NULL,
  `inhab_status_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_inhab_species_category` (`inhab_category_id`),
  CONSTRAINT `FK1_inhab_species_category` FOREIGN KEY (`inhab_category_id`) REFERENCES `inhab_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.inhab_species: ~10 rows (approximately)
DELETE FROM `inhab_species`;
/*!40000 ALTER TABLE `inhab_species` DISABLE KEYS */;
INSERT INTO `inhab_species` (`id`, `dateset`, `inhab_category_id`, `name`, `latin`, `description`, `image`, `date_introduced`, `inhab_status_id`) VALUES
  (39, '2017-04-14 19:56:34', 1, 'Yellow Tang', 'Zebrasoma flavescens', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'yellowtang.jpg', '2017-01-31 00:00:00', '1'),
  (40, '2017-04-13 20:38:35', 1, 'Mr Eel', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'eel.jpg', '2017-02-05 00:00:00', '2'),
  (42, '2017-04-13 20:38:58', 3, 'Cleaner Shrimp', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'cleaner.jpg', '2017-02-05 05:08:32', '1'),
  (43, '2018-05-23 14:22:10', 3, 'Scarlet Crab', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'scarlet.jpg', '2017-02-05 00:00:00', '3'),
  (44, '2017-04-13 20:40:02', 3, 'Blue Hermit', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'hermit.jpg', '2017-02-05 05:09:18', '3'),
  (47, '2017-02-05 05:11:20', 2, 'Brain Coral', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'brain.jpg', '2017-02-05 05:11:20', '1'),
  (48, '2017-02-05 05:11:43', 2, 'Star Polyps', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'gsp.jpg', '2017-02-05 00:00:00', '1'),
  (49, '2017-02-05 05:12:09', 2, 'Hammer Coral', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'hammer.jpg', '2017-02-05 05:12:09', '2'),
  (51, '2017-02-05 05:24:19', 4, 'Cheato', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'cheato.jpg', '2017-02-05 05:24:19', '3'),
  (52, NULL, 1, 'Yellow spot goby', 'spoticus mobious', 'LaLaLa', 'DiamondWatchman.jpg', '2018-05-22 00:00:00', '1');
/*!40000 ALTER TABLE `inhab_species` ENABLE KEYS */;

-- Dumping structure for table jayfish.inhab_status
DROP TABLE IF EXISTS `inhab_status`;
CREATE TABLE IF NOT EXISTS `inhab_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.inhab_status: ~3 rows (approximately)
DELETE FROM `inhab_status`;
/*!40000 ALTER TABLE `inhab_status` DISABLE KEYS */;
INSERT INTO `inhab_status` (`id`, `status`) VALUES
  (1, 'Healthy'),
  (2, 'Monitor'),
  (3, 'Sick');
/*!40000 ALTER TABLE `inhab_status` ENABLE KEYS */;

-- Dumping structure for table jayfish.ledim
DROP TABLE IF EXISTS `ledim`;
CREATE TABLE IF NOT EXISTS `ledim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ledim_name_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `channel` int(11) NOT NULL,
  `auto` int(11) NOT NULL,
  `manual` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Dumping data for table jayfish.ledim: ~0 rows (approximately)
DELETE FROM `ledim`;
/*!40000 ALTER TABLE `ledim` DISABLE KEYS */;
/*!40000 ALTER TABLE `ledim` ENABLE KEYS */;

-- Dumping structure for table jayfish.ledim_name
DROP TABLE IF EXISTS `ledim_name`;
CREATE TABLE IF NOT EXISTS `ledim_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jayfish.ledim_name: ~0 rows (approximately)
DELETE FROM `ledim_name`;
/*!40000 ALTER TABLE `ledim_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `ledim_name` ENABLE KEYS */;

-- Dumping structure for table jayfish.log
DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection` varchar(50) DEFAULT '0',
  `dateset` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `value` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.log: ~0 rows (approximately)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table jayfish.mcp4131
DROP TABLE IF EXISTS `mcp4131`;
CREATE TABLE IF NOT EXISTS `mcp4131` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stage` varchar(50) NOT NULL DEFAULT '0',
  `run` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.mcp4131: ~7 rows (approximately)
DELETE FROM `mcp4131`;
/*!40000 ALTER TABLE `mcp4131` DISABLE KEYS */;
INSERT INTO `mcp4131` (`id`, `stage`, `run`) VALUES
  (1, 'sunrise', 0),
  (2, 'morning', 0),
  (3, 'daytime', 0),
  (4, 'sunset', 0),
  (5, 'night', 0),
  (6, 'nolight', 1),
  (7, 'overide', 0);
/*!40000 ALTER TABLE `mcp4131` ENABLE KEYS */;

-- Dumping structure for table jayfish.piinfo
DROP TABLE IF EXISTS `piinfo`;
CREATE TABLE IF NOT EXISTS `piinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  `measurement` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.piinfo: ~5 rows (approximately)
DELETE FROM `piinfo`;
/*!40000 ALTER TABLE `piinfo` DISABLE KEYS */;
INSERT INTO `piinfo` (`id`, `kpi`, `value`, `measurement`) VALUES
  (1, 'Ram Free', '48M', 'MB'),
  (2, 'Cpu Heat', '46.7', 'Degrees'),
  (3, 'Diskspace Size', '7.2G', 'GB'),
  (4, 'Diskspace Free', '1.4G', 'GB'),
  (5, 'IP Addess', '192.168.0.22', 'IP');
/*!40000 ALTER TABLE `piinfo` ENABLE KEYS */;

-- Dumping structure for table jayfish.relay_dose
DROP TABLE IF EXISTS `relay_dose`;
CREATE TABLE IF NOT EXISTS `relay_dose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `polarity` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '0',
  `gpio` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT NULL,
  `mls` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.relay_dose: ~0 rows (approximately)
DELETE FROM `relay_dose`;
/*!40000 ALTER TABLE `relay_dose` DISABLE KEYS */;
/*!40000 ALTER TABLE `relay_dose` ENABLE KEYS */;

-- Dumping structure for table jayfish.relay_dose_sched
DROP TABLE IF EXISTS `relay_dose_sched`;
CREATE TABLE IF NOT EXISTS `relay_dose_sched` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` int(11) NOT NULL DEFAULT '0',
  `time` time NOT NULL DEFAULT '00:00:00',
  `seconds` float NOT NULL DEFAULT '0',
  `relay_dose_id` int(11) DEFAULT NULL,
  `dosecompleted` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.relay_dose_sched: ~0 rows (approximately)
DELETE FROM `relay_dose_sched`;
/*!40000 ALTER TABLE `relay_dose_sched` DISABLE KEYS */;
/*!40000 ALTER TABLE `relay_dose_sched` ENABLE KEYS */;

-- Dumping structure for table jayfish.relay_master
DROP TABLE IF EXISTS `relay_master`;
CREATE TABLE IF NOT EXISTS `relay_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sunrise` int(11) NOT NULL,
  `morning` int(11) NOT NULL,
  `daytime` int(11) NOT NULL,
  `afternoon` int(11) NOT NULL,
  `sunset` int(11) NOT NULL,
  `night` int(11) NOT NULL,
  `nolight` int(11) NOT NULL,
  `gpio` int(11) NOT NULL,
  `auto` int(11) NOT NULL,
  `thermconfig_id` int(11) NOT NULL DEFAULT '0',
  `therm_low_value` int(11) NOT NULL DEFAULT '0',
  `therm_low_decision` int(11) NOT NULL DEFAULT '0',
  `therm_high_value` int(11) NOT NULL DEFAULT '0',
  `therm_high_decision` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0',
  `polarity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.relay_master: ~0 rows (approximately)
DELETE FROM `relay_master`;
/*!40000 ALTER TABLE `relay_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `relay_master` ENABLE KEYS */;

-- Dumping structure for table jayfish.relay_wave
DROP TABLE IF EXISTS `relay_wave`;
CREATE TABLE IF NOT EXISTS `relay_wave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `relay` int(11) DEFAULT NULL,
  `gpio` int(11) DEFAULT NULL,
  `polarity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.relay_wave: ~2 rows (approximately)
DELETE FROM `relay_wave`;
/*!40000 ALTER TABLE `relay_wave` DISABLE KEYS */;
INSERT INTO `relay_wave` (`id`, `name`, `relay`, `gpio`, `polarity`) VALUES
  (1, 'wave_a', 98, 0, 1),
  (2, 'wave_b', 99, 0, 1);
/*!40000 ALTER TABLE `relay_wave` ENABLE KEYS */;

-- Dumping structure for table jayfish.relay_wave_phase
DROP TABLE IF EXISTS `relay_wave_phase`;
CREATE TABLE IF NOT EXISTS `relay_wave_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL DEFAULT '0',
  `wave_a_pulse` float NOT NULL DEFAULT '0',
  `wave_a_rest` float NOT NULL DEFAULT '0',
  `wave_a_state` varchar(50) DEFAULT NULL,
  `wave_b_pulse` float DEFAULT NULL,
  `wave_b_rest` float DEFAULT NULL,
  `wave_b_state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.relay_wave_phase: ~7 rows (approximately)
DELETE FROM `relay_wave_phase`;
/*!40000 ALTER TABLE `relay_wave_phase` DISABLE KEYS */;
INSERT INTO `relay_wave_phase` (`id`, `description`, `wave_a_pulse`, `wave_a_rest`, `wave_a_state`, `wave_b_pulse`, `wave_b_rest`, `wave_b_state`) VALUES
  (1, 'sunrise', 3, 3, 'off', 3, 3, 'off'),
  (2, 'morning', 3, 3, 'off', 3, 3, 'off'),
  (3, 'daytime', 3, 3, 'off', 3, 3, 'off'),
  (4, 'afternoon', 1, 1, 'off', 1, 1, 'off'),
  (5, 'sunset', 3, 3, 'off', 3, 3, 'off'),
  (6, 'night', 3, 3, 'off', 3, 3, 'off'),
  (7, 'nolight', 3, 3, 'off', 3, 3, 'off');
/*!40000 ALTER TABLE `relay_wave_phase` ENABLE KEYS */;

-- Dumping structure for table jayfish.sched
DROP TABLE IF EXISTS `sched`;
CREATE TABLE IF NOT EXISTS `sched` (
  `id` int(11) NOT NULL,
  `sunrise_start` varchar(50) DEFAULT NULL,
  `sunrise_end` varchar(50) DEFAULT NULL,
  `morning_start` varchar(50) DEFAULT NULL,
  `morning_end` varchar(50) DEFAULT NULL,
  `daytime_start` varchar(50) DEFAULT NULL,
  `daytime_end` varchar(50) DEFAULT NULL,
  `afternoon_start` varchar(50) DEFAULT NULL,
  `afternoon_end` varchar(50) DEFAULT NULL,
  `sunset_start` varchar(50) DEFAULT NULL,
  `sunset_end` varchar(50) DEFAULT NULL,
  `night_start` varchar(50) DEFAULT NULL,
  `night_end` varchar(50) DEFAULT NULL,
  `nolight_start` varchar(50) DEFAULT NULL,
  `nolight_end` varchar(50) DEFAULT NULL,
  `phase` varchar(50) DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.sched: ~1 rows (approximately)
DELETE FROM `sched`;
/*!40000 ALTER TABLE `sched` DISABLE KEYS */;
INSERT INTO `sched` (`id`, `sunrise_start`, `sunrise_end`, `morning_start`, `morning_end`, `daytime_start`, `daytime_end`, `afternoon_start`, `afternoon_end`, `sunset_start`, `sunset_end`, `night_start`, `night_end`, `nolight_start`, `nolight_end`, `phase`, `lastupdate`) VALUES
  (0, '06:00', '06:30', '06:31', '10:55', '10:56', '16:00', '16:15', '16:30', '16:31', '20:00', '20:01', '21:00', '21:01', '23:59', 'night', '2018-06-29 20:39:25');
/*!40000 ALTER TABLE `sched` ENABLE KEYS */;

-- Dumping structure for table jayfish.schedaction
DROP TABLE IF EXISTS `schedaction`;
CREATE TABLE IF NOT EXISTS `schedaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT NULL,
  `feed` int(11) NOT NULL DEFAULT '0',
  `feed_result` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.schedaction: ~7 rows (approximately)
DELETE FROM `schedaction`;
/*!40000 ALTER TABLE `schedaction` DISABLE KEYS */;
INSERT INTO `schedaction` (`id`, `phase`, `description`, `feed`, `feed_result`, `timestamp`) VALUES
  (1, 1, 'sunrise', 0, 1, '2018-01-05 01:24:29'),
  (2, 2, 'morning', 0, 0, '2018-01-05 01:24:30'),
  (3, 3, 'daytime', 0, 1, '2018-01-05 01:24:30'),
  (4, 4, 'sunset', 0, 1, '2018-01-05 01:24:30'),
  (5, 5, 'afternoon', 0, 0, '2018-05-31 19:13:52'),
  (6, 6, 'night', 0, 1, '2018-05-31 19:14:00'),
  (7, 7, 'nolight', 0, 1, '2018-05-31 19:13:56');
/*!40000 ALTER TABLE `schedaction` ENABLE KEYS */;

-- Dumping structure for table jayfish.species
DROP TABLE IF EXISTS `species`;
CREATE TABLE IF NOT EXISTS `species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(10000) DEFAULT '0',
  `image` varchar(50) DEFAULT '0',
  `title` varchar(50) DEFAULT '0',
  `classification` varchar(50) DEFAULT NULL,
  `dateadded` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.species: ~6 rows (approximately)
DELETE FROM `species`;
/*!40000 ALTER TABLE `species` DISABLE KEYS */;
INSERT INTO `species` (`id`, `article`, `image`, `title`, `classification`, `dateadded`) VALUES
  (2, '<p>Cleaner shrimp is a common name for any swimming decapod crustacean that cleans other organisms of parasites. This is a widely cited example of cleaning symbiosis: a relationship in which both parties benefit. The fish benefit by having parasites removed from them, and the shrimp gain the nutritional value of the parasites. In many coral reefs, cleaner shrimp congregate at cleaning stations.</p>', 'cleanershrimp.jpg', 'Cleaner Shrimp', NULL, NULL),
  (3, '<p>Clownfish or anemonefish are fishes from the subfamily Amphiprioninae in the family Pomacentridae. Thirty species are recognized: one in the genus Premnas, while the remaining are in the genus Amphiprion. In the wild, they all form symbiotic mutualisms with sea anemones. Depending on species, anemonefish are overall yellow, orange, or a reddish or blackish color, and many show white bars or patches. The largest can reach a length of 18 centimetres (7.1&nbsp;in), while the smallest barely achieve 10 centimetres (3.9&nbsp;in).</p>', 'clown.jpg', 'Clown Fish', NULL, NULL),
  (4, 'The Arrow Crab, also known as the Spider Crab, has extremely long legs. It is called the Arrow Crab because of the shape of the body and head. The size is variable, many reaching six inches, and some up to 10 inches. Females may be dramatically smaller. Different species inhabit different parts of the world. The most common Arrow Crab (Stenorhynchus seticornis) comes from the Caribbean, but other species are imported from the Indo-Pacific region, eastern Africa, and California. They normally inhabit portions of the reef usually associated with a small cave or crevice.', 'arrowcrab.jpg', 'Arrow Crab', NULL, NULL),
  (5, '<p>These star polyps will do well when given moderate to high lighting and moderate to high and turbulent water flows. Keep your water parameters within standard reef tank requirements and youll be able to make your own GSP frags in no time. They are quite popular but still command a decent price for a frag, anywhere from 30 to 60 dollars depending on the size of the frag. Your local reef shop should at least allow you to trade your frags in for store credit if they arent overrun with them already since they are rather good sellers. To frag them get a new and clean razor blade and carefully slice them off the rock they are growing on. Then rubber band the newly sliced GSP on a frag plug. After it has encrusted the frag plug you can safely remove the rubber band, usually after a few days.</p>', 'greenstar.jpg', 'Green Star Polyps', NULL, NULL),
  (6, 'The Hammer Coral is a large polyp stony (LPS) coral and often referred to as&nbsp;Euphyllia&nbsp;Hammer Coral&nbsp;or Anchor Coral. Its common names are derived from the appearance of its hammer-, or anchor-shaped tentacles. Its polyps are visible throughout the day and night and hide its skeletal base. It may be green, tan, or brown in color, with lime green or yellow tips on the ends of its tentacles that glow under actinic lighting. Some varieties may be branched which makes them look similar to a Torch Coral (E. glabrescens).', 'hammer.jpg', 'Hammer Coral', NULL, NULL),
  (7, 'The Yellow Fiji Leather Coral may be referred to as theSarcophyton elegans&nbsp;Coral. It can be found in shades of yellow, and unlike other&nbsp;Sarcophyton&nbsp;corals, it does not grow an extended stalk. Instead, these corals grow close to the rockwork, and will develop beautiful ruffles around the edges.\r\nIt is a relatively peaceful coral but adequate space should be provided between itself and others in the reef aquarium. The Yellow Fiji Leather Coral requires medium to high lighting combined with moderate to strong water movement. For continued good health, it will also require the addition of strontium, iodine, and other trace elements to the water.', 'brownleather.jpg', 'Yellow Leather Coral', NULL, NULL);
/*!40000 ALTER TABLE `species` ENABLE KEYS */;

-- Dumping structure for table jayfish.thermconfig
DROP TABLE IF EXISTS `thermconfig`;
CREATE TABLE IF NOT EXISTS `thermconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensorname` varchar(45) NOT NULL,
  `serialnumber` varchar(45) NOT NULL,
  `current_therm` float NOT NULL,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.thermconfig: ~0 rows (approximately)
DELETE FROM `thermconfig`;
/*!40000 ALTER TABLE `thermconfig` DISABLE KEYS */;
/*!40000 ALTER TABLE `thermconfig` ENABLE KEYS */;

-- Dumping structure for table jayfish.thermlog
DROP TABLE IF EXISTS `thermlog`;
CREATE TABLE IF NOT EXISTS `thermlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_thermconfig` int(11) NOT NULL,
  `sensorname` varchar(45) NOT NULL,
  `reading` float NOT NULL,
  `dateset` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.thermlog: ~0 rows (approximately)
DELETE FROM `thermlog`;
/*!40000 ALTER TABLE `thermlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `thermlog` ENABLE KEYS */;

-- Dumping structure for table jayfish.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table jayfish.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `level`, `username`, `password`, `email`) VALUES
  (1, '0', 'admin', '123', 'admin@local');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
