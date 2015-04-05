<?php
include 'auth.inc.php';

session_destroy();
setcookie(session_name(),'',time()-3600);
$_SESSION=array();

$url = "index.php";
?>

<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Library">
  <meta name="author" content="Yxr">
  <link rel="icon" href="images/IndexImage.ico">
  <meta http-equiv="refresh" content="1;
	url=<?php echo $url; ?>">

  <style type="text/css">
		h1 {text-align:center}
  </style>

 </head>
 <body>
  <h1>成功退出！</h1>
 </body>
</html>
