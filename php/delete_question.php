<?php
session_start();
require_once 'controller.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 1) {
    http_response_code(403);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question_id'])) {
    $question_id = $_POST['question_id'];
    $success = archiveQuestion($question_id);
    echo json_encode(['success' => $success]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false]);
}
