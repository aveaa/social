<?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
include( 'exec/header.php' );
include( 'exec/datefn.php' );
include( 'exec/leftmenu.php' );
$id = htmlentities( $_GET[ 'id' ], ENT_QUOTES );
$q  = "SELECT * FROM blog WHERE id='" . $id . "'"; // выбираем нашего 
$q1 = $dbh1->prepare( $q ); // отправляем запрос серверу
$q1->execute();
$user = $q1->fetch(); // ответ в переменную 
if ( $user[ 'id' ] == "" )
  {
    header( "Location: blank.php?id=4" );
    exit( );
  } //$user[ 'id' ] == ""
?>
 <link href="blog1.css" rel="stylesheet">
 
<a href="/blogs.php"><img src="/img/notif/blog-back.png"><br><br></a>

<h1><?php
echo $user[ 'name' ];
?></h1>
<h6> Автор: <?php
echo $user[ 'author' ];
?></h6>
<hr>
<?php
if ( $user[ 'imgur' ] == '1' )
  {
    echo '	
<img src="' . $user[ "photo1" ] . '" width="400" height="auto">
';
  } //$user[ 'imgur' ] == '1'
?>
<p> <?php
echo $user[ 'text' ];
?> </p>
</div>
</div>
</div>
<div>
<?php
include( 'exec/footer.php' );
?>
</div>
</body>
</html>