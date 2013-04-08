<?php
/**********************************************************************
 *Contains all the basic Configuration
 *dbHost = Host of your MySQL DataBase <span id="IL_AD3" class="IL_AD">Server</span>... Usually it is localhost
 *dbUser = Username of your DataBase
 *dbPass = Password of your DataBase
 *dbName = Name of your DataBase
 **********************************************************************/
$host="207.171.8.35"; // Host name 
$username="greenbracket"; // Mysql username 
$password="9145707"; // Mysql password 
$db_name="token"; // Database name 
$tbl_name=""; // Table name

// Connect to server and select databse.
$link = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

?>