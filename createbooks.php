<?php
session_start();

include 'ConnectDatabase.inc.php';

if(isset($_POST['submit']) && $_POST['submit'] == '提交')
{
		$checkyearpattern = "/^[0-9]{3}[1-9]|[0-9]{2}[1-9][0-9]{1}|[0-9]{1}[1-9][0-9]{2}|[1-9][0-9]{3}$/";

		$isbn = (isset($_POST['isbn'])) ? trim($_POST['isbn']) : '';
		$name = (isset($_POST['name'])) ? trim($_POST['name']) : '';
		$author = (isset($_POST['author'])) ? trim($_POST['author']) : '';
		$press = (isset($_POST['press'])) ? trim($_POST['press']) : '';
		$publicationdate = (isset($_POST['publicationdate'])) ? trim($_POST['publicationdate']) : '';
		$price = (isset($_POST['price'])) ? trim($_POST['price']) : '';
		$pages = (isset($_POST['pages'])) ? trim($_POST['pages']) : '';
		$callnumber = (isset($_POST['callnumber'])) ? trim($_POST['callnumber']) : '';
		$introduction = (isset($_POST['introduction'])) ? trim($_POST['introduction']) : '';

		if (empty($isbn) || empty($name) || empty($author) || empty($press) ||
				empty($publicationdate) || empty($price) || empty($callnumber))
		{
				echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>数据输入不完整，请重新输入!</strong></p>
						</div>';
		}
		else if(!preg_match($checkyearpattern,$publicationdate))
		{
				echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>出版年格式不合法，请重新输入!</strong></p>
						</div>';
		}
		else
		{
				$query = 'SELECT * FROM books WHERE isbn = "'. $isbn .'";';
				$result = mysql_query($query,$db) or die (mysql_error($db));
				if ($result && mysql_num_rows($result) > 0)
				{
						echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>'. $isbn .' 该图书已存在，请征订!</strong></p>
						</div>';
				}
				else
				{
						$query = 'INSERT INTO books VALUES("'. $isbn .'","'. $name .'",';
						$query .= '"'. $author .'","'. $press .'","'. $publicationdate .'",';
						$query .= $price .',';
						if(isset($pages) && $pages != '')
						{
								$query .= $pages;
						}
						else
						{
								$query .= 'NULL';
						}
						$query .= ',"'. $callnumber .'",';
						if(isset($introduction) && $introduction != '')
						{
								$query .= '"'. $introduction .'"';
						}
						else
						{
								$query .= '" "';
						}
						$query .= ');';
						$result = mysql_query($query,$db) or die (mysql_error($db));
						if(!$result)
						{
								echo '<div class="alert alert-danger" role="alert">
								<p class="text-center"><strong>创建图书失败!</strong></p>
								</div>';
						}
						echo '<div class="alert alert-success" role="alert">
						<p class="text-center"><strong>创建图书成功!</strong></p>
						</div>';
						mysql_close($db);
						header('Location:booksmanagement.php');
				}
		}
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

    <script src="js/checkcreatebooks.js"></script>

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
			<h1 class="page-header">图书管理</h1>
		</div>

		<div class="row">
			<div class="col-md-4"><a href="createbooks.php" class="btn btn-primary btn-lg" role="button">创建图书</a></div>
			<div class="col-md-4"><a href="addbooks.php" class="btn btn-primary btn-lg" role="button">图书征订</a></div>
			<div class="col-md-4"><a href="destroybooks.php" class="btn btn-primary btn-lg" role="button">销毁图书</a></div>
		</div>

		<div class="row">
			<h3 class="page-header">创建图书</h3>
		</div>

		<form class="form-horizontal" role="form" name="send" action="createbooks.php" method="POST" onsubmit="return Check();">
		  <fieldset>
				<div class="form-group">
					<div class="col-md-4">
				    <label for="isbn" class="col-md-4 control-label">ISBN:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="isbn" id="isbn" maxlength="13" placeholder="请输入ISBN号" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="name" class="col-md-4 control-label">书名:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="请输入书名">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="author" class="col-md-4 control-label">作者:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="author" id="author" maxlength="50" placeholder="请输入作者">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="press" class="col-md-4 control-label">出版社:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="press" id="press" maxlength="50" placeholder="请输入出版社名">
						</div>
					</div> <!--/div for col-md-4  -->
					<div class="col-md-4">
				    <label for="publicationdate" class="col-md-4 control-label">出版年:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="publicationdate" id="publicationdate" maxlength="4" placeholder="请输入出版年">
						</div>
					</div> <!--/div for col-md-4  -->
				  <div class="col-md-2">格式：YYYY</div>
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="price" class="col-md-4 control-label">价格:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="price" id="price" maxlength="10" placeholder="请输入价格">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="pages" class="col-md-4 control-label">页数:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="pages" id="pages" maxlength="10" placeholder="请输入页数">
						</div>
					</div> <!--/div for col-md-4  -->
					<div class="col-md-4">
				    <label for="callnumber" class="col-md-4 control-label">索书号:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="callnumber" id="callnumber" maxlength="20" placeholder="请输入索书号">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-8">
				    <label for="callnumber" class="col-md-4 control-label col-md-pull-2">简介:</label>
						<div class="col-md-8 col-md-pull-2">
								<textarea class="form-control" name="introduction" id="introduction" rows="3"></textarea>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
				  <div class="col-sm-10 col-sm-offset-1">
						<button type="submit" name="submit" value="提交" class="btn btn-primary">提交</button>
						<button type="reset" name="reset" value="重置" class="btn btn-default">重置</button>
					</div>
				</div>
		  </fieldset>
		</form>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; YangXiangRui YuHao LiangXiao 2015</p>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
