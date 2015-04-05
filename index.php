<?php
session_start();

include 'ConnectDatabase.inc.php';

$id = (isset($_SESSION['id'])) ? trim($_SESSION['id']) : '';

if($id != '')
{
		$query = 'SELECT * FROM user WHERE id="'. $id .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		$row = mysql_fetch_assoc($result);
		$name = $row['name'];
		$usertype = $row['type'];
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

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

<?php
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
{

?>
    <div class="jumbotron-index">
      <h1>欢迎您!</h1>
      <p class="lead">如果您还未注册，您可以点击下方的“注册”按钮进行注册，注册后您将可以在该图书馆借书。</p>
		  <p class="lead">如果您拥有账号但还未登陆，您可以点击下方的“登陆”按钮进行登陆。</p>
		  <p>
				<a class="btn btn-lg btn-primary" href="register.php" role="button">注册</a>
				<a class="btn btn-lg btn-primary" href="login.php" role="button">登陆</a>
			</p>
    </div>

<?php
}
else if(isset($_SESSION['logged']) && $_SESSION['logged'] == true)
{
		echo '<div class="jumbotron-index"><h1>欢迎您,'. $name .'!</h1></div>';
}
?>


		<div class="row">
			<h1 class="page-header">公告栏</h1>
		</div>

		<div class="jumbotron">
		  <div class="container">
<?php
$query = 'SELECT * FROM bulletin ORDER BY id DESC';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
	echo '<div class="panel panel-info">';
	echo '<div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>公告序号:'. $row['id'] .'</div>';
	echo '<div class="panel-body">'. $row['content'] .'</div>';
	echo '<div class="panel-footer">发布时间:'. $row['create_time'] .'</div>';
	echo '</div>';
}
mysql_free_result($result);
?>
		  </div>
		</div>

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

