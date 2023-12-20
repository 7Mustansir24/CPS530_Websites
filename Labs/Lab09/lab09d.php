<?php
include('dbconnect.php');

// Fetch distinct locations from the database
$locationQuery = "SELECT DISTINCT location FROM Photographs";
$locationResult = mysqli_query($connect, $locationQuery);

// Fetch distinct years from the database
$yearQuery = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photographs";
$yearResult = mysqli_query($connect, $yearQuery);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_form'])) {
    $selectedLocation = mysqli_real_escape_string($connect, $_POST['location']);
    $selectedYear = mysqli_real_escape_string($connect, $_POST['year']);

    // Query the database based on user selection
    $sql = "SELECT * FROM Photographs WHERE location = '$selectedLocation' AND YEAR(date_taken) = '$selectedYear' ORDER BY date_taken DESC";
    $result = mysqli_query($connect, $sql);
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Query Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            background-color: #ecf0f1;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
        }

        .photo {
            margin-top: 20px;
            text-align: center;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .caption {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Photo Query Form</h2>
        <form action="lab09d.php" method="post">
            <label for="location">Select Location:</label>
            <select name="location" id="location" required>
                <option value="">-- Select Location --</option>
                <?php
                while ($row = mysqli_fetch_assoc($locationResult)) {
                    echo "<option value='{$row['location']}'>{$row['location']}</option>";
                }
                ?>
            </select>

            <label for="year">Select Year:</label>
            <select name="year" id="year" required>
                <option value="">-- Select Year --</option>
                <?php
                while ($row = mysqli_fetch_assoc($yearResult)) {
                    echo "<option value='{$row['year']}'>{$row['year']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Submit" name="submit_form">
        </form>

        <?php
        if (isset($result)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='photo'>";
                    echo "<img src='{$row['picture_url']}' alt='{$row['subject']}'>";
                    echo "<div class='caption'>{$row['subject']} - {$row['location']}</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-photos'>No photos match the selected criteria.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
