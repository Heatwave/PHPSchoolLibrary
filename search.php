<?php
session_start();

include 'ConnectDatabase.inc.php';
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

		<div class="row">
			<h1 class="page-header">图书检索</h1>
		</div>

		<form class="form-horizontal" role="form" name="send" action="searchresult.php" method="POST">
		  <fieldset>
				<div class="form-group">
				  </br></br>
					<div class="col-md-2">
						<select class="form-control" name="searchitem" id="searchitrm">
						  <option value="name">书名</option>
						  <option value="author">作者</option>
						  <option value="press">出版社</option>
						  <option value="isbn">ISBN</option>
						</select>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" name="searchword" id="searchword" maxlength="80" placeholder="请输入检索词" autofocus>
					</div>
					<div class="col-md-2">
						<button type="submit" name="submit" value="searchresult" class="btn btn-primary">检索</button>
					</div>
				</div>	<!--/div for form-group -->
		  </fieldset>
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
