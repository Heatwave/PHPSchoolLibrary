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
			<h1 class="page-header">图书检索结果</h1>
		</div>

		<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">ISBN</th>
						<th class="text-center">书名</th>
						<th class="text-center">作者</th>
						<th class="text-center">出版社</th>
						<th class="text-center">索书号</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
<?php
if(isset($_POST['searchword']) && $_POST['searchword'] != '')
{
		$searchitem = $_POST['searchitem'];
		$searchword = $_POST['searchword'];

		$query = 'SELECT * FROM books WHERE '.$searchitem.' LIKE "%'.$searchword.'%";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		while($row = mysql_fetch_assoc($result))
		{
				$item = '<tr><td>'.$row['isbn'].'</td>';
				$item .= '<td>'.$row['name'].'</td>';
				$item .= '<td>'.$row['author'].'</td>';
				$item .= '<td>'.$row['press'].'</td>';
				$item .= '<td>'.$row['callnumber'].'</td>';
				$item .= '<td><a class="btn btn-primary btn-xs" href="item.php?isbn='.$row['isbn'].'">查看详细</a></td>';
				$item .= '</tr>';
				echo $item;
		}

mysql_free_result($result);
}
?>
				</tbody>
		  </table>
	  </div>	<!--/div for table-responsive-->

		<div class="row">
		  <a class="btn btn-primary btn-lg" href="search.php">返回检索</a>
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
