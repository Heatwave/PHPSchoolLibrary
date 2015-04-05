<?php
session_start();

include 'ConnectDatabase.inc.php';

if(isset($_GET['type']) && $_GET['type'] == "delete")
{
		$query = 'DELETE FROM user WHERE id="'. $_GET['id'] .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				echo '<script type="text/javascript">';
				echo 'alert("删除成功!");';
				echo 'window.location.href="readermanagement.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("删除失败!");';
				echo 'window.location.href="readermanagement.php";';
				echo '</script>';
		}
		die();
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

		<script>
		function deleteuser(id)
		{
				if(confirm("确认删除?"))
				{
						document.location.href="readermanagement.php?type=delete&id=" + id;
				}
				else
				{
						alert("取消删除!");
				}
		}
		</script>

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
      <h1 class="page-header">读者管理</h1>
		</div>

		<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">用户名</th>
						<th class="text-center">姓名</th>
						<th class="text-center">电话</th>
						<th class="text-center">Email</th>
						<th class="text-center">注册时间</th>
						<th class="text-center">历史借阅</th>
						<th class="text-center">用户类型</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
<?php
$query = 'SELECT * FROM user';
$query .= ' ORDER BY registertime DESC';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
	echo '<tr><td>';
	echo $row['id'];
	echo '</td><td>';
	echo $row['name'];
	echo '</td><td>';
	echo $row['phone'];
	echo '</td><td>';
	echo $row['email'];
	echo '</td><td>';
	echo $row['registertime'];
	echo '</td><td>';
	echo $row['borrowednumber'];
	echo '</td><td>';
	switch($row['type'])
	{
	case 'bachelor':echo '本科生';break;
	case 'master':echo '研究生';break;
	case 'doctor':echo '博士生';break;
	case 'teacher':echo '教师';break;
	case 'admin':echo '管理员';break;
	default:echo 'error!';
	}
	echo '</td><td>';
	echo '<button class="btn btn-danger btn-xs" onclick="deleteuser(\''.$row['id'].'\')">删除</button>';			//	\为转义字符 转义单引号
	echo '</td></tr>';
}
mysql_free_result($result);
?>
		  </tbody>
		</table>
	  </div>	<!--/div for table-responsive-->


      <!-- Site footer -->
      <div class="footer">
        <p>&copy; YangXiangRui YuHao LiangXiao 2015</p>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
