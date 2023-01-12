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

<h1>View a Doctor's Patient(s)</h1>

<?php
include "connecttodb.php";

/*
Creates dropdown with doctor license numbers as options.
*/

$sql = "SELECT licensenum FROM doctor";
$result = mysqli_query($connection, $sql);

echo '<form action="" method="post">';
echo '<select name="spec">';
while ($row = mysqli_fetch_assoc($result))
{
    echo '<option value="" selected disabled hidden>Choose Doctor</option>';
    echo '<option value="' . $row["licensenum"] . '">' . $row["licensenum"];
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
        echo "You have chosen the doctor with license number: " . $selected;
        echo "<br>";
}

/*
The query is made once the submit button is pressed and the information is displayed in a table.
*/

if(isset($_POST['submit'])){
$sql = "SELECT patient.firstname, patient.lastname, patient.ohipnum FROM patient, looksafter WHERE looksafter.licensenum='$selected' AND patient.ohipnum=looksafter.ohipnum";

$result = $connection->query($sql);

        if ($result->num_rows > 0) {
                echo "<h3>Doctor's Patient Information</h3>";
                echo "<table><tr><th>Patient Firstname</th><th>Patient Lastname</th><th>Patient OHIP Number</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["firstname"] . "</td><td>" . $row["lastname"]. "</td><td>" . $row["ohipnum"] . "</td></tr>";
                }
                echo "</table>";
        }
         else {
                echo "The doctor you selected does not have any patients in the database.";
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
