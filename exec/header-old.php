<?php
date_default_timezone_set('Europe/Moscow');
if($_SESSION['loginin'] == "1"){
$unixshit = time();
$qo = "UPDATE `users` SET `lastonline` = '".$unixshit."' WHERE `users`.`id` = ".$_SESSION['id']; // выбираем нашего 
$qonline = $dbh1->prepare($qo); // отправляем запрос серверу
$qonline -> execute(); 
$qonline->fetch();
}
?>
<html>
 <head>
  <title>l-lacker Social</title>
  <meta charset="utf-8">
  
  <link rel="stylesheet" type="text/css" href="style.css?012">
  <style>#head-wrapper{background:url(img/header-beta.png);}</style>
    <?php
  $qs = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'"; // выбираем нашего 
$qstyle = $dbh1->prepare($qs); // отправляем запрос серверу
$qstyle -> execute(); 
$qst = $qstyle->fetch();
if ($qst['cssstyle'] == '2') {
   echo '<link rel="stylesheet" type="text/css" href="/vkstyle.css">';
 } ?>
  
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48989789 = new Ya.Metrika2({
                    id:48989789,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48989789" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  
  <link rel="shortcut icon" href="img/favicon.png">
  <link id="jquery_ui_theme_loader" type="text/css" href="/js/jquery/themes/black-tie/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" href="/js/jquery/window/css/jquery.window.css" rel="stylesheet" />
	
	
	<script type="text/javascript" src="https://vk.com/js/api/openapi.js?156"></script>

<script type="text/javascript">
  VK.init({apiId: 6616937, onlyWidgets: true});
</script>

 </head>
 <body>
 <noscript><div class="infonew">Мы заметили у Вас древнейший браузер.<br><br>Некоторые функции сайта не будут работать (из-за использования JavaScript).<br><br>Рекомендуем Вам обновить свой браузер на <a href="http://google.com/chrome">Google Chrome</a> или на <a href="http://browser.yandex.ru">Яндекс.Браузер</a>, но в то же время поддерживаются старые версии Opera, Firefox, Chrome</div></noscript>
 <?
 
$qh2 = "SELECT * FROM users WHERE id='".$id."'";
 $h2 = $dbh1->prepare($qh2);
$h2 -> execute();
$g2r = $h2->fetch();
if($_SESSION['loginin'] == "1"){
$q = "SELECT * FROM info_site"; // выбираем нашего 
 $q1 = $dbh1->prepare($q); // отправляем запрос серверу
 $q1 -> execute(); 
 $inf = $q1->fetch(); // ответ в переменную

if($inf['infoonn'] == '1'){
echo '<div class="infonew">
'.$inf["infotext"].'
</div>';
}
} ?>
 <? if($inf['off_site'] == '1'){
  echo '<center> Сайт выключен по тех.причинам. </center>';
  echo '<center>Подробности в группе <a href="https://vk.com/openvk.onion"> ВК </a>.</center>';
exit();
} ?>
 <div id="head">
  <div id="head-wrapper">
    
   <div style="margin-left: 50px;"></div>
   <div id="head-buttons"><div id="home">
      <a href="index.php">OpenVK</a>
    </div>
   <?php 
  if ($_SESSION['loginin'] == '1') {
  ?>
  <div id="head-button" style="width: 8em"><form action="blank.php" method="get">
  	<input type="text" name="search" style="border: #6688A3 solid 1px;font-size: 11px;padding: 2px 2px 2px 17px;background: url(img/searchicon.png) no-repeat 3px 4px; background-color: #fff;" placeholder="Недоступно" size="13">
  </form></div>
  <div id="head-button" style="width: 3.5em"><a href="logout.php">выйти</a></div><div id="head-button" style="width: 4.0em"><a href="help.php">помощь</a></div><div id="head-button" style="width: 3.5em"><a href="donate.php">донат</a></div><div id="head-button" style="width: 5.5em"><a href="tour.php?a=1">тур по сайту</a></div>
     <div id="head-button" style="width: 3.5em"><a href="usercatalog.php">люди</a></div><div id="head-button" style="width: 4em"><a href="groupcatalog.php">группы</a></div><div id="head-button" style="width: 3.3em"><a href="audio.php">плеер</a></div><?php }elseif ($_SESSION['loginin'] != '1') {
      echo '
       <div id="head-button" style="width: 3.5em"><a href="help.php">помощь</a></div><div id="head-button" style="width: 6em"><a href="register.php">регистрация</a></div><div id="head-button" style="width: 3.5em"><a href="index.php">войти</a></div>
      ';
     } ?></div>	
   </div>
  </div>
 </div>