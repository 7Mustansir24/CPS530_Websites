<?php
include('dbconnect.php');

// Fetch data from the database sorted by date_taken in descending order
$sql = "SELECT * FROM Photographs ORDER BY date_taken DESC";
$result = mysqli_query($connect, $sql);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photographs Gallery</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Photographs Gallery</h2>
        <table>
            <tr>
                <th>Picture Number</th>
                <th>Subject</th>
                <th>Location</th>
                <th>Date Taken</th>
                <th>Picture URL</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['picture_number']}</td>";
                echo "<td>{$row['subject']}</td>";
                echo "<td>{$row['location']}</td>";
                echo "<td>{$row['date_taken']}</td>";
                echo "<td><img src='{$row['picture_url']}' alt='{$row['subject']}' style='max-width: 100px; max-height: 100px;'></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
