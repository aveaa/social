<?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
if ( isset( $_GET[ 'id' ] ) != null )
  {
    $id = $_GET[ 'id' ];
    $q  = "SELECT * FROM `galbum` WHERE id='" . $id . "'"; // выбираем нашего 
    $q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
    $q1->execute();
    $user = $q1->fetch(); // ответ в переменную 
    if ( $_SESSION[ 'loginin' ] == "1" )
      {
        if ( $_POST[ 'album_create' ] )
          {
            if ( $_POST[ 'album_name' ] == NULL )
              {
                echo '<meta charset="utf-8">мы не можем для вас создать безымянную группу, извините.';
                exit( );
              } //$_POST[ 'album_name' ] == NULL
            elseif ( $_GET[ 'id' ] != '' )
              {
                echo '<meta charset="utf-8">Хакеры?';
                exit( );
              } //$_GET[ 'id' ] != ''
            $_POST[ 'album_name' ]  = htmlentities( $_POST[ 'album_name' ], ENT_QUOTES );
            $_POST[ 'album_about' ] = htmlentities( $_POST[ 'album_about' ], ENT_QUOTES );
            $_POST[ 'album_about' ] = str_replace( array(
                 "\r\n",
                "\r",
                "\n" 
            ), '<br>', $_POST[ 'album_about' ] );
            $q22                    = $dbh1->prepare( "SELECT * FROM club WHERE `id` = '" . $_POST[ 'id' ] . "'" );
            $q22->execute();
            $clbq = $q22->fetch();
            if ( $clbq[ 'authorid' ] != $_SESSION[ 'id' ] )
              {
                echo '<meta charset="utf-8">Хакеры?';
                exit( );
              } //$clbq[ 'authorid' ] != $_SESSION[ 'id' ]
            $q  = "INSERT INTO `galbums` (`id`, `name`, `note`, `aid`, `date`) VALUES (NULL, '" . $_POST[ 'album_name' ] . "', '" . $_POST[ 'album_about' ] . "', '" . $_POST[ 'id' ] . "', '" . time() . "')";
            $q1 = $dbh1->prepare( $q );
            $q1->execute();
            $q1->fetch();
            $q2 = $dbh1->prepare( "SELECT * FROM galbum WHERE `name` = '" . $_POST[ 'album_name' ] . "' AND `aid` = '" . $_SESSION[ 'id' ] . "'" );
            $q2->execute();
            $clb = $q2->fetch();
            $clb = $clb[ 'id' ];
            header( "Location: albums-" . $_POST[ 'id' ] );
            exit( );
          } //$_POST[ 'album_create' ]
        include( 'exec/header.php' );
        include( 'exec/leftmenu.php' );
        if ( $_GET[ 'id' ] )
          {
?>
<div>
<div id="content-infoname"><b>Создание альбома в группе</b></div>
<form action="galbum_add.php" method="post">
	<input type="hidden" name="id" value="<?php
            echo $_GET[ 'id' ];
?>">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Название альбома:</div></td><td><input id="text" style="width:380px;" name="album_name" maxlength="255"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">О альбоме:</div></td><td><textarea style="min-width:380px;max-width:380px;" id="text" nkeypress="return isNotMax(this)" name="album_about" maxlength="500"></textarea></td></tr>
<script type="text/javascript">
	function isNotMax(oTextArea) {
    return oTextArea.value.length <= oTextArea.getAttribute('maxlength');
}
</script>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Создать альбом" name="album_create"></div>
</form>
</div>
 </div>
 </div>
 </div>
 <div>
 <?php
            include( 'exec/footer.php' );
?>
 </div>
 </div>
 </body>
</html>
<?php
          } //$_GET[ 'id' ]
      } //$_SESSION[ 'loginin' ] == "1"
?>
<?php
  } //isset( $_GET[ 'id' ] ) != null
else if ( $_SESSION[ 'loginin' ] != "1" )
  {
    echo '<meta charset="utf-8">Пожалуйста, авторизируйтесь.<meta http-equiv="refresh" content="3;blank/../">';
    exit( );
  } //$_SESSION[ 'loginin' ] != "1"
?>