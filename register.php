<?php
		$id = (isset($_POST['id'])) ? trim($_POST['id']) : '';
		$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
		$cpassword = (isset($_POST['cpassword'])) ? trim($_POST['cpassword']) : '';
		$name = (isset($_POST['name'])) ? trim($_POST['name']) : '';
		$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
		$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
		$type = (isset($_POST['type'])) ? trim($_POST['type']) : '';

		$pattern ="/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";

if($_POST['id'] != '')
{
		if (empty($id) || empty($password) || empty($cpassword) || empty($name) ||
				empty($phone) || empty($email) || empty($type))
		{
				echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>数据输入不完整，请重新输入!</strong></p>
						</div>';
		}
		else if(!preg_match($pattern,$email))
		{
				echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>Email格式不合法，请重新输入!</strong></p>
						</div>';
		}
		else
		{
				include 'ConnectDatabase.inc.php';
				$query = 'SELECT * FROM user WHERE id = "'. $id .'";';
				$result = mysql_query($query,$db) or die (mysql_error($db));
				if ($result && mysql_num_rows($result) > 0)
				{
						echo '<div class="alert alert-danger" role="alert">
						<p class="text-center"><strong>'. $id .' 该用户名已被注册，请换一个试试!</strong></p>
						</div>';
				}
				else
				{
						$query = 'INSERT INTO user VALUES("'. $id .'",PASSWORD("'. $password .'"),"'. $name .'","'. $phone .'","'. $email .'",NOW(),0,"'. $type .'");';
						$result = mysql_query($query,$db) or die (mysql_error($db));
						if(!$result)
						{
								echo '<div class="alert alert-danger" role="alert">
								<p class="text-center"><strong>注册失败!</strong></p>
								</div>';
						}
						echo '<div class="alert alert-success" role="alert">
						<p class="text-center"><strong>注册成功!即将跳转到登陆页面！</strong></p>
						</div>';
						mysql_close($db);
						header('Location:login.php');
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

    <script src="js/checkregister.js"></script>

  </head>

  <body>

		<div class="container">

<?php
include "navbar.php";	//导航条
?>

		<div class="row">
      <h1 class="page-header">用户注册</h1>
		</div>

		<form class="form-horizontal" role="form" name="send" action="register.php" method="POST" onsubmit="return Check();">
		  <fieldset>
				<div class="form-group">
					<div class="col-md-4">
				    <label for="id" class="col-md-4 control-label">用户名</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="id" id="id" maxlength="30" placeholder="请输入用户名" autofocus>
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="password" class="col-md-4 control-label">密码</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" id="password" maxlength="43" placeholder="请输入密码">
						</div>
					</div> <!--/div for col-md-4  -->
					<div class="col-md-4">
				    <label for="cpassword" class="col-md-4 control-label">确认密码</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="cpassword" id="cpassword" maxlength="43" placeholder="请再次输入密码">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="name" class="col-md-4 control-label">姓名</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="name" id="name" maxlength="20" placeholder="请输入姓名">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="phone" class="col-md-4 control-label">电话</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="phone" id="phone" maxlength="20" placeholder="请输入电话">
						</div>
					</div> <!--/div for col-md-4  -->
					<div class="col-md-4">
				    <label for="email" class="col-md-4 control-label">Email</label>
						<div class="col-md-8">
							<input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="请输入Email">
						</div>
					</div> <!--/div for col-md-4  -->
				</div>	<!--/div for form-group -->
				<div class="form-group">
					<div class="col-md-4">
				    <label for="type" class="col-md-4 control-label">读者类型</label>
						<div class="col-md-8">
							<select class="form-control" name="type" id="type">
								<option value="bachelor">本科生</option>
								<option value="master">研究生</option>
								<option value="doctor">博士生</option>
								<option value="teacher">教师</option>
							</select>
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
