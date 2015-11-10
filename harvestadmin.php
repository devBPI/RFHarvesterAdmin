<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
		$menu = 'ErreurMenu';
		$section = 'ErreurSection';
		switch($_GET['menu'])
		{
			case 'menu2':
				$menu = "Menu 2";
			break;
			case 'menu3':
				$menu = 'Menu 3';
			break;
			default:
				$menu = 'Moissons';
				switch($_GET['section'])
				{
					case 'programmation':
						$section = 'Programmation';
						switch($_GET['programmation'])
						{
							case 'disponible':
								$Programmation = 'Moissons disponibles';
							break;
							case 'journaliere':
								$Programmation = 'Journalière';
							break;
							case 'hebdomadaire':
								$Programmation = 'Hebdomadaire';
							break;
							case 'mensuelle':
								$Programmation = 'Mensuelle';
							break;
							case 'daemon':
								$Programmation = 'Cron Daemon';
							break;
							default:
								$Programmation = 'Crontab';
							break;
						}
					break;
					case 'historique':
						$section = 'Historique';
					break;
					default:
						$section = 'Moissonnage';
					break;
				}
			break;
		}
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>RFHarvester V2</title>
		<link rel="stylesheet" type="text/css" href="css/body.css" />
		<link rel="stylesheet" type="text/css" href="css/head.css" />
		<link rel="stylesheet" type="text/css" href="css/middle.css" />
		<link rel="stylesheet" type="text/css" href="css/foot.css" />
		<link rel="stylesheet" type="text/css" href="css/table.css" /><!---->
		<style type="text/css" media="screen"></style>

		<script src="js/head.js" type="text/javascript" language="javascript"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript" language="javascript"></script>

		<?php
			switch($menu)
			{
				case 'Moissons':
					switch($section)
					{
						case 'Moissonnage':
							echo '<script src="js/Moissons/MoissonsMoissonnage.js" type="text/javascript" language="javascript"></script>';
						break;
						case 'Programmation':
							echo '<script src="js/Moissons/MoissonsProgrammation.js" type="text/javascript" language="javascript"></script>';
						break;
						case "Historique":
							echo '';
						break;
					}
				break;
				default:
					echo '';
				break;
			}
			?>

		<script type="text/javascript" language="javascript">
		</script>
	</head>
	<body>
		<div class="pageHead">
			<div class="headTitles">
				<div class="headTitle" id="title">
					<p>RFHarvester V2</p>
				</div>
				<div class="headTitle headButton" onclick="displayHeadSelection(0);">
					<p>Menu Principal</p>
				</div>
				<div class="headTitle headButton toogled" onclick="displayHeadSelection(1);">
					<p><?php echo $menu; ?></p>
				</div>
				<div class="headTitle headButton" onclick="displayHeadSelection(2);">
					<p>Connexion</p>
					<!--Déconnexion-->
				</div>
			</div>
			<div class="headSelections" style="display:none;">
				<a href="?menu=moissons" <?php if($menu == 'Moissons') echo ' class="selected"'; ?>>Moissons</a>
				<a href="?menu=menu2" <?php if($menu == 'Menu 2') echo ' class="selected"'; ?>>Menu 2</a>
				<a href="?menu=menu3" <?php if($menu == 'Menu 3') echo ' class="selected"'; ?>>Menu 3</a>
			</div>
			<div class="headSelections">
				<?php
					switch($menu)
					{
						case 'Moissons':
							echo
								'<a href="?menu=moissons&section=moisonnage"'.(($section == 'Moissonnage')? ' class="selected"' : '').'>Moissonnage</a>
								<a href="?menu=moissons&section=programmation"'.(($section == 'Programmation')? ' class="selected"' : '').'>Programmation</a>
								<a href="?menu=moissons&section=historique"'.(($section == 'Historique')? ' class="selected"' : '').'>Historique des moissons</a>'
							;
						break;
						case 'Menu 2':
						break;
						case 'Menu 3':
						break;
					}
				?>
			</div>
			<div class="headSelections" style="display:none;">
				<div class="headSelection">
					<form name="loginForm" action="index.php"><!-- method="post"><!---->
						<input type="text" size="20" maxlength="20" name="login" placeholder="Login" disabled />
						<input type="password" size="20" maxlength="20" name="password" placeholder="Password" disabled />
						<input type="submit" value="Connexion" disabled="disabled" />
					</form>
				</div>
			</div>
		</div>
		<div class="pageMid">
			<?php
				switch($menu)
				{
					case 'Moissons':
						echo
							'<div class="middleParts">
								<div class="middlePart">
									<fieldset class="middleWarningMessage">
										<legend>&#x26A0 Warning &#x26A0</legend>
										Site en construction
									</fieldset>
								</div>
							</div>'
						;
						switch($section)
						{
							case 'Moissonnage':
								echo
									'<div class="middleParts">'
								;
								/*echo
									'<div class="middlePart" style="width: 20%;">
											<fieldset>
												<legend>left</legend>
												<p>Empty</p>
											</fieldset>
										</div>'
								;*/
								echo
									'<div class="middlePart" style="width: 60%;">
											<fieldset>
												<legend>Moisonneur</legend>'
								;
								exec("ps -aux | grep -i 'RFHarvesterV2test.jar' | grep -v grep | awk '{print $2}'", $pids);
								if(empty($pids))
								{
									print 'Moisson éteinte<br />';
									echo '<button type="button" onclick="script()">Click Me</button>';
								}
								else
								{
									foreach ($pids as $value)
									{
										print 'Moisson en cours avec le PID:'.$value.'<br />';
									}
									/*print_r($pids);
									echo '<br />';*/
									echo '<button type="button" onclick="script(\'killall\')">KillAll</button>';
								}
								/*$output = `ps -aux | grep 'RFHarvesterV2test.jar'`;
								echo "<pre>$output</pre><br />";
								$output = `ls -la`;
								echo "<pre>$output</pre>";*/

								echo
											'</fieldset>
											<fieldset>
												<legend>logs</legend>
												<button id = "refreshbutton" type="button" onclick="invertRefresh()">▮▮ Pause</button>
												DisplayErros<input id="checkError" name="checkError" type="checkbox" onclick="logsCheck()" checked />
												DisplayWarnings<input id="checkWarning" name="checkWarning" type="checkbox" onclick="logsCheck()" checked />
												DisplayInfo<input id="checkInfo" name="checkInfo" type="checkbox" onclick="logsCheck()" checked />
												DisplayDebug<input id="checkDebug" name="checkDebug" type="checkbox" onclick="logsCheck()" checked />
												<div id="logs"></div>
											</fieldset>
										</div>'
								;
								/*echo
										'<div class="middlePart" style="width: 20%;">
											<fieldset>
												<legend>right</legend>
												<p>▼ ▾▶►▸</p>
												<p>'
								;
								$t=time();
								echo $t;
								echo '<br />';
								echo date('m/d/Y', $t);
								echo
												'</p>
											</fieldset>
										</div>'
								;*/
								echo
										'</div>'
								;
							break;
							case 'Programmation':
								echo
									'<div class="middleParts">
										<div class="middlePart" style="width: 20%;">
											<fieldset class="menu'.(($Programmation == 'Moissons disponibles')? ' selected' : '').'">
												<legend style="margin-bottom: -8px;">Menu</legend>
												<a onclick="alert(\'Menu indisponible\'); return false;" style="cursor: not-allowed;" href="?menu=moissons&section=programmation&programmation=disponible">Moissons disponibles</a>
											</fieldset>
											<fieldset class="menu'.(($Programmation == 'Journalière')? ' selected' : '').'">
												<a onclick="alert(\'Menu indisponible\'); return false;" style="cursor: not-allowed;" href="?menu=moissons&section=programmation&programmation=journaliere">Journalière</a>
											</fieldset>
											<fieldset class="menu'.(($Programmation == 'Hebdomadaire')? ' selected' : '').'">
												<a onclick="alert(\'Menu indisponible\'); return false;" style="cursor: not-allowed;" href="?menu=moissons&section=programmation&programmation=hebdomadaire">Hebdomadaire</a>
											</fieldset>
											<fieldset class="menu'.(($Programmation == 'Mensuelle')? ' selected' : '').'">
												<a onclick="alert(\'Menu indisponible\'); return false;" style="cursor: not-allowed;" href="?menu=moissons&section=programmation&programmation=mensuelle">Mensuelle</a>
											</fieldset>
											<fieldset class="menu'.(($Programmation == 'Crontab')? ' selected' : '').'">
												<a href="?menu=moissons&section=programmation">&#x26a0 Crontab <span style="float:right;">&#x26a0</span></a>
											</fieldset>
											<fieldset class="menu'.(($Programmation == 'Cron Daemon')? ' selected' : '').'">
												<a href="?menu=moissons&section=programmation&programmation=daemon">Cron Daemon</a>
											</fieldset>
										</div>

										<div class="middlePart" style="width: 80%;">'
								;
								switch($Programmation)
								{
									case 'Crontab':
										echo
											'<fieldset class="middleWarningMessage">
												<legend>Informations</legend>
													<p>
														# Edit this file to introduce tasks to be run by cron.<br/>
														# <br/>
														# Each task to run has to be defined through a single line<br/>
														# indicating with different fields when the task will be run<br/>
														# and what command to run for the task<br/>
														# <br/>
														# To define the time you can provide concrete values for<br/>
														# minute (m), hour (h), day of month (dom), month (mon),<br/>
														# and day of week (dow) or use \'*\' in these fields (for \'any\').<br/>
														# <br/>
														# Notice that tasks will be started based on the cron\'s system<br/>
														# daemon\'s notion of time and timezones.<br/>
														# <br/>
														# Output of the crontab jobs (including errors) is sent through<br/>
														# email to the user the crontab file belongs to (unless redirected).<br/>
														# <br/>
														# For example, you can run a backup of all your user accounts<br/>
														# at 5 a.m every week with:<br/>
														# 0 5 * * 1 tar -zcf /var/backups/home.tgz /home/<br/>
														# <br/>
														# For more information see the manual pages of crontab(5) and cron(8)<br/>
														# <br/>
														# m h  dom mon dow   command
													</p>
												</fieldset>'
										;
									break;
									default:
									break;
								}
								echo
												'<fieldset>
													<legend>'.$Programmation.'</legend>'
								;
								switch($Programmation)
								{
									case 'Crontab':
										/*$input = shell_exec("cat cron/cron.cron");
										file_put_contents('/tmp/crontab.txt', $input.PHP_EOL);

										$output = shell_exec("crontab -l");
										echo '<textarea id="crontext" style="width: 100%; min-height: 226px; resize: none;" readonly>';
										echo exec('crontab /tmp/crontab.txt', $out, $return);
										echo '<br />';
										echo $return;
										echo '<br />';
										echo $out;
										echo '<br />';
										echo $output;
										echo '</textarea>';*/


										echo '<button id="savebutton" type="button" onclick="saveCrontab()">Enregistrer</button>';
										echo '<div id="cron"></div>';
									break;
									case 'Cron Daemon':
										echo '<button id="resetbutton" class="danger" type="button" onclick="resetCrontab()">&#x26a0 Reset cron &#x26A0</button>';
										echo '<div id="crondaemon"></div>';
									break;
									default:
										echo '';
									break;
								}
								echo
												'</fieldset>
										</div>
									</div>'
								;
							break;
							case "Historique":
								include 'errorFieldSet.php';
							break;
						}
					break;
					default:
						include 'errorFieldSet.php';
				}
			?>
		</div>
		<div class="pageFoot">
			<div class="footParts">
				<div class="footPart" id="mainFootPart">
					<p>Interface d'administration du moissonneur de la BPI.</p>
				</div>
			</div>
		</div>
	</body>
</html>
