<?php
session_start();
include "exec/dbconnect.php";
if($_SESSION['loginin'] == "1"){
header("Location: index.php");
exit();
}else{
if($_POST['reg_subm']){
$_POST['reg_login'] = str_replace(' ','',$_POST['reg_login']);
if($_POST['reg_login'] == NULL){
echo '<meta charset="utf-8">логин пуст';
exit();
}
$checkquery = $dbh1->prepare("SELECT * FROM users WHERE login = '".$_POST['reg_login']."'");
$checkquery->execute();
$resultcheck = $checkquery->fetch();
if($resultcheck['login'] == $_POST['reg_login']){
echo '<meta charset="utf-8">пользователь с таким логином уже существует!';
exit();
}
$_POST['reg_fpass'] = str_replace(' ','',$_POST['reg_fpass']);
$_POST['reg_spass'] = str_replace(' ','',$_POST['reg_spass']);
$_POST['reg_fpass'] = md5($_POST['reg_fpass']);
$_POST['reg_spass'] = md5($_POST['reg_spass']);
if($_POST['reg_fpass'] == NULL || $_POST['reg_spass'] == NULL){
echo '<meta charset="utf-8">пароль пуст';
exit();
}
if($_POST['reg_fpass'] != $_POST['reg_spass']){
echo '<meta charset="utf-8">пароли не совпадают';
exit();
}
$_POST['reg_fname'] = htmlentities($_POST['reg_fname'],ENT_QUOTES);
$_POST['reg_fname'] = trim($_POST['reg_fname']);
$_POST['reg_fname'] = mb_strtolower($_POST['reg_fname'], 'utf-8');
$_POST['reg_fname'] = mb_convert_case($_POST['reg_fname'], MB_CASE_TITLE, 'UTF-8');
$_POST['reg_fname'] = str_replace(' ','-',$_POST['reg_fname']);
$_POST['reg_lname'] = htmlentities($_POST['reg_lname'],ENT_QUOTES);
$_POST['reg_lname'] = trim($_POST['reg_lname']);
$_POST['reg_lname'] = mb_strtolower($_POST['reg_lname'], 'utf-8');
$_POST['reg_lname'] = mb_convert_case($_POST['reg_lname'], MB_CASE_TITLE, 'UTF-8');
$_POST['reg_lname'] = str_replace(' ','-',$_POST['reg_lname']);
if($_POST['reg_fname'] == NULL || $_POST['reg_lname'] == NULL){
echo '<meta charset="utf-8">Напишите имя и/или фамилию.';
exit();
}
$q = "INSERT INTO `users` (`id`, `name`, `surname`, `gender`, `login`, `password`, `regdate`) VALUES (NULL, '".$_POST['reg_fname']."', '".$_POST['reg_lname']."', '".$_POST['reg_gender']."', '".$_POST['reg_login']."', '".$_POST['reg_fpass']."', '".time()."')";
$q1 = $dbh1->prepare($q);
$q1->execute();
$q1->fetch();
$q2 = $dbh1->prepare("SELECT * FROM users WHERE login = '".$_POST['reg_login']."'");
$q2->execute();
$us = $q2->fetch();
$_SESSION['loginin'] = '1';
$_SESSION['login'] = $_POST['reg_login']; 
$_SESSION['id'] = $us['id'];
$_SESSION['admin'] = $us['groupu'];
$_SESSION['pass'] = $_POST['reg_fpass'];
$_SESSION['groupu'] = $us['groupu'];
header('Location: id'.$_SESSION['id']);
}else{
echo '<meta charset="utf-8">пожалуйста, напишите инвайт-код!';
exit();
}
}
include "exec/header.php";
include "exec/leftmenu.php";
include "exec/form_register.php";
?>
</div>
</div>
</div>
<div><?php include "exec/footer.php"; ?></div>
</body>
</html>
<?php
}
?>
