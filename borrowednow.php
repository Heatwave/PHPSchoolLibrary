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

		$query = 'SELECT * FROM usertype WHERE type="'. $usertype .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		$row = mysql_fetch_assoc($result);
		$daysofborrowed = $row['daysofborrowed'];
		mysql_free_result($result);
}

if(isset($_GET['action']) && $_GET['action'] == 'return')
{
		$query = 'UPDATE borrowedbook SET returndate=NOW() WHERE booksid="'.$_GET['booksid'].'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				$query2 = 'UPDATE user SET borrowednumber=borrowednumber+1 WHERE id="'.$id.'";';
				$result2 = mysql_query($query2,$db) or die (mysql_error($db));
				echo '<script type="text/javascript">';
				echo 'alert("还书成功!");';
				echo 'window.location.href="borrowednow.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("还书失败!");';
				echo 'window.location.href="borrowednow.php";';
				echo '</script>';
		}
		mysql_free_result($result);
		mysql_free_result($result2);
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

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>


		<div class="row">
			<h1 class="page-header">当前借阅</h1>
		</div>

		<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">图书编号</th>
						<th class="text-center">ISBN</th>
						<th class="text-center">书名</th>
						<th class="text-center">责任者</th>
						<th class="text-center">借书日期</th>
						<th class="text-center">应还日期</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>
<?php
$query = 'SELECT borrowedbook.booksid,borrowedbook.isbn,books.name,books.author,borrowedbook.borroweddate,DATE_ADD(borrowedbook.borroweddate,INTERVAL '.$daysofborrowed.' DAY) AS shouldreturn FROM borrowedbook,books WHERE books.isbn=borrowedbook.isbn AND borrowedbook.userid="'.$id.'" AND borrowedbook.returndate IS NULL;';
$result = mysql_query($query,$db) or die (mysql_error($db));
while($row = mysql_fetch_assoc($result))
{
		$item = '<tr><td>'.$row['booksid'].'</td>';
		$item .= '<td>'.$row['isbn'].'</td>';
		$item .= '<td>'.$row['name'].'</td>';
		$item .= '<td>'.$row['author'].'</td>';
		$item .= '<td>'.$row['borroweddate'].'</td>';
		$item .= '<td>'.$row['shouldreturn'].'</td>';
		$item .= '<td><a class="btn btn-success btn-xs" href="borrowednow.php?action=return&booksid='.$row['booksid'].'")">还书</a></td>';
		$item .= '</tr>';
		echo $item;
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
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
