-- MySQL dump 10.13  Distrib 5.6.35, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: celebrateplus
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `advertiser_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `type` text NOT NULL,
  `image_path` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `display_order` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','bb7791d8ec64946ef81035202b872a03','admin@admin.com','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertiser`
--

DROP TABLE IF EXISTS `advertiser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertiser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image_path` text NOT NULL,
  `content` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertiser`
--

LOCK TABLES `advertiser` WRITE;
/*!40000 ALTER TABLE `advertiser` DISABLE KEYS */;
/*!40000 ALTER TABLE `advertiser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendee`
--

DROP TABLE IF EXISTS `attendee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` text NOT NULL,
  `event_id` text NOT NULL,
  `user_id` text NOT NULL,
  `ufname` text NOT NULL,
  `ulname` text NOT NULL,
  `uemail` text NOT NULL,
  `etitle` text NOT NULL,
  `esdate` text NOT NULL,
  `estime` text NOT NULL,
  `eedate` text NOT NULL,
  `eetime` text NOT NULL,
  `ecity` text NOT NULL,
  `estate` text NOT NULL,
  `cdate` datetime NOT NULL,
  `tot_addendees` text NOT NULL,
  `comments` text NOT NULL,
  `funding` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `how_mch` text NOT NULL,
  `anonymous` text NOT NULL,
  `gave_to_site` double(10,2) NOT NULL,
  `gave_to_event_owner` double(10,2) NOT NULL,
  `commission_rate` double(10,2) NOT NULL,
  `payment_status` text NOT NULL,
  `is_attendee` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendee`
--

