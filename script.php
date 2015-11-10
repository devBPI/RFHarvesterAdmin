<?php
	switch($_GET['command'])
	{
		case 'kill':
			exec("ps -aux | grep -i 'RFHarvesterV2test.jar' | grep -v grep | awk '{print $2}'", $pids);
			if(!empty($pids))
			{
				foreach ($pids as $value)
				{
					$command = 'kill '.$value;
					shell_exec($command);
				}
			}
		break;
		default:
			//$command = 'ping google.fr';
			exec("ps -aux | grep -i 'RFHarvesterV2test.jar' | grep -v grep | awk '{print $2}'", $pids);
			if(empty($pids))
			{
				$command = 'java -jar -Xms1024m -Xmx2048m -Dfile.encoding=UTF-8 bin/RFHarvesterV2test.jar --debug --harvest=portfolio > /dev/null & echo $!';
				echo shell_exec($command);
			}
		break;
	}
?>
