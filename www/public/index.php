<?php declare(strict_types=1);

use Lib\Kernel;

include_once __DIR__ . '/../autoload.php';
include_once __DIR__ . '/../boostrap.php';

$kernel = new Kernel();
$kernel->run();

die;
