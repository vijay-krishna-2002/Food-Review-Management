<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $totalRows = $result->num_rows;

    $sumfood_accuracy = 0;
    $sumfood_service = 0;
    $sumhygiene = 0;
    $sumquality = 0;
    $sumambiance = 0;
    $sumserver_behavior = 0;

    while ($row = $result->fetch_assoc()) {
        $sumfood_accuracy += intval($row['food_accuracy']);
        $sumfood_service += intval($row['food_service']);
        $sumhygiene += intval($row['hygiene']);
        $sumquality += intval($row['quality']);
        $sumambiance += intval($row['ambiance']);
        $sumserver_behavior += intval($row['server_behavior']);
    }

    $avgfood_accuracy = $sumfood_accuracy / $totalRows;
    $avgfood_service = $sumfood_service / $totalRows;
    $avghygiene = $sumhygiene / $totalRows;
    $avgquality = $sumquality / $totalRows;
    $avgambiance = $sumambiance / $totalRows;
    $avgserver_behavior = $sumserver_behavior / $totalRows;

    $lowestRating = min($avgfood_accuracy, $avgfood_service, $avghygiene, $avgquality, $avgambiance, $avgserver_behavior);
    $lowestRatingCategory = "";
    $lowestRatingIndex = 0;

    $ratings = [$avgfood_accuracy, $avgfood_service, $avghygiene, $avgquality, $avgambiance, $avgserver_behavior];
    foreach ($ratings as $index => $rating) {
        if ($rating === $lowestRating) {
            $lowestRatingIndex = $index;
            break;
        }
    }

    switch ($lowestRatingIndex) {
        case 0:
            $lowestRatingCategory = "Food_Accuracy";
            break;
        case 1:
            $lowestRatingCategory = "Food_Service";
            break;
        case 2:
            $lowestRatingCategory = "Hygiene";
            break;
        case 3:
            $lowestRatingCategory = "Quality";
            break;
        case 4:
            $lowestRatingCategory = "Ambiance";
            break;
        case 5:
            $lowestRatingCategory = "Server Behavior";
            break;
        default:
            $lowestRatingCategory = "";
            break;
    }
} else {
    echo "No feedback data found.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Average Feedback Ratings</title>
    <link rel="stylesheet" href="css/view1.css">
</head>
<body>
    <div class="container">
        <h2>Average Feedback Ratings</h2>

        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>

        <?php if (!empty($lowestRatingCategory)) : ?>
            <div class="suggestion">
                <h3>Suggestion:</h3>
                <p>The lowest rating is in <?php echo $lowestRatingCategory; ?> category.</p>
                <ul>
                    <li>Make your customers comfortable through your maintenance and services, particularly by improving the lowest rating in service.</li>
                </ul>
            </div>
        <?php endif; ?>


        <div id="commentsContainer" style="display: none;">
            <?php
           $sql = "SELECT additional_comments FROM feedback";
           $result = $conn->query($sql);
       
           if ($result->num_rows > 0) {
               echo '<table>';
               echo '<tr><th>Additional Comments</th></tr>';
       
               while ($row = $result->fetch_assoc()) {
                   $comments = explode("\n", $row['additional_comments']);
       
                   foreach ($comments as $comment) {
                       if (!empty($comment)) {
                           echo '<tr><td>' . $comment . '</td></tr>';
                       }
                   }
               }
       
               echo '</table>';
           } else {
               echo "No comments found.";
           }
       
           $conn->close();
           ?>
        </div> 

    
        <div class="form-container">
        <form action="comments.php">
            <button>Show Comments</button>
        </form>

        <form action="admin.php">
            <button>Select Question</button>
        </form>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var chartData = {
                labels: ["Food Accuracy", "Food Service", "Hygiene", "Quality", "Ambiance", "Server Behavior"],
                datasets: [{
                    data: [
                        <?php echo round(($avgfood_accuracy / 5) * 100); ?>,
                        <?php echo round(($avgfood_service / 5) * 100); ?>,
                        <?php echo round(($avghygiene / 5) * 100); ?>,
                        <?php echo round(($avgquality / 5) * 100); ?>,
                        <?php echo round(($avgambiance / 5) * 100); ?>,
                        <?php echo round(($avgserver_behavior / 5) * 100); ?>
                    ],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#4BC0C0",
                        "#9966FF",
                        "#FF9F40"
                    ]
                }]
            };

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false
            };

            var chart = new Chart(document.getElementById("chart"), {
                type: 'pie',
                data: chartData,
                options: chartOptions
            });

            var showCommentsButton = document.getElementById("showCommentsButton");
            showCommentsButton.addEventListener("click", function() {
                var commentsContainer = document.getElementById("commentsContainer");
                commentsContainer.style.display = "block";
            });
        });
    </script>
   
</body>
</html>