<div class="adm">
<fieldset><legend>Панель администратора:</legend>
<center>
<button OnClick="$('#add_ban').show(); $('#del_ban').hide();" class="buttonadm">Заблокировать игрока</button>
<button OnClick="$('#add_ban').hide(); $('#del_ban').show();" class="buttonadm">Разблокировать игрока</button>
</center>

<div id="add_ban">
<?php
include("add_ban.php");
?>
</div>

<div id="del_ban">
<?php
include("del_ban.php");
?>
</div>
</fieldset>
</div>