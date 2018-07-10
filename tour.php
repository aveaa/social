<?php
session_start();
include 'exec/dbconnect.php';
include( 'exec/check_user.php' );
include 'exec/datefn.php';
include 'exec/header.php';
include 'exec/leftmenu.php';
?>
   <?php
$q  = "SELECT COUNT(1) FROM users"; // выбираем нашего 
$q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
$q1->execute();
$countusers = $q1->fetch();
$countusers = $countusers[ 0 ];
if ( $countusers == '1' )
  {
    $userscouunt = (string) $countusers . " пользователь";
  } //$countusers == '1'
elseif ( $countusers == '2' OR $countusers == '3' OR $countusers == '4' )
  {
    $userscouunt = (string) $countusers . " пользователя";
  } //$countusers == '2' OR $countusers == '3' OR $countusers == '4'
else
  {
    $userscouunt = (string) $countusers . " пользователей";
  }
// конец подсчитывания пользователей
// грузим страницу дальше
?>
<div id="content-infoname"><b>Тур по сайту</b></div>
<div style="min-width:0;width:415px;min-height:300px;float:left;margin-top:-10px;border-right:#BEBEBE solid 1px;">
<br>
<?php
if ( $_GET[ 'a' ] == 0 )
  {
?>
Выберите раздел тура для его просмотра.
<?php
  } //$_GET[ 'a' ] == 0
