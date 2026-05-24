<?php
  // http_response_code(404);
  // die();
  // header("HTTP/1.0 404 Not Found");
// $error = http_response_code(404)?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
    <title>Error<?=out((isset($errMsg) ? ": " . $errMsg : "Handled") )?> </title>
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
  <body class="p-8 bg-gray-800/100 text-white">
    <h1 class="text-3xl shadow-lg pt-2 pb-2 font-semibold text-center rounded m-4 ml-0 mr-0  bg-amber-600/100">
      OwnWork Error Handler
    </h1>

    <?php if (isset($errMsg)): ?>
      <h1 class="text-2xl border-1 p-4 pt-2 pb-2 font-semibold rounded">
        Error Message:<br>
        <div class="pl-4 pr-4 text-xl text-red-500/100"><?=out($errMsg)?></div>
      </h1>
    <?php endif;?>

      <br>

      <?php if (isset($traceBlocksArr,$tracePathArr)): ?>
      <h2 class="text-xl mb-2 font-medium">Stack Trace:</h2>
      <?php $i=0; ?>
        <div class="flex flex-col gap-8">
          <?php foreach($tracePathArr as $trace): ?>
            <div class="p-4 border rounded">
              <?php comp("stackTrace-block.php", [
                "filePath" => $trace["file"]
              ], $syscompdir);
            ?>
            <?=($traceBlocksArr[$i]);?>
            </div>
            <?php $i++; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    <h2 class="w-max m-auto p-3">
      <code>
        <a href="/">Home Page</a>
      </code>
    </h2>
  </body>
</html>
