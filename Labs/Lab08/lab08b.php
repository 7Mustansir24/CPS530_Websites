<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_INT);
    $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_INT);

    if ($num1 && $num2 && $num1 >= 3 && $num1 <= 12 && $num2 >= 3 && $num2 <= 12) {
        echo '<html><body>';
        for ($i = 1; $i <= $num1; $i++) {
            for ($j = 1; $j <= $num2; $j++) {
                echo $i * $j . ' ';
            }
            echo '<br>';
        }
        echo '</body></html>';
    } else {
        echo '<html><body>';
        echo '<p>Please enter valid numbers between 3 and 12.</p>';
        echo '<a href="lab08.php">Go back</a>';
        echo '</body></html>';
    }
} else {
    header('Location: lab08.php');
    exit();
}
?>
