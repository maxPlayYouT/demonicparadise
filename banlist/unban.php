<meta charset="utf-8" /> 
<?php
include("config.php");
$connect_db;
mysql_select_db($db_name);
$username = mysql_real_escape_string($_POST['username']);
if($username == ''){
echo "Ошибка доступа!";
}else{
$sql = mysql_query("SELECT realmoney FROM dle_users WHERE name='$username'");
$realmoney = mysql_result($sql,0);
if($realmoney >= $cost_unban){
mysql_query("DELETE FROM $db_table WHERE name='$username'");
mysql_query("UPDATE dle_users SET realmoney=realmoney-$cost_unban WHERE name='$username'")or die(mysql_error());
echo "<div class='banlist_payout'> Ваш аккаунт успешно разблокирован! Пожалуйста соблюдайте правила проекта! </div>";
	}else{
echo "<div class='banlist_error'> На вашем счету не достаточно средств, пожалуйста пополните счёт через личный кабинет! </div>";
	}
}
mysql_close($connect_db);
?>