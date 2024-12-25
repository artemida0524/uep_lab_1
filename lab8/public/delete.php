<?php
require_once '../autoload.php';
use App\Controllers\ItemController;

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$controller = new ItemController();
$controller->delete($id);