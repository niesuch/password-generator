<?php

function __autoload($classname) {
    $filename = dirname(__FILE__) . "/" . $classname . ".php";
    include_once($filename);
}
