<?php
session_start();

include 'ConnectDatabase.inc.php';

if(isset($_POST['submit']) && ($_POST['submit']=="确认添加"))
{
		if(empty($_POST['bulletin']))
		{
				echo '<script type="text/javascript">';
				echo 'alert("请填写公告")';
				echo '</script>';
		}
		else
		{
				$query = 'INSERT INTO bulletin(content) VALUES("'. mysql_real_escape_string($_POST['bulletin'],$db) .'");';
				$result = mysql_query($query,$db) or die (mysql_error($db));
				echo '<script type="text/javascript">';
				echo 'alert("添加成功!")';
				echo '</script>';
		}
}

if(isset($_GET['action']) && ($_GET['action']=='delete'))
{
	//点击删除后
	$query = 'DELETE FROM bulletin WHERE id=' . $_GET['id'] . '';
	$result = mysql_query($query,$db) or die (mysql_error($db));
	if($result)
	{
		echo '<script type="text/javascript">';
		echo 'alert("删除成功!")';
		echo '</script>';
	}
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("删除失败!")';
		echo '</script>';
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

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
			<h1 class="page-header">公告管理</h1>
		</div>

		<form class="form-horizontal" role="form" action="bulletinmanagement.php" method="POST">
		  <div class="form-group">
		    <label class="col-md-2 control-label">添加公告</label>
				<div class="col-md-10">
				  <textarea class="form-control" rows="5" name="bulletin"/></textarea>
				</div>
		  </div>
			<div class="form-group">
		    <div class="col-md-10 col-md-offset-2">
				  <input type="submit" class="btn btn-primary btn-md" name="submit" value="确认添加">
				</div>
		  </div>
	  </form>

		<div class="row">
			<h1 class="page-header"></h1>
		</div>

		<div class="table-responsive">
		  <table width="50" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				<tr class="info">
				  <th class="text-center">公告id</th>
				  <th class="text-center">添加日期</th>
				  <th class="text-center">公告内容</th>
				  <th class="text-center">操作</th>
					<!--为每一列分别设定宽度-->
					<col style="width: 10%" />
					<col style="width: 20%" />
					<col style="width: 65%" />
					<col style="width: 5%" />
				</tr>
				</thead>
				<tbody>
<?php
$query = 'SELECT * FROM bulletin ORDER BY id DESC';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
	echo '<tr>';
	echo '<td>';
	echo $row['id'];
	echo '</td>';
	echo '<td>';
	echo $row['create_time'];
	echo '</td>';
	echo '<td>';
	echo $row['content'];
	echo '</td>';
	echo '<td>';
	echo '<a class="btn btn-danger btn-xs" href="bulletinmanagement.php?action=delete&id='. $row['id'] .'">删除</a>';
	echo '</td>';
	echo '</tr>';
}
mysql_free_result($result);
?>
		  </tbody>
		</table>
	  </div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; YangXiangRui YuHao LiangXiao 2015</p>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
