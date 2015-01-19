<?php
$host = "localhost"; // sql200.byethost3.com
$username = "root"; // b3_9018955
$pass = ""; // 92702689
$dbname = "inf205"; // b3_9018955_my
$condb = mysql_connect($host, $username, $pass);
if (!$condb) echo "Host can not be connected:<br>" .mysql_error()."<br />";
$sedb = mysql_select_db($dbname, $condb);
if (!$sedb) echo "Database can not be selected:<br>" .mysql_error()."<br />";
mysql_query("SET NAMES 'UTF8'");
?>