<?php
session_start();

include 'ConnectDatabase.inc.php';

$id = (isset($_POST['id'])) ? trim($_POST['id']) : '';
$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';

if(isset($_POST['submit']))
{
	$query = 'SELECT * FROM user WHERE ' .
		'id = "' . mysql_real_escape_string($id,$db) . '" AND ' .
		'password = PASSWORD("' . mysql_real_escape_string($password,$db) . '")';
	$result = mysql_query($query,$db) or die (mysql_error($db));

	if(mysql_num_rows($result)> 0)
	{
		mysql_free_result($result);

		$query = 'SELECT * FROM user WHERE ' .
			'id = "' . mysql_real_escape_string($id,$db) . '" AND ' .
			'password = PASSWORD("' . mysql_real_escape_string($password,$db) . '")';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$usertype = $row['type'];

		$_SESSION['id'] = $id;
		$_SESSION['usertype'] = $usertype;
		$_SESSION['logged'] = true;
		mysql_free_result($result);
		header('Location:index.php');
		mysql_close($db);
		die();
	}
	else
	{
		$_SESSION['id'] = '';
		$_SESSION['logged'] = false;

		$error= '<div class="alert alert-danger" role="alert">
        <p class="text-center"><strong>用户名或密码错误，请重新输入!</strong></p>
		</div>';
	}
	mysql_free_result($result);
}
?>

<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Library">
    <meta name="author" content="Yxr">
		<link rel="icon" href="images/IndexImage.ico">

    <title>图书馆书目检索系统</title>

		<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">

		<link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/global.js"></script>

  </head>

  <body>

<?php
if(isset($error))
{
	echo $error;
}
?>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
      <h1 class="page-header">登陆</h1>
		</div>

		<form class="form-signin" role="form" action="login.php" method="POST">
      <h2 class="form-signin-heading">请登录</h2>
      <input type="username" name="id" class="form-control" placeholder="用户名" required autofocus>
      <input type="password" name="password" class="form-control" placeholder="密码" required>
<!--
      <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> 记住我
        </label>
      </div>
-->
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">登陆</button>
    </form>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; YangXiangRui YuHao LiangXiao 2015</p>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
