<?php
require_once '../config.php';
require_once '../autoload.php';

use App\Controllers\ItemController;

$controller = new ItemController();
$controller->index();