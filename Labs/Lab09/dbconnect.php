<?php
// Replace these values with your actual database credentials
$hostname = "localhost";
$username = "msaheb";
$password = "NPKQAbf2";
$database = "msaheb";


$connect = mysqli_connect($hostname, $username, $password, $database);

if($connect){ 
    echo "<h2 style='text-align: center; margin-top: 10px;'> LAB 09 </h2>";
    echo "<p style='text-align: center; font-size: 1.6rem; font-weight: bold;'> Connection established successfully: '$database' selected </p>"; 
}
else{ echo "Connection failed"; }

?>