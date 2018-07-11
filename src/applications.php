<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div style="margin-bottom:10px;">
<div id="content-infoname"><span style="font-weight:bold;color:#000000;">Каталог приложений</span><div style="float:right;"><span style="font-style:italic;">самые полезные (нет) приложения</span></div></div>
<div id="faqcontent">Добро пожаловать в Каталог Приложений! Здесь вы можете найти различные самописные приложения, интересные и нет, на Flash и HTML5.</div>
<?php
echo '<img src="http://l-lsoc.cf/apps/catalog.png"><br><hr><br>';
echo '<a href="megatest.php"><img src="http://l-lsoc.cf/apps/megatest.png"/></a><br><br>';
echo '<a href="audio.php"><img src="http://l-lsoc.cf/apps/music.png"/></a><br>';
?>
<br>
</div>
<div>
<?php
include 'exec/footer.php';
?>
</div>
</body>
</html>

