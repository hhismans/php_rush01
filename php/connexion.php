<?PHP
//error_reporting(0);
include "install.php";
$mysqli = new mysqli("localhost","root","root");
$mysqli->query("CREATE DATABASE IF NOT EXISTS `db_rush01`");
if ($mysqli->query("SHOW TABLES FROM `db_rush01`")->num_rows < 2)
{
	if(create_database() == 1)
	{
		echo "ERROR";
		return;
	}
}
$mysqli = new mysqli("localhost","root","root", "db_rush01");
?>