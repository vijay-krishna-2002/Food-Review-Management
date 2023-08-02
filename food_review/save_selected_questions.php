<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = file_get_contents('php://input');
    $selectedQuestions = json_decode($postData, true);

    $_SESSION['selected_questions'] = $selectedQuestions;

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>


