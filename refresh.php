<?php
	$servername = "127.0.0.1";
	$username = "bpiharvest_admin";
	$password = "h4rv351-";
	$dbname = "bpiharvester";

/*
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		echo "ERROR";
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		echo "SUCCESS";
	}
*/

	$conn = mysql_connect($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
		echo "ERROR";
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		echo "SUCCESS";
	}
	mysql_select_db($dbname, $conn);
/*	$sql = 'SHOW DATABASES';

	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req))
	{
		// on affiche les informations de l'enregistrement en cours
		$key = key($data);
		foreach ($data as $key => $value)
		{
			echo '<p>'.$key.' '.$value.'</p>';
		}
	}*/

	$sql = 'SHOW TABLES';

	// on envoie la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req))
	{
		// on affiche les informations de l'enregistrement en cours
		$key = key($data);
		foreach ($data as $key => $value)
		{
			echo '<p>'.$key.' '.$value.'</p>';
		}
	}

	// on ferme la connexion à mysql
	mysql_close();
?>
