<?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
if ( $_SESSION[ 'loginin' ] == '1' )
  {
    if ( $_POST[ 'text' ] == NULL )
      {
        echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;club' . $_SESSION[ 'clubwall' ] . '">';
        exit( );
      } //$_POST[ 'text' ] == NULL
    if ( $_POST[ 'text' ] == ' ' )
      {
        echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;club' . $_SESSION[ 'clubwall' ] . '">';
        exit( );
      } //$_POST[ 'text' ] == ' '
    $qch = $dbh1->prepare( "SELECT * FROM club WHERE id = '" . $_SESSION[ 'clubwall' ] . "'" );
    $qch->execute();
    $ch = $qch->fetch();
    if ( $ch[ 'authorid' ] == $_SESSION[ 'id' ] )
      {
        if ( $_POST[ 'bygroup' ] == "on" )
          {
            $bygroup = "1";
          } //$_POST[ 'bygroup' ] == "on"
        else
          {
            $bygroup = "0";
          }
      } //$ch[ 'authorid' ] == $_SESSION[ 'id' ]
    else
      {
        $bygroup = "0";
      }
    if ( $ch[ 'wall' ] == "1" )
      {
        if ( $ch[ 'authorid' ] != $_SESSION[ 'id' ] )
          {
            echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
            exit( );
          } //$ch[ 'authorid' ] != $_SESSION[ 'id' ]
        else
          {
            $bygroup = "1";
          }
      } //$ch[ 'wall' ] == "1"
    //$_POST['text'] = htmlentities($_POST['text'],ENT_QUOTES);
    $_POST[ 'text' ] = str_replace( array(
         "\r\n",
        "\r",
        "\n" 
    ), '
<br>', $_POST[ 'text' ] );
    $_POST[ 'text' ] = preg_replace( "~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a href="$1://$2">$1://$2</a>$3', $_POST[ 'text' ] );
    //общедоступные смайлы
    $_POST[ 'text' ] = str_replace( ':-)', '<img src="/img/testers-emoji/good.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(сердечко)', '<img src="/img/testers-emoji/love.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(луна)', '<img src="/img/testers-emoji/luna.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(плачу)', '<img src="/img/testers-emoji/plachu.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(победа)', '<img src="/img/testers-emoji/pobeda.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(подмигивание)', '<img src="/img/testers-emoji/podmigivanie.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(солнце)', '<img src="/img/testers-emoji/solntse.png">', $_POST[ 'text' ] );
    $_POST[ 'text' ] = str_replace( '(брызг)', '<img src="/img/testers-emoji/bryzg.png">', $_POST[ 'text' ] );
    //тестирование плюшек
    if ( $_SESSION[ 'groupu' ] == '1' OR $_SESSION[ 'groupu' ] == '2' )
      {
        //цвета
        $_POST[ 'text' ] = str_replace( '&amp;cGreen', '<span style="color:green">', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;cRed', '<span style="color:red">', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;cBlue', '<span style="color:blue">', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;cViolet', '<span style="color:violet">', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;cBrown', '<span style="color:brown">', $_POST[ 'text' ] );
        //закрывалка
        $_POST[ 'text' ] = str_replace( '&amp;cClose', '</span>', $_POST[ 'text' ] );
        //тестерские фразы (для баг-трекера)
        $_POST[ 'text' ] = str_replace( '&amp;отчет', '<br><img src="/img/bugtracker/otchet.gif"><br><hr>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;отчёт', '<br><img src="/img/bugtracker/otchet.gif"><br><hr>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;заголовок', '<b>Заголовок отчёта:</b>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;ожидаемый', '<b>Ожидаемый результат:</b>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;фактический', '<b>Фактический результат:</b>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;критикал', '<br><img src="/img/bugtracker/critical.gif"><br>', $_POST[ 'text' ] );
        $_POST[ 'text' ] = str_replace( '&amp;нормал', '<br><img src="/img/bugtracker/normal.gif"><br>', $_POST[ 'text' ] );
      } //$_SESSION[ 'groupu' ] == '1' OR $_SESSION[ 'groupu' ] == '2'
    include( 'exec/dbconnect.php' );
    $path = 'content/img-gpost/';
    if ( !@copy( $_FILES[ 'upimg' ][ 'tmp_name' ], $path . $_FILES[ 'upimg' ][ 'name' ] ) )
      {
        $timep = time();
        $q     = "INSERT INTO `gpost` (`id`, `iduser`, `idwall`, `text`, `date`, `bygroup`) VALUES (NULL, '" . $_SESSION[ 'id' ] . "', '" . $_SESSION[ 'clubwall' ] . "', '" . $_POST[ 'text' ] . "', '" . $timep . "', '" . $bygroup . "')"; // выбираем нашего 
        $q1    = $dbh1->prepare( $q ); // отправляем запрос серверу
        $q1->execute();
        $q1->fetch();
        header( 'Location: club' . $_SESSION[ 'clubwall' ] );
        exit( );
      } //!@copy( $_FILES[ 'upimg' ][ 'tmp_name' ], $path . $_FILES[ 'upimg' ][ 'name' ] )
    else
      {
        if ( strpos( $_FILES[ 'upimg' ][ 'name' ], '.jpg' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.png' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.jpeg' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.gif' ) )
          {
            $timep = time();
            $rand  = rand( "1000000000", "9999999999" );
            $path  = 'content/img-gpost/';
            if ( file_exists( $path . $rand . ".jpg" ) )
              {
                $rand = rand( "1000000000", "9999999999" );
              } //file_exists( $path . $rand . ".jpg" )
            $q  = "INSERT INTO `gpost` (`id`, `iduser`, `idwall`, `text`, `date`, `image`, `bygroup`) VALUES (NULL, '" . $_SESSION[ 'id' ] . "', '" . $_SESSION[ 'clubwall' ] . "', '" . $_POST[ 'text' ] . "', '" . $timep . "', '" . $path . $rand . ".jpg', '" . $bygroup . "')"; // выбираем нашего 
            $q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
            $q1->execute();
            $q1->fetch();
            //if (!@copy($_FILES['upimg']['tmp_name'], $path . $_FILES['upimg']['name'])){
            //	//echo $path.$_FILES['upimg']['name'].'.jpg // '.$path.$_FILES['upimg']['tmp_name'].'.jpg';
            //	header('Location: id'.$_SESSION['userwall']);
            //}else{
            imagejpeg( imagecreatefromstring( file_get_contents( $path . $_FILES[ 'upimg' ][ 'name' ] ) ), $path . $rand . ".jpg" );
            unlink( $path . $_FILES[ 'upimg' ][ 'name' ] );
            header( 'Location: club' . $_SESSION[ 'clubwall' ] );
          } //strpos( $_FILES[ 'upimg' ][ 'name' ], '.jpg' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.png' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.jpeg' ) || strpos( $_FILES[ 'upimg' ][ 'name' ], '.gif' )
        else
          {
            echo '<meta charset="utf-8">выберите картинку, а не что-то другое.';
            unlink( $path . $_FILES[ 'upimg' ][ 'name' ] );
            exit( );
          }
      }
  } //$_SESSION[ 'loginin' ] == '1'
else if ( $_SESSION[ 'loginin' ] != '1' )
  {
    echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
    exit( );
  } //$_SESSION[ 'loginin' ] != '1'
?>
