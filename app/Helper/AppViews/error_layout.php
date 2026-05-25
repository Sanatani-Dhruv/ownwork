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
      <h3 class="text-2xl border-1 p-4 pt-2 pb-2 font-semibold rounded">
        Error Message:<br>
        <div class="pl-2 pr-2 text-xl text-red-500/100"><?=out($errMsg)?></div>
      </h3>
    <?php endif;?>

      <br>

      <?php if (isset($TMPtraceBlocksArr,$tracePathArr)): ?>
      <h3 class="text-xl mb-2 font-medium">Stack Trace:</h3>
      <?php $i=0; ?>
        <div class="flex flex-col gap-8">
          <?php foreach($tracePathArr as $trace): ?>
            <div class="p-4 border rounded text-md">
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
        <div class="p-4 border rounded text-md">
          <div class="file_name overflow-auto text-md p-2 rounded text-black mb-4 bg-green-500/100 flex">
            <div class="w-full">
              <strong>File name:</strong> <span class="font-medium text-white">/home/guest/ownwork/public/index.php</span>
            </div>
            <div class="collapse-svg-block pl-2 pr-2 font-black font-mono">^</div>
          </div>
          <pre class="file_content overflow-auto"><div>5 
</div><div>6 require __DIR__ . "/../bundle/Bundler.php";
</div><div>7 // Bundler class bundles your application with routes and other neccesary things
</div><div>8 $app = new Bundler();
</div><div class="text-red-500/100">9 $app-&gt;bundle(); // Starting our app
        </div></pre>            </div>

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
