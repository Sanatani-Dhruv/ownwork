<?php
// http_response_code(404);
// die();
// header("HTTP/1.0 404 Not Found");
// $error = http_response_code(404)?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
    <title>View Not Found</title>
    <style>
<?php
  include(__DIR__ . "/styles/index.css");
?>
    </style>
  </head>
  <body>
    <h1>
      View with name <code>`<?=htmlspecialchars($view_name)?>`</code> not Found.
    </h1>
    <h3>
      <a href="/">Home Page</a>
    </h3>
  </body>
</html>

