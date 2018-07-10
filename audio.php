<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div style="margin-bottom:10px;">
<div id="content-infoname"><span style="font-weight:bold;color:#000000;">Аудио</span><div style="float:right;"><span style="font-style:italic;">слушать онлайн</span></div></div>
<embed type="application/x-shockwave-flash" src="http://l-lacker.ru/blackhole/player.swf" width="614" height="900" pluginspage="http://www.adobe.com/go/getflashplayer" />
<noembed>Alternative content</noembed>
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

