<?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
if ( $_SESSION[ 'loginin' ] == '1' )
  {
    if ( $_POST[ 'text' ] == NULL )
      {
        echo '<meta charset="utf-8">Проверьте, вы вообще что-то писали на поле?<meta http-equiv="refresh" content="3;post' . $_POST[ 'id' ] . '">';
        exit( );
      } //$_POST[ 'text' ] == NULL
    //$_POST['text'] = str_replace('<', '&#60;', $_POST['text']);
    //$_POST['text'] = str_replace('>', '&#62;', $_POST['text']);
    $_POST[ 'id' ]    = htmlentities( $_POST[ 'id' ], ENT_QUOTES );
    $_POST[ 'id' ]    = str_replace( "\n", '<br>', $_POST[ 'id' ] );
    $_POST[ 'text' ]  = htmlentities( $_POST[ 'text' ], ENT_QUOTES );
    $_POST[ 'text' ]  = str_replace( "\n", '<br>', $_POST[ 'text' ] );
    $_POST[ 'topic' ] = htmlentities( $_POST[ 'topic' ], ENT_QUOTES );
    $_POST[ 'topic' ] = str_replace( "\n", '<br>', $_POST[ 'text' ] );
    include( 'exec/dbconnect.php' );
    if ( isset( $_SESSION[ 'id' ] ) )
      {
        $id = $_SESSION[ 'id' ];
      } //isset( $_SESSION[ 'id' ] )
    if ( isset( $_POST[ 'id' ] ) )
      {
        $idpost = $_POST[ 'id' ];
      } //isset( $_POST[ 'id' ] )
    if ( isset( $_POST[ 'text' ] ) )
      {
        $text = $_POST[ 'text' ];
      } //isset( $_POST[ 'text' ] )
    $q  = "INSERT INTO `messages` (`id`, `id1`, `id2`, `topic`, `text`, `date`) VALUES (NULL, '" . $id . "', '" . $idpost . "', '" . $_POST[ 'topic' ] . "', '" . $text . "', '" . time() . "')"; // добавляем коммент 
    $q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
    $q1->execute();
    $q1->fetch();
    header( 'Location: messages.php' );
  } //$_SESSION[ 'loginin' ] == '1'
else if ( $_SESSION[ 'loginin' ] != '1' )
  {
    echo '<meta charset="utf-8">Хакеры? Интересно.<meta http-equiv="refresh" content="3;blank/..">';
    exit( );
  } //$_SESSION[ 'loginin' ] != '1'
?>
