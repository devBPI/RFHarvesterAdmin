<?php
	switch($_GET['command'])
	{
		case 'kill':
			exec("crontab -r");
		break;
		default:
			/*$output = shell_exec('ls -la');
			echo "<pre>$output</pre>";
			echo "<br />";
			$output = shell_exec("cat cron/cron.cron");
			echo "<pre>$output</pre>";
			echo "<br />";*/

			/*$output = shell_exec("crontab cron/cron.cron");
			echo "<pre>$output</pre>";
			echo "<br />";
			echo exec("crontab /var/www/php/cron/cron.cron");
			echo "<br />";*/
			/*exec("crontab -l", $crons);
			if(!empty($crons))
			{
				foreach ($crons as $cron)
				{
					echo '<p>'.$cron.'</p>';
				}
			}
			else
				echo '<p>Emptycrons</p>';*/
			$output = shell_exec("crontab -l");
			if($output)
			{
				echo '<textarea id="crontext" style="width: 100%; min-height: 226px; resize: none;" readonly>';
				echo $output;
				echo '</textarea>';
			}
			else
				echo '<textarea id="crontext" style="width: 100%; min-height: 226px; resize: none;" readonly>Empty crons</textarea>';
		break;
	}
?>
