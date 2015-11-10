<?php
	if(!isset($_POST['txt']))
	{
		header('HTTP/1.1 500 Internal Server Error');
		print('No data text sent');
	}
	else
	{
		$cronFile = fopen('cron/cron.cron', 'w');
		if(!$cronFile)
		{
			header('HTTP/1.1 500 Internal Server Error');
			print ('Unable to save cron file!');
		}
		else
		{
			fwrite($cronFile, $_POST['txt']);
			fclose($cronFile);
			exec("crontab -r");
			$input = shell_exec("cat cron/cron.cron");
			file_put_contents('/tmp/crontab.txt', $input.PHP_EOL);
			exec('crontab /tmp/crontab.txt', $output, $return_var);
			if($return_var != 0)
			{
				header('HTTP/1.1 500 Internal Server Error');
				print ("Unable to launch Cron.\nWrong fileformat.");
			}
		}
	}
?>
