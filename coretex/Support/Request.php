<?php

use Coretex\Support;

class Request {
    private array $gets;
    private array $posts;
    private array $puts;
    private array $deletes;
    private array $files;

    public function __construct() {
        $this->posts = $_POST;
        $this->gets = $_GET;
        $this->files = $_FILES;
    }

    public function getVariable(string $name) {
        pre($_REQUEST);
    }

    public function getVariableRaw(string $name) {
    }
}
