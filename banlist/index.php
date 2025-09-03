<?php
if(!defined('DATALIFEENGINE')) die("Нет доступа!");

include("config.php");
$connect_db;
mysql_select_db($db_name);
?>

<?php
if(isset($_POST["del_ban"])){
	if($usergroup == '1'){
$unban_name = mysql_real_escape_string($_POST["unban_name"]);
mysql_query("DELETE FROM $db_table WHERE name='$unban_name'");
}else{
echo "Ошибка! У вас нет доступа!";
};
};

if(isset($_POST['add_ban'])){
	if($usergroup == '1'){
$ban_name = mysql_real_escape_string($_POST["ban_name"]);
$ban_reason = mysql_real_escape_string($_POST["ban_reason"]);
$time = time();
if(mysql_real_escape_string($_POST['perm']) == "ban_perm"){
$ban_time = '0';
}else{
$ban_time = time();
$sutk = mysql_real_escape_string($_POST["sutk"]);
$sutk = $sutk * 24 * 60 * 60;
$hour = mysql_real_escape_string($_POST["hour"]);
$hour = $hour * 60 * 60;
$min = mysql_real_escape_string($_POST["min"]);
$min = $min * 60;
$ban_time = $ban_time + $sutk + $hour + $min;
};
mysql_query("INSERT INTO $db_table (name, reason, admin, time, temptime) VALUES ('$ban_name', '$ban_reason', 'Server', '$time', '$ban_time')")or die(mysql_error());
}else{
echo "Ошибка! У вас нет доступа!";
}
}

$cost_unbant = substr($cost_unban, -2);
if($cost_unbant > 10 and $cost_unbant < 15){$term = 'ей';}else{        
$cost_unbant = substr($cost_unbant, -1);
if($cost_unbant == 0) {$term = 'ей';}
if($cost_unbant == 1 ) {$term = 'ь';}
if($cost_unbant > 1 ) {$term = 'я';}
if($cost_unbant > 4 ) {$term = 'ей';}}

if(isset($_POST['search'])){
$part_search = mysql_real_escape_string($_POST['search_edit']);
$banlist = mysql_query("SELECT * FROM $db_table WHERE name LIKE '%$part_search%' ORDER BY time DESC");
}
?>

<div id="banlist">
<?php
if($usergroup == "1"){
include("admin_panel.php");
}else{};
print '<br>';
?>
<form method="post" class="subscription_email">
<p align="right">
<input class="rss_fieldn" type="text" name="search_edit">
<input type="submit" class="rss_button" name="search" value="Искать">
</p>
</form><br>
<?php
print '<br>';
print '<div id="message"></div>';
print '<br>';
print '<table cellspacing="0" width="100%">';
print '<th>Игрок</th>';
print '<th>Заблокировал</th>';
print '<th>Причина</th>';
print '<th>Дата блокировки</th>';
print '<th>Дата разблокировки</th>';

print '<tfoot><tr>
<th></th>
<th></th>
<th></th>
<th></th>
</tr></tfoot>';

