<?PHP
function table_user($mysqli)
{
	$req = "CREATE TABLE IF NOT EXISTS `db_rush01`.`user` ( `user_id` INT NOT NULL AUTO_INCREMENT ,  `user_login` VARCHAR(50) NOT NULL , 
	`user_pass` VARCHAR(128) NOT NULL ,    PRIMARY KEY  (`user_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	$req = "INSERT INTO `db_rush01`.`user` (`user_id`, `user_login`, `user_pass`) VALUES ('1', 'a',
	'8aca2602792aec6f11a67206531fb7d7f0dff59413145e6973c45001d0087b42d11bc645413aeff63a42391a39145a591a92200d560195e53b478584fdae231a')";
	mysqli_query($mysqli, $req);
	$req = "INSERT INTO `db_rush01`.`user` (`user_id`, `user_login`, `user_pass`) VALUES ('2', 'b',
	'b0e869f9707a0ceb019795aa8b2c2b06fbee8dc4207da822828b1a1348e9eeb9b38eb12517c150cbce3cd653c09d3314c7dfbf53a54358b97f1d4c0f6b68103f')";
	mysqli_query($mysqli, $req);
	return (0);
}

function table_chat($mysqli)
{
	$req = "CREATE TABLE IF NOT EXISTS `db_rush01`.`chat` ( `chat_id` INT NOT NULL AUTO_INCREMENT , `chat_user_id` INT NOT NULL , `chat_game_id` INT NOT NULL DEFAULT '0' , `chat_text` LONGTEXT NOT NULL , PRIMARY KEY (`chat_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	return (0);
}

function table_game($mysqli)
{
	$req = "CREATE TABLE IF NOT EXISTS `db_rush01`.`game` ( `game_id` INT NOT NULL AUTO_INCREMENT , `game_user_id1` INT NOT NULL , `game_user_id2` INT NOT NULL DEFAULT '0' , `game_lock` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`game_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	return (0);
}

function table_ship($mysqli)
{
	$req = "CREATE TABLE `db_rush01`.`ship` ( `ship_id` INT NOT NULL AUTO_INCREMENT , `ship_user_id` INT NOT NULL , `ship_game_id` INT NOT NULL , `ship_pos_x` INT NOT NULL , `ship_pos_y` INT NOT NULL , `ship_pts_coque` INT NOT NULL , `ship_shield` INT NOT NULL , `ship_color` VARCHAR(255) NOT NULL , `ship_dir` INT NOT NULL, `ship_type` INT NOT NULL , `ship_wpn` INT NOT NULL , `ship_refresh_j1` INT NOT NULL DEFAULT '0', `ship_refresh_j2` INT NOT NULL DEFAULT '0', PRIMARY KEY (`ship_id`))";
	if ($mysqli->query($req) == false)
		return (1);
	$req = "INSERT INTO `ship` (`ship_id`, `ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES (NULL, '1', '1', '2', '2', '5', '5', 'red', '0', '1', '1');";
	mysqli_query($mysqli, $req);
	return (0);
}

function create_database()
{
	$mysqli = mysqli_connect('localhost', 'root', 'root', "db_rush01");
	if (table_user($mysqli) == 1)
		return (1);
	if (table_chat($mysqli) == 1)
		return (1);
	if (table_game($mysqli) == 1)
		return (1);
	if (table_ship($mysqli) == 1)
		return (1);
	return (0);
}
?>
