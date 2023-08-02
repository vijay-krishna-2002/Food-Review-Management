<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Select Questions</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        
        .popup {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            color: #000000;
            padding: 15px 20px; 
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
            display: none;
        }

        .popup-close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            color: #fff;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Admin Panel - Select Questions</h1>
    <form id="admin-form">
        <input type="checkbox" name="question[]" value="How was accuracy of your order:"> <label>How was accuracy of your order? </label><br>
        <input type="checkbox" name="question[]" value="How was the speed of service:"> <label>How was the speed of service? </label><br>
        <input type="checkbox" name="question[]" value="To rate the standard of hygiene:"> <label>To rate the standard of hygiene? </label><br>
        <input type="checkbox" name="question[]" value="Rate the quality of the food:"> <label>Rate the quality of the food? </label><br>
        <input type="checkbox" name="question[]" value="Rate the decor of restaurant:"> <label>Rate the decor of restaurant? </label><br>
        <input type="checkbox" name="question[]" value="How Was The Server Behavior:"> <label>How Was The Server Behavior? </label><br><br><br>
        <input type="submit" value="Save Questions">
    </form>
    </div>
    <div class="popup" id="popup">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <p>Selected questions saved successfully!</p>
    </div>
    <script>
        document.getElementById('admin-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const selectedQuestions = Array.from(document.querySelectorAll('input[name="question[]"]:checked'))
                .map((checkbox) => checkbox.value);

            fetch('save_selected_questions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(selectedQuestions)
            })
            .then((response) => response.json())
            .then((data) => {
                showPopup();
            })
            .catch((error) => {
                console.error('Error saving selected questions:', error);
            });
        });

        function showPopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'block';
            setTimeout(() => {
                closePopup();
            }, 2000); 
        }

        function closePopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>

</body>
</html>
