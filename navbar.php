<div class="masthead">
		<h3 class="text-muted"><span class="glyphicon glyphicon-book"></span>图书馆书目检索系统</h3>
		<ul class="nav nav-justified">
			<li id="liofindex"><a href="index.php">主页</a></li>
			<li id="liofsearch"><a href="search.php">图书检索</a></li>
			<!--<li><a href="topborrowed.php">热门借阅</a></li>-->
<?php
if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin')
{
			echo '<li id="liofbooksmanagement"><a href="booksmanagement.php">图书管理</a></li>';
			echo '<li id="liofbulletinmanagement"><a href="bulletinmanagement.php">公告管理</a></li>';
			echo '<li id="liofreadermanagement"><a href="readermanagement.php">读者管理</a></li>';
}
if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != 'admin')
{
			echo '<li id="liofborrowednow"><a href="borrowednow.php">当前借阅</a></li>';
			echo '<li id="liofborrowedhistory"><a href="borrowedhistory.php">历史借阅</a></li>';
}
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
{
			echo '<li id="liofregister"><a href="register.php">注册</a></li>';
			echo '<li id="lioflogin"><a href="login.php">登陆</a></li>';
}
else
{
		echo '<li id="liofuserinfo"><a href="userinfo.php">个人资料</a></li>';
		echo '<li id="liofexit"><a href="exit.php">退出</a></li>';
}
?>
		</ul>
</div>
