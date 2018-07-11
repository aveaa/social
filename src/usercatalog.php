<?php
session_start();
include "exec/dbconnect.php";
include "exec/check_user.php";
$qu4 = $dbh1->prepare( "SELECT * FROM users WHERE id = '" . $_GET[ 'idu' ] . "'" );
$qu4->execute();
$user = $qu4->fetch();
include "exec/datefn.php";
include "exec/header.php";
include "exec/leftmenu.php";
?>
<div id="content-infoname"><b>Каталог пользователей</b></div>
<table border="0" style="font-size:11px;">
<tr>
<td>
ID
</td>
<td>
Ф.И.
</td>
<td>
Права
</td>
<td>
О пользователе
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
' . $users[ 'aboutuser2' ] . '
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