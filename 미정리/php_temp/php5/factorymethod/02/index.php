<?php

require "factory.php";
require "newfactory.php";
require "product.php";
require "newproduct.php";

$fac = new NewFactory;
$pro = $fac->create();
$pro->hello();

