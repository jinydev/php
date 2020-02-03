<?php

require "Product.php";
include "UserA.php";

$job = new UserA("S-822");
$product = $job->doSomthing();

