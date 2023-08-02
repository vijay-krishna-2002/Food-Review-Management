<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['selected_questions'])) {
        $selectedQuestions = $_SESSION['selected_questions'];

        $conn = new mysqli('localhost', 'root', '', 'test');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $feedbackData = [];

        foreach ($selectedQuestions as $question) {
            if (isset($_POST['question'][$question])) {
                $rating = $_POST['question'][$question];
                if (!in_array($rating, ['5', '4', '3', '2'])) {
                    echo '<p>Please select a valid rating (5, 4, 3, or 2) for question: "' . htmlspecialchars($question) . '".</p>';
                    continue; 
                }
            } else {
                echo '<p>Please select a rating for question: "' . htmlspecialchars($question) . '".</p>';
                continue; 
            }

            $feedbackData[$question] = $rating;
        }

        $additionalComments = $_POST['additional_comments'];

        $sql = "INSERT INTO feedback (food_accuracy, food_service, hygiene, quality, ambiance, server_behavior, additional_comments) VALUES (
            '{$feedbackData['How was accuracy of your order:']}',
            '{$feedbackData['How was the speed of service:']}',
            '{$feedbackData['To rate the standard of hygiene:']}',
            '{$feedbackData['Rate the quality of the food:']}',
            '{$feedbackData['Rate the decor of restaurant:']}',
            '{$feedbackData['How Was The Server Behavior:']}',
            '{$additionalComments}'
        )";

        if ($conn->query($sql) === TRUE) {
            echo '<p>Feedback saved successfully!</p>';
        } else {
            echo '<p>Error saving feedback. Please try again later.</p>';
        }

        $conn->close();
        header('Location: final.php');
        exit;


    } else {
        echo '<p>No selected questions found in the session. Please go back and select questions first.</p>';
    }
}
?>
