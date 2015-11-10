function saveCrontab(args)
{
    if(confirm("Cette opération remplacera toutes les tâches prévues."))
    {
		  saveurl="crontabsave.php";
		  $.ajax
		  ({
			  type: 'POST',
			  url: saveurl,
			  data: {txt:document.getElementById("crontext").value},
			  async: false,
			  cache: false,
			  timeout: 30000,
			  success: function(data)
			  {
				  alert("Cron updated");
				  $("#cron").load("crontab.php?flag="+flag);
			  },
			  error: function(xhr, status, error)
			  {
				  alert(xhr.responseText);
			  }
		  });
    }
}

function resetCrontab(args)
{
    if(confirm("Cette opération supprimera toutes les tâches prévues."))
    {
		  saveurl="resetcron.php?command=kill";
		  $.ajax
		  ({
			  type: 'POST',
			  url: saveurl,
			  async: false,
			  cache: false,
			  timeout: 30000,
			  success: function(data)
			  {
				  $("#crondaemon").load("resetcron.php");
			  },
			  error: function(xhr, status, error)
			  {
				  alert(xhr.responseText);
			  }
		  });
    }
}

$().ready(function()
{
	$("#cron").load("crontab.php?");
	$("#crondaemon").load("resetcron.php");

	logsCheck();
});
