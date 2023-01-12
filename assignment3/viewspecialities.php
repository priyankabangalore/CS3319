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

<h1>View Doctor Specialities</h1>

<?php
include "connecttodb.php";

/*
Creates dropdown with specialities as options.
*/

$sql = "SELECT DISTINCT speciality FROM doctor";
$result = mysqli_query($connection, $sql);

echo '<form action="" method="post">';
echo '<select name="spec">';
while ($row = mysqli_fetch_assoc($result))
{
    echo '<option value="" selected disabled hidden>Choose Speciality</option>';
    echo '<option value="' . $row["speciality"] . '">' . $row["speciality"];
    echo '</option>';
}
echo "</select>";

echo "<br>";
echo "<br>";

echo '<input type="submit" name="submit" value="Submit Choice" />';

echo "<br>";
echo "<br>";

echo "</form>";

if(!empty($_POST['spec'])) {
        $selected = $_POST['spec'];
        echo 'You have chosen: ' . $selected;
        echo "<br>";
}

/*
If submit is clicked and speciality has been chosen, the query is ran and a table is created with the results.
*/

if(isset($_POST['submit']) && !empty($_POST['spec'])){
$sql = "SELECT * FROM doctor WHERE speciality='$selected'";

$result = $connection->query($sql);

        if ($result->num_rows > 0) {
                echo "<h3>Doctor Information According to Speciality</h3>";
                echo "<table><tr><th>Speciality</th><th>Firstname</th><th>Lastname</th><th>License Number</th><th>License Date</th><th>Birthdate</th><th>Hospital They Work At</th></tr>";
                while($row = $result->fetch_assoc()) { 
                    echo "<tr><td>" . $row["speciality"] . "</td><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . "</td><td>" . $row["licensenum"] . "</td><td>"
                    . $row["licensedate"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["hosworksat"] . "</td></tr>";
            }
    echo "</table>";
    }
     else {
            echo "0 results for selected speciality.";
    }
}

/*
The result variable is freed and the database connection is closed.
*/

if(isset($result) && $result!=null){
 mysqli_free_result($result);
}
$connection->close();
?>

</body>
</html>
