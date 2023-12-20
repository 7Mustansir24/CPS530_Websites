<?php
include('dbconnect.php');

// Drop the table if it exists
mysqli_query($connect, "DROP TABLE IF EXISTS Photographs");

// Create the table
$sql = "CREATE TABLE Photographs (
    picture_number INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    subject VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date_taken DATE NOT NULL,
    picture_url VARCHAR(500) NOT NULL
)";

$created = mysqli_query($connect, $sql);

// Insert initial values into the table
$initialDataSql = "
    INSERT INTO Photographs (subject, location, date_taken, picture_url) VALUES
        ('Niagara Falls', 'Niagara, Ontario', '2023-05-29', 'images/img1.jpeg'),
        ('Sunsetz', 'Tobermory, Ontario', '2023-04-21', 'images/img2.jpg'),
        ('Taj Mahal', 'Agra, India', '2023-11-25', 'images/img3.jpg'),
        ('Colosseum', 'Rome, Italy', '2023-08-25', 'images/img4.jpeg'),
        ('Eiffel Tower', 'Paris, France', '2023-08-26', 'images/img5.jpeg'),
        ('Banff National Park', 'Banff, British Columbia', '2023-09-02', 'images/img6.jpeg'),
        ('London Bridge', 'London, United Kingdom', '2023-08-28', 'images/img7.jpeg'),
        ('Burj Khalifa', 'Dubai, United Arab Emirates', '2023-10-31', 'images/img8.jpeg'),
        ('Central Park Skyline', 'New York City, New York', '2023-11-17', 'images/img9.jpeg'),
        ('Kaaba', 'Mecca, Saudi Arabia', '2023-08-30', 'images/img10.jpg'),
        ('Statue of Liberty', '	New York City, New York', '2023-05-21', 'images/img11.jpg'),
        ('Great Wall of China', 'Huairau, China', '2023-10-01', 'images/img12.jpeg'),
        ('Great Pyramid Of Giza', 'Giza Plateau, Egypt', '2023-02-22', 'images/img13.jpg')
";

mysqli_multi_query($connect, $initialDataSql);


// Function to add entry
function addEntry($connect)
{
    $subject = $location = $date_taken = $picture_url = '';

    if (isset($_POST['subject']) && isset($_POST['location']) && isset($_POST['date_taken']) && isset($_FILES['picture_url'])) {
        // Get the maximum picture_number
        $query = mysqli_query($connect, "SELECT MAX(picture_number) AS max_number FROM Photographs;");
        $row = mysqli_fetch_assoc($query);
        $max_number = $row['max_number'];

        // Set the AUTO_INCREMENT value
        mysqli_query($connect, "ALTER TABLE Photographs AUTO_INCREMENT = " . ($max_number + 1));

        // Define the upload directory and file name
        $upload_dir = 'images/';
        $picture_url = mysqli_real_escape_string($connect, $_FILES['picture_url']['name']);
        $upload_file = $upload_dir . basename($picture_url);

        // Check file name length
        if (strlen($picture_url) > 250) {
            $text = "<p class='error-message'>Upload failed. File name is too long.</p>";
            return [false, $text];
        }

        // Check file size
        if ($_FILES['picture_url']['size'] > 10000000) {
            $text = "<p class='error-message'>Upload failed. File is too large.</p>";
            return [false, $text];
        }

        // Check file type
        $allowed_types = ['gif', 'jpeg', 'jpg', 'png'];
        $file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        if (!in_array($file_type, $allowed_types)) {
            $text = "<p class='error-message'>Error, unsupported file type.</p>";
            return [false, $text];
        }

        // Check if the file already exists in the database
        $query = mysqli_query($connect, "SELECT * FROM Photographs WHERE picture_url = '$upload_file';");
        $exists = mysqli_fetch_assoc($query);
        if ($exists) {
            $text = "<p class='error-message'>File exists in the database.</p>";
            return [false, $text];
        }

        // Move the uploaded file to the images folder
        if (move_uploaded_file($_FILES["picture_url"]["tmp_name"], $upload_file)) {
            $text = "<p class='success-message'>File upload successful.</p>";
        } else {
            $text = "<p class='error-message'>File upload failed.</p>";
            return [false, $text];
        }

        // Escape and retrieve form data
        $subject = mysqli_real_escape_string($connect, $_POST['subject']);
        $location = mysqli_real_escape_string($connect, $_POST['location']);
        $date_taken = mysqli_real_escape_string($connect, $_POST['date_taken']);

        // Insert data into the database using prepared statements
        $sql = "INSERT INTO Photographs (subject, location, date_taken, picture_url) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);

        mysqli_stmt_bind_param($stmt, "ssss", $subject, $location, $date_taken, $upload_file);
        mysqli_stmt_execute($stmt);

        return [true, $text];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_form'])) {
    $bool = addEntry($connect);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photographs Gallery</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="lab09a.php" method="post" enctype="multipart/form-data">
            <h2>Add New Entry To Existing Table</h2>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>

            <label for="date_taken">Date Taken:</label>
            <input type="date" name="date_taken" id="date_taken" required>

            <label for="picture_url">Image:</label>
            <input type="file" name="picture_url" id="picture_url" required>

            <input type="submit" value="Add Entry" name="submit_form">
        </form>

        <div id="output">
            <?php
            if (isset($bool)) {
                echo $bool[0] ? "<p class='success-message'>" . htmlspecialchars($bool[1]) . "</p><p>Entry added successfully</p>" : "<p class='error-message'>" . htmlspecialchars($bool[1]) . "</p>";
            }
            ?>
            <p><a href="lab09b.php">Visit Part-B</a></p>
			<p><a href="lab09c.php">Visit Part-C</a></p>
			<p><a href="lab09d.php">Visit Part-D</a></p>
			<p><a href="lab09e.php">Visit Part-E</a></p>

        </div>
    </div>
</body>

</html>
