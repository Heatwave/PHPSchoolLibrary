<?php
$db = mysql_connect('localhost','bp6am','bp6ampass') or
	die ('Unable to connect.Check your connection parameters.');
mysql_select_db('library',$db) or die (mysql_error($db));
?>
