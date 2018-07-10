  <?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
if ( isset( $_GET[ 'id' ] ) != null )
  {
    $id = $_GET[ 'id' ];
    $q  = "SELECT * FROM club WHERE id='" . $id . "'"; // выбираем нашего 
    $q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
    $q1->execute();
    $club = $q1->fetch(); // ответ в переменную
    $q44  = "SELECT * FROM users WHERE id='" . $_SESSION[ 'id' ] . "'"; // выбираем нашего 
    $q2   = $dbh1->prepare( $q ); // отправляем запрос серверу
    $q2->execute();
    $user = $q2->fetch(); // ответ в переменную 
  } //isset( $_GET[ 'id' ] ) != null
$_SESSION[ 'clubwall' ] = $id;
if ( $club[ 'id' ] == "" )
  {
    header( "Location: blank.php?id=2" );
    exit( );
  } //$club[ 'id' ] == ""
if ( isset( $_GET[ 'id' ] ) == null )
  {
    header( "Location: blank.php?id=2" );
    exit( );
  } //isset( $_GET[ 'id' ] ) == null
include( 'exec/header.php' );
include( 'exec/datefn.php' );
include( 'exec/leftmenu.php' );
$qchsubcl = $dbh1->prepare( "SELECT * FROM clubsub WHERE `id1` = '" . $_SESSION[ 'id' ] . "' AND `id2` = '" . $id . "'" );
$qchsubcl->execute();
$chsubcl   = $qchsubcl->fetch();
$qchsubcl1 = $dbh1->prepare( "SELECT * FROM clubsubrequest WHERE `id1` = '" . $_SESSION[ 'id' ] . "' AND `id2` = '" . $id . "'" );
$qchsubcl1->execute();
$chsubcl1 = $qchsubcl1->fetch();
?>
<?php
if ( $club[ 'closed' ] == '2' AND $club[ 'authorid' ] == $_SESSION[ 'id' ] )
  {
?>
.
<?php
  } //$club[ 'closed' ] == '2' AND $club[ 'authorid' ] == $_SESSION[ 'id' ]
