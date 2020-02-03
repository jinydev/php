<?php

require "factory.php";
require "product.php";

$fac = new Factory;
$pro = $fac->create();
$pro->hello();

