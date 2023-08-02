<!DOCTYPE html>
<html>
<head>
    <title>Feedback System</title>
    <link rel="stylesheet" href="css/user1.css">
</head>
<body>
    <h1>Feedback Form</h1>
    
    <form method="POST" action="store.php">
    <label for="rate" class="food-taste-label">Excellent&nbsp;&nbsp;&nbsp;&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor</label>
<br>
        <?php
        session_start();

        // Check if selected_questions is set in the session
        if (isset($_SESSION['selected_questions'])) {
            $selectedQuestions = $_SESSION['selected_questions'];

            foreach ($selectedQuestions as $question) {
                echo '<div class="label-container">';
                echo '<label>' . htmlspecialchars($question) . '</label>';
                echo '<div class="radio-container">';
                echo '<input type="radio" name="question[' . htmlspecialchars($question) . ']" value="5">';
                echo '<input type="radio" name="question[' . htmlspecialchars($question) . ']" value="4">';
                echo '<input type="radio" name="question[' . htmlspecialchars($question) . ']" value="3">';
                echo '<input type="radio" name="question[' . htmlspecialchars($question) . ']" value="2">';
                echo '</div>';
                echo '</div>';
            }

        } else {
            echo '<p>No selected questions to display.</p>';
        }
        ?>
        <br>
        <div class="label-container">
            <label>Any additional comments:</label>
            <textarea name="additional_comments" rows="5" cols="50"></textarea>
        </div>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
