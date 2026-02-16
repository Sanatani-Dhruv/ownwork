<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title><?=out(env("APP_NAME") . " App")?></title>
	</head>
	<body>
		<h2>Welcome to <?=env("APP_NAME")?>!</h2>
		<p>
			<a href="/">Home Page</a>
		</p>
		<form action="/user/Shyam/13" method="get">
			<button>Try to View GET Page Which Uses Dyanamic Url</button>
		</form>
		<br>
		<form action="/user/update/Shyam/13" method="post">
			<button type="submit">Try to View POST Page Which Uses Dyanamic Url</button>
		</form>
	</body>
</html>