LOCK TABLES `attendee` WRITE;
/*!40000 ALTER TABLE `attendee` DISABLE KEYS */;
INSERT INTO `attendee` VALUES (1,'4','4','4','Gaurav','Bhattacharya','gaurav@technource.com','Eminem Show','0000-00-00','','0000-00-00','','','','2017-06-27 17:06:03','4','','No',NULL,'','',0.00,0.00,0.00,'New',1,'');
/*!40000 ALTER TABLE `attendee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_post_comments`
--

DROP TABLE IF EXISTS `blog_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `description` text,
  `posted_by` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `approve` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_post_comments`
--

LOCK TABLES `blog_post_comments` WRITE;
/*!40000 ALTER TABLE `blog_post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` text NOT NULL,
  `category_id` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_summary` text NOT NULL,
  `full_content` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `is_feature` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_rate`
--

DROP TABLE IF EXISTS `commission_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commission_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commission_rate` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_rate`
--

LOCK TABLES `commission_rate` WRITE;
/*!40000 ALTER TABLE `commission_rate` DISABLE KEYS */;
INSERT INTO `commission_rate` VALUES (1,10.00);
/*!40000 ALTER TABLE `commission_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_promos`
--

DROP TABLE IF EXISTS `content_promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_promos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `navigation` text NOT NULL,
  `content` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `dont_display_title` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_promos`
--

LOCK TABLES `content_promos` WRITE;
/*!40000 ALTER TABLE `content_promos` DISABLE KEYS */;
INSERT INTO `content_promos` VALUES (6,'From our insiders!',',3,','<p>\r\n	&quot;Studies show that a shorter campaign, no less than 30 days and no more than 60 days, has 35% more chance of success&quot;<br />\r\n	<br />\r\n	<br />\r\n	&quot;Studies show that if you share your campaign on facebook and twitter your chances of success grow exponentially!&quot;</p>\r\n',2,0),(7,'Plan out your expenses',',8,','<p>\r\n	&quot;Crowdfunding money for your event is not considered a loan, it&nbsp;is considered a gift or a donation and the organizer is responsible for spending the money effectively.&quot;</p>\r\n',3,0),(8,'Personal relationships',',11,','<p>\r\n	&quot;Friends and family are the best sources for crowdfunding and because of that they are the best sources to raise funds for your personal events&quot;<br />\r\n	<br />\r\n	<br />\r\n	&quot;More people everyday reach for the support of friends and family to finance their special celebrations so they can spend their money on a new home, or a car, that special trip, etc!&quot;</p>\r\n',4,0),(5,'Did you know?',',2,','<p>\r\n	&quot;Did you know that thanks to our platform you can raise even more than your stated goal!?&quot;<br />\r\n	&nbsp;</p>\r\n<p>\r\n	&quot;Did you know that even if you don&#39;t reach your goal all the money raised is yours for your event!?&quot;</p>\r\n',4,0),(9,'Plan your expenses',',13,','<p>\r\n	&quot;Crowdfunding money for your event is not considered a loan, is considered a gift or a donation and the organizer is responsible for efficiently spending the money raised&quot;</p>\r\n',5,0),(10,'Reach out to a friend!',',12,','<p>\r\n	&quot;More people everyday reach for the support of friends and family to finance their special celebrations so they can spend their money on a new home, or a car, that special trip, etc!&quot;</p>\r\n',6,0),(11,'PayPal Policies',',9,','<p>\r\n	<a href=\\\"https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&amp;content_ID=ua/AcceptableUse_full&amp;locale.x=en_US\\\" target=\\\"_blank\\\"><img alt=\\\"\\\" src=\\\"/userfiles/images/rgt_paypal.jpg\\\" style=\\\"border-width: 0px; border-style: solid; width: 200px; height: 68px;\\\" /></a></p>\r\n',7,0);
/*!40000 ALTER TABLE `content_promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cplus_files`
--

DROP TABLE IF EXISTS `cplus_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cplus_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_file_name` text NOT NULL,
  `request_initiator_full_file_name` text NOT NULL,
  `server_ip_address` varchar(50) NOT NULL,
  `remote_ip_address` varchar(50) NOT NULL,
  `file_variable_name` varchar(100) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` text NOT NULL,
  `file_tmp_name` text NOT NULL,
  `file_error` int(11) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cplus_files`
--

LOCK TABLES `cplus_files` WRITE;
/*!40000 ALTER TABLE `cplus_files` DISABLE KEYS */;
INSERT INTO `cplus_files` VALUES (1,'/dev/save_event.php','http://celebrateplus.com/dev/create_event.php','74.208.10.230','27.54.180.228','image_path','Hydrangeas.jpg','image/jpeg','/tmp/phpSLS03Q',0,'595284');
/*!40000 ALTER TABLE `cplus_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custphone`
--

DROP TABLE IF EXISTS `custphone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custphone` (
  `CustID` int(30) NOT NULL,
  `Phone` text NOT NULL,
  PRIMARY KEY (`CustID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custphone`
--

LOCK TABLES `custphone` WRITE;
/*!40000 ALTER TABLE `custphone` DISABLE KEYS */;
/*!40000 ALTER TABLE `custphone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` text NOT NULL,
  `add_date` date NOT NULL,
  `title` text NOT NULL,
  `sdate` date NOT NULL,
  `stime` text NOT NULL,
  `edate` date NOT NULL,
  `etime` text NOT NULL,
  `max_cap` text NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL,
  `loc_name` text NOT NULL,
  `loc_street` text NOT NULL,
  `loc_suite` text NOT NULL,
  `loc_city` text NOT NULL,
  `loc_state` text NOT NULL,
  `loc_zip` text NOT NULL,
  `loc_country` text NOT NULL,
  `image_path` text NOT NULL,
  `fund_amt` text NOT NULL,
  `current_fund` text NOT NULL,
  `fund_end_date` date NOT NULL,
  `payment` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `amt_paid_org` bigint(20) NOT NULL,
  `order_status` text NOT NULL,
  `max_don_amt` text NOT NULL,
  `donate_to_attend` text NOT NULL,
  `define_donation_levels` text NOT NULL,
  `df_friends` text NOT NULL,
  `df_bronze` text NOT NULL,
  `df_silver` text NOT NULL,
  `df_gold` text NOT NULL,
  `df_platinum` text NOT NULL,
  `df_benefactor` text NOT NULL,
  `searchable` text NOT NULL,
  `display_fund` text NOT NULL,
  `attendee_list_public` text NOT NULL,
  `space_available` int(11) NOT NULL,
  `fund_allowed` text NOT NULL,
  `deleted` int(2) NOT NULL,
  `map_link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'1','2017-05-02','New Year party celebration','0000-00-00','','0000-00-00','','','New Year party celebration','You are invited!','','','','','','','','','','','0000-00-00','',0,0,'','','','','','','','','','','','','',0,'No',0,''),(2,'2','2017-05-09','First event','0000-00-00','','0000-00-00','','','First event','hello','','','','','','','','','','','0000-00-00','',0,0,'','','','','','','','','','','','','',0,'No',0,''),(5,'6','2017-06-28','sfsdfsa','0000-00-00','','0000-00-00','','','sfsdfsa','fsfsa fsadfa','','','','','','','','','','','0000-00-00','',0,0,'','','','','','','','','','','','','',0,'No',0,''),(4,'4','2017-06-27','Eminem Show','0000-00-00','','0000-00-00','','','Eminem Show','Welcome to Eminem show. ','','','','','','','','','','','0000-00-00','',0,0,'','','','','','','','','','','','','',0,'No',0,'');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_feature`
--

DROP TABLE IF EXISTS `home_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image_path` text NOT NULL,
  `content` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_feature`
--

LOCK TABLES `home_feature` WRITE;
/*!40000 ALTER TABLE `home_feature` DISABLE KEYS */;
INSERT INTO `home_feature` VALUES (1,'Get Funded!','','<ul>\r\n	<li>\r\n		Send your invitations with a link to your personal CelebratePlus account and be able to <strong>collect money to cover your celebration expenses</strong>.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		CelebratePlus will collect your money in a<strong> friendly and respectful</strong> manner liberating you from the pain of solving how to cover all your celebration expenses.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		CelebratePlus will send friendly reminders and you can access your dashboard and <strong>see how many people have confirmed and&nbsp;contributed to&nbsp;your celebration</strong>.</li>\r\n</ul>\r\n',2),(2,'Celebrate!','','<ul>\r\n	<li>\r\n		Collect via <strong>friends, family and social media</strong> the money needed for your event and only worry to have an excellent celebration.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		The new economy has to have <strong>new tools to invite, finance</strong> and celebrate our events.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		Take advantage of the tools that CelebratePlus has to offer you and <strong>start</strong> <strong>celebrating!</strong></li>\r\n</ul>\r\n',3),(3,'Invite!','','<ul>\r\n	<li>\r\n		Create your own<strong> personalized invitations</strong> for any event or celebration.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		We have<strong> featured templates</strong> very easy to use for you to create an easy, personal and beautiful invitation for every occasion.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Organize your events</strong> easily, send friendly reminders and have complete control of your event or celebration.</li>\r\n</ul>\r\n',1);
/*!40000 ALTER TABLE `home_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) NOT NULL,
  `invitation_date` date NOT NULL,
  `design_style` text NOT NULL,
  `invitation_message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitations`
--

LOCK TABLES `invitations` WRITE;
/*!40000 ALTER TABLE `invitations` DISABLE KEYS */;
INSERT INTO `invitations` VALUES (1,1,'2017-05-02','1','You are invited!'),(2,2,'2017-05-09','2','hello'),(3,2,'2017-05-09','1','Hello'),(4,3,'2017-05-14','10','Henrik &#8211; Rest assured I went back and read your comment, and it was decent as well. I basically tossed aside even coedsinring the ones that included childish remarks.');
/*!40000 ALTER TABLE `invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitations_email`
--

DROP TABLE IF EXISTS `invitations_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitations_email` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `event_id` bigint(10) NOT NULL,
  `invitations_id` bigint(10) NOT NULL,
  `add_date` date NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitations_email`
--

LOCK TABLES `invitations_email` WRITE;
/*!40000 ALTER TABLE `invitations_email` DISABLE KEYS */;
INSERT INTO `invitations_email` VALUES (1,1,1,'2017-05-02',''),(2,2,2,'2017-05-09','divakar.j@gmail.com'),(3,2,3,'2017-05-09','divakar_j@yahoo.com'),(4,3,4,'2017-05-14','Henrik &#8211; Rest assured I went back and read your comment'),(5,3,4,'2017-05-14','and it was decent as well. I basically tossed aside even coedsinring the ones that included childish remarks.');
/*!40000 ALTER TABLE `invitations_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keshavstate`
--

DROP TABLE IF EXISTS `keshavstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keshavstate` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `per` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keshavstate`
--

LOCK TABLES `keshavstate` WRITE;
/*!40000 ALTER TABLE `keshavstate` DISABLE KEYS */;
INSERT INTO `keshavstate` VALUES (1,'Alabama','50'),(2,'Alaska','5'),(3,'Arizona','10'),(4,'Arkansas','0'),(5,'California','0'),(6,'Colorado','0'),(7,'Connecticut','0'),(8,'Delaware','0'),(9,'Florida','0'),(10,'Georgia','0'),(11,'Hawaii','0'),(12,'Idaho','0'),(13,'Illinois','0'),(14,'Indiana','0'),(15,'Iowa','0'),(16,'Kansas','0'),(17,'Kentucky','0'),(18,'Louisiana','0'),(19,'Maine','0'),(20,'Maryland','0'),(21,'Massachusetts','0'),(22,'Michigan','0'),(23,'Minnesota','0'),(24,'Mississippi','0'),(25,'Missouri','0'),(26,'Montana','0'),(27,'Nebraska','0'),(28,'Nevada','0'),(29,'New Hampshire','0'),(30,'New Jersey','0'),(31,'New Mexico','0'),(32,'New York','0'),(33,'North Carolina','0'),(34,'North Dakota','0'),(35,'Ohio','0'),(36,'Oklahoma','0'),(37,'Oregon','0'),(38,'Pennsylvania','0'),(39,'Rhode Island','0'),(40,'South Carolina','25'),(41,'South Dakota','0'),(42,'Tennessee','0'),(43,'Texas','8.25'),(44,'Utah','0'),(45,'Vermont','0'),(46,'Virginia','0'),(47,'Washington','0'),(48,'Washington DC','0'),(49,'West Virginia','0'),(50,'Wisconsin','0'),(51,'Wyoming','0'),(52,'I live outside of the U.S','0');
/*!40000 ALTER TABLE `keshavstate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_errors`
--

DROP TABLE IF EXISTS `mail_errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` text NOT NULL,
  `mail_from` text NOT NULL,
  `mail_to` text NOT NULL,
  `mail_subject` text NOT NULL,
  `mail_body` text NOT NULL,
  `ip_address` text NOT NULL,
  `error_on` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_errors`
--

LOCK TABLES `mail_errors` WRITE;
/*!40000 ALTER TABLE `mail_errors` DISABLE KEYS */;
INSERT INTO `mail_errors` VALUES (1,'/save_event.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Jyo Jandhyala<jyotsna.jandhyala@gmail.com>\r\n','','You have been invited to attend New Year party celebration','\n	<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n	\n  <tr>\n    <td align=\"left\" valign=\"top\" background=\"http://www.celebrateplus.comimages/email/Balloons_Design_bg.jpg\" style=\"padding:249px 0 0 0px;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n      <tr>\n        <td align=\"center\" valign=\"top\" style=\"font-family:Impact; font-size:42px; color:#0092c3;\">You are invited to<br />\n          <a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=1\" style=\"font-family: Arial, Helvetica, sans-serif; font-size:42px; color:#88b130; text-decoration:none;\">New Year party celebration</a> <br /></td>\n      </tr>\n      <tr>\n        <td align=\"center\" valign=\"top\" style=\"padding:36px 0 0 0px;font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;line-height:24px;\">\n		You are invited!\n		</td>\n      </tr><tr>\n			<td align=\"center\" valign=\"top\" style=\"padding:36px 0 0 0px; line-height:24px;\">\n			<a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=1\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#0092C3; text-decoration:none;\">View Event</a>\n			</td>\n		  </tr></table></td>\n  </tr>\n  <tr>\n  	<td align=\"right\" style=\"padding:5px;\"><a href=\"http://www.celebrateplus.com/\" target=\"_blank\"><img src=\"http://www.celebrateplus.comimages/logo_invite_email.png\" border=\"0\"></a></td>\n  </tr>\n</table>','167.137.1.16','2017-05-02 11:57:58',0,''),(2,'/save_event.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Divakar Jandhyala<divakar@innofoundry.com>\r\n','divakar.j@gmail.com','You have been invited to attend First event','\n<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" background=\"http://www.celebrateplus.comimages/email/back2.jpg\" >\n	<tr>\n		<td align=\"center\" valign=\"top\" style=\"padding-top:70px; padding-bottom:75px;\">\n			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n				<tr>\n					<td align=\"left\" valign=\"top\">&nbsp;</td>\n					<td align=\"center\" valign=\"top\" width=\"590\" background=\"http://www.celebrateplus.comimages/email/trnce.png\" style=\"padding:50px 0px; width:590px;\">\n						<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n							<tr>\n								<td  align=\"center\" valign=\"top\" style=\"font-family:Palatino Linotype; font-size:60px; color:#0092c3; \">You are invited to<br /><a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=2\" style=\"font-family:Palatino Linotype; font-size:43px; color:#88b130; text-decoration:none;\">First event</a></td>\n							</tr>\n							<tr>\n								<td align=\"center\" valign=\"top\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; line-height:24px; \">hello</td>\n							</tr><tr>\n								<td align=\"center\" valign=\"top\" style=\"padding:20px 0 0 0px; line-height:24px;\">\n								<a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=2\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#0092C3; text-decoration:none;\">View Event</a>\n								</td>\n						   </tr></table>\n					</td>\n					<td align=\"left\" valign=\"top\">&nbsp;</td>\n				</tr>\n			</table>\n		</td>\n	</tr> \n	<tr>\n  		<td align=\"right\" style=\"padding:5px;\"><a href=\"http://www.celebrateplus.com/\" target=\"_blank\"><img src=\"http://www.celebrateplus.comimages/logo_invite_email.png\" border=\"0\"></a></td>\n 	</tr> \n</table>','68.203.11.139','2017-05-08 05:37:29',0,''),(3,'/create_email_invitation.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Divakar Jandhyala<divakar@innofoundry.com>\r\n','divakar_j@yahoo.com','You have been invited to attend First event','\n	<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n	\n  <tr>\n    <td align=\"left\" valign=\"top\" background=\"https://www.celebrateplus.comimages/email/Balloons_Design_bg.jpg\" style=\"padding:249px 0 0 0px;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n      <tr>\n        <td align=\"center\" valign=\"top\" style=\"font-family:Impact; font-size:42px; color:#0092c3;\">You are invited to<br />\n          <a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=2\" style=\"font-family: Arial, Helvetica, sans-serif; font-size:42px; color:#88b130; text-decoration:none;\">First event</a> <br /></td>\n      </tr>\n      <tr>\n        <td align=\"center\" valign=\"top\" style=\"padding:36px 0 0 0px;font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;line-height:24px;\">\n		Hello\n		</td>\n      </tr><tr>\n			<td align=\"center\" valign=\"top\" style=\"padding:36px 0 0 0px; line-height:24px;\">\n			<a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=2\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#0092C3; text-decoration:none;\">View Event</a>\n			</td>\n		  </tr></table></td>\n  </tr>\n  <tr>\n  	<td align=\"right\" style=\"padding:5px;\"><a href=\"http://www.celebrateplus.com/\" target=\"_blank\"><img src=\"https://www.celebrateplus.comimages/logo_invite_email.png\" border=\"0\"></a></td>\n  </tr>\n</table>','68.203.11.139','2017-05-08 05:37:54',0,''),(4,'/save_event.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Marty Marty<rt9hezpdm@gmail.com>\r\n','Henrik &#8211; Rest assured I went back and read your comment','You have been invited to attend Henrik &#8211; Rest ','\n<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" background=\"http://www.celebrateplus.comimages/email/bg_img10.jpg\">\n  <tr>\n    <td align=\"left\" valign=\"top\" style=\"height:509px; padding:10px 30px;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n      <tr>\n        <td align=\"left\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n          <tr>\n            <td align=\"center\" valign=\"middle\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:60px; color:#FFFFFF;\">You are invited to</td>\n          </tr>\n          <tr>\n            <td align=\"center\" valign=\"middle\"><a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=3\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:42px; color:#54454a; font-style:italic; text-decoration:none;\">Henrik &#8211; Rest </a></td>\n          </tr>\n          <tr>\n            <td align=\"center\" valign=\"middle\">&nbsp;</td>\n          </tr>\n        </table></td>\n      </tr>\n      <tr>\n        <td align=\"left\" valign=\"top\"><table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n          <tr>\n            <td width=\"350\" align=\"center\" valign=\"top\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#000000; line-height:25px; padding:20px;\">Henrik &#8211; Rest assured I went back and read your comment, and it was decent as well. I basically tossed aside even coedsinring the ones that included childish remarks.</td>\n          </tr>\n		  <tr>\n			<td width=\"350\" align=\"center\" valign=\"top\" style=\"padding:20px 0 0 0px; line-height:24px;\">\n			<a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=3\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#FFFFFF; text-decoration:none;\">View Event</a>\n			</td>\n		  </tr>\n        </table></td>\n      </tr>\n    </table></td>\n  </tr>\n  <tr>\n  	<td align=\"right\" style=\"padding:5px;\"><a href=\"http://www.celebrateplus.com/\" target=\"_blank\"><img src=\"http://www.celebrateplus.comimages/logo_invite_email.png\" border=\"0\"></a></td>\n  </tr>\n</table>','46.161.14.99','2017-05-14 11:31:09',0,''),(5,'/save_event.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: Marty Marty<rt9hezpdm@gmail.com>\r\n','and it was decent as well. I basically tossed aside even coedsinring the ones that included childish remarks.','You have been invited to attend Henrik &#8211; Rest ','\n<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" background=\"http://www.celebrateplus.comimages/email/bg_img10.jpg\">\n  <tr>\n    <td align=\"left\" valign=\"top\" style=\"height:509px; padding:10px 30px;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n      <tr>\n        <td align=\"left\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n          <tr>\n            <td align=\"center\" valign=\"middle\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:60px; color:#FFFFFF;\">You are invited to</td>\n          </tr>\n          <tr>\n            <td align=\"center\" valign=\"middle\"><a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=3\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:42px; color:#54454a; font-style:italic; text-decoration:none;\">Henrik &#8211; Rest </a></td>\n          </tr>\n          <tr>\n            <td align=\"center\" valign=\"middle\">&nbsp;</td>\n          </tr>\n        </table></td>\n      </tr>\n      <tr>\n        <td align=\"left\" valign=\"top\"><table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n          <tr>\n            <td width=\"350\" align=\"center\" valign=\"top\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#000000; line-height:25px; padding:20px;\">Henrik &#8211; Rest assured I went back and read your comment, and it was decent as well. I basically tossed aside even coedsinring the ones that included childish remarks.</td>\n          </tr>\n		  <tr>\n			<td width=\"350\" align=\"center\" valign=\"top\" style=\"padding:20px 0 0 0px; line-height:24px;\">\n			<a href=\"https://www.celebrateplus.com/event_detail.php?eve_id=3\" style=\"font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#FFFFFF; text-decoration:none;\">View Event</a>\n			</td>\n		  </tr>\n        </table></td>\n      </tr>\n    </table></td>\n  </tr>\n  <tr>\n  	<td align=\"right\" style=\"padding:5px;\"><a href=\"http://www.celebrateplus.com/\" target=\"_blank\"><img src=\"http://www.celebrateplus.comimages/logo_invite_email.png\" border=\"0\"></a></td>\n  </tr>\n</table>','46.161.14.99','2017-05-14 11:31:09',0,''),(6,'/forgot_password.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: info@celebrateplus.com\r\n','divakar@innofoundry.com','Your Celebrate Plus Account Login Information','<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">\n		<tr>\n				<td colspan=\"2\">Your Celebrate Plus account login information can be found below:</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Username :\n				</td>\n				<td>divakar@innofoundry.com		\n				</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Password :\n				</td>\n				<td>divakar001		\n				</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			\n		</table>','216.54.247.178','2017-06-14 11:30:11',0,''),(7,'/forgot_password.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: info@celebrateplus.com\r\n','divakar@innofoundry.com','Your Celebrate Plus Account Login Information','<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">\n		<tr>\n				<td colspan=\"2\">Your Celebrate Plus account login information can be found below:</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Username :\n				</td>\n				<td>divakar@innofoundry.com		\n				</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Password :\n				</td>\n				<td>divakar001		\n				</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			\n		</table>','216.54.247.178','2017-06-14 11:56:48',0,''),(8,'/forgot_password.php?','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: info@celebrateplus.com\r\n','divakar@innofoundry.com','Your Celebrate Plus Account Login Information','<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">\n		<tr>\n				<td colspan=\"2\">Your Celebrate Plus account login information can be found below:</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Username :\n				</td>\n				<td>divakar@innofoundry.com		\n				</td>\n			</tr>\n			<tr>\n				<td align=\"right\" width=\"40%\">Password :\n				</td>\n				<td>divakar001		\n				</td>\n			</tr>\n			<tr>\n				<td colspan=\"2\">&nbsp;</td>\n			</tr>\n			\n		</table>','4.31.128.178','2017-06-15 03:01:20',0,'');
/*!40000 ALTER TABLE `mail_errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maillist`
--

DROP TABLE IF EXISTS `maillist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maillist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `tdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maillist`
--

LOCK TABLES `maillist` WRITE;
/*!40000 ALTER TABLE `maillist` DISABLE KEYS */;
INSERT INTO `maillist` VALUES (1,NULL,NULL,'divakar@innofoundry.com','0000-00-00'),(2,NULL,NULL,'sathies@stallioni.com','0000-00-00');
/*!40000 ALTER TABLE `maillist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizer`
--

DROP TABLE IF EXISTS `organizer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_date` date NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `cpassword` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `payment_method` text NOT NULL,
  `mstreet_address` text NOT NULL,
  `mapartment` text NOT NULL,
  `mcity` text NOT NULL,
  `mstate` text NOT NULL,
  `mzip` text NOT NULL,
  `mcountry` text NOT NULL,
  `mcomments` text NOT NULL,
  `paypalid` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `find_us` text NOT NULL,
  `acc_notes` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `temp` text NOT NULL,
  `ran_no` text NOT NULL,
  `opted_email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizer`
--

LOCK TABLES `organizer` WRITE;
/*!40000 ALTER TABLE `organizer` DISABLE KEYS */;
INSERT INTO `organizer` VALUES (1,'2017-05-02','','597 622 687 582 632 582 667','','Jyo','Jandhyala','jyotsna.jandhyala@gmail.com','','','','','','','','','','','','Texas','United States of America','','',NULL,'','',''),(2,'2017-05-09','','597 622 687 582 632 582 667 337 337 342','','Divakar','Jandhyala','divakar@innofoundry.com','5127511182','','','','','','','','','','','Texas','United States of America','','',NULL,'','','true'),(6,'2017-06-28','','','','','','','','','','','','','','','','','','','','','',NULL,'','',''),(4,'2017-06-27','','342 347 352 357 362 367 372 377','','Gaurav','Bhattacharya','gaurav@technource.com','','','','','','','','','','','','California','United States of America','','',NULL,'','',''),(5,'2017-06-27','','677 602 672 677 342 347 352','','sathieskumar','a','sathies@stallioni.com','','','','','','','','','','','','Illinois','United States of America','','',NULL,'','','true');
/*!40000 ALTER TABLE `organizer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_mode`
--

DROP TABLE IF EXISTS `payment_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_mode` (
  `paymentmode` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_mode`
--

LOCK TABLES `payment_mode` WRITE;
/*!40000 ALTER TABLE `payment_mode` DISABLE KEYS */;
INSERT INTO `payment_mode` VALUES ('FALSE');
/*!40000 ALTER TABLE `payment_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amt_paid` bigint(20) NOT NULL,
  `order-status` text NOT NULL,
  `org_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pimage` text NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL,
  `target` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `banner_image_path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` VALUES (6,'Invite. Get Funded. Celebrate.','380home_slide1.jpg','<p>\r\n	CelebratePlus is an innovative group funding platform that allows you to manage your events online, share them with your friends and family, and raise money to support your event.</p>\r\n<p>\r\n	<a href=\\\"http://www.celebrateplus.com/login.php\\\" target=\\\"_self\\\"><img alt=\\\"\\\" src=\\\"/userfiles/images/start_an_event.png\\\" style=\\\"border-width: 0px; border-style: solid; width: 126px; height: 33px;\\\" /></a></p>\r\n','','',1,1,'It\'s That Easy!');
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staticpage`
--

DROP TABLE IF EXISTS `staticpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staticpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_header` text NOT NULL,
  `image_path` text NOT NULL,
  `content` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_discription` text NOT NULL,
  `title` text NOT NULL,
  `alt` text NOT NULL,
  `display_order` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staticpage`
--

LOCK TABLES `staticpage` WRITE;
/*!40000 ALTER TABLE `staticpage` DISABLE KEYS */;
INSERT INTO `staticpage` VALUES (1,'Invite, Get Funded and Celebrate. Thatâ€™s CelebratePlus','179','','Home, CelebratePlus','Home CelebratePlus','Home | CelebratePlus','',''),(2,'How It Works','539','<p>\r\n	<strong>Invite!</strong></p>\r\n<ul>\r\n	<li>\r\n		Create and send an invitation for your guests for that special event that you are carefully planning.</li>\r\n	<li>\r\n		CelebratePlus will help you design a beautiful invitation to share with your guests and will also give you a dashboard where you can see and control who has already funded your event.</li>\r\n	<li>\r\n		CelebratePlus&nbsp;will help you make a fun, competitive campaign for your funds. You will be able to assign different levels of rewards to your sponsors and you are in complete control to share it or keep it private.</li>\r\n</ul>\r\n<p>\r\n	<strong>Get Funded!</strong></p>\r\n<ul>\r\n	<li>\r\n		Are you paying for your special event? How about getting some help from the people more interested in your happiness. How about if you let us raise money on your behalf, so you can spend that money on the celebration expenses or in all your new needs. That is CelebratePlus: An opportunity to be practical with money, maintaining your lifestyle and traditions intact.</li>\r\n	<li>\r\n		We will ask your guests to collaboratively fund your event to help you collect money to cover your expenses. We will take care of collecting the money in your name, so you don&rsquo;t have to bother. We will never touch your money since is directed transferred to your PayPal account.</li>\r\n	<li>\r\n		You are able to suggest a minimum necessary contribution or leave the option open to your guests. We will give you fun tools to incentivize the contributions. Also you have complete control if you want to make public or private the people who have contributed. You can share your invitation in facebook or twitter to reach more of your friends.</li>\r\n</ul>\r\n<p>\r\n	<strong>Celebrate!</strong></p>\r\n<ul>\r\n	<li>\r\n		With the money received in your account in advance to the event you can pay for whatever you need. This way you can enjoy your celebration and have extra resources to set up your house, pay debt, or whatever you need!</li>\r\n</ul>\r\n<p>\r\n	<strong><em>That is CelebratePlus!</em></strong></p>\r\n<p>\r\n	<a href=\"http://www.celebrateplus.com/login.php\" target=\"_self\"><img alt=\"\" src=\"/userfiles/images/start_an_event.png\" style=\"border-width: 0px; border-style: solid; width: 126px; height: 33px;\" /></a></p>\r\n','How It Works, CelebratePlus','How It Works CelebratePlus','How It Works | CelebratePlus','',''),(3,'Features','601','<ul>\r\n	<li>\r\n		CelebratePlus has been designed as a tool for you, the person who wants to have a special celebration and thinks that resources are scarce and the best way to use it is to involve friends and family and ask for their collaboration in crowd funding your event.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		We want you to concentrate in having a good time and leave to CelebratePlus the task to invite your guests, collect the funds to pay for your event, sent reminders and give you access to your funds.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		You will have a dashboard to see the progress of your event campaign. We will be sending the reminders and collecting the funds on your behalf so you don&rsquo;t have that hassle.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		We have designed tools to incentivize the collaboration of your guests by &ndash;optionally- giving certain levels of sponsorship, that can be accessed by your guests, if you want.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		We are working with companies to offer you discounts and special access to everything you need for your special celebration and beyond.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		We have designed and built CelebratePlus thinking of you, your money, your needs and how to help save that money and time. If there is any question or comments that you want to share with us, or just to say &ldquo;hello&rdquo; send us a message to: <a href=\\\"mailto:Contact@CelebratePlus.com\\\">Contact@CelebratePlus.com</a></li>\r\n</ul>\r\n<p>\r\n	<a href=\\\"http://www.celebrateplus.com/login.php\\\" target=\\\"_self\\\"><img alt=\\\"\\\" src=\\\"/userfiles/images/start_an_event.png\\\" style=\\\"border-width: 0px; border-style: solid; width: 126px; height: 33px;\\\" /></a></p>\r\n','Features, CelebratePlus','Features CelebratePlus','Features | CelebratePlus','',''),(4,'Signup','649','<p>\r\n	Signup for a CelebratePlus account below:</p>\r\n','Signup, CelebratePlus','Signup CelebratePlus','Signup | CelebratePlus','',''),(5,'Account','470','<p>\r\n	Update your account information using the form below:</p>\r\n','Account, CelebratePlus','Account CelebratePlus','Account | CelebratePlus','',''),(6,'User Signup Header2','921','User signup full content','User Signup Keywords','User Signup Description','User Signup Title','',''),(7,'User Account Header2','310','User Account Full Content','User Account Keywords','User Account Description','User Account Title','',''),(8,'Resources','405','<p>\r\n	We want you to have the most useful tools to create a special event. In the resources we listed here you might find answers for frequent questions about crowdfunding and for events in general.</p>\r\n<p>\r\n	As you can see these are links to third party sites and we cannot validate or endorse their information, however we believe you can find it useful. And remember, if you need help at any time on how to make your invitation and/or how to plan a special event, email us and we will be happy to help.</p>\r\n<ul>\r\n	<li>\r\n		<a href=\\\"http://www.forbes.com/sites/ilyapozin/2012/06/28/crowdfunding-saving-the-u-s-economy-infographic/\\\" target=\\\"_blank\\\">Did you know that 81% of the money raised in crowdfunding campaigns comes from friends and family?</a><br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<a href=\\\"http://www.slate.com/articles/podcasts/manners_for_the_digital_age/2011/09/do_evites_cheapen_a_wedding.html\\\" target=\\\"_blank\\\">Is it acceptable to email wedding invitations?</a><br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<a href=\\\"http://www.costofwedding.com/\\\" target=\\\"_blank\\\">What is the cost of a wedding in the U.S?</a><br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<a href=\\\"http://answers.yahoo.com/question/index?qid=20090120065127AAJnTsZ\\\" target=\\\"_blank\\\">On average, how many invited guests show up to the wedding ceremony and reception?</a><br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<a href=\\\"http://www.crowdsourcing.org/editorial/questions-about-crowdfunding-ask-an-expert/19831\\\" target=\\\"_blank\\\">Questions about crowd funding? Ask an expert</a><br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<a href=\\\"http://www.scribd.com/doc/92871793/Crowd-Funding-Industry-Report-2011\\\" target=\\\"_blank\\\">Do you want to learn about the crowd funding industry? Here&#39;s a leading study.</a></li>\r\n</ul>\r\n','Resources, CelebratePlus','Resources CelebratePlus','Resources | CelebratePlus','',''),(9,'Policies','815','<p>\r\n	<strong>Privacy Policy</strong></p>\r\n<p>\r\n	We respect your right to privacy. We will not give your name or personal information to third parties.</p>\r\n<p>\r\n	PayPal processes all of the transactions on CelebratePlus. No one sees your credit card information besides PayPal, not even us. By using PayPal as a payment mechanism, users are also bound by the PayPal <a href=\\\"https://cms.paypal.com/us/cgi-bin/marketingweb?cmd=_render-content&amp;content_ID=ua/Privacy_full&amp;locale.x=en_US\\\" target=\\\"_blank\\\"><u>Privacy Policy</u></a> and PayPal <a href=\\\"https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&amp;content_ID=ua/UserAgreement_full&amp;locale.x=en_US\\\" target=\\\"_blank\\\"><u>Acceptable Use Policy</u></a> .</p>\r\n<p>\r\n	<strong>Technology / Security</strong></p>\r\n<p>\r\n	CelebratePlus uses cookies to help (anonymously) recognize you as a repeat visitor and to track traffic patterns on our site. We use this information to make CelebratePlus more user-friendly.</p>\r\n<p>\r\n	CelebratePlus may obtain IP addresses from users. We will use this information to monitor and prevent fraud, diagnose problems, and (anonymously) estimate demographic information.</p>\r\n<p>\r\n	When you place orders we use&nbsp;PayPal&#39;s secure server. To the extent you select the secure server method and your browser supports such functionality, all credit card information you supply is transmitted via Secure Socket Layer (SSL) technology.</p>\r\n<p>\r\n	Regardless of these efforts by us, no data transmission over the public Internet can be guaranteed to be 100% secure.</p>\r\n<p>\r\n	<strong>Email</strong></p>\r\n<p>\r\n	We want to communicate with you only if you want to hear from us. We will send you email relating to your personal transactions. We will keep these emails to a minimum.</p>\r\n<p>\r\n	You will also receive certain email notifications (forwarded messages, etc.), for which you may opt-out. We may send you service-related announcements on rare occasions when it is necessary to do so.</p>\r\n<p>\r\n	Event creators [customers according to the Terms of Use] will upload the email addresses of their backers [participants and/or beneficiaries, according to the Terms of Use] so the Event is successfully funded.</p>\r\n<p>\r\n	<strong>Voluntary Disclosure</strong></p>\r\n<p>\r\n	Any personal information or content that you voluntarily disclose in public areas becomes publicly available and can be collected and used by other users. You should exercise caution before disclosing your personal information via these public venues.</p>\r\n<p>\r\n	<strong>Event Creators</strong></p>\r\n<p>\r\n	By entering into our User Agreement, CelebratePlus Event Creators agree to not abuse other users&#39; personal information. Abuse is defined as using personal information for any purpose other than those explicitly specified in the Event Creator&rsquo;s Page, or is not related to fulfilling delivery of a product or service explicitly specified in the Event Creator&rsquo;s Event.</p>\r\n<p>\r\n	<strong>CelebratePlus Event Creators never receive users&#39; credit card information.</strong></p>\r\n<p>\r\n	<strong>Wrap-up</strong></p>\r\n<p>\r\n	CelebratePlus reserves the right to update this privacy policy at anytime. Updates to our privacy policy will be sent to the email address that you have provided us or posted prominently on the website.</p>\r\n<p>\r\n	We reserve the right to disclose your personally identifiable information as required by law and when we believe that disclosure is necessary to protect our rights, or in the good-faith belief that such action is necessary to comply with state and federal laws (such as U.S. Copyright Law, Finance and Banking Regulations).</p>\r\n<p>\r\n	To modify or delete any or all of the personal information you have provided to us, please log in and update your profile. People under 18 are not permitted to use CelebratePlus on their own, and so this privacy policy makes no provision for their use of the site.</p>\r\n<p>\r\n	<strong>Questions</strong></p>\r\n<p>\r\n	If you have questions or suggestions you can contact us at: <a href=\\\"mailto:Support@CelebratePlus.com\\\">Support@CelebratePlus.com</a></p>\r\n','Policies, CelebratePlus','Policies CelebratePlus','Policies | CelebratePlus','',''),(10,'Site Map','45','<p>\r\n	Browse the CelebratePlus site map below:</p>\r\n','Site Map, CelebratePlus','Site Map CelebratePlus','Site Map | CelebratePlus','',''),(11,'About','208','<p>\r\n	CelebratePlus is an innovative, efficient and accountable crowdfunding site to collect money online. It has been designed to be a tool for you, to make your life easier, to help you collect money for your special events, so the money is just one preoccupation less so you spent your time planning just to have an amazing event.</p>\r\n<p>\r\n	Imagine that you can fund your special celebration, wedding, your party, pizza night with friends, Thanksgiving dinner or basically any project with the support of the people that care for your prosperity and wellbeing.</p>\r\n<p>\r\n	Imagine the peace of mind that you can have with a balanced approach between your lifestyle and traditions plus the independence that brings the financial security for a special celebration in your life.</p>\r\n<p>\r\n	CelebratePlus will collect money -hassle-free- from your friends and family relieving you from the inconvenient of doing it personally, so you can focus on the results of the most important part: Having a good time!</p>\r\n<p>\r\n	<a href=\\\"http://www.celebrateplus.com/login.php\\\" target=\\\"_self\\\"><img alt=\\\"\\\" src=\\\"/userfiles/images/start_an_event.png\\\" style=\\\"border-width: 0px; border-style: solid; width: 126px; height: 33px;\\\" /></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n','About, CelebratePlus','About CelebratePlus','About | CelebratePlus','',''),(12,'Advertise','411','<p>\r\n	Our users love to host, fund and attend parties and events with CelebratePlus. These active consumers spend their money from food, beverages, and d&eacute;cor for the party, to gifts for the host or guest of honor, to beauty and personal care to look their best, many of them are starting new lives together as couples, so their needs are varied.</p>\r\n<p>\r\n	We intend to offer our customers with creative tools to throw and attend the perfect party. Let&rsquo;s work together to help consumers to find discounts and help them making purchase decisions to go out and get together.</p>\r\n<p>\r\n	Get in contact with us to show you all the creative ways that we can help our customers by working together at <a href=\\\"mailto:Ads@CelebratePlus.com\\\">Ads@CelebratePlus.com</a></p>\r\n','Advertise, CelebratePlus','Advertise CelebratePlus','Advertise | CelebratePlus','',''),(13,'Help','750','<p>\r\n	<a href=\\\"mailto:Help@CelebratePlus.com\\\">Help@CelebratePlus.com</a> , we usually answer the same day. But if not, don&rsquo;t panic, we answer every inquiry, every question.</p>\r\n<p>\r\n	Thanks!</p>\r\n','Help, CelebratePlus','Help CelebratePlus','Help | CelebratePlus','',''),(14,'Terms of Service','848','<p>\r\n	<strong>Terms of Use</strong></p>\r\n<p>\r\n	PLEASE READ THESE TERMS OF USE (&quot;AGREEMENT&quot; OR &quot;TERMS OF USE&quot;) CAREFULLY BEFORE USING THE SERVICES OFFERED BY Celebrate Plus LLC (&quot;COMPANY&quot;). THIS AGREEMENT SETS FORTH THE LEGALLY BINDING TERMS AND CONDITIONS FOR YOUR USE OF THE WEBSITE AT www.CelebratePlus.com (THE &quot;SITE&quot;) AND THE SERVICE OWNED AND OPERATED BY COMPANY (COLLECTIVELY WITH THE SITE, THE &quot;SERVICE&quot;). BY USING THE SITE OR SERVICE IN ANY MANNER, INCLUDING BUT NOT LIMITED TO VISITING OR BROWSING THE SITE, YOU AGREE TO BE BOUND BY THIS AGREEMENT. THIS AGREEMENT APPLIES TO ALL USERS OF THE SITE OR SERVICE, INCLUDING USERS WHO ARE ALSO EVENT ORGANIZERS, CONTRIBUTORS OF CONTENT, INFORMATION, AND OTHER MATERIALS OR SERVICES ON THE SITE.</p>\r\n<p>\r\n	<strong>Definitions</strong></p>\r\n<p>\r\n	<strong>Customer</strong>: A person that registers with the service as an organizer or as a participant or a beneficiary of group events.</p>\r\n<p>\r\n	<strong>Participant</strong>: A person invited by the organizer to an event or to collaborate with funds to that event.</p>\r\n<p>\r\n	<strong>Beneficiary</strong>: A person designated to receive the payment transaction.</p>\r\n<p>\r\n	<strong>Event</strong>: The pooling or aggregation of funds from customers via payment transactions that are either sent to the organizer&rsquo;s PayPal account or to a beneficiary.</p>\r\n<p>\r\n	<strong>Payment Instrument:</strong> Credit cards, debit cards, and the PayPal service are all payment instruments. Customers using PayPal do not have to live in the United States, as PayPal accepts International currencies.</p>\r\n<p>\r\n	<strong>Payment Transaction</strong>: The processing of a payment through the service that results in the debiting or charging of the purchase amount to a customer&rsquo;s payment instrument and the crediting of funds to a beneficiary.</p>\r\n<p>\r\n	<strong>Product</strong>: Any merchandise, good or service that a customer or beneficiary may receive from customers using the service.</p>\r\n<p>\r\n	<strong>Purchase Amount</strong>: The dollar amount of an event payment transaction to pay for a product and any related fees, taxes or shipping charges, as applicable.</p>\r\n<p>\r\n	<strong>Service</strong>: The service, described in these Terms of Service for customers, facilitates the processing of payment transactions on behalf of an organizer for the benefit of a recipient.</p>\r\n<p>\r\n	<strong>Acceptance of Terms</strong></p>\r\n<p>\r\n	The Service is offered subject to acceptance without modification of all of the terms and conditions contained herein (the &quot;Terms of Use&quot;), which term also incorporates the Privacy Policy available at www.CelebratePlus.com/privacy, and all other operating rules, policies and procedures that may be published from time to time on the Site by Company, each of which is incorporated by reference and each of which may be updated by Company from time to time without notice to you. In addition, some services offered through the Service may be subject to additional terms and conditions promulgated by Company from time to time; your use of such services is subject to those additional terms and conditions, which are incorporated into these Terms of Use by this reference.</p>\r\n<p>\r\n	The Service is available only to individuals who are at least 18 years old. You represent and warrant that if you are an individual, you are of legal age to form a binding contract, and that all registration information you submit is accurate and truthful. Company may, in its sole discretion, refuse to offer the Service to any person or entity and change its eligibility criteria at any time. This provision is void where prohibited by law and the right to access the Service is revoked in such jurisdictions.</p>\r\n<p>\r\n	<strong>Modification of Terms of Use</strong></p>\r\n<p>\r\n	Company reserves the right, at its sole discretion, to modify or replace any of the Terms of Use, or change, suspend, or discontinue the Service (including without limitation, the availability of any feature, database, or content) at any time by posting a notice on the Site or by sending you an email. Company may also impose limits on certain features and services or restrict your access to parts or all of the Service without notice or liability. It is your responsibility to check the Terms of Use periodically for changes. Your continued use of the Service following the posting of any changes to the Terms of Use constitutes acceptance of those changes.</p>\r\n<p>\r\n	<strong>Rules and Conduct</strong></p>\r\n<p>\r\n	As a condition of use, you promise not to use the Service for any purpose that is prohibited by the Terms of Use or by the law. The Service (including, without limitation, any Content or User Submissions (both as defined below)) is provided only for your own personal, non-commercial use (except as allowed by the terms set forth in the Events: Fund-Raising and Commerce section of the Terms of Use). You are responsible for all of your activity in connection with the Service. For purposes of the Terms of Use, the term &quot;Content&quot; includes, without limitation, any User Submissions, videos, audio clips, written forum comments, information, data, text, photographs, software, scripts, graphics, and interactive features generated, provided, or otherwise made accessible by Company or its partners on or through the Service.</p>\r\n<p>\r\n	By way of example, and not as a limitation, you shall not (and shall not permit any third party to) either (a) take any action or (b) upload, download, post, submit or otherwise distribute or facilitate distribution of any content on or through the Service, including without limitation any User Submission, that:</p>\r\n<p>\r\n	infringes any patent, trademark, trade secret, copyright, right of publicity or other right of any other person or entity or violates any law or contractual duty;</p>\r\n<p>\r\n	you know is false, misleading, untruthful or inaccurate;</p>\r\n<p>\r\n	is unlawful, threatening, abusive, harassing, defamatory, libelous, deceptive, fraudulent, invasive of another&#39;s privacy, tortious, obscene, offensive, or profane;</p>\r\n<p>\r\n	constitutes unsolicited or unauthorized advertising or promotional material or any junk mail, spam or chain letters;</p>\r\n<p>\r\n	contains software viruses or any other computer codes, files, or programs that are designed or intended to disrupt, damage, limit or interfere with the proper function of any software, hardware, or telecommunications equipment or to damage or obtain unauthorized access to any system, data, password or other information of Company or any third party; or impersonates any person or entity, including any employee or representative of Company.</p>\r\n<p>\r\n	Additionally, you shall not: (i) take any action that imposes or may impose (as determined by Company in its sole discretion) an unreasonable or disproportionately large load on Company&rsquo;s (or its third party providers&rsquo;) infrastructure; (ii) interfere or attempt to interfere with the proper working of the Service or any activities conducted on the Service; (iii) bypass any measures Company may use to prevent or restrict access to the Service (or other accounts, computer systems or networks connected to the Service); (iv) run Maillist, Listserv, any form of auto-responder or &quot;spam&quot; on the Service; or (v) use manual or automated software, devices, or other processes to &quot;crawl&quot; or &quot;spider&quot; any page of the Site.</p>\r\n<p>\r\n	You shall not (directly or indirectly): (i) decipher, decompile, disassemble, reverse engineer or otherwise attempt to derive any source code or underlying ideas or algorithms of any part of the Service, except to the limited extent applicable laws specifically prohibit such restriction, (ii) modify, translate, or otherwise create derivative works of any part of the Service, or (iii) copy, rent, lease, distribute, or otherwise transfer any of the rights that you receive hereunder. You shall abide by all applicable local, state, national and international laws and regulations.</p>\r\n<p>\r\n	Company does not guarantee that any Content or User Submissions (as defined below) will be made available on the Site or through the Service. Company has no obligation to monitor the Site, Service, Content, or User Submissions. However, Company reserves the right to (i) remove, edit or modify any Content in its sole discretion, including without limitation any User Submissions, from the Site or Service at any time, without notice to you and for any reason (including, but not limited to, upon receipt of claims or allegations from third parties or authorities relating to such Content or if Company is concerned that you may have violated the Terms of Use), or for no reason at all and (ii) to remove or block any User Submissions from the Service.</p>\r\n<p>\r\n	Registration</p>\r\n<p>\r\n	You may browse the Site and view Content without registering, but as a condition to using certain aspects of the Service, you may be required to register with Company and select a password and screen name (&quot;User ID&quot;). You shall provide Company with accurate, complete, and updated registration information. Failure to do so shall constitute a breach of the Terms of Use, which may result in immediate termination of your Company account. You shall not (i) select or use as a User ID or domain a name of another person with the intent to impersonate that person; (ii) use as a User ID or domain a name subject to any rights of a person other than you without appropriate authorization; or (iii) use as a User ID or domain a name that is otherwise offensive, vulgar or obscene. Company reserves the right to refuse registration of, or cancel a User ID and domain in its sole discretion. You are solely responsible for activity that occurs on your account and shall be responsible for maintaining the confidentiality of your Company password. You shall never use another user&rsquo;s account without such other user&rsquo;s express permission. You will immediately notify Company in writing of any unauthorized use of your account, or other account related security breach of which you are aware.</p>\r\n<p>\r\n	Events: Fund-Raising and Commerce</p>\r\n<p>\r\n	CelebratePlus.com (&quot;CelebratePlus&quot;) is a venue for fund-raising and commerce. CelebratePlus allows certain users (&quot;Customers&quot;) to list Events and raise funds from other users (&quot;Participants&quot;). All funds are collected for customers by PayPal. CelebratePlus does not, at any time, receive or hold any monies intended for customers or beneficiaries.</p>\r\n<p>\r\n	CelebratePlus shall not be liable for your interactions with any organizations and/or individuals found on or through the CelebratePlus service. This includes, but is not limited to, delivery of goods and services, and any other terms, conditions, warranties or representations associated with listings on CelebratePlus. CelebratePlus does not oversee the performance or punctuality of Events. CelebratePlus is not responsible for any damage or loss incurred as a result of any such dealings. All dealings are solely between you and such organizations and/or individuals. CelebratePlus is under no obligation to become involved in disputes between Customers and/or Customers, or between site members and any third party. In the event of a dispute, you release CelebratePlus, its officers, employees, agents and successors in rights from claims, damages and demands of every kind, known or unknown, suspected or unsuspected, disclosed or undisclosed, arising out of or in any way related to such disputes and our service.</p>\r\n<p>\r\n	Though CelebratePlus cannot be held liable for the actions of a Customer, Customers are nevertheless wholly responsible for fulfilling obligations both implied and stated in any Event listing they create. CelebratePlus reserves the right to cancel an Event listing and refund all associated members&#39; payments at any time for any reason. CelebratePlus reserves the right to remove an Event listing from public listings for any reason.</p>\r\n<p>\r\n	CelebratePlus makes no guarantees regarding the performance or fairness of PayPal. Additionally, because of occasional failures of some credit cards, CelebratePlus cannot guarantee the full receipt of the targeted amount.</p>\r\n<p>\r\n	Customers may initiate refunds at their own discretion. CelebratePlus is not responsible for issuing refunds for funds that have been collected by Customers.</p>\r\n<p>\r\n	CelebratePlus reserves the right to cancel, interrupt or suspend a listing at any time for any reason.</p>\r\n<p>\r\n	<strong>Fees and Payments</strong></p>\r\n<p>\r\n	Joining CelebratePlus is free. However, we do charge fees for certain services. PayPal collects all fees for CelebratePlus. When you use a service that has a fee you have an opportunity to review and accept the fees that you will be charged, which we may change from time to time. Changes to that Policy are effective after we provide you with notice by posting the changes on the Sites. We may choose to temporarily change the fees for our services for promotional events or new services, and such changes are effective when we post the temporary promotional event or new service on the Sites.</p>\r\n<p>\r\n	You are responsible for paying all fees and applicable taxes associated with your use of the site. In the event a listing is removed from the Service for violating the Terms of Use, all fees paid will be non-refundable, unless in its sole discretion CelebratePlus determines that a refund is appropriate. CelebratePlus charges a fee of 5% of the money raised for your event.</p>\r\n<p>\r\n	<strong>Third Party Site</strong></p>\r\n<p>\r\n	The Service may permit you to link to other websites or resources on the Internet, and other websites or resources may contain links to the Site. When you access third party websites, you do so at your own risk. These other websites are not under Company&#39;s control, and you acknowledge that Company is not responsible or liable for the content, functions, accuracy, legality, appropriateness or any other aspect of such websites or resources. The inclusion of any such link does not imply endorsement by Company or any association with its operators. You further acknowledge and agree that Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such Content, goods or services available on or through any such website or resource.</p>\r\n<p>\r\n	<strong>Content and License</strong></p>\r\n<p>\r\n	You agree that the Service contains Content specifically provided by Company or its partners and that such Content is protected by copyrights, trademarks, service marks, patents, trade secrets or other proprietary rights and laws. You shall abide by and maintain all copyright notices, information, and restrictions contained in any Content accessed through the Service.</p>\r\n<p>\r\n	Company grants each user of the Site and/or Service a worldwide, non-exclusive, non-sublicensable and non-transferable license to use, modify and reproduce the Content, solely for personal, non-commercial use. Use, reproduction, modification, distribution or storage of any Content for other than personal, non-commercial use is expressly prohibited without prior written permission from Company, or from the copyright holder identified in such Content&#39;s copyright notice. You shall not sell, license, rent, or otherwise use or exploit any Content for commercial use or in any way that violates any third party right.</p>\r\n<p>\r\n	<strong>Third Party Intellectual Property &mdash; Copyright Notifications</strong></p>\r\n<p>\r\n	CelebratePlus respects the intellectual property of others, and we ask our users to do the same. CelebratePlus may, in appropriate circumstances and at its discretion, terminate the accounts of users who infringe the rights of others. CelebratePlus will remove infringing materials in accordance with the Digital Millennium Copyright Act if properly notified that content infringes copyright.</p>\r\n<p>\r\n	Although our services are for personal events and celebrations, if you believe that your work has been copied in a way that constitutes copyright infringement, please provide CelebratePlus&#39;s Copyright Agent with a written notification containing at least the following information (please confirm these requirements with your legal counsel, or see Section 512(c)(3) of the U.S. Copyright Act, 17 U.S.C. &sect;512(c)(3), for more information):</p>\r\n<ul>\r\n	<li>\r\n		an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright interest;</li>\r\n	<li>\r\n		a description of the copyrighted work that you claim has been infringed;</li>\r\n	<li>\r\n		a description of where the material that you claim is infringing is located on the CelebratePlus Site, sufficient for CelebratePlus to locate the material;</li>\r\n	<li>\r\n		your address, telephone number, and email address;</li>\r\n	<li>\r\n		a statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law; and</li>\r\n	<li>\r\n		a statement by you that the above information in your notice is accurate and, under penalty of perjury, that you are the copyright owner or authorized to act on the copyright owner&#39;s behalf.</li>\r\n</ul>\r\n<p>\r\n	If you believe that your work has been removed or disabled by mistake or misidentification, please provide the CelebratePlus&rsquo;s Copyright Agent with a written counter-notification containing at least the following information (please confirm these requirements with your legal counsel or see Section 512(g)(3) of the U.S. Copyright Act, 17 U.S.C. &sect;512(g)(3), for more information):</p>\r\n<ul>\r\n	<li>\r\n		a physical or electronic signature of the subscriber/user of the Services;</li>\r\n	<li>\r\n		identification of the material that has been removed or to which access has been disabled and the location at which the material appeared before it was removed or access to it was disabled;</li>\r\n	<li>\r\n		a statement made under penalty of perjury that the subscriber has a good faith belief that the material was removed or disabled as a result of mistake or misidentification of the material to be removed or disabled; and</li>\r\n	<li>\r\n		the subscriber&#39;s name, address, telephone number, and a statement that the subscriber consents to the jurisdiction of the Federal District Court for the judicial district in which the address is located, or if the subscriber&#39;s address is outside of the United States, for any judicial district in which the service provider may be found, and that the subscriber will accept service of process from the person who provided notification under subsection (c)(1)(C) or an agent of such person.</li>\r\n	<li>\r\n		You acknowledge that if you fail to comply with all of the aforementioned notice requirements, your notification or counter-notification may not be valid and that CelebratePlus may ignore such incomplete or inaccurate notices without liability of any kind.</li>\r\n</ul>\r\n<p>\r\n	Under Section 512(f) of the Copyright Act, 17 U.S.C. &sect;512(f), any person who knowingly materially misrepresents that material or activity is infringing or was removed or disabled by mistake or misidentification may be subject to liability.</p>\r\n<p>\r\n	Our designated copyright agent for notice of alleged copyright infringement could be contacted at Email: <a href=\\\"mailto:Copyright@CelebratePlus.com\\\">Copyright@CelebratePlus.com</a></p>\r\n<p>\r\n	<strong>Intellectual Property Rights &mdash; Customers</strong></p>\r\n<p>\r\n	The Service provides you with the ability to upload your content to the Site. Company will not have any ownership rights in your content; however, Company needs the following license to perform the Service. You hereby grant to Company the worldwide, non-exclusive, royalty-free, right to (and to allow others acting on its behalf to) (i) use, host, display, and otherwise perform the Service on your behalf (e.g., use, host, stream, transmit, playback, transcode, copy, display, feature, market, sell, distribute and otherwise exploit (&quot;Host&quot;) the content, along with all associated copyrightable works or metadata, including without limitation photographs, graphics, and descriptive text (&quot;Artworks&quot;) in connection with the Service); (ii) (and to allow other users to) stream, transmit, playback, download, display, feature, distribute, collect, and otherwise use the content and Artworks; and (iii) use and publish, and to permit others to use and publish, the name(s), trademarks, likenesses, and personal and biographical materials of you and the members of your group, in connection with the provision of the Service.</p>\r\n<p>\r\n	You agree to pay all royalties and other amounts owed to any person or entity due to your submission of your content to the Service or the Company&rsquo;s Hosting of the content as contemplated by these Terms of Use.</p>\r\n<p>\r\n	To enable Company to Host your content pursuant to the above provisions, you hereby grant to Company the worldwide, non-exclusive, perpetual, royalty-free, sublicensable and transferable right to use, reproduce, copy, and display your trademarks, service marks, slogans, logos or similar proprietary rights (collectively, the &quot;Trademarks&quot;) solely in connection with the Service.</p>\r\n<p>\r\n	<strong>Intellectual Property Rights &mdash; Users</strong></p>\r\n<p>\r\n	The Service may provide users with the ability to add, create, upload, submit, distribute, collect, or post (&quot;Submitting&quot; or &quot;Submission&quot;) content, videos, audio clips, written forum comments, data, text, photographs, software, scripts, graphics, or other information to the Site (collectively, the &quot;User Submissions&quot;). By Submitting User Submissions on the Site or otherwise through the Service, you:</p>\r\n<p>\r\n	Acknowledge that by submitting any User Submission to the Site, you are publishing that User Submission, and that you may be identified publicly by your User ID in association with any such User Submission;</p>\r\n<p>\r\n	By Submitting any User Submissions through the Site or the Service, you hereby do and shall grant Company a worldwide, non-exclusive, perpetual, irrevocable, royalty-free, fully paid, sublicensable and transferable license to use, edit, modify, reproduce, distribute, prepare derivative works of, display, perform, and otherwise fully exploit the User Submissions in connection with the Site, the Service and Company&rsquo;s (and its successors and assigns&rsquo;) business, including without limitation for promoting and redistributing part or all of the Site (and derivative works thereof) or the Service in any media formats and through any media channels (including, without limitation, third party websites). You also hereby do and shall grant each user of the Site and/or the Service a non-exclusive license to access your User Submissions through the Site and the Service, and to use, edit, modify, reproduce, distribute, prepare derivative works of, display and perform such User Submissions solely for personal, non-commercial use. For clarity, the foregoing license grant to Company does not affect your other ownership or license rights in your User Submission(s), including the right to grant additional licenses to the material in your User Submission(s), unless otherwise agreed in writing;</p>\r\n<p>\r\n	Represent and warrant, and can demonstrate to Company&rsquo;s full satisfaction upon request that you (i) own or otherwise control all rights to all content in your User Submissions, or that the content in such User Submissions is in the public domain, (ii) you have full authority to act on behalf of any and all owners of any right, title or interest in and to any content in your User Submissions to use such content as contemplated by these Terms of Use and to grant the license rights set forth above, (iii) you have the permission to use the name and likeness of each identifiable individual person and to use such individual&rsquo;s identifying or personal information as contemplated by these Terms of Use; and (iv) you are authorized to grant all of the aforementioned rights to the User Submissions to Company and all users of the Service;</p>\r\n<p>\r\n	You agree to pay all royalties and other amounts owed to any person or entity due to your Submission of any User Submissions to the Service;</p>\r\n<p>\r\n	That the use or other exploitation of such User Submissions by Company and use or other exploitation by users of the Site and Service as contemplated by this Agreement will not infringe or violate the rights of any third party, including without limitation any privacy rights, publicity rights, copyrights, contract rights, or any other intellectual property or proprietary rights; and understand that Company shall have the right to delete, edit, modify, reformat, excerpt, or translate any materials, content or information submitted by you; and that all information publicly posted or privately transmitted through the Site is the sole responsibility of the person from which such content originated and that Company will not be liable for any errors or omissions in any content; and that Company cannot guarantee the identity of any other users with whom you may interact in the course of using the Service.</p>\r\n<p>\r\n	Company does not endorse and has no control over any User Submission. Company cannot guarantee the authenticity of any data that users may provide about themselves. You acknowledge that all Content accessed by you using the Service is at your own risk and you will be solely responsible for any damage or loss to any party resulting therefore.</p>\r\n<p>\r\n	<strong>Termination</strong></p>\r\n<p>\r\n	Company may terminate your access to all or any part of the Service at any time, with or without cause, with or without notice, effective immediately, which may result in the forfeiture and destruction of all information associated with your membership. If you wish to terminate your account, you may do so by following the instructions on the Site. Any fees paid hereunder are non-refundable. All provisions of the Terms of Use that by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>\r\n<p>\r\n	<strong>Warranty Disclaimer</strong></p>\r\n<p>\r\n	Company has no special relationship with or fiduciary duty to you. You acknowledge that Company has no control over, and no duty to take any action regarding: which users gains access to the Site; what Content you access via the Site; what effects the Content may have on you; how you may interpret or use the Content; or what actions you may take as a result of having been exposed to the Content. You release Company from all liability for you having acquired or not acquired Content through the Site. The Site may contain, or direct you to websites containing, information that some people may find offensive or inappropriate. Company makes no representations concerning any Content contained in or accessed through the Site, and Company will not be responsible or liable for the accuracy, copyright compliance, legality or decency of material contained in or accessed through the Site or the Service.</p>\r\n<p>\r\n	THE SERVICE IS PROVIDED &quot;AS IS&quot; AND &quot;AS AVAILABLE&quot; AND IS WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE, AND ANY WARRANTIES IMPLIED BY ANY COURSE OF PERFORMANCE OR USAGE OF TRADE, ALL OF WHICH ARE EXPRESSLY DISCLAIMED. COMPANY, AND ITS DIRECTORS, EMPLOYEES, AGENTS, SUPPLIERS, PARTNERS AND CONTENT PROVIDERS DO NOT WARRANT THAT: (A) THE SERVICE WILL BE SECURE OR AVAILABLE AT ANY PARTICULAR TIME OR LOCATION; (B) ANY DEFECTS OR ERRORS WILL BE CORRECTED; (C) ANY CONTENT OR SOFTWARE AVAILABLE AT OR THROUGH THE SERVICE IS FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS; OR (D) THE RESULTS OF USING THE SERVICE WILL MEET YOUR REQUIREMENTS. YOUR USE OF THE SERVICE IS SOLELY AT YOUR OWN RISK.</p>\r\n<p>\r\n	SOME STATES DO NOT ALLOW LIMITATIONS ON HOW LONG AN IMPLIED WARRANTY LAST, SO THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.</p>\r\n<p>\r\n	Electronic Communications Privacy Act Notice (18USC 2701-2711): COMPANY MAKES NO GUARANTY OF CONFIDENTIALITY OR PRIVACY OF ANY COMMUNICATION OR INFORMATION TRANSMITTED ON THE SITE OR ANY WEBSITE LINKED TO THE SITE. Company will not be liable for the privacy of email addresses, registration and identification information, disk space, communications, confidential or trade-secret information, or any other Content stored on Company&rsquo;s equipment, transmitted over networks accessed by the Site, or otherwise connected with your use of the Service.</p>\r\n<p>\r\n	<strong>Indemnification</strong></p>\r\n<p>\r\n	You shall defend, indemnify, and hold harmless Company, its affiliates and each of its, and its affiliates employees, contractors, directors, suppliers and representatives from all liabilities, claims, and expenses, including reasonable attorneys&#39; fees, that arise from or relate to your use or misuse of, or access to, the Site, Service, Content or otherwise from your User Submissions, violation of the Terms of Use, or infringement by you, or any third party using the your account, of any intellectual property or other right of any person or entity. Company reserves the right to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, in which event you will assist and cooperate with Company in asserting any available defenses.</p>\r\n<p>\r\n	<strong>Limitation of Liability</strong></p>\r\n<p>\r\n	IN NO EVENT SHALL COMPANY, NOR ITS DIRECTORS, EMPLOYEES, AGENTS, PARTNERS, SUPPLIERS OR CONTENT PROVIDERS, BE LIABLE UNDER CONTRACT, TORT, STRICT LIABILITY, NEGLIGENCE OR ANY OTHER LEGAL OR EQUITABLE THEORY WITH RESPECT TO THE SERVICE (I) FOR ANY LOST PROFITS, DATA LOSS, COST OF PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES, OR SPECIAL, INDIRECT, INCIDENTAL, PUNITIVE, OR CONSEQUENTIAL DAMAGES OF ANY KIND WHATSOEVER, SUBSTITUTE GOODS OR SERVICES (HOWEVER ARISING), (II) FOR ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE (REGARDLESS OF THE SOURCE OF ORIGINATION), OR (III) FOR ANY DIRECT DAMAGES IN EXCESS OF (IN THE AGGREGATE) ONE-HUNDRED U.S. DOLLARS ($100.00). SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATIONS AND EXCLUSIONS MAY NOT APPLY TO YOU.</p>\r\n<p>\r\n	<strong>International</strong></p>\r\n<p>\r\n	Accessing the Service is prohibited from territories where such Content is illegal. If you access the Service from other locations, you do so at your own initiative and are responsible for compliance with local laws.</p>\r\n<p>\r\n	<strong>Electronic Delivery/Notice Policy and Your Consent</strong></p>\r\n<p>\r\n	By using the Services, you consent to receive from CelebratePlus all communications including notices, agreements, legally required disclosures or other information in connection with the Services (collectively, &quot;Contract Notices&quot;) electronically. CelebratePlus may provide such electronic Contract Notices by posting them on the CelebratePlus Site. If you desire to withdraw your consent to receive Contract Notices electronically, you must discontinue your use of the CelebratePlus Site and Services.</p>\r\n<p>\r\n	<strong>Governing Law</strong></p>\r\n<p>\r\n	These Terms of Service (and any further rules, policies or guidelines incorporated by reference herein) shall be governed by and construed in accordance with the laws of the State of Texas, without giving effect to any principles of conflicts of law, and without application of the Uniform Computer Information Transaction Act or the United Nations Convention of Controls for International Sale of Goods. You agree that the company (and all Services) is deemed a passive website that does not give rise to personal jurisdiction over CelebratePlus or its respective parents, subsidiaries, affiliates, successors, assigns, employees, agents, directors, officers or shareholders, either specific or general, in any jurisdiction other than the State of Texas. You agree that any action at law or in equity arising out of or relating to these terms, or your use or non-use of the Services, shall be filed only in the state or federal courts located in Collin County in the State of Texas (Northern District of Texas) and you hereby consent and submit to the personal jurisdiction of such courts for the purposes of litigating any such action. You hereby irrevocably waive any right you may have to trial by jury in any such dispute, action or proceeding.</p>\r\n<p>\r\n	<strong>Integration and Severability</strong></p>\r\n<p>\r\n	The Terms of Use are the entire agreement between you and Company with respect to the Service and use of the Site, and supersede all prior or contemporaneous communications and proposals (whether oral, written or electronic) between you and Company with respect to the Site. If any provision of the Terms of Use is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary so that the Terms of Use will otherwise remain in full force and effect and enforceable. The failure of either party to exercise in any respect any right provided for herein shall not be deemed a waiver of any further rights hereunder.</p>\r\n<p>\r\n	<strong>Miscellaneous</strong></p>\r\n<p>\r\n	Company shall not be liable for any failure to perform its obligations hereunder where such failure results from any cause beyond Company&rsquo;s reasonable control, including, without limitation, mechanical, electronic or communications failure or degradation (including &quot;line-noise&quot; interference). The Terms of Use are personal to you, and are not assignable, transferable or sublicensable by you except with Company&#39;s prior written consent. Company may assign, transfer or delegate any of its rights and obligations hereunder without consent. No agency, partnership, joint venture, or employment relationship is created as a result of the Terms of Use and neither party has any authority of any kind to bind the other in any respect. In any action or proceeding to enforce rights under the Terms of Use, the prevailing party will be entitled to recover costs and attorneys&#39; fees. All notices under the Terms of Use will be in writing and will be deemed to have been duly given when received, if personally delivered or sent by certified or registered mail, return receipt requested; when receipt is electronically confirmed, if transmitted by facsimile or e-mail; or the day after it is sent, if sent for next day delivery by recognized overnight delivery service.</p>\r\n','Terms of Service, CelebratePlus','Terms of Service CelebratePlus','Terms of Service | CelebratePlus','',''),(15,'','74','<p>\r\n	Welcome to your CelebratePlus account control panel. Use this control panel to setup events, manage existing events and view events that you have been invited to or are attending.</p>\r\n','','','','',''),(16,'','568','','','','','',''),(17,'','813','','','','','',''),(18,'','878','<p>\r\n	A list of events that you have confirmed attendance to can be found below:</p>\r\n','','','','',''),(19,'','474','<p>\r\n	A list of your events that you are hosting can be found below:</p>\r\n','','','','',''),(20,'Find an Event','279','<p>\r\n	Search for an event using the search box below:</p>\r\n','Find an Event, CelebratePlus','Find an Event CelebratePlus','Find an Event | CelebratePlus','',''),(26,'Don\'t Have an Account? Register Today!','41','<p>\r\n	Follow our simple and quick registration&nbsp;steps to have your account created with us. After that you will be able to confirm attendance to events, create invitations for your own events, raise funds and start celebrating!</p>\r\n','Celebrate Plus, Login','Celebrate Plus Login','Celebrate Plus | Login','',''),(25,'','366','<p>\r\n	Testing Account Event Reminder content2</p>\r\n','','','','',''),(21,'','531','','','','','','Account Create Invitation'),(22,'','120','','','','','',''),(24,'','554','<!---<p>\r\n	Thank you for submitting your contribution to this event!</p> -->','','','','','Contribution Confirmation');
/*!40000 ALTER TABLE `staticpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_admin`
--

DROP TABLE IF EXISTS `sub_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `cpassword` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_admin`
--

LOCK TABLES `sub_admin` WRITE;
/*!40000 ALTER TABLE `sub_admin` DISABLE KEYS */;
INSERT INTO `sub_admin` VALUES (6,'testadmin','9283a03246ef2dacdc21a9b137817ec1','9283a03246ef2dacdc21a9b137817ec1','Test','Test','divakar@innofoundry.com',1);
/*!40000 ALTER TABLE `sub_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subpage`
--

DROP TABLE IF EXISTS `subpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subpage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `static_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `linkname` text NOT NULL,
  `navigation` text NOT NULL,
  `page_header` text NOT NULL,
  `image_path` text NOT NULL,
  `browserbar` text NOT NULL,
  `metakeyword` text NOT NULL,
  `metadescription` text NOT NULL,
  `content1` text NOT NULL,
  `url` text NOT NULL,
  `target` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  `map_path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subpage`
--

LOCK TABLES `subpage` WRITE;
/*!40000 ALTER TABLE `subpage` DISABLE KEYS */;
/*!40000 ALTER TABLE `subpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_date` date NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `cpassword` text NOT NULL,
  `email` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-23 11:14:06
