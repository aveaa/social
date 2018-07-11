<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div style="margin-bottom:10px;">
<div id="content-infoname"><span style="font-weight:bold;color:#000000;">МегаТест</span><div style="float:right;"><span style="font-style:italic;">приложение</span></div></div>
<iframe src="http://l-lacker.ru/llsoc-apps/megatest" width="614" height="800" frameborder="0" scrolling="false"></iframe>  
<?php
// <iframe src="" width="614" height="900" frameborder="0" scrolling="false"></iframe>  
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

