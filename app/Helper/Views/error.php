<?php
http_response_code(404);
// die();
// header("HTTP/1.0 404 Not Found");
// $error = http_response_code(404)?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
    <title>404 Not Found</title>
    <style>
      * {
        box-sizing: border-box;
      }

      body {
        background-color: darkgrey;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: black;
        font-weight: 900;
        margin: auto;
        width: 100%;
        height: 100dvh;
      }

      a {
        color: white;
        transition: all 0.15s;
      }

      a:hover {
        color: white;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <h1>
      404 Not Found
    </h1>
    <h3>
      <a href="/">Home Page</a>
    </h3>
  </body>
</html>
