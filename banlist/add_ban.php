<hr>
<center><font size="+1"><b> Заблокировать игрока: </b></font></center>
<br>
<form action="<? $faction ?>"  method="post">
<table width="100%">
<tr><td>Имя игрока:</td> <td><input class="txt1" name="ban_name" type="text"></td></tr>
<tr><td>Причина:</td> <td><input class="txt1" name="ban_reason" type="text"></td></tr>
<tr><td>Длительность блокировки:</td> <td>
<input class="txt1" id="tbnums" name="sutk" type="text" value="Сутки" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}">  
<input class="txt1" id="tbnumh" name="hour" type="text" value="Часы" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}">  
<input class="txt1" id="tbnumm" name="min" type="text" value="Минуты" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}">
<input type="checkbox" id="checkperm" name="perm" OnClick="perml()" value="ban_perm">Навсегда<Br>
</td></tr>
</table>
<br><br>
<center>
<button name="add_ban" class="buttonadm save">Заблокировать</button>
</form>
<a OnClick="$('#add_ban').hide(); $('#del_ban').hide();" class="buttonadm" style="">Отмена</a>

</center>