function script(args)
{
		scripturl="script.php";
		if(typeof(args) !== 'undefined')
		{
			switch(typeof(args))
			{
				case "string":
					switch(args)
					{
						case "killall":
							scripturl+="?command=kill";
						break;
						default:
							alert("Unrecognised string args: " + args);
						break;
					}
				break;
				case "object":
					alert("Error args type " + typeof(args) + " : " + Object.keys(args));
				break;
				default:
					alert("Error args type " + typeof(args));
				break;
			}
		}
		$.ajax
		({
			type: 'POST',
			url: scripturl,
			async: false,
			cache: false,
			timeout: 30000,
			success: function(data)
			{
				//alert(data);
				location.reload();
			},
			error: function(data)
			{
					alert('Unable to launch harvester');
			}
		});
}

flag = 15;
function logsCheck()
{
	if(document.getElementById('checkError').checked)
		flag = flag & 14;
	else
		flag = flag | 1;
	if(document.getElementById('checkWarning').checked)
		flag = flag & 13;
	else
		flag = flag | 2;
	if(document.getElementById('checkInfo').checked)
		flag = flag & 11;
	else
		flag = flag | 4;
	if(document.getElementById('checkDebug').checked)
		flag = flag & 7;
	else
		flag = flag | 8;
	$("#logs").load("bpiharvesterlogs.php?flag="+flag);
}

refresh = true;
function invertRefresh()
{
	refresh = !refresh;
	//alert(Object.keys($("#refreshbutton")));
	if(refresh)
	{
		$("#refreshbutton")["0"].firstChild.nodeValue="▮▮ Pause";
	}
	else
	{
		$("#refreshbutton")["0"].firstChild.nodeValue="▶ Play";
	}
}

$().ready(function()
{
	{
		$("#logs").load("bpiharvesterlogs.php?flag="+flag);
		var $logdiv = $("#logs");
		setInterval(function()
		{
			if(refresh)
				$logdiv.load("bpiharvesterlogs.php?flag="+flag);
		}, 1000); // Refresh scores every seconds
	}

	logsCheck();
});
