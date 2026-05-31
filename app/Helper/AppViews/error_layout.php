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
  include(__DIR__ . "/styles/error.css");
  if (file_exists(__DIR__ . "/styles/error.css")) {
    include(__DIR__ . "/styles/error.css");
  }
?>
    </style>
  </head>
  <body class="p-8 bg-gray-800/100 text-white">
    <h1 class="text-3xl shadow-lg pt-2 pb-2 font-semibold text-center rounded m-4 ml-0 mr-0  bg-amber-600/100">
      OwnWork Error Handler
    </h1>

    <?php if (isset($errMsg)): ?>
      <div class="border-1 p-4 pt-2 pb-2 rounded">
        <h3 class="text-2xl font-semibold">
          Error Message:
        </h3>
        <div class="pl-2 pr-2 text-xl text-red-500/100"><?=out($errMsg)?></div>
        <?php if(isset($errFile)):?>
        <br>
        <h3 class="text-xl font-semibold">
          Error in File:<br>
        </h3>
        <div class="pl-2 pr-2 text-lg text-red-500/100"><?=out($errFile)?></div>
        <?php endif;?>
      </div>
      <?php endif;?>

      <h4 class="p-3 font-medium text-xl">Basic App Infos</h4>
      <div class="pb-4 pt-4 text-xl text-white-500/100 text-center"><span class="italic">App Directory:</span> <?=approot()?></div>

      <?php if (isset($traceBlocksArr,$tracePathArr)): ?>
      <h3 class="text-xl mb-2 font-medium">Stack Trace:</h3>
      <?php $i=0; ?>
        <div class="flex flex-col gap-4">
          <?php foreach($tracePathArr as $trace): ?>
            <div class="stackTraceBlock p-3 border border-gray-50/30 rounded text-md">
              <?php comp("stackTrace-block.php", [
                "filePath" => (str_contains($trace["file"], approot()) ? str_replace(approot() . "/", "" , $trace['file']) : $trace["file"]),
                "i" => $i
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
        <script>
          <?php if(file_exists(__DIR__ . "/script/script.js")): ?>
            <?php include(__DIR__ . "/script/script.js"); ?>
            <?php endif; ?>
        </script>
  </body>
</html>
