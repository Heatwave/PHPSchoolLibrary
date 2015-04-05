<?php
session_start();

include 'ConnectDatabase.inc.php';

$id = (isset($_SESSION['id'])) ? trim($_SESSION['id']) : '';

if(isset($_POST['submit']) && $_POST['submit'] == '修改')
{
		$query = 'UPDATE user SET name = "'. mysql_real_escape_string($_POST['name'],$db) .'",phone = "'. mysql_real_escape_string($_POST['phone'],$db) .'",email = "'. mysql_real_escape_string($_POST['email'],$db) .'" WHERE id="'. mysql_real_escape_string($id,$db) .'";';
		$result = mysql_query($query,$db) or die (mysql_error($db));
		if($result)
		{
				echo '<script type="text/javascript">';
				echo 'alert("修改成功!");';
				echo 'window.location.href="userinfo.php";';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'alert("修改失败，请重试!");';
				echo 'window.location.href="userinfo.php";';
				echo '</script>';
		}
		die();
}


$query = 'SELECT * FROM user WHERE id="'. mysql_real_escape_string($id,$db) .'"';
$result = mysql_query($query,$db) or die (mysql_error($db));
$row = mysql_fetch_assoc($result);
if($row > 0)
{
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
}
else
{
		echo 'mysql no data!</br>';
}
mysql_free_result($result);
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

    <script src="js/checkmodify.js"></script>

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
      <h1 class="page-header">个人资料</h1>
		</div>


		<form class="form-horizontal" role="form" name="send" action="userinfo.php" method="POST" onsubmit="return Check();">
		  <fieldset>
				<div class="form-group">
					<div class="col-md-4">
				    <label for="id" class="col-md-4 control-label">用户名</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="id" id="id" readonly="readonly" maxlength="30" value="<?php echo $id;?>" placeholder="请输入用户名" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="name" class="col-md-4 control-label">姓名</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="name" id="name" maxlength="20" value="<?php echo $name;?>" placeholder="请输入姓名" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="phone" class="col-md-4 control-label">电话</label>
						<div class="col-md-8">
						<input type="text" class="form-control" name="phone" id="phone" maxlength="20" value="<?php echo $phone;?>" placeholder="请输入电话" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="email" class="col-md-4 control-label">Email</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="email" id="email" maxlength="50" value="<?php echo $email;?>" placeholder="请输入Email" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
				  <div class="col-sm-10 col-sm-offset-1">
						<button type="submit" name="submit" value="修改" class="btn btn-default">修改</button>
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
