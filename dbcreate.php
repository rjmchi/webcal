<?php

$db=mysql_connect ("localhost", "root","kether1330") or die ('I cannot connect to the database because: ' . mysql_error());

mysql_select_db ("webcal");

mysql_query("CREATE TABLE `calendar` (`id` int(11) NOT NULL auto_increment,`month` int(11) NOT NULL default '0',`day` int(11) NOT NULL default '0',
  `year` int(11) NOT NULL default '0',
  `event` varchar(255) NOT NULL default '',
  `description` text,
  `sortorder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=45", $db);



mysql_query("CREATE TABLE `secur` (
  `userid` varchar(25) NOT NULL default '',
  `password` blob NOT NULL,
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM", $db);

mysql_query("INSERT INTO `secur` VALUES ('admin', 0xac4ec898f0f90bc21d63bd6124e8f50c)");



