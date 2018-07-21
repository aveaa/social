<form action="register.php" method="post">
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;vertical-align:top;"><div style="float:right;padding-right:7px;color:#777;"><img src="img/logo_reg.png"></div></td><td style="vertical-align:0;"><b>l-lacker Social</b> &mdash; открытая социальная сеть на базе движка <b>OpenVKCi</b>. Не является точным клоном ВКонтакте. <span style="color:#000;font-style:italic;">На данный момент этот проект, находится в открытом доступе на сайте Github: <a href="https://github.com/l-lsoc/social" target="_blank">https://github.com/l-lsoc/social</a></span></td></tr>
</table>
<br>
<table border="0" style="font-size:11px;">
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Имя пользователя (логин):</div></td><td><input style="width:380px;" type="text" name="reg_login" id="text" placeholder="потребуется для входа"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Ваше имя:</div></td><td><input style="width:380px;" type="text" name="reg_fname" id="text"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Ваша фамилия:</div></td><td><input style="width:380px;" type="text" name="reg_lname" id="text"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пол:</div></td><td><select style="width:380px;" name="reg_gender" style="width:185px;"><option value="1">Мужской</option>
  <option value="2">Женский</option>
  <option value="0">Не указано</option></select></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Пароль:</div></td><td><input style="width:380px;" type="password" name="reg_fpass" id="text" placeholder="потребуется для входа"></td></tr>
<tr><td style="width:150px;"><div style="float:right;padding-right:7px;color:#777;">Повторите пароль:</div></td><td><input style="width:380px;" type="password" name="reg_spass" id="text" placeholder="потребуется для входа"></td></tr>
</table><br>
<div style="margin-left:157px;"><input type="submit" id="button" value="Зарегистрироваться" name="reg_subm"></div><br>
<div style="margin-left:157px;">Уже в социальной сети?<a style="margin-left:7px;" href="login.php">Авторизоваться</a></div>
</form>