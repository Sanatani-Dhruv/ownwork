<?php

function out($data) {
  return htmlspecialchars($data);
}

function view($string) {
  return __DIR__ . "/../resources/views/$string";
}
