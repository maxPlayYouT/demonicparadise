<?php
/* Подключение к базе данных */
$db_name = "demonicparadise"; // Название
$db_user = "dbdemonicparadise"; // Пользователь
$db_pass = 'yTd3D?4Lqs3W'; // Пароль
$db_host = "localhost"; // Хост
$db_table = "banlist"; // Таблица банлиста
$connect_db = mysql_connect($db_host, $db_user, $db_pass)or die('Ошибка, невозможно соединиться с базой данных: ' . mysql_error()); //не трогать
/* Подключение к базе данных */

/* Занесение данных в переменные */
$username = $member_id['name'];
$faction = $_SERVER['REQUEST_URI'];
$cost_unban = '100'; // Стоимость разблокировки аккаунта
$usergroup = $member_id['user_group'];
/* Занесение данных в переменные */
?>