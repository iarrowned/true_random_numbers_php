<?php
require_once "vendor/autoload.php";
use Randomizer\Randomizer;

$r = new Randomizer();
print_r($r->generateIntegers(2, 10, 20));
print_r($r->generateUUIDs());
print_r($r->generateGaussians());
//print_r($r->generateIntegers(1e4));