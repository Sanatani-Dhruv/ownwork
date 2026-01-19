<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<!-- <title>Home Page</title> -->
		<title><?=htmlspecialchars(getenv("APP_NAME") . " App")?></title>
	</head>
	<body>
		<h2>Hello World from Ownwork!</h2>
		<p>This is routing example that shows Route of this framework works</p>
		<p>
			<?=htmlspecialchars("This is PHP Message")?>
		</p>
	</body>
</html>
