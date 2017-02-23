
drop database webcal;
create database webcal;
use webcal;

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL auto_increment,
  `month` int(11) NOT NULL default '0',
  `day` int(11) NOT NULL default '0',
  `year` int(11) NOT NULL default '0',
  `event` varchar(255) NOT NULL default '',
  `description` text,
  `sortorder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

CREATE TABLE `secur` (
  `userid` varchar(25) NOT NULL default '',
  `password` blob NOT NULL,
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `secur`
-- 

INSERT INTO `secur` VALUES ('admin', 0xad85fbc980071c315ffd7415188db82c);