<?php
require_once './ApiController.php';
$config = require_once '../config/config.php'; 
$input = file_get_contents('php://input');
$data = json_decode($input, true) ?? $_POST;

$action = $data['action'] ?? null;

if (!$action) {
    echo json_encode(['status' => false, 'message' => 'Missing action']);
    exit;
}

$controller = new ApiController($data, $config);

switch ($action) {
    case 'addlead':
        $controller->addLead();
        break;
    case 'get_statuses':
        $controller->getStatuses();
        break;

    default:
        echo json_encode(['status' => false, 'message' => 'Unknown action']);
        exit;
}