<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
$qu = $dbh1->prepare( "SELECT * FROM club WHERE id = '" . $_GET[ 'idg' ] . "'" );
$qu->execute();
$user = $qu->fetch();
?>
<div id="content-infoname"><b>Каталог сообществ</b></div>
<table border="0" style="font-size:11px;">
<tr>
<td>
ID
</td>
<td>
Название
</td>
<td>
Описание
</td>
</tr>
<?php
$qu = $dbh1->prepare( "SELECT * FROM club" );
$qu->execute();
while ( $users = $qu->fetch() )
  {
    echo '<tr>
<td>
' . $users[ 'id' ] . '
</td>
<td>
<a href="club' . $users[ 'id' ] . '">' . $users[ 'name' ] . '</a>
</td>
<td>
' . $users[ 'about' ] . '
</td>
</tr>';
  } //$users = $qu->fetch()
?>
</table>
<br>
<br>
<div><?php
include "exec/footer.php";
?></div>
</body>
</html>