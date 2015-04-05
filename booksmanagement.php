<?php
session_start();

include 'ConnectDatabase.inc.php';

if(isset($_GET['type']) && $_GET['type'] == "destroy")
{
		$query = 'DELETE FROM books WHERE isbn="'. $_GET['isbn'] .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		$query2 = 'DELETE FROM addbooks WHERE isbn="'. $_GET['isbn'] .'";';
		$result2 = mysql_query($query,$db) or die (mysql_error($db));
		if($result && $result2)
		{
				echo '<script type="text/javascript">';
				echo 'alert("销毁成功!");';
				echo 'window.location.href="booksmanagement.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("销毁失败!");';
				echo 'window.location.href="booksmanagement.php";';
				echo '</script>';
		}
		die();
}

if(isset($_GET['type']) && $_GET['type'] == "delete")
{
		$query = 'DELETE FROM addbooks WHERE id="'. $_GET['id'] .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				echo '<script type="text/javascript">';
				echo 'alert("销毁成功!");';
				echo 'window.location.href="booksmanagement.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("销毁失败!");';
				echo 'window.location.href="booksmanagement.php";';
				echo '</script>';
		}
		die();
}

if(isset($_GET['type']) && $_GET['type'] == "add")
{
		$query = 'INSERT INTO addbooks(isbn) VALUES("'. $_GET['isbn'] .'");';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				echo '<script type="text/javascript">';
				echo 'alert("征订成功!");';
				echo 'window.location.href="booksmanagement.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("征订失败!");';
				echo 'window.location.href="booksmanagement.php";';
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
		function addbooks(isbn)
		{
				if(confirm("确认征订?"))
				{
						document.location.href="booksmanagement.php?type=add&isbn=" + isbn;
				}
		}
		function destroybooks(isbn)
		{
				if(confirm("确认销毁?"))
				{
						document.location.href="booksmanagement.php?type=destroy&isbn=" + isbn;
				}
				else
				{
						alert("取消!");
				}
		}
		function deletebooks(id)
		{
				if(confirm("确认销毁?"))
				{
						document.location.href="booksmanagement.php?type=delete&id=" + id;
				}
				else
				{
						alert("取消!");
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
			<h1 class="page-header">图书管理</h1>
		</div>

		<div class="row">
			<div class="col-md-4"><a href="createbooks.php" class="btn btn-primary btn-lg" role="button">创建图书</a></div>
		</div>

		<div class="row">
			<h3 class="page-header">已创建图书</h3>
		</div>

		<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">ISBN</th>
						<th class="text-center">书名</th>
						<th class="text-center">作者</th>
						<th class="text-center">出版社</th>
						<th class="text-center">出版日期</th>
						<th class="text-center">价格</th>
						<th class="text-center">索书号</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
<?php
$query = 'SELECT * FROM books;';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
		$item = '<tr><td>'. $row['isbn'] .'</td>';
		$item .= '<td>'. $row['name'] .'</td>';
		$item .= '<td>'. $row['author'] .'</td>';
		$item .= '<td>'. $row['press'] .'</td>';
		$item .= '<td>'. $row['publicationdate'] .'</td>';
		$item .= '<td>'. $row['price'] .'</td>';
		$item .= '<td>'. $row['callnumber'] .'</td>';
		$item .= '<td><button class="btn btn-success btn-xs" onclick="addbooks(\''.$row['isbn'].'\')">征订</button>';
		$item .= '<button class="btn btn-danger btn-xs" onclick="destroybooks(\''.$row['isbn'].'\')">销毁</button></td>';
		$item .= '</tr>';
		echo $item;
}
mysql_free_result($result);
?>
				</tbody>
		  </table>
	  </div>	<!--/div for table-responsive-->

		<div class="row">
			<h3 class="page-header">征订订单</h3>
		</div>

		<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">序号</th>
						<th class="text-center">ISBN</th>
						<th class="text-center">书名</th>
						<th class="text-center">入库时间</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
<?php
$query = 'SELECT addbooks.id,addbooks.isbn,books.name,addbooks.addtime FROM books,addbooks WHERE books.isbn=addbooks.isbn;';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
		$item2 = '<tr><td>'.$row['id'].'</td>';
		$item2 .= '<td>'.$row['isbn'].'</td>';
		$item2 .= '<td>'.$row['name'].'</td>';
		$item2 .= '<td>'.$row['addtime'].'</td>';
		$item2 .= '<td><button class="btn btn-danger btn-xs" onclick="deletebooks(\''.$row['id'].'\')">销毁</button></td>';
		$item2 .= '</tr>';
		echo $item2;
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
