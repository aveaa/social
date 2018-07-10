<?php
session_start();
include 'exec/dbconnect.php';
include 'exec/check_user.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
<div style="margin-bottom:10px;">
<div id="content-infoname"><span style="font-weight:bold;color:#000000;">Тестовый аккаунт</span><div style="float:right;"><span style="font-style:italic;">официальный аккаунт</span></div></div>
<h4>Об этой странице</h4><br>
<div id="faqhead">Что это?</div>
<div id="faqcontent">Это - тестовый аккаунт. Профиль не предназначен для просмотра.</div>
<div id="faqhead">Для чего он нужен?</div>
<div id="faqcontent">Для тестирования новых функций.</div>
<div id="faqhead">Что за новые функции? Когда они выйдут?</div>
<div id="faqcontent">Точных дат нет, но знайте - мы часто выпускаем обновления, так что скоро всё будет ;)</div>
<br>
</div>
<div>
<?php
include 'exec/footer.php';
?>
</div>
</body>
</html>

