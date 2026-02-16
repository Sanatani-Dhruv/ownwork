<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title>Show Detail Page</title>
	</head>
	<body>
		<h1>
			User Detail Page
		</h1>
		<p>
			Name is <?=out(isset($name) ? "$name" : "Not Set")?><br>
			ID is <?=out(isset($id) ? "$id" : "Not Set")?>
		</p>
		<a href="/">Home Page</a>
	</body>
</html>
