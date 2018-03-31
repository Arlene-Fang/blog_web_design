## A back-end design with PHP and MySQLi

You need to set your database information in db.php

You also need to create some tables, which are used in this website.

Tabel stories stores the main web content.
``` bash
CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `writer` varchar(16) NOT NULL,
  `category` varchar(16) NOT NULL DEFAULT '',
  `headline` text,
  `story_text` text,
  `picture` text,
  `location` text,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
```
Tabel writers stores users' infomation.
``` bash
CREATE TABLE `writers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` char(40) NOT NULL,
  `full_name` text,
  `signup_date` datetime DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `avatar` text,
  PRIMARY KEY (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
```
Tabel writers_permissions stores common users' and admins' permission.
``` bash
CREATE TABLE `writer_permissions` (
  `writer` varchar(16) NOT NULL DEFAULT '',
  `category` varchar(16) NOT NULL DEFAULT '',
  PRIMARY KEY (`writer`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
Tabel post stores comments.
``` bash
CREATE TABLE `post` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `username` varchar(200) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `category` text,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;
```
Tabel comment stores users comments chat.
``` bash
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
```
Tabel category stores category of stories.
``` bash
CREATE TABLE `category` (
  `code` varchar(16) NOT NULL,
  `description` text,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
Tabel likelist stores users' likelist.
``` bash
CREATE TABLE `likelist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(11) DEFAULT NULL,
  `liketime` varchar(11) DEFAULT NULL,
  `storyid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
```
