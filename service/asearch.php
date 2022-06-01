<!DOCTYPE html>
<html>
<head>
	<style>
		.username-ok{color:#2FC332;}
		.username-taken{color:#D60202;}
	</style>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script>
		function checkAvailability() 
		{
			jQuery.ajax(
			{
				url: "acheck_availability.php",
				data:'username='+$("#username").val(),
				type: "POST",
				success:function(data)
				{
					$("#msg").html(data);
				}
			});
		}

		function getResult() 
		{
			jQuery.ajax(
			{
				url: "backend-search.php",
				data:'term='+$("#term").val(),
				type: "POST",
				success:function(data2)
				{
					$("#result").html(data2);
				}
			});
		}
	</script>
</head>
<body>
	<h1>Check if username is available in database</h2>
	<label>Check Username:</label>
	<input name="username" type="text" id="username" onkeyup="acheckAvailability()">
	<div id="msg"></div>    
	
	<br><hr><br>
	
	<h1>Live Search</h1>
	<input name="term" type="text" id="term" onkeyup="getResult()" placeholder="Search Term..." />
	<div id="result"></div>
</body>
</html>
