<?php
namespace App\Controller;

use App\Router\Route;

class UserController {
	function __construct() {
		//
	}

	public function showDetail() {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>UserController::showDetail()</title>
	</head>
	<body>
		<h1>
Message from <?=UserController::class?> method showDetail()
		</h1>
	</body>
</html>
<?php
		echo (isset($id)) ? "True" : "False";
	}

	public function welcome() {
		require(__DIR__ . "/../../app/Views/welcome.php");
	}
}
