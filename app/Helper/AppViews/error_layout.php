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
  if(file_exists(approot() . "/public/build/output.css")):
    require(approot() . "/public/build/output.css");
endif;
if (file_exists(__DIR__ . "/styles/index.css")) {
  // include(__DIR__ . "/styles/index.css");
}
?>
    </style>
  </head>
  <body class="p-4 bg-gray-800/100 text-white">
    <h1 class="text-3xl shadow-lg p-4 pt-2 pb-2 font-semibold text-center rounded mt-0 m-4 bg-amber-600/100">
      OwnWork Error Handler
    </h1>

    <?php if (isset($errMsg)): ?>
      <h1 class="text-2xl border-1 p-4 pt-2 pb-2 font-semibold">
        Error Message:<br>
        <div class="pl-3 pr-3"><?php echo out($errMsg) ?></div>
      </h1>
    <?php endif;?>

    <h2 class="w-max m-auto p-3">
      <code>
        <a href="/">Home Page</a>
      </code>
    </h2>
  </body>
</html>
