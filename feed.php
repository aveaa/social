<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
$qu4 = $dbh1->prepare( "SELECT * FROM clubsub WHERE id1=" . $_SESSION[ "id" ] );
$qu4->execute();
$subs = $qu4->fetch( PDO::FETCH_NUM );
$qu5  = $dbh1->prepare( "SELECT * FROM gpost WHERE idwall=" . implode( " OR idwall=", $subs ) );
$qu5->execute();
$posts = $qu5->fetchAll( PDO::FETCH_NUM );
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Новости</b></div>
  <?php
foreach ( $posts as &$post ):
?>
    <a name="FeedPostBoundary---<?= $post[ 3 ] ?>"></a>
    <div id="content-wall-post">
      <div id="content-wall-post-infoofpost">
        <div id="content-wall-post-authorofpost"><text style="margin-right: 3px;"><b><a href="">Группа</a></b></text>написала</div>
        <div id="content-wall-post-text"><?= $post[ 3 ] ?></div>
      </div>
    </div>
  <?php
endforeach;
?>
<div><?php
include "exec/footer.php";
?></div>
</body>
</html>