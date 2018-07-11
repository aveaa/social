<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if ( $_SESSION[ 'loginin' ] == "1" )
  {
    if ( $_SESSION[ 'groupu' ] == "2" )
      {
        include "exec/datefn.php";
        include "exec/header.php";
        include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Админ-панель</b></div>
<?php
        echo '<img src="http://l-lsoc.cf/img/admin-img/razd2.png"><br>';
?>
<p>Сейчас онлайн <?php
        $q  = "SELECT * FROM users"; // выбираем нашего 
        $q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
        $q1->execute();
        while ( $countusers = $q1->fetch() )
          {
            if ( time() - 300 <= $countusers[ 'lastonline' ] )
              {
                $userscouunt++;
              } //time() - 300 <= $countusers[ 'lastonline' ]
          } //$countusers = $q1->fetch()
        if ( $userscouunt == '1' )
          {
            $userscouunt = (string) $userscouunt . " пользователь";
          } //$userscouunt == '1'
        elseif ( $userscouunt == '2' OR $userscouunt == '3' OR $userscouunt == '4' )
          {
            $userscouunt = (string) $userscouunt . " пользователя";
          } //$userscouunt == '2' OR $userscouunt == '3' OR $userscouunt == '4'
        else
          {
            $userscouunt = (string) $userscouunt . " пользователей";
          }
        echo $userscouunt;
?>.</p>
<hr>
<?php
        echo '<img src="http://l-lsoc.cf/img/admin-img/razd1.png"><br>';
?>
<br>
<?php
        echo '<a href="admin_users.php"><img src="http://l-lsoc.cf/img/admin-img/p_users.png"/></a>';
        echo '<a href="admin_groups.php"><img src="http://l-lsoc.cf/img/admin-img/p_groups.png"/></a><br>';
?>
<br><hr>
<?php
        echo '<img src="http://l-lsoc.cf/img/admin-img/razd3.png"><br>';
?>
<br>
В данный момент скрытые настройки недоступны.
<br><hr>
<?php
        echo '<img src="http://l-lsoc.cf/img/admin-img/razd4.png"><br>';
?>
<br>
<a href="admin_users.php">Пользователи</a><br>
<a href="admin_groups.php">Группы</a><br>
<a href="admin_blog.php">Блог</a><br>
<a href="admin_users.php">Пользователи</a><br>
<a href="admin_bugtr.php">Баг-трекер</a><br><br>
</div>
<div><?php
        include "exec/footer.php";
?></div>
</body>
</html>
<?php
      } //$_SESSION[ 'groupu' ] == "2"
    else
      {
        include "exec/header.php";
        include "exec/leftmenu.php";
?>
<div style="margin:0 -10px;padding:55px;"><center><img src="img/critical-error.png"><br><br><b style="font-size:25px;">Access denied</b><br><text style="font-size:14px;">У Вас нет доступа к данной странице.</text></center></div>
</div>
<div><?php
        include "exec/footer.php";
?></div>
</body>
</html>
<?php
      }
  } //$_SESSION[ 'loginin' ] == "1"
else
  {
    header( "Location: blank/.." );
    exit( );
  }
?>