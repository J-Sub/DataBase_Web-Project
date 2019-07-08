<!DOCTYPE html>
<html lang='ko'>
	<head>
	    <title>Who Are You - Get</title>
	    <meta charset="UTF-8">
	</head>
	
	<body>
		
	<form name= "form1" action="mynameis.php" method="get"> <!-- action이 여기서 들어간 값이 mynameis로 들어간다는것!!! -->
	First name : <input type="text" name="name1"> <br>
	Last name : <input type="text" name="name2"> <br> 
	<input type="submit" value="Submit">
	</form> 

<br>

<?
for($num=1; $num <= 10; $num++)
{    echo "$num";  
		echo "<br>" ; }
?>



			

	</body>
</html>