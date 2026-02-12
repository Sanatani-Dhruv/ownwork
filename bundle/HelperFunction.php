<?php

function out($data) {
  return htmlspecialchars($data);
}

function view($string) {
  require __DIR__ . "/../resources/views/$string";
}
