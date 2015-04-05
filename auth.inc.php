<?php
session_start();

if(!isset($_SESSION['logged']) || ($_SESSION['logged'] != true))
{
	header('Refresh:5;URL=login.php');
	echo '<p>你还未登录，请先登录！</p>';
	echo '<p>你的浏览器将会跳转到登录页面，如果不能自动跳转，' .
		'请<a href="login.php">点击这里</a></p>';
	die();
}
?>