?>
<?php
if ( $club[ 'closed' ] != '2' )
  {
?>
<div id="content-infoname"><b><?php
    if ( $club[ 'ban' ] == '1' )
      {
        echo "Сообщество заблокированно";
      } //$club[ 'ban' ] == '1'
    else
      {
        echo substr( $club[ 'name' ], 0, 45 );
      }
?></b><?php
    if ( $club[ 'verify' ] == '1' )
      {
        echo '<img src="img/verify.png" width="12" height="12" style="margin-left:5px;margin-right:5px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа была официально верифицирована администрацией l-lacker Social.</div>';
      } //$club[ 'verify' ] == '1'
    if ( $club[ 'verify' ] == '2' )
      {
        echo '<img src="img/verify_blue.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа - страница тестеров l-lacker Social.</div>';
      } //$club[ 'verify' ] == '2'
    if ( $club[ 'verify' ] == "3" )
      {
        echo '<img src="img/verify_green.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Данная группа - группа от команды разработчиков.</div>';
      } //$club[ 'verify' ] == "3"
    if ( $club[ 'verify' ] == "4" )
      {
        echo '<img src="img/verify_orange.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Эту группу создал донатер с правами тестера, а группу подтвердила администрация. Особый сорт элиты!</div>';
      } //$club[ 'verify' ] == "4"
    if ( $club[ 'verify' ] == "5" )
      {
        echo '<img src="img/verify_interes.png" width="12" height="12" style="margin-left:4px;margin-right:4px;margin-bottom:-2px;" onmouseenter="openVerify();" onmouseleave="openVerify();"><div id="verify" style="display:none;margin:10px 0;">Группа вызывает повышенный интерес у читателей и подтверждена администрацией.</div>';
      } //$club[ 'verify' ] == "5"
?>
    </div>
  <?php
    if ( $club[ 'ban' ] == "1" )
      {
?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Группа заблокирована.<hr> Комментарий модератора:
   <?php
        if ( $club[ 'comment_ban' ] != null )
          {
            echo $club[ 'comment_ban' ];
          } //$club[ 'comment_ban' ] != null
        else
          {
            echo 'отсутствует.';
          }
?><br>


  
  </div>
   <?php
        if ( $_SESSION[ 'groupu' ] == "2" )
          {
            echo '<a id="aprofile" href="admin/actions/ban_club.php?id=' . $id . '">Забанить/Разбанить</a>';
          } //$_SESSION[ 'groupu' ] == "2"
?>
 </div>
<?php
      } //$club[ 'ban' ] == "1"
?>
  <?php
    if ( $club[ 'deleted' ] == "1" )
      {
?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Группа удалена.


  
  </div>

   <?php
        if ( $_SESSION[ 'groupu' ] == "2" )
          {
            echo '<a id="aprofile" href="admin/actions/ban_club.php?id=' . $id . '">Забанить/Разбанить</a>';
          } //$_SESSION[ 'groupu' ] == "2"
?>
 </div>
<?php
        exit( );
      } //$club[ 'deleted' ] == "1"
?>
  <div id="content-left" style="width:397px;">
   <div id="content-info" >
    
    


    <?php
    if ( $_SESSION[ 'loginin' ] == '1' )
      {
?>
    <div class="clear" id="profile_current_info"><span style="font-size:10px;"><?php // echo $club['status'] 
?></span></div>
    <?php
      } //$_SESSION[ 'loginin' ] == '1'
?>

  
<?php
    if ( $club[ 'maturecontent' ] == '1' )
      {
        echo '<br><div id="faqcontent">Согласно нашей нейросети, в группе может быть порнография.</div>';
      } //$club[ 'maturecontent' ] == '1'
?>
        <?php
    if ( $club[ 'ban' ] != '1' )
      {
?>
<div id="content-wall-title" class="clear_fix">Информация</div>
        <div class="profile_info" class="clear_fix"><div class="clear_fix miniblock">
            <?php
        if ( $club[ 'type' ] == '1' )
          {
?><h4>О встрече</h4><?php
          } //$club[ 'type' ] == '1'
?>
 <div class="label fl_l" style="width: 65px;">Название:</div>
<b><?php
        echo substr( $club[ 'name' ], 0, 45 );
?></b><br>
 <div class="label fl_l" style="width: 65px;">Тип:</div>
<?php
        if ( $club[ 'type' ] == "0" )
          {
            echo 'Группа';
          } //$club[ 'type' ] == "0"
        else if ( $club[ 'type' ] == "1" )
          {
            echo "Встреча";
          } //$club[ 'type' ] == "1"
?>
  <?php
        if ( $club[ 'type' ] == "1" )
          {
?>
  <br>
  <br>
  <h4>Время и место</h4>
  <?php
            $club[ 'place' ] = htmlentities( $club[ 'place' ], ENT_QUOTES );
            $club[ 'place' ] = str_replace( array(
                 "\r\n",
                "\r",
                "\n",
                "<",
                ">",
                "<script>" 
            ), '<br>', $club[ 'place' ] );
            if ( $club[ 'place' ] != "" )
              {
?>
  <div class="label fl_l" style="width: 65px;">Место:</div>
<?php
                echo $club[ 'place' ];
?><br><?php
              } //$club[ 'place' ] != ""
?>
  <div class="label fl_l" style="width: 65px;">Начало:</div>
<?php
            echo zmd( $club[ 'datestart' ] );
?><br>
<div class="label fl_l" style="width: 65px;">Окончание:</div>
<?php
            echo zmd( $club[ 'datefinish' ] );
?>
<?php
            $club[ 'email' ] = htmlentities( $club[ 'email' ], ENT_QUOTES );
            $club[ 'email' ] = str_replace( array(
                 "\r\n",
                "\r",
                "\n",
                "<",
                ">",
                "<script>" 
            ), '<br>', $club[ 'email' ] );
            if ( $club[ 'email' ] == '' )
              {
              } //$club[ 'email' ] == ''
            else
              {
?>
<br>
<br>
 <h4>Дополнительно</h4>
<div class="label fl_l" style="width: 65px;">Email:</div>
<?php
                echo $club[ 'email' ];
?><br>
  <?php
              }
          } //$club[ 'type' ] == "1"
?>
</div>
</div>
<div id="content-wall-title">Описание</div>
<div class="label fl_l" style="width: 65px;"></div><br>
  <?php
        if ( $club[ 'about' ] )
          {
            echo '<div class="labeled fl_l" style="width:400px;">' . substr( $club[ 'about' ], 0, 255 ) . '</div>';
          } //$club[ 'about' ]
        else
          {
            echo '<div class="labeled fl_l" style="width:320px;"><i>&#60;нет информации&#62;</i></div>';
          }
?>
<?php
        if ( $club[ 'widget' ] == '1' )
          {
            echo '<br><br><div id="content-wall-title">Виджет</div>';
          } //$club[ 'widget' ] == '1'
        if ( $club[ 'widgettype' ] == '1' )
          {
            echo '<iframe src="http://l-lacker.ru/llsoc-widgets/llacker/index.html" width="400" height="155" frameborder="0" scrolling="false"></iframe>';
          } //$club[ 'widgettype' ] == '1'
        else if ( $club[ 'widgettype' ] == '2' )
          {
            echo '<iframe src="http://l-lsoc.cf/api2/register.php" width="400" height="155" frameborder="0" scrolling="false"></iframe>';
          } //$club[ 'widgettype' ] == '2'
        else if ( $club[ 'widgettype' ] == '3' )
          {
            echo '<iframe src="http://l-lsoc.cf/group-widgets/stefani-g" width="400" height="155" frameborder="0" scrolling="false"></iframe>';
          } //$club[ 'widgettype' ] == '3'
?>
    
	  
   <div id="content-wall" class="clear_fix" style="padding-top:15px;">

<?php
        if ( $club[ 'ban' ] == '0' )
          {
?>
<?php
            echo '<a href="participants.php?id=' . $id . '" style="text-decoration: none;">';
?><div id="content-wall-title">Участники</div>
<div id="content-wall-send"><?php
            $qcountclub = $dbh1->prepare( "SELECT COUNT(1) FROM clubsub WHERE `id2` = '" . $id . "'" );
            $qcountclub->execute();
            $countclub = $qcountclub->fetch();
            $countclub = $countclub[ 0 ];
            if ( $countclub == '1' OR $countclub == '21' )
              {
                echo $countclub . " участник";
              } //$countclub == '1' OR $countclub == '21'
            elseif ( $countclub == '2' OR $countclub == '3' OR $countclub == '4' OR $countclub == '22' )
              {
                echo $countclub . " участника";
              } //$countclub == '2' OR $countclub == '3' OR $countclub == '4' OR $countclub == '22'
            else
              {
                echo $countclub . " участников";
              }
?>
</div></a>

<?php
            $qsubclub = $dbh1->prepare( "SELECT * FROM clubsub WHERE `id2` = '" . $id . "' GROUP BY id1 ORDER BY RAND() LIMIT 6" );
            $qsubclub->execute();
            while ( $subclub = $qsubclub->fetch() )
              {
                $qsubu = $dbh1->prepare( "SELECT * FROM users WHERE `id` = '" . $subclub[ 'id1' ] . "'" );
                $qsubu->execute();
                $subu = $qsubu->fetch();
                if ( $subu[ 'avatar' ] != null )
                  {
                    echo '<div id="content-friends-friend" style="clear:both;margin-right:3.65px;"><img id="avatar" src="avatarc.php?image=' . $subu[ 'avatar' ] . '" style="margin-top: 3px;clear:both;">
<b style="margin-right: 3px;clear:both;"><a style="margin-top: 3px;clear:both;" href="id' . $subu[ 'id' ] . '">' . $subu[ 'name' ] . '<br> <text style="font-size: 8px;clear:both;">' . $subu[ 'surname' ] . '</text></a></b></div>';
                  } //$subu[ 'avatar' ] != null
                else
                  {
                    echo '<div id="content-friends-friend" style="clear:both;margin-right:3.65px;"><img id="avatar" src="img/camera_200.png" width="50" height="50" style=" margin-top: 3px;clear:both;">
<b style="margin-right: 3px;clear:both;"><a style="margin-top: 3px;clear:both;" href="id' . $subu[ 'id' ] . '">' . $subu[ 'name' ] . '<br> <text style="font-size: 8px;clear:both;">' . $subu[ 'surname' ] . '</text></a></b></div>';
                  }
              } //$subclub = $qsubclub->fetch()
?>
<br><br><?php
            if ( $club[ 'closed' ] == '0' OR $chsubcl[ 'id1' ] == $_SESSION[ 'id' ] AND $chsubcl[ 'id2' ] == $id )
              {
?>
   <div id="content-wall-title" class="clear_fix">Стена</div>
    <div id="content-wall-send" class="clear_fix"><?php
                $qwallcount = $dbh1->prepare( "SELECT COUNT(1) FROM gpost WHERE idwall='" . $id . "'" );
                $qwallcount->execute();
                $wlcount = $qwallcount->fetch();
                $wlcount = $wlcount[ 0 ];
                if ( $wlcount == '1' OR $wlcount == '21' )
                  {
                    $wlcounnt = (string) $wlcount . " запись";
                  } //$wlcount == '1' OR $wlcount == '21'
                elseif ( $wlcount == '2' OR $wlcount == '3' OR $wlcount == '4' OR $wlcount == '22' )
                  {
                    $wlcounnt = (string) $wlcount . " записи";
                  } //$wlcount == '2' OR $wlcount == '3' OR $wlcount == '4' OR $wlcount == '22'
                else
                  {
                    $wlcounnt = (string) $wlcount . " записей";
                  }
                echo '<div class="post-textarea-button">' . $wlcounnt;
?><?php
                if ( $_SESSION[ 'loginin' ] == '1' )
                  {
                    if ( $club[ 'wall' ] == "0" OR $club[ 'authorid' ] == $_SESSION[ 'id' ] )
                      {
?>

   <a href="#" style="display: block;float: right;" onmousedown="openTextarea();" >Написать</a></div>
    <div class="post-textarea" style="display: none;">
    <form method="post" action="add_gpost.php" enctype="multipart/form-data">
     <textarea placeholder="Что нового?" name="text"></textarea><div id="postphoto" style="display: none;"><input type="file" name="upimg" accept="image/jpeg,image/png,image/gif"></div><div style="float:right;clear:both;"><?php
                        if ( $club[ 'wall' ] == "1" )
                          {
                            echo '<input style="margin-right:5px;" type="checkbox" name="bygroup" id="bygroup" checked disabled><label for="bygroup" style="color:black;margin-right:8px;" >от имени сообщества</label>';
                          } //$club[ 'wall' ] == "1"
                        elseif ( $club[ 'authorid' ] == $_SESSION[ 'id' ] || $user[ 'groupu' ] == '2' )
                          {
                            echo '<input style="margin-right:5px;" type="checkbox" name="bygroup" id="bygroup"><label for="bygroup" style="color:black;margin-right:8px;">от имени сообщества</label>';
                          } //$club[ 'authorid' ] == $_SESSION[ 'id' ] || $user[ 'groupu' ] == '2'
?><a href="#" onclick="openMenuPin();" class="pinlink">Прикрепить</a><div class="absolutemenu" id="pinpostmenu" style="display: none;<?php
                        if ( $club[ 'authorid' ] == $_SESSION[ 'id' ] )
                          {
?>margin-left: 139px;<?php
                          } //$club[ 'authorid' ] == $_SESSION[ 'id' ]
?>"><a href="#" onclick="menuPinPhoto();" ><img src="img/photo-icon.png"> Фотография</a></div></div><input type="submit" id="button" value="Опубликовать" style="float:left;margin-top:5px;"></form><div style="clear:both;"></div>
   </div>
 </div>
    <?php
                      } //$club[ 'wall' ] == "0" OR $club[ 'authorid' ] == $_SESSION[ 'id' ]
                    else
                      {
                        echo "</div></div>";
                      }
                  } //$_SESSION[ 'loginin' ] == '1'
                else
                  {
                    echo "</div></div>";
                  }
?>

    <?php
                if ( $_SESSION[ 'loginin' ] == '1' )
                  {
                    $q2 = $dbh1->prepare( "SELECT * FROM gpost WHERE idwall='" . $id . "' ORDER BY id DESC" );
                    $q2->execute();
                    while ( $wall = $q2->fetch() )
                      {
                        $q3 = $dbh1->prepare( "SELECT * FROM users WHERE id='" . $wall[ 'iduser' ] . "'" ); // отправляем запрос серверу
                        $q3->execute();
                        $authorwall = $q3->fetch(); // ответ в переменную .
                        if ( time() - 300 <= $authorwall[ 'lastonline' ] )
                          {
                            $onlinewall = "<b>Онлайн</b>";
                          } //time() - 300 <= $authorwall[ 'lastonline' ]
                        else
                          {
                            $onlinewall = "";
                          }
                        if ( $wall[ 'bygroup' ] == "0" )
                          {
                            $qchg = $dbh1->prepare( "SELECT * FROM club WHERE id='" . $id . "' AND authorid='" . $_SESSION[ 'id' ] . "'" );
                            $qchg->execute();
                            $chg = $qchg->fetch();
                            if ( $chg[ 'id' ] == $id && $chg[ 'authorid' ] == $_SESSION[ 'id' ] )
                              {
                                if ( $wall[ 'iduser' ] == $_SESSION[ 'id' ] OR $chg[ 'id' ] == $id && $chg[ 'authorid' ] == $_SESSION[ 'id' ] )
                                  {
                                    $deletebutton = '<a href="del_gpost.php?id=' . $wall[ 'id' ] . '" style="float:left;">Удалить</a>';
                                  } //$wall[ 'iduser' ] == $_SESSION[ 'id' ] OR $chg[ 'id' ] == $id && $chg[ 'authorid' ] == $_SESSION[ 'id' ]
                                else
                                  {
                                    $deletebutton = '';
                                  }
                              } //$chg[ 'id' ] == $id && $chg[ 'authorid' ] == $_SESSION[ 'id' ]
                            else
                              {
                                if ( $wall[ 'iduser' ] == $_SESSION[ 'id' ] )
                                  {
                                    $deletebutton = '<a href="del_gpost.php?id=' . $wall[ 'id' ] . '" style="float:left;">Удалить</a>';
                                  } //$wall[ 'iduser' ] == $_SESSION[ 'id' ]
                                else
                                  {
                                    $deletebutton = '';
                                  }
                              }
                            if ( $wall[ 'image' ] != null )
                              {
                                $im = '<br><br><a href="watchi.php?image=' . $wall[ 'image' ] . '"><img src="imagep.php?image=' . $wall[ 'image' ] . '"></a>';
                              } //$wall[ 'image' ] != null
                            else
                              {
                                $im = '';
                              }
                            if ( $authorwall[ 'avatar' ] == NULL )
                              {
                                $ava = "img/camera_200.png";
                              } //$authorwall[ 'avatar' ] == NULL
                            else
                              {
                                $ava = "avatarc.php?image=" . $authorwall[ 'avatar' ];
                              }
                            echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="' . $ava . '" width="50"></div>' . $onlinewall . '</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="id' . $authorwall[ 'id' ] . '">' . $authorwall[ 'name' ] . ' ' . $authorwall[ 'surname' ] . '</a></b></text>написал<br><div id="content-date"><a href="gpost' . $wall[ 'id' ] . '">' . zmdate( $wall[ 'date' ] ) . '</a></div></div>
     
     <div id="content-wall-post-text">' . $wall[ 'text' ] . $im . ' </div>
     </div>' . $deletebutton . '<a href="gpost' . $wall[ 'id' ] . '" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
                          } //$wall[ 'bygroup' ] == "0"
                        elseif ( $wall[ 'bygroup' ] == "1" )
                          {
                            if ( $wall[ 'image' ] != null )
                              {
                                $im = '<br><br><a href="watchi.php?image=' . $wall[ 'image' ] . '"><img src="imagep.php?image=' . $wall[ 'image' ] . '"></a>';
                              } //$wall[ 'image' ] != null
                            else
                              {
                                $im = '';
                              }
                            if ( $club[ 'avatar' ] == NULL )
                              {
                                $ava = "img/camera_200.png";
                              } //$club[ 'avatar' ] == NULL
                            else
                              {
                                $ava = "avatarc.php?image=" . $club[ 'avatar' ];
                              }
                            echo '<div id="content-wall-post"><table border="0" style="font-size:11px;"><tr><td style="width:54px;vertical-align:top;">
   <div id="content-wall-post-avatar"><img id="avatar" src="' . $ava . '" width="50"></div>' . $onlinewall . '</td><td style="width:345px;vertical-align:0;">
     <div id="content-wall-post-infoofpost">
      
      <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="club' . $club[ 'id' ] . '">' . substr( $club[ 'name' ], 0, 45 ) . '</a></b></text><br><div id="content-date"><a href="gpost' . $wall[ 'id' ] . '">' . zmdate( $wall[ 'date' ] ) . '</a></div></div>
     
     <div id="content-wall-post-text">' . $wall[ 'text' ] . $im . '<br><div style="margin-top:6px;font-size:9px;"><a href="id' . $authorwall[ 'id' ] . '"><svg width="8" height="9" viewBox="20 203 8 9" xmlns="http://www.w3.org/2000/svg" style="fill:#AABBCE;margin-right:5px;"><path d="M24 209c3.5 0 4 1 4 2.5 0 .5 0 .5-1 .5h-6c-1 0-1 0-1-.5 0-1.5.5-2.5 4-2.5zm0-1c-1.1 0-2-1.12-2-2.5s.9-2.5 2-2.5 2 1.12 2 2.5-.9 2.5-2 2.5z"/></svg>' . $authorwall[ 'name' ] . ' ' . $authorwall[ 'surname' ] . '</a></div></div>
     </div>' . $deletebutton . '<a href="gpost' . $wall[ 'id' ] . '" style="float:right;">Открыть комментарии</a><div style="clear:both;"></div>
    
    </td></tr></table></div><br>';
                          } //$wall[ 'bygroup' ] == "1"
                      } //$wall = $q2->fetch()
                  } //$_SESSION[ 'loginin' ] == '1'
                else
                  {
?> <div id="msg">Для того, чтобы просматривать стену группы, вам необходимо авторизоваться</div><?php
                  }
              } //$club[ 'closed' ] == '0' OR $chsubcl[ 'id1' ] == $_SESSION[ 'id' ] AND $chsubcl[ 'id2' ] == $id
          } //$club[ 'ban' ] == '0'
?>
    
  </div>
  </div>
  </div>
  <div id="content-right" style="width:200px;">
    
   <div id="content-avatar">
    <?php
        if ( $club[ 'avatar' ] != null AND $club[ 'ban' ] == '0' )
          {
            echo '<a href="watchi.php?image=' . $club[ 'avatar' ] . '"><img src="avatar.php?image=' . $club[ 'avatar' ] . '"></a>';
          } //$club[ 'avatar' ] != null AND $club[ 'ban' ] == '0'
        else
          {
            echo '<img src="img/camera_200.png">';
          }
        if ( $_SESSION[ 'loginin' ] == "1" )
          {
            if ( $club[ 'ban' ] != '1' )
              {
                if ( $chsubcl[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl[ 'id2' ] == $id )
                  {
                    echo '<a id="aprofile" href="unsub_club.php" style="margin-top:10px;clear:both;">Выйти из группы</a>';
                  } //$chsubcl[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl[ 'id2' ] == $id
                elseif ( $chsubcl1[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl1[ 'id2' ] == $id )
                  {
                    echo '<a id="aprofile" href="club_cancelreq.php?id=' . $club[ 'id' ] . '" style="margin-top:10px;clear:both;">Отменить заявку</a>';
                  } //$chsubcl1[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl1[ 'id2' ] == $id
                else if ( $club[ 'closed' ] == "1" )
                  {
                    echo '<a id="aprofile" href="club_sendreq.php?id=' . $club[ 'id' ] . '" style="margin-top:10px;clear:both;">Отправить заявку</a>';
                  } //$club[ 'closed' ] == "1"
                else
                  {
                    echo '<a id="aprofile" href="sub_club.php" style="margin-top:10px;clear:both;">Вступить в группу</a>';
                  }
              } //$club[ 'ban' ] != '1'
          } //$_SESSION[ 'loginin' ] == "1"
        if ( $club[ 'authorid' ] == $_SESSION[ 'id' ] )
          {
            echo '<a id="aprofile" href="gsettings.php?id=' . $id . '" style="margin-top:10px;clear:both;">Редактировать группу</a>';
          } //$club[ 'authorid' ] == $_SESSION[ 'id' ]
        if ( $_SESSION[ 'groupu' ] == "2" )
          {
            //echo '<a id="aprofile" href="#" onclick="openAdmin();">Дополнительные параметры</a><br>';
            //echo '<div id="admin" style="display:none;">
            //<a id="aprofile" href="gsettings.php?id='.$id.'" style="margin-top:10px;clear:both;">Редактировать группу</a>';
            //echo '<a id="aprofile" href="admin/actions/ban_club.php?id='.$id.'">Забанить/Разбанить</a>';
            //echo '</div>';
          } //$_SESSION[ 'groupu' ] == "2"
?>
   </div>
<?php
        if ( $club[ 'type' ] == '1' )
          {
?>
<div id="content-wall-title" style="clear:both;">Тип события</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это открытая встреча. Любой может прийти.</p></div>
<?php
          } //$club[ 'type' ] == '1'
        elseif ( $club[ 'closed' ] == "0" AND $club[ 'type' ] == "0" )
          {
?>
<div id="content-wall-title" style="clear:both;">Тип группы</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это открытая группа. В неё может вступить любой желающий.</p></div>
<?php
          } //$club[ 'closed' ] == "0" AND $club[ 'type' ] == "0"
        elseif ( $club[ 'closed' ] == "1" AND $club[ 'type' ] == "0" )
          {
?>
<div id="content-wall-title" style="clear:both;">Тип группы</div>
<div id="content-wall" style="width: 200px;margin:5px;"><p>Это закрытая группа. В неё можно вступить только по заявке.</p></div>
<?php
          } //$club[ 'closed' ] == "1" AND $club[ 'type' ] == "0"
        if ( $chsubcl[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl[ 'id2' ] == $id )
          {
?>
<br><a href="albums-<?php
            echo $id;
?>" style="text-decoration: none;"><div id="content-wall-title">Фотоальбомы</div>
<div id="content-wall-send"><?php
            $qalbumscount = $dbh1->prepare( "SELECT COUNT(1) FROM `galbums` WHERE `aid` = '" . $id . "'" );
            $qalbumscount->execute();
            $phocount = $qalbumscount->fetch();
            $phocount = $phocount[ 0 ];
            if ( $phocount == '1' )
              {
                $vidcouunt = (string) $phocount . " альбом";
              } //$phocount == '1'
            elseif ( $phocount == '2' OR $phocount == '3' OR $phocount == '4' )
              {
                $vidcouunt = (string) $phocount . " альбома";
              } //$phocount == '2' OR $phocount == '3' OR $phocount == '4'
            else
              {
                $vidcouunt = (string) $phocount . " альбомов";
              }
            echo $vidcouunt . '</div><div id="content-wall">';
            $qphoto = $dbh1->prepare( "SELECT * FROM `galbums` WHERE `aid` = '" . $id . "' ORDER BY RAND() LIMIT 2" );
            $qphoto->execute();
            while ( $pho = $qphoto->fetch() )
              {
                $qgg = $dbh1->prepare( "SELECT * FROM `galbums` WHERE `id` = '" . $pho[ 'id' ] . "'" );
                $qgg->execute();
                $photo   = $qgg->fetch();
                $qphotoo = $dbh1->prepare( "SELECT * FROM `photo` WHERE `galbum` = '" . $photo[ 'id' ] . "' ORDER BY id LIMIT 1" );
                $qphotoo->execute();
                $photoo = $qphotoo->fetch();
                if ( $phocount == "0" )
                  {
                    $photoalbum = "img/nophoto.jpg";
                  } //$phocount == "0"
                else
                  {
                    $photoalbum = $photoo[ 'image' ];
                  }
                echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><a href="album-' . $photo[ 'id' ] . '" style="clear:both;"><img src="' . $photoalbum . '" width="75" height="auto" style="clear:both;"></a></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="album-' . $photo[ 'id' ] . '" style="clear:both;">' . $photo[ 'name' ] . '</a></b></td></tr></div></table>';
              } //$pho = $qphoto->fetch()
?>

   </div></a><?php
          } //$chsubcl[ 'id1' ] == $_SESSION[ 'id' ] && $chsubcl[ 'id2' ] == $id
?>
<?php
        if ( $club[ 'authorid' ] != "0" AND $club[ 'type' ] == '0' )
          {
?>
<div id="content-wall-title" style="clear:both;">Создатель</div>
<?php
          } //$club[ 'authorid' ] != "0" AND $club[ 'type' ] == '0'
        else
          {
            echo '<div id="content-wall-title" style="clear:both;">Организатор</div>';
          }
        if ( $club[ 'authorid' ] != "0" )
          {
?>
<?php
            $qcont = $dbh1->prepare( "SELECT * FROM users WHERE `id` = '" . $club[ 'authorid' ] . "'" );
            $qcont->execute();
            $contu = $qcont->fetch();
            if ( $contu[ 'avatar' ] )
              {
                $contu[ 'avatar' ] = "avatarm.php?image=" . $contu[ 'avatar' ];
              } //$contu[ 'avatar' ]
            else
              {
                $contu[ 'avatar' ] = "img/camera_200.png";
              }
            echo '<table border="0" style="font-size:11px;clear:both;"><div style="clear:both;"><tr><td style="width:25px;margin-right:7px;"><img src="' . $contu[ 'avatar' ] . '" width="25" height="auto" style="clear:both;"></td><td style="width:168px;"><b style="padding-left:7px;clear:both;"><a href="id' . $contu[ 'id' ] . '" style="clear:both;">' . $contu[ 'name' ] . ' ' . $contu[ 'surname' ] . '</a></b></td></tr></div></table>';
          } //$club[ 'authorid' ] != "0"
      } //$club[ 'ban' ] != '1'
  } //$club[ 'closed' ] != '2'
?>
<?php
if ( $club[ 'closed' ] == '2' AND $club[ 'authorid' ] != $_SESSION[ 'id' ] )
  {
?>
<link rel="stylesheet" href="blank.css">
<div class="simpleBlock">
  <div class="simpleHeader">Ошибка!</div>
  <div class="simpleBar clearFix">
   Это частное сообщество. Доступ только по приглашениям администраторов.<hr><br>


  
  </div>
   <?php
    if ( $_SESSION[ 'groupu' ] == "2" )
      {
        echo '<a id="aprofile" href="admin/actions/ban_club.php?id=' . $id . '">Забанить/Разбанить</a>';
      } //$_SESSION[ 'groupu' ] == "2"
?>
 </div>
<?php
  } //$club[ 'closed' ] == '2' AND $club[ 'authorid' ] != $_SESSION[ 'id' ]
?>


<br>
   </div>
  </div>
  </div>
  </div>
  </div>
 <div>
 <?php
include( 'exec/footer.php' );
?>
 </div>
 </body>
 <script type="text/javascript">
function otvet(a,b)

{
var str = a;
var idd = b;
var text=document.getElementById(b);
document.getElementById(b).value=a+", "+text.value;
}
  function openVerify() {
  if(document.getElementById('verify').style.display == "none"){
    document.getElementById('verify').style.display = "block";
  }else{
    document.getElementById('verify').style.display = "none";
  }
}
 function openAdmin() {
    if(document.getElementById('admin').style.display == "none"){
      document.getElementById('admin').style.display = "block";
    }else{
      document.getElementById('admin').style.display = "none"
    }
  }

function openMenuPin() {
    if(document.getElementById('pinpostmenu').style.display == "block"){
      document.getElementById('pinpostmenu').style.display = "none";
    }else{
      document.getElementById('pinpostmenu').style.display = "block";
    }
  }

  function menuPinPhoto() {
    document.getElementById('pinpostmenu').style.display = "none";
    document.getElementById('postphoto').style.display = "block";
  }

function openTextarea() {
  document.getElementsByClassName('post-textarea-button')[0].style.display = "none";
  document.getElementsByClassName('post-textarea')[0].style.display = "block"; 
}
</script>
</html>