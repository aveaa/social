<?php
session_start();
include( 'exec/dbconnect.php' );
include( 'exec/check_user.php' );
include( 'exec/header.php' );
include( 'exec/leftmenu.php' );
include 'exec/datefn.php';
if ( $_GET[ 'id' ] != '' )
  {
    $id = $_GET[ 'id' ];
  } //$_GET[ 'id' ] != ''
else
  {
    echo 'error ID';
    exit( );
  }
if ( $_GET[ 'id' ] == '0' )
  {
    echo "error ID";
    exit( );
  } //$_GET[ 'id' ] == '0'
if ( $_GET[ 'sort_by' ] == "date1" )
  {
    $qs = $dbh1->prepare( "SELECT * FROM galbums WHERE `aid` = '" . $id . "'" );
  } //$_GET[ 'sort_by' ] == "date1"
elseif ( $_GET[ 'sort_by' ] == "date2" )
  {
    $qs = $dbh1->prepare( "SELECT * FROM galbums WHERE `aid` = '" . $id . "' ORDER BY id DESC" );
  } //$_GET[ 'sort_by' ] == "date2"
elseif ( empty( $_GET[ 'sort_by' ] ) || $_GET[ 'sort_by' ] == "random" )
  {
    $qs = $dbh1->prepare( "SELECT * FROM galbums WHERE `aid` = '" . $id . "' ORDER BY RAND()" );
  } //empty( $_GET[ 'sort_by' ] ) || $_GET[ 'sort_by' ] == "random"
$qs->execute();
$userr = $dbh1->prepare( "SELECT * FROM club WHERE id = '" . $id . "'" );
$userr->execute();
$userrr = $userr->fetch();
?>
<div id="content-infoname"><b><?php
echo '<a href="club' . $userrr[ 'id' ] . '">' . $userrr[ 'name' ] . '</a>';
?> » Альбомы</b><?php
if ( $_SESSION[ 'id' ] == $userrr[ 'authorid' ] )
  {
?><text style="font-size: 8pt; color: #aaa; float: right;"><a href="galbum_add.php?id=<?php
    echo $id;
?>">Создать альбом</a></text><?php
  } //$_SESSION[ 'id' ] == $userrr[ 'authorid' ]
?></div>
<br>
<?php
$qalbumscount = $dbh1->prepare( "SELECT COUNT(1) FROM galbums WHERE `aid` = '" . $id . "'" );
$qalbumscount->execute();
$albcount = $qalbumscount->fetch();
$albcount = $albcount[ 0 ];
if ( $albcount == '1' )
  {
    $albcouunt = (string) $albcount . " альбом";
  } //$albcount == '1'
elseif ( $albcount == '2' OR $albcount == '3' OR $albcount == '4' )
  {
    $albcouunt = (string) $albcount . " альбома";
  } //$albcount == '2' OR $albcount == '3' OR $albcount == '4'
else
  {
    $albcouunt = (string) $albcount . " альбомов";
  }
echo '<b>' . $albcouunt . '</b><br>';
?>
<div id="content-main-gray">

<?php
while ( $alb = $qs->fetch() )
  {
    $qg = $dbh1->prepare( "SELECT * FROM galbums WHERE `id` = '" . $alb[ 'id' ] . "'" );
    $qg->execute();
    $album       = $qg->fetch();
    $qphotocount = $dbh1->prepare( "SELECT COUNT(1) FROM photo WHERE `galbum` = '" . $album[ 'id' ] . "'" );
    $qphotocount->execute();
    $phocount = $qphotocount->fetch();
    $phocount = $phocount[ 0 ];
    if ( $phocount == '1' )
      {
        $photocouunt = (string) $phocount . " фотография";
      } //$phocount == '1'
    elseif ( $phocount == '2' OR $phocount == '3' OR $phocount == '4' )
      {
        $photocouunt = (string) $phocount . " фотографии";
      } //$phocount == '2' OR $phocount == '3' OR $phocount == '4'
    else
      {
        $photocouunt = (string) $phocount . " фотографий";
      }
    $qphoto = $dbh1->prepare( "SELECT * FROM photo WHERE `galbum` = '" . $album[ 'id' ] . "' ORDER BY id LIMIT 1" );
    $qphoto->execute();
    $photo = $qphoto->fetch();
    if ( $phocount == "0" )
      {
        $photoalbum = "img/nophoto.jpg";
      } //$phocount == "0"
    else
      {
        $photoalbum = $photo[ 'image' ];
      }
    echo '<div id="content-main-gray-content">
		<table border="0" style="font-size: 11px;">
		<tbody>	
			<tr>
				<td width="200" style="vertical-align: top;">
					<img src="avatar.php?image=' . $photoalbum . '">
				</td>
				<td style="vertical-align: 0;">
					<div id="content-main-gray-content-info"><a href="album-' . $album[ 'id' ] . '"><h4><b>' . $album[ 'name' ] . '</b></h4></a><span><br>' . $photocouunt . '<br>Создан ' . zmdate( $album[ 'date' ] ) . '</span><br>' . $album[ 'note' ] . '</div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>';
  } //$alb = $qs->fetch()
?>
	
</div>
</div>
<?php
include( 'exec/footer.php' );
?>
</body>
</html>