else if ( $_GET[ 'a' ] == 1 )
  {
?>
Кажется, вы решили зарегистрироваться в нашей соцсети, которая насчитывает уже <b><?php
    echo $userscouunt;
?></b>, и это значение постоянно увеличивается, т.к. популярность с каждым днём растет! <br><br>
<b>l-lacker Social</b> - социальная сеть на основе OpenVK, но по лицензии GPL мы должны выложить исходный код <i>(выложим после перехода на OVKR)</i> и полуадаптивным дизайном для старых браузеров. Надо знать, что l-lacker Social и OpenVK не являются точной копией старого ВКонтакте, скорее всего это просто фан-переделка.<br><br>
<a href="https://i.imgur.com/Ni7R7Ep.png"><img src="https://i.imgur.com/Ni7R7Epm.jpg"></a><br><br>
После входа в аккаунт вы сразу попадаете в свою анкету, вы можете заполнить информацию о себе в настройках. <br>Остальные функции находятся в шапке и меню сайта.<br><br>Если вы видите галочку около имени в анкете, значит администрация подтвердила профиль пользователя. <br><br><i><b>Интересный факт: </b>До id 10 всем выдавалась тестерская галочка, до id 29 тестерка выдавалась по просьбе, начиная с id 30 только по донату.</i><br><br><center><a id="button" href="tour.php?a=2">Далее →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 1
else if ( $_GET[ 'a' ] == 2 )
  {
?>
<b>Группы</b> - чуть ли не самая главная функция соцсети. Здесь вы можете поделиться своими новостями, показать всем фото с недавней поездки, создать клуб по интересам.. <br><br>
<a href="https://i.imgur.com/FXqZm1q.png"><img src="https://i.imgur.com/FXqZm1qm.jpg"></a><br><br>
Администрация модерирует контент, который вы отправляете в группу. В случае нарушений или многочисленных жалоб мы вправе заблокировать или удалить группу без предупреждения.
<br><br><i><b>Интересный факт: </b>Табличка "Согласно нашей нейросети, в группе может быть порнография" является шуточной, и никакой порнографии в ней нет. Если вам её выдали - не спешите публиковать прон, <s>сначала нам покажите</s> мы вас можем заблокировать по правилу 2.1.</i>
<br><br><center><a id="button" href="tour.php?a=3">Далее →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 2
else if ( $_GET[ 'a' ] == 3 )
  {
?>
<h4>Создавайте фотоальбомы</h4>
<ul>
    <li>На Вашей странице находятся ссылки на Ваши фотоальбомы.</li>
    <li>Вы определяете, кому доступен тот или иной Ваш альбом.</li>
    <li>Вы можете отмечать на фотографиях лица друзей.</li>
    <li>И конечно, Ваши друзья могут комментировать Ваши фотографии.</li>
</ul>
<br>
<a href="https://i.imgur.com/pI14d4v.png"><img src="https://i.imgur.com/pI14d4vm.jpg"></a><br><br>
<center>Вы сможете загрузить столько фотографий, сколько захотите. Ограничения устанавливаете только Вы.</center>
<br><br><center><a id="button" href="tour.php?a=4">Далее →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 3
else if ( $_GET[ 'a' ] == 4 )
  {
?>
<h4>Слушайте музыку</h4>
Перейдя на страницу <b>"Мои аудиозаписи"</b>, вы сможете прослушать музыку, подобранную нашими администраторами специально для Вас.
<br><br>
<a href="https://i.imgur.com/RPBtjux.png"><img src="https://i.imgur.com/RPBtjuxm.jpg"></a><br><br>
После загрузки аудиозаписей, вы сможете прослушать музыку без каких-либо прогрузок и стриминга аудио. Увы, для такого удобства приходится грузить <b>109 мегабайт данных каждый раз</b>. В кэш, несмотря на наши ожидания, ничего не сохраняется.
<br><br><center><a id="button" href="tour.php?a=5">Следующиий раздел →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 4
else if ( $_GET[ 'a' ] == 5 )
  {
?>
<h4>Реклама в профиле</h4>
В настройках вы можете включить рекламу для своего профиля. Она включается просто и всего через одну галочку. Она отображается у всех пользователей, зашедших на вашу страницу.
<br><a href="https://i.imgur.com/kHRpkwM.png"><img src="https://i.imgur.com/kHRpkwMm.jpg"></a><br><br>
Выглядит она примерно таким образом.
<br><a href="https://i.imgur.com/YJpRmKT.png"><img src="https://i.imgur.com/YJpRmKTm.jpg"></a><br><br>
Реклама <b>не является настоящей</b>, её не должны блокировать блокировщики рекламы.
<br><br><center><a id="button" href="tour.php?a=6">Далее →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 5
else if ( $_GET[ 'a' ] == 6 )
  {
?>
<h4>Изменение цвета</h4>
Специально <b>для тестеров и администраторов</b> предусмотрена смена цвета текста: в записях на страницах и в группах, а также в комментариях.
<br><br>Введя запись со специальными символами, например:
<br><i>&GreenВсем&Close&Brown привет!&Close </i>
<br>А затем опубликовав запись увидим, что текст цветной.
<br><br><a href="https://i.imgur.com/nBfpyIR.png"><img src="https://i.imgur.com/nBfpyIRm.jpg"></a><br><br>
Все возможные цвета вы увидите <b>в блоке "Смена цвета"</b> (отображается в меню). Если он у вас не отображается, значит вы не сможете писать такие записи.
<br><br><center><a id="button" href="tour.php?a=7">Следующиий раздел →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 6
else if ( $_GET[ 'a' ] == 7 )
  {
?>
<h4>Как получить галочку</h4>
<b>1. </b>Не ведитесь на сайты, группы ВКонтакте и прочее, где написано "Бесплатная галочка" или что-то в этом роде. Там вам никто галочки не даст. Только в <a href="https://vk.me/hackerapps">официальной группе ВКонтакте</a> вам могут выдать галочку для группы или профиля.
<br><br><b>2. </b>У всех пользователей до id 30 <i>(кроме недоверенных лиц)</i> есть галочка. Например, тестерская или обычная.
<br><br><b>3. </b>За донат от суммы минимум 30 рублей <i>(ранее 20)</i> вы получаете в подарок элитную оранжевую галочку (её нет даже у админов!). На вашу страницу обязательно, а в ваши группы только в том случае, если они наполняются контентом.
<br><br><b>4. </b>Если вы хорошо знакомы с администрацией сайта, вам легко получить галочку, т.к. вам могут выдасть вместе с ней еще и права тестера. Просто попросите у главного админа выдасть галку, и всё!
<br><br><center><a id="button" href="tour.php?a=8">Далее →</a></center><br>
<?php
  } //$_GET[ 'a' ] == 7
else if ( $_GET[ 'a' ] == 8 )
  {
?>
<h4>Как легко попасть в блог</h4>
Вы должны чем-то прославиться в пределах данной соцсети. Напомним, у нас сидит всего <?php
    echo $userscouunt;
?>, так что чем-то немного прославиться у нас - дело быстрое.
<br><br>Что можно сделать? Например, если вы будете проявлять много активности в <a href="http://l-lsoc.cf/club132">тестпуле</a> (если вы, конечно же, тестер), то вас обязательно упомянут в какой-либо записи из блога. Ищите баги - мелкие и большие, уязвимости, да что угодно! Серьезнее баг - на вас обратят больше внимания, а админы всё пофиксят, сделая соцсеть ещё лучше и безопаснее.
<br><br>Или же если мы обратим внимание на вас в <a href="https://vk.com/llackersocial">группе ВКонтакте</a>, что вы следите за каждой записью, комментируете, лайкаете (притом не сразу все записи прокомментировать и лайкнуть "на отвали", а следить за каждым обновлением, чтобы мы действительно видели ваш интерес).
<br><br>Я хочу сказать то, что у нас это не так сложно, как вы могли подумать.
<?php
  } //$_GET[ 'a' ] == 8
?>
</div>
<div style="float:right;width:200px;margin-top:-8px;">
<div style="margin:10px;">
<h4>Основы сайта</h4>
<a id="aprofile" href="tour.php?a=1">Ваша страница</a>
<a id="aprofile" href="tour.php?a=2">Группы</a>
<a id="aprofile" href="tour.php?a=3">Фотографии</a>
<a id="aprofile" href="tour.php?a=4">Музыка</a>
<br><h4>Элементы</h4>
<a id="aprofile" href="tour.php?a=5">Реклама в профиле</a>
<a id="aprofile" href="tour.php?a=6">Изменение цвета</a>
<br><h4>Секретные материалы</h4>
<a id="aprofile" href="tour.php?a=7">Получение галочки</a>
<a id="aprofile" href="tour.php?a=8">Как попасть в блог</a>
<hr style="margin-left:-14px;margin-right:-20px;margin-top:10px;margin-bottom:10px;">
</div>
</div>
</div>
<div>
<?php
include 'exec/footer.php';
?>
</div>