$sql = "SELECT name FROM $db_table WHERE `name` = '$username'";
$sql = mysql_query($sql);
if(mysql_fetch_array($sql)){
$sql = mysql_query("SELECT admin FROM $db_table WHERE name='$username'");
$adm_ban = mysql_result($sql,0);
$sql = mysql_query("SELECT reason FROM $db_table WHERE name='$username'");
$res_ban = mysql_result($sql,0);
$sql = mysql_query("SELECT temptime FROM $db_table WHERE name='$username'");
$time_ban = mysql_result($sql,0);
$sql = mysql_query("SELECT time FROM $db_table WHERE name='$username'");
$time_banned = mysql_result($sql,0);
$time_banned = Date("H:i d.m.Y", $time_banned);
if($time_ban == '0' || $time_ban == ''){$time_ban = '<font color="red">Перманент</font>';}else{$time_ban = Date("H:i d.m.Y", $time_ban);}
print '<tr><td style="background: #ffdbdb;" colspan="5">';
print '<p class="ban_mes"> Мы сожалеем, но ваш аккаунт - '.$username.' заблокирован! </p>';
print '<p align="left"><b>К сожалению ваш аккаунт заблокирован модератором!</b></p>';
print '<p align="left"><b>Ваш ник: '.$username.'</b></p>';
print '<p align="left"><b>Заблокировал: '.$adm_ban.'</b></p>';
print '<p align="left"><b>Причина: '.$res_ban.'</b></p>';
print '<p align="left"><b>Дата блокировки: '.$time_banned.'</b></p>';
print '<p align="left"><b>Дата окончания блокировки: '.$time_ban.'</b></p>';
print '<p align="left"><b><font>Вы можете дождаться разблокировки или приобрести платный разбан.</font> <form id="unban_player" method="post"><input type="hidden" id="username" value="'.$username.'">Стоимость разблокировки '.$cost_unban.' рубл'.$term.'</form></b></p>';
print '</td></tr>';
}else{
print '<tr><td style="background: #eeffde;" colspan="5">';
print '<p class="ban_mes"> Вы не найдены в списке заблокированных! </p>';
print '<p align="left"><b>Если вы видите это сообщение - это значит, что ваш аккаунт в данный момент не заблокирован.</b></p>';
print '<p align="left"><b>Соблюдайте <a href="/rules.html"><font color="orange">правила проекта</font></a>, что бы никогда сюда не попасть!</b></p>';
print '</td></tr>';
};

if(!isset($_POST['search'])){
$banlist = mysql_query("SELECT * FROM $db_table ORDER BY time DESC");
}
while($bans = mysql_fetch_array($banlist)){

$tmpban = $bans['temptime'];
print '
<tr>
<td><b><a href="/user/'.$bans['name'].'/">'.$bans['name'].'</a></b></td>
<td><b><a href="/user/'.$bans['admin'].'/">'.$bans['admin'].'</a></b></td>
<td><b>'.$bans['reason'].'</b></td>
<td><b>'.Date("H:i d.m.Y", $bans['time']).'</b></td>';
if($tmpban == '0'){
print '
<td><b><font color="red">Перманент</font></b></td>
';
}else{
print '
<td><b>'.Date("H:i d.m.Y", $tmpban).'</b></td>';};
print '</tr>';
};
print '</table>';
?>
</div>
<?php
mysql_close($connect_db);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="/banlist/styles.css">

<script type="text/javascript">
function buy_unban() {
    var username = $("#username").val();
       $.ajax({
                type: "POST",
                url: "/banlist/unban.php",
                data: {"username" : username},
                success: function(html) {
                        $("#message").empty();
                        $("#message").append(html);
                }
        });
}
</script>

<script>
$('#add_ban').hide(); $('#del_ban').hide();
</script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="/banlist/jquery.leanModal.min.js"></script>
		<script type="text/javascript">
			$(function() {
    			$('a[rel*=leanModal]').leanModal({ top : 200 });		
			});
		</script>
<script>
function perml() {
if (document.getElementById("checkperm").checked) {
document.getElementById("tbnums").disabled = true;
document.getElementById("tbnumh").disabled = true;
document.getElementById("tbnumm").disabled = true;
}
else {
document.getElementById("tbnums").disabled = false;
document.getElementById("tbnumh").disabled = false;
document.getElementById("tbnumm").disabled = false;
}
}
</script>

</head>

<body>
		<div id="test">
			<center><p class="ban_mes">Скрипт - Онлайн банлист!</p></center>
			<p><b>Автор:</b> Алмазик, также известный как - Almazik0_o, AlmazikLife.</p>
			<br>
			<p><b><font size="+1">Контакты:</font></b></p>
			<p><b>[В]Контакте:</b> vk.com/Almazik0_o</p>
			<p><b>Skype:</b> Almazik0_o</p>
			<p><b>Почта:</b> x3me32@mail.ru</p>
			<p align="right"><b>С уважением,</b> Алмазик!</p>
		</div>
</body>
</html>