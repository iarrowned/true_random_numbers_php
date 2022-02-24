<?php
require_once 'src/Randomizer.php';

$r = new Randomizer();
print_r($r->generateIntegers());