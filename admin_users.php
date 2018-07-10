<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
if ( $_SESSION[ 'loginin' ] == "1" )
  {
    if ( $_SESSION[ 'groupu' ] == "2" )
      {
        if ( $_GET[ 'idu' ] )
          {
            if ( $_POST[ 'edit_general_submit' ] )
              {
                $qu = $dbh1->prepare( "UPDATE `users` SET `name`='" . $_POST[ 'edit_general_fname' ] . "',`surname`='" . $_POST[ 'edit_general_lname' ] . "',`gender`='" . $_POST[ 'edit_general_gender' ] . "',`groupu`='" . $_POST[ 'edit_general_groupu' ] . "',`verify`='" . $_POST[ 'edit_general_verify' ] . "',`ban`='" . $_POST[ 'edit_general_ban' ] . "' WHERE 1" );
                $qu->execute();
                $userdata = $qu->fetch();
                header( 'Location: admin_user.php?idu="' . $_GET[ 'idu' ] . '"' );
                exit( );
              } //$_POST[ 'edit_general_submit' ]
            $qu4 = $dbh1->prepare( "SELECT * FROM users WHERE id = '" . $_GET[ 'idu' ] . "'" );
            $qu4->execute();
            $user = $qu4->fetch();
            include "exec/datefn.php";
            include "exec/header.php";
            include "exec/leftmenu.php";
?>
<div id="content-infoname"><b><?php
            echo $user[ 'name' ] . ' ' . $user[ 'surname' ];
?><div style="float:right;"><a href="admin_users.php">Назад</a></div></b></div>
<form action="admin_users.php" method="post">
<input type="hidden" name="edit_id" <?php
            echo 'value="' . $_GET[ 'idu' ] . '"';
?>>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Имя:</div></td><td><input id="text" style="width:380px;" name="edit_general_fname" <?php
            echo 'value="' . $user[ 'name' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Фамилия:</div></td><td><input id="text" style="width:380px;" name="edit_general_lname" <?php
            echo 'value="' . $user[ 'surname' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Никнейм:</div></td><td><input id="text" style="width:380px;" name="edit_general_nname" <?php
            echo 'value="' . $user[ 'nickname' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Статус:</div></td><td><input id="text" style="width:380px;" name="edit_general_status" <?php
            echo 'value="' . $user[ 'status' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Рейтинг::</div></td><td><input id="text" style="width:380px;" name="edit_general_rating" <?php
            echo 'value="' . $user[ 'rating' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пол:</div></td><td><select style="width:380px;" name="edit_general_gender" style="width:185px;"><option value="1"<?php
            if ( $user[ 'gender' ] == "1" )
              {
                echo ' selected';
              } //$user[ 'gender' ] == "1"
?>>Мужской</option>
  <option value="2"<?php
            if ( $user[ 'gender' ] == "2" )
              {
                echo ' selected';
              } //$user[ 'gender' ] == "2"
?>>Женский</option>
  <option value="0"<?php
            if ( $user[ 'gender' ] == "0" )
              {
                echo ' selected';
              } //$user[ 'gender' ] == "0"
?>>Не указано</option></select></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" name="edit_general_about"><?php
            $user[ 'aboutuser' ] = str_replace( '<br>', '
', $user[ 'aboutuser' ] );
            echo $user[ 'aboutuser' ];
?></textarea></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О себе (<a href="search.php">для поиска</a>):</div></td><td><input id="text" style="width:380px;" name="edit_general_about2" <?php
            echo 'value="' . $user[ 'aboutuser2' ] . '"';
?>></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Группа:</div></td><td><select style="width:380px;" name="edit_general_groupu" style="width:185px;">
<option value="3"<?php
            if ( $user[ 'groupu' ] == "3" )
              {
                echo ' selected';
              } //$user[ 'groupu' ] == "3"
?>>Супер-администратор</option>
<option value="2"<?php
            if ( $user[ 'groupu' ] == "2" )
              {
                echo ' selected';
              } //$user[ 'groupu' ] == "2"
?>>Администратор</option>
  <option value="1"<?php
            if ( $user[ 'groupu' ] == "1" )
              {
                echo ' selected';
              } //$user[ 'groupu' ] == "1"
?>>Тестер</option>
  <option value="0"<?php
            if ( $user[ 'groupu' ] == "0" )
              {
                echo ' selected';
              } //$user[ 'groupu' ] == "0"
?>>Обычный пользователь</option></select></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Забанен?:</div></td><td><select style="width:380px;" name="edit_general_ban" style="width:185px;"><option value="1"<?php
            if ( $user[ 'ban' ] == "1" )
              {
                echo ' selected';
              } //$user[ 'ban' ] == "1"
?>>Да</option>
  <option value="0"<?php
            if ( $user[ 'ban' ] == "0" )
              {
                echo ' selected';
              } //$user[ 'ban' ] == "0"
?>>Нет</option></select></td></tr>
  <tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Галочка?:</div></td><td><select style="width:380px;" name="edit_general_verify" style="width:185px;">
<option value="1"<?php
            if ( $user[ 'verify' ] == "1" )
              {
                echo ' selected';
              } //$user[ 'verify' ] == "1"
?>>Обычная</option>
  <option value="5"<?php
            if ( $user[ 'verify' ] == "5" )
              {
                echo ' selected';
              } //$user[ 'verify' ] == "5"
?>>Админская</option>
   <option value="0"<?php
            if ( $user[ 'verify' ] == "0" )
              {
                echo ' selected';
              } //$user[ 'verify' ] == "0"
?>>Нету</option>
  <option value="3"<?php
            if ( $user[ 'verify' ] == "3" )
              {
                echo ' selected';
              } //$user[ 'verify' ] == "3"
?>>Не указано</option></select></td></tr>
<?php
            if ( $user[ 'ban' ] == "1" )
              {
                //echo '<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Причина бана:</div></td><td><input id="text" style="width:380px;" name="edit_general_fname" value="'.$user['comment_ban'].'"></td></tr>';
              } //$user[ 'ban' ] == "1"
            //этот участок писал артёмка. не тронь тобi пiзда
            if ( $_POST[ 'edit_id' ] )
              {
                $id         = $_POST[ 'edit_id' ];
                $fname      = $_POST[ 'edit_general_fname' ];
                $lname      = $_POST[ 'edit_general_lname' ];
                $nick       = $_POST[ 'edit_general_nname' ];
                $stat       = $_POST[ 'edit_general_status' ];
                $pol        = $_POST[ 'edit_general_gender' ];
                $about      = $_POST[ 'edit_general_about' ];
                $about_find = $_POST[ 'edit_general_about2' ];
                $group      = $_POST[ 'edit_general_groupu' ];
                $ban        = $_POST[ 'edit_general_ban' ];
                $verify     = $_POST[ 'edit_general_verify' ];
                $rating     = $_POST[ 'edit_general_rating' ];
                $qu4        = $dbh1->prepare( "UPDATE `users` SET `name`='" . $fname . "', `nickname`='" . $nick . "', `status`='" . $stat . "', `surname`='" . $lname . "', `gender`='" . $pol . "', `groupu`='" . $group . "', `verify`='" . $verify . "', `ban`='" . $ban . "', `rating`='" . $rating . "' WHERE `id`='" . $_POST[ 'edit_id' ] . "'" );
                $qu4->execute();
              } //$_POST[ 'edit_id' ]
            //конец неприкасаемой территории
?>
</table>
<div style="margin-left:157px;"><input type="submit" id="button" value="Сохранить" name="edit_general_submit"></div>
</form>
</div>
<div><?php
            include "exec/footer.php";
?></div>
</body>
</html><?php
          } //$_GET[ 'idu' ]
        else
          {
            include "exec/datefn.php";
            include "exec/header.php";
            include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Пользователи</b></div>
<table border="0" style="font-size:11px;">
<tr>
<td>
ID
</td>
<td>
Ф.И.
</td>
<td>
Группа
</td>
<td>
Логин
</td>
<td>
Управление
</td>
</tr>
<?php
            $qu = $dbh1->prepare( "SELECT * FROM users ORDER BY id" );
            $qu->execute();
            while ( $users = $qu->fetch() )
              {
                if ( $users[ 'groupu' ] == "2" )
                  {
                    $gr = "Администратор";
                  } //$users[ 'groupu' ] == "2"
                elseif ( $users[ 'groupu' ] == "1" )
                  {
                    $gr = "Тестер";
                  } //$users[ 'groupu' ] == "1"
                else
                  {
                    $gr = "Пользователь";
                  }
                echo '<tr>
<td>
' . $users[ 'id' ] . '
</td>
<td>
<a href="id' . $users[ 'id' ] . '">' . $users[ 'name' ] . ' ' . $users[ 'surname' ] . '</a>
</td>
<td>
' . $gr . '
</td>
<td>
' . $users[ 'login' ] . '
</td>
<td>
<a href="admin_users.php?idu=' . $users[ 'id' ] . '">Перейти в управление</a>
</td>
</tr>';
              } //$users = $qu->fetch()
?>
</table>
<br>
</div>
<div><?php
            include "exec/footer.php";
?></div>
</body>
</html>
<?php
          }
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