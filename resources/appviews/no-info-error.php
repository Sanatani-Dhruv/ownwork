<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
    <title><?=($error_title)?></title>
    <style>
<?php
include(__DIR__ . "/styles/index.css");
?>
    </style>
  </head>
  <body>
    <h1>
      <code> <?=($error_message)?> </code>
    </h1>
    <?php if(isset($error_description)): ?>
        <p style="font-size: x-large; font-family: sans-serif;text-align: center;">
          <?=$error_description?>
        </p>
    <?php endif;?>
    <h2>
      <code>
        <a href="/">Home Page</a>
      </code>
    </h2>
  </body>
</html>
