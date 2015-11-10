<?php
	$servername = "127.0.0.1";
	$username = "bpiharvest_admin";
	$password = "h4rv351-";
	$dbname = "bpiharvester";

	$conn = mysql_connect($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
		echo
			'<fieldset class="middlePart middleErrorMessage">
				<legend>logs ERROR!</legend>'.
				'Connection failed: ' . $conn->connect_error
			.'</fieldset>'
		;
	}
	else
	{
		mysql_select_db($dbname, $conn);

		if(isset($_GET['flag']) && is_numeric($_GET['flag']) && intval($_GET['flag'])<=15 && intval($_GET['flag'])>0)
		{
			$ERROR		= bindec("0b0001");
			$WARNING	= bindec("0b0010");
			$INFO			= bindec("0b0100");
			$DEBUG		= bindec("0b1000");
			$MASKED		= "";
			/*echo
				"<fieldset class=\"middlePart middleWarningMessage\">
					<legend>flags</legend>".
					$_GET['flag']."<br />".
					$ERROR."<br />".
					$WARNING."<br />".
					$INFO."<br />".
					$DEBUG."<br />"
				."</fieldset>"
			;
			echo
				"<fieldset class=\"middlePart middleWarningMessage\">
					<legend>masks</legend>".
					($_GET['flag'] & $ERROR)."<br />".
					($_GET['flag'] & $WARNING)."<br />".
					($_GET['flag'] & $INFO)."<br />".
					($_GET['flag'] & $DEBUG)."<br />"
				."</fieldset>"
			;*/
			if(($_GET['flag'] & $ERROR) != 0)
				$MASKED .= " AND type != \"[ERROR]\"";
			if(($_GET['flag'] & $WARNING) != 0)
				$MASKED .= " AND type != \"[WARNING]\"";
			if(($_GET['flag'] & $INFO) != 0)
				$MASKED .= " AND type != \"[INFO]\"";
			if(($_GET['flag'] & $DEBUG) != 0)
				$MASKED .= " AND type != \"[DEBUG]\"";
			$MASKED = substr($MASKED, 5);
			/*echo
				"<fieldset class=\"middlePart middleWarningMessage\">
					<legend>MASKED</legend>".
					$MASKED
				."</fieldset>"
			;*/
			$sql = 'SELECT * FROM logs WHERE '.$MASKED.' ORDER BY ID DESC LIMIT 20';
		}
		else
			$sql = 'SELECT * FROM logs ORDER BY ID DESC LIMIT 20';

		// on envoie la requête
		$req = mysql_query($sql);
		if(!$req)
		{
			echo
				'<fieldset class="middlePart middleErrorMessage">
					<legend>logs ERROR!</legend>'.
					mysql_error().'<br />'.$sql
				.'</fieldset>'
			;
		}
		else
		{
			echo'<table style=\"width:100%\">';
			$i = 0;
			echo '<tr>';
			while ($i < mysql_num_fields($req))
			{
				echo '<th>';
				$meta = mysql_fetch_field($req, $i);
				echo $meta->name;
				echo "</th>";
				$i++;
			}
			echo '</tr>';
			while($data = mysql_fetch_assoc($req))
			{
				echo '<tr>';
				echo '<td style="white-space: nowrap;text-align: right;">'.$data['id'].'</td>';
				echo '<td style="white-space: nowrap;text-align: right;">'.$data['date'].'</td>';
				echo '<td style="white-space: nowrap;text-align: right;">'.$data['thread'].'</td>';
				echo '<td style="white-space: nowrap;">'.$data['type'].'</td>';
				echo '<td style="width: 100%;">'.str_replace('\n', '<br />', $data['message']).'</td>';
				echo '</tr>';
			}

			/*while($data = mysql_fetch_assoc($req))
			{
				echo "<tr>".'<td>'.$data['id'].'</td>'.'<td>'.$data['date'].'</td>'.'<td>'.$data['thread'].'</td>'.'<td>'.$data['type'].'</td>'.'<td>'.$data['message'].'</td>'."</tr>";
				echo "<tr>";
				// on affiche les informations de l'enregistrement en cours
				$key = key($data);
				foreach ($data as $key => $value)
				{
					//echo '<td>'.$key.' '.$value.'</td>';
					echo '<td>'.$value.'</td>';
				}
				echo "</tr>";
			}*/
			echo '</table>';
		}
		// on ferme la connexion à mysql
		mysql_close();
	}
?>
