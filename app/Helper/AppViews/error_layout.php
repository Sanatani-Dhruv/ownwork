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


        <?php if (isset($traceBlocksArr,$tracePathArr)): ?>
      <h3 class="text-xl mt-4 mb-4 font-medium">Stack Trace:</h3>
      <?php $i=0; ?>
        <div class="flex flex-col gap-4">
          <?php foreach($tracePathArr as $trace): ?>
            <div class="stackTraceBlock p-3 border border-gray-50/30 rounded text-md">
              <?php comp("stackTrace-block.php", [
                "filePath" => $trace,
                "i" => $i
              ], $syscompdir);
            ?>
            <?=($traceBlocksArr[$i]);?>
            </div>
            <?php $i++; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <h4 class="pt-4 pb-4 font-medium text-2xl underline">Basic App Infos</h4>
        <div class="border rounded pt-2 p-4 mt-4 md:ml-40 md:mr-40">
          <div class="text-gray-500 text-xl"><code># [GENERAL INFORMATION]</code></div>
          <div class="text-lg text-white-500/100 flex gap-4 items-end">
            <span class="italic flex-1 whitespace-nowrap">
              App Directory:
            </span>
            <span class="text-right whitespace-nowrap">
              <?=out(approot())?>
            </span>
          </div>
            <hr class="w-full text-gray-500 border"><br>
          <div class="text-gray-500 text-xl"><code># [ENV_VARIABLES]</code></div>
          <?php if(isset($envArr)): ?>
            <?php foreach($envArr as $key => $value): ?>
            <div class="text-lg text-white-500/100 flex gap-4 items-end">
              <span class="italic flex-1 whitespace-nowrap">
                <?=out(trim($key))?>:
              </span>
              <span class="text-right whitespace-nowrap">
                <?=($value == "") ? "<span class='text-gray-500'>[EMPTY]</span>" : $value?>
              </span>
            </div>
            <hr class="w-full text-gray-500 border"><br>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="m-auto w-max p-4">
          <a href="/">
            <button class="cursor-pointer border p-3 bg-white text-black font-bold text-xl rounded hover:rounded-none transition">
              <code>
                Home Page
              </code>
            </button>
          </a>
        </div>
        <script>
          <?php if(file_exists(__DIR__ . "/script/script.js")): ?>
            <?php include(__DIR__ . "/script/script.js"); ?>
            <?php endif; ?>
        </script>
  </body>
</html>
