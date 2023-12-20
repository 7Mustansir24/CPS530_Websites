<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
      

        /* Problem 1 Section */
        #problem1 {
            <?php
            $hour = date('H');
            $backgroundImage = '';

            if ($hour >= 6 && $hour < 12) {
                $backgroundImage = 'morning.jpg';
            } elseif ($hour >= 12 && $hour < 16) {
                $backgroundImage = 'afternoon.jpg';
            } elseif ($hour >= 16 && $hour < 20) {
                $backgroundImage = 'evening.jpg';
            } else {
                $backgroundImage = 'night.jpg';
            }



    echo "background: url('$backgroundImage') no-repeat center center fixed;";
    echo 'background-size: cover;'; // Ensure the image covers the entire container without distortion
    echo 'width: 100%;'; // Use 100% width of the container
    echo 'height: 100vh;'; // Use 100% of the viewport height
    echo 'position: relative;'; // Set position to relative
    echo 'color: #fff;'; // Set text color to white for better contrast
    echo 'font-size: 53px;'; // Increase font size for emphasis
    ?>
       
}


        /* Problem 4 Section */
        #problem4 {
            margin-top: 20px;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
        }

        #problem4 a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        #problem4 a:hover {
            color: #ff6600;
        }
    </style>
</head>
<body>
    <!-- Problem 1 Section -->
    <div id="problem1">
        <h1>
            <?php
            if ($hour >= 6 && $hour < 12) {
                echo 'Good Morning! :)';
            } elseif ($hour >= 12 && $hour < 16) {
                echo 'Good Afternoon! :)';
            } elseif ($hour >= 16 && $hour < 20) {
                echo 'Good Evening! :)';
            } else {
                echo 'Good Night! :)';
            }
            ?>
        </h1>
    </div>

    <!-- Problem 2 Section -->
<!-- Problem 2 Section -->
<div id="problem2">
    <div class="section-heading">
        <h2>Problem 2</h2>
        <p>Enter two numbers in the form below to generate a table.</p>
    </div>
    
    <div class="problem-box">
        <form action="lab08b.php" method="post">
            <label for="num1">Enter the first number (3-12):</label>
            <input type="number" name="num1" min="3" max="12" required>

            <label for="num2">Enter the second number (3-12):</label>
            <input type="number" name="num2" min="3" max="12" required>

            <button type="submit">Generate Table</button>
        </form>
    </div>
</div>

    
    <?php
    $counter = isset($_COOKIE['hit_counter']) ? $_COOKIE['hit_counter'] : 0;
    $counter++;

    setcookie('hit_counter', $counter, time() + 3600 * 24 * 30); // Cookie lasts for 30 days
    ?>
  <!-- Hit Counter (moved outside #problem3) -->
    <div id="hit-counter">Hits: <?php echo $counter; ?></div>

    <div id="problem3">
    
</div>

    <!-- Problem 4 Section -->
    <div id="problem4">
        <h2>Problem 4</h2>
        <p>Click on the links to change the Halloween image:</p>
        <a href="?image=zombie1.gif">Zombie 1</a>
        <a href="?image=zombie2.gif">Zombie 2</a>
        <a href="?image=zombie3.gif">Zombie 3</a>

        <p class="return">Current Image: <?php echo isset($_GET['image']) ? $_GET['image'] : 'default.gif'; ?></p>
        
        <div id="halloween-img">
            <img src="images/<?php echo isset($_GET['image']) ? $_GET['image'] : 'default.gif'; ?>" alt="Halloween Image">
        </div>
    </div>
</body>
</html>
