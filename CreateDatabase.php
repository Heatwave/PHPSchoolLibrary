<?php
$db = mysql_connect('localhost','bp6am','bp6ampass') or
	die ('Unable to connect.Check your connection parameters.');
mysql_select_db('library',$db) or die (mysql_error($db));

//create usertype table
$query = 'CREATE TABLE IF NOT EXISTS usertype(
		type ENUM("bachelor","master","doctor","teacher") NOT NULL PRIMARY KEY,
		maxborrowed INT NOT NULL,
		daysofborrowed INT NOT NULL
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

//Create user table
$query = 'CREATE TABLE IF NOT EXISTS user(
		id CHAR(30) NOT NULL PRIMARY KEY,
		password CHAR(32) NOT NULL,
		name CHAR(10) NOT NULL,
		phone VARCHAR(20),
		email VARCHAR(50),
		registertime DATE NOT NULL,
		borrowednumber INT NOT NULL DEFAULT 0,
		type CHAR(20) NOT NULL,
		FOREIGN KEY(type) REFERENCES usertype(type)
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

//create books table
$query = 'CREATE TABLE IF NOT EXISTS books(
		isbn CHAR(13) NOT NULL PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		author VARCHAR(50) NOT NULL,
		press VARCHAR(50) NOT NULL,
		publicationdate YEAR NOT NULL,
		price FLOAT(9,2) NOT NULL,
		pages INT,
		callnumber CHAR(20) NOT NULL,
		introduction TEXT
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

//create addbooks table
$query = 'CREATE TABLE IF NOT EXISTS addbooks(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		isbn CHAR(13) NOT NULL,
		addtime TIMESTAMP NOT NULL,
		FOREIGN KEY(isbn) REFERENCES books(isbn)
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

//create borrowedbook table
$query = 'CREATE TABLE IF NOT EXISTS borrowedbook(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		isbn CHAR(13) NOT NULL,
		booksid INT NOT NULL,
		userid CHAR(30) NOT NULL,
		borroweddate DATE NOT NULL,
		returndate DATE,
		FOREIGN KEY(isbn) REFERENCES books(isbn),
		FOREIGN KEY(userid) REFERENCES user(id)
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

//create bulletin table
$query = 'CREATE TABLE IF NOT EXISTS bulletin(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		create_time TIMESTAMP NOT NULL,
		content TEXT NOT NULL
		)
		ENGINE=MyISAM';
mysql_query($query,$db) or die (mysql_error($db));

echo 'OK!';
?>
