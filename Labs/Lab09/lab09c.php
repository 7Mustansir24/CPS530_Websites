<?php
include('dbconnect.php');

// Fetch photos taken in Ontario
$sql = "SELECT * FROM Photographs WHERE location LIKE '%Ontario%' ORDER BY date_taken DESC";
$result = mysqli_query($connect, $sql);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ontario Photos Gallery</title>
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

        .photo {
            margin-bottom: 20px;
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

        .no-photos {
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ontario Photos Gallery</h2>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='photo'>";
                echo "<img src='{$row['picture_url']}' alt='{$row['subject']}'>";
                echo "<div class='caption'>{$row['subject']} - {$row['location']}</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-photos'>No photos taken in Ontario.</p>";
        }
        ?>
    </div>
</body>
</html>
