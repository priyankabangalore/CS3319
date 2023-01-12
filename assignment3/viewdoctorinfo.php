<!--
        Programmer Name: 00
        Assignment: 3
        Course: CS3319
        Date: November 25th, 2022
-->

<!DOCTYPE html>
<html>
<head>
        <title>CS3319 Assignment 3</title>
        <link rel="stylesheet" type="text/css" href="landingpage.css">
        <link href="https://fonts.googleapis.com/css?family=Trirong" rel="stylesheet">
</head>
<body>

<?php
include "connecttodb.php";

/*
Creates radio buttons with sorting methods as options.
*/

?>

<form method="post" action="">
<h1>View Doctor Information</h1>
<p>Please select how you would like to view all doctor data:</p>
<input type="radio" name="order" value="lastnameasc" checked>By doctor lastname, in ascending order<br>
<input type="radio" name="order" value="lastnamedesc">By doctor lastname, in descending order<br>
<input type="radio" name="order" value="birthdateasc">By doctor birthdate, in ascending order<br>
<input type="radio" name="order" value="birthdatedesc">By doctor birthdate, in descending order<br>
<br>
<input type="submit" name="submit" value="Submit">
<br>
</form>
<br>

<?php
$radioVal = $_POST["order"];

/*
Parses choice from radio buttons and creates the corresponding query. If the query is successful, a sorted table is displayed.
*/

if(isset($_POST['submit'])){
    if($radioVal == "lastnameasc"){
            $sql = "SELECT * FROM doctor ORDER BY lastname ASC";
            $result = $connection->query($sql);
    
            if ($result->num_rows > 0) {
                    echo "<h3>Doctor Information Sorted by Ascending Lastname</h3>";
                    echo "<table><tr><th>Lastname</th><th>Firstname</th><th>License Number</th><th>License Date</th><th>Birthdate</th><th>Hospital They Work At</th><th>Specialty</th></tr>";
                    while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["lastname"]. "</td><td>" . $row["firstname"] . "</td><td>" . $row["licensenum"] . "</td><td>"
                            . $row["licensedate"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["hosworksat"] . "</td><td>" . $row["speciality"] . "</td></tr>";
                    }
            echo "</table>";
            }
             else {
                    echo "0 results for selected sorting.";
            }
    }
    elseif($radioVal == "lastnamedesc"){
            $sql = "SELECT * FROM doctor ORDER BY lastname DESC";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                echo "<h3>Doctor Information Sorted by Descending Lastname</h3>";
                echo "<table><tr><th>Lastname</th><th>Firstname</th><th>License Number</th><th>License Date</th><th>Birthdate</th><th>Hospital They Work At</th><th>Specialty</th></tr>";
                while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["lastname"]. "</td><td>" . $row["firstname"] . "</td><td>" . $row["licensenum"] . "</td><td>"
                        . $row["licensedate"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["hosworksat"] . "</td><td>" . $row["speciality"] . "</td></tr>";
                }
        echo "</table>";
        }
         else {
                echo "0 results for selected sorting.";
        }

}
elseif($radioVal == "birthdatedesc"){
        $sql = "SELECT * FROM doctor ORDER BY birthdate DESC";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
                echo "<h3>Doctor Information Sorted by Descending Birthdate</h3>";
                echo "<table><tr><th>Birthdate</th><th>Lastname</th><th>Firstname</th><th>License Number</th><th>License Date</th><th>Hospital They Work At</th><th>Specialty</th></tr>";
                while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["birthdate"]. "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>"
                        . $row["licensenum"] . "</td><td>" . $row["licensedate"] . "</td><td>" . $row["hosworksat"] . "</td><td>" . $row["speciality"] . "</td></tr>";
                    }
            echo "</table>";
            }
             else {
                    echo "0 results for selected sorting.";
            }
    
    }
    elseif($radioVal == "birthdateasc"){
            $sql = "SELECT * FROM doctor ORDER BY birthdate ASC";
            $result = $connection->query($sql);
    
            if ($result->num_rows > 0) {
                    echo "<h3>Doctor Information Sorted by Ascending Birthdate</h3>";
                    echo "<table><tr><th>Birthdate</th><th>Lastname</th><th>Firstname</th><th>License Number</th><th>License Date</th><th>Hospital They Work At</th><th>Specialty</th></tr>";
                    while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["birthdate"]. "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>"
                            . $row["licensenum"] . "</td><td>" . $row["licensedate"] . "</td><td>" . $row["hosworksat"] . "</td><td>" . $row["speciality"] . "</td></tr>";
                    }
            echo "</table>";
            }
             else {
                echo "0 results for selected sorting.";
            }
    }
    else{
            echo "<br>" .  "Please choose an option.";
    }
    }
    
    /*
    Frees result variable and closes connection to database.
    */
    
     if(isset($result) && $result!=null){
         mysqli_free_result($result);
     }
    
    $connection->close();
    ?>
    
    </body>
    </html>
        
    