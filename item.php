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

if(isset($_GET['action']) && $_GET['action'] == 'borrow')
{
		$query = 'INSERT INTO borrowedbook(isbn,booksid,userid,borroweddate) VALUES("'.$_GET['isbn'].'","'.$_GET['booksid'].'","'.$_GET['userid'].'",NOW())';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				echo '<script type="text/javascript">';
				echo 'alert("借书成功!");';
				echo 'window.location.href="item.php?isbn='.$_GET['isbn'].'";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("借书失败!");';
				echo 'window.location.href="item.php?isbn'.$_GET['isbn'].'";';
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

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>



		<div class="row">
			<h1 class="page-header">书籍信息</h1>
		</div>

		<div class="row">
<?php
if(isset($_GET['isbn']) && $_GET['isbn'] !='')
{
		$query = 'SELECT * FROM books WHERE isbn="'.$_GET['isbn'].'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		$row = mysql_fetch_assoc($result);
		$showinfo = '<h4>书名:'.$row['name'].'</h4>';
		$showinfo .= '<h4>作者:'.$row['author'].'</h4>';
		$showinfo .= '<h4>出版社:'.$row['press'].'</h4>';
		$showinfo .= '<h4>出版日期:'.$row['publicationdate'].' 年</h4>';
		$showinfo .= '<h4>ISBN:'.$row['isbn'].'</h4>';
		$showinfo .= '<h4>价格:'.$row['price'].'</h4>';
		$showinfo .= '<h4>页数:'.$row['pages'].'</h4>';
		$showinfo .= '<h4>索书号:'.$row['callnumber'].'</h4>';
		$showinfo .= '<h4>简介:'.$row['introduction'].'</h4>';
		echo $showinfo;

		mysql_free_result($result);

		echo  '<h2>馆藏信息</h2>';
		$tableinfo1 = '<div class="table-responsive">
		  <table name="table" id="table" style="word-break:break-word" class="text-center table table-striped table-bordered table-condensed">
		    <thead>
				  <tr class="info">
						<th class="text-center">书籍编号</th>
						<th class="text-center">索书号</th>
						<th class="text-center">入库时间</th>
						<th class="text-center">书籍状态</th>
						<th class="text-center">操作</th>
					</tr>
				</thead>
				<tbody>';
		echo $tableinfo1;
		$query = 'SELECT addbooks.id,books.callnumber,addbooks.addtime,books.isbn FROM books,addbooks WHERE books.isbn=addbooks.isbn AND addbooks.isbn="'.$_GET['isbn'].'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		while($row = mysql_fetch_assoc($result))
		{
				$query2 = 'SELECT * FROM addbooks,borrowedbook WHERE addbooks.id=borrowedbook.booksid AND borrowedbook.booksid='.$row['id'].' AND returndate IS NULL;';
				$result2 = mysql_query($query2,$db) or die (mysql_error($db));
				$row2 = mysql_fetch_assoc($result2);

				$tableinfo2 ='<tr><td>'.$row['id'].'</td>';
				$tableinfo2 .='<td>'.$row['callnumber'].'</td>';
				$tableinfo2 .='<td>'.$row['addtime'].'</td>';
				if(mysql_num_rows($result2)>0)
				{
						$tableinfo2 .='<td>借出</td>';
				}
				else
				{
						$tableinfo2 .='<td>可借</td>';
				}
				if($id != '' && mysql_num_rows($result2)<=0)
				{
						$tableinfo2 .='<td><a class="btn btn-xs btn-success" href="item.php?isbn='.$row['isbn'].'&action=borrow&booksid='.$row['id'].'&userid='.$id.'">借阅</a></td>';
				}
				else
				{
						$tableinfo2 .='<td></td>';
				}
				$tableinfo2 .='</tr>';
				echo $tableinfo2;

				mysql_free_result($result2);
		}
		$tableinfo3 = '</tbody>
		  </table>
	  </div>	<!--/div for table-responsive-->';
		echo $tableinfo3;
		mysql_free_result($result);
}
?>
		</div><!-- /row -->

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
