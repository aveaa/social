<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if($_SESSION['loginin'] == "1"){
if($_SESSION['groupu'] == "2"){
if($_SESSION['groupu'] == "1"){
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Тестерское меню</b></div>

Тест

<?php
}else{
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div style="margin:0 -10px;padding:55px;"><center><img src="img/critical-error.png"><br><br><b style="font-size:25px;">Access denied</b><br><text style="font-size:14px;">Доступ к данной странице имеют только тестеры и администраторы.</text></center></div>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html>
<?php
}
}else{
header("Location: blank/..");
exit();
}
?>