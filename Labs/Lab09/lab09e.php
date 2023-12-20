<?php
include('dbconnect.php');

// Query to fetch a random image
$randomImageQuery = "SELECT * FROM Photographs ORDER BY RAND() LIMIT 1";
$randomImageResult = mysqli_query($connect, $randomImageQuery);

// Query to get the total number of images
$totalImagesQuery = "SELECT COUNT(*) AS total FROM Photographs";
$totalImagesResult = mysqli_query($connect, $totalImagesQuery);
$totalImagesRow = mysqli_fetch_assoc($totalImagesResult);
$totalImages = $totalImagesRow['total'];

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Image Display</title>
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
            text-align: center;
        }

        .photo {
            margin-top: 20px;
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

        .total-images {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Random Image Display</h2>

        <?php
        if (mysqli_num_rows($randomImageResult) > 0) {
            $randomImage = mysqli_fetch_assoc($randomImageResult);

            echo "<div class='photo'>";
            echo "<img src='{$randomImage['picture_url']}' alt='{$randomImage['subject']}'>";
            echo "<div class='caption'>{$randomImage['subject']} - {$randomImage['location']}</div>";
            echo "</div>";
        } else {
            echo "<p class='no-photos'>No photos available.</p>";
        }
        ?>

        <div class="total-images">
            Total Number of Images: <?php echo $totalImages; ?>
        </div>
    </div>
</body>
</html>
