<hr>
<center><font size="+1"><b> Разблокировать игрока: </b></font></center>
<br>
<table width="100%">
<tr>
<td>Введите имя игрока:</td>
<td>
<?php
print '<form action="'.$faction.'"  method="post">';
print '<input type="text" class="txt1" name="unban_name">';
?>
</td>
</tr>
</table><br>
<center>
<button name="del_ban" class="buttonadm save">Разблокировать</button>
<a OnClick="$('#add_ban').hide(); $('#del_ban').hide();" class="buttonadm delete">Отмена</a>
</center>
</form>