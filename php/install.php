<?PHP
function table_user($mysqli)
{
	$req = "CREATE TABLE IF NOT EXISTS `db_rush01`.`user` ( `user_id` INT NOT NULL AUTO_INCREMENT ,  `user_login` VARCHAR(50) NOT NULL , 
	`user_pass` VARCHAR(128) NOT NULL ,    PRIMARY KEY  (`user_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	$req = "INSERT INTO `db_rush01`.`user` (`user_id`, `user_login`, `user_pass`) VALUES (NULL, 'a',
	'8aca2602792aec6f11a67206531fb7d7f0dff59413145e6973c45001d0087b42d11bc645413aeff63a42391a39145a591a92200d560195e53b478584fdae231a')";
	mysqli_query($mysqli, $req);
	return (0);
}

function table_chat($mysqli)
{
	$req = "CREATE TABLE `db_rush01`.`chat` ( `chat_id` INT NOT NULL AUTO_INCREMENT , `chat_user_id` INT NOT NULL , `chat_game_id` INT NOT NULL , `chat_text` LONGTEXT NOT NULL , PRIMARY KEY (`chat_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	return (0);
}

function create_database()
{
	$mysqli = mysqli_connect('localhost', 'root', 'root', "db_rush01");
	if (table_user($mysqli) == 1)
		return (1);
	if (table_chat($mysqli) == 1)
		return (1);
	return (0);
}
?>
