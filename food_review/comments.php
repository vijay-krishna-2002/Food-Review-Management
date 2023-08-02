<!DOCTYPE html>
<html>
<head>
    <title>Additional Comments</title>
    <style>
       body {
        font-size: 20px;
    font-style: italic;
    color: #black;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px; /* Adjust the padding as needed */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.877);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
    color: white;
    text-align: center; /* Set the font color for table head (th) to black */
}

td {
    background-color: #f2f2f2;
    color: black; /* Set the font color for table data (td) to white */
}
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
</body>
</html>
