<?php
	$servername = '127.0.0.1';
	$username = 'bpiharvest_admin';
	$password = 'h4rv351-';
	$dbname = 'bpiharvester';

	$cronFile = fopen('cron/cron.cron', 'r');
	if(!$cronFile)
	{
		$cronFile = fopen('cron/cron.cron', 'x');
	}
	if(!$cronFile)
	{
		echo
			'<div class="middleParts">
				<div class="middlePart">
					<fieldset class="middleErrorMessage">
						<legend>ERROR!</legend>
							Missing cron file and unable to create it!
					</fieldset>
				</div>
			</div>'
		;
	}
	else
	{
		echo '<textarea id="crontext" style="width: 100%; min-height: 200px">'.fread($cronFile,filesize('cron/cron.cron')).'</textarea>';
		fclose($cronFile);
	}
?>
