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

<h1>Assign Doctors to Patients</h1>

<?php
include "connecttodb.php";

/*
Creates dropdown with doctor license numbers as options.
*/

$sql = "SELECT licensenum FROM doctor";
$result = mysqli_query($connection, $sql);

echo '<form action="" method="post">';
echo '<select name="doctor">';
while ($row = mysqli_fetch_assoc($result))
{
    echo '<option value="" selected disabled hidden>Choose Doctor</option>';
    echo '<option value="' . $row["licensenum"] . '">' . $row["licensenum"];
    echo '</option>';
}
echo "</select>";

echo "<br>";
echo "<br>";

/*
Creates dropdown with patient ohip numbers as options.
*/

$sql2 = "SELECT ohipnum FROM patient";
$result2 = mysqli_query($connection, $sql2);

echo '<select name="patient">';
while ($row2 = mysqli_fetch_assoc($result2))
{
    echo '<option value="" selected disabled hidden>Choose Patient</option>';
    echo '<option value="' . $row2["ohipnum"] . '">' . $row2["ohipnum"];
    echo '</option>';
}
echo "</select>";

echo "<br>";
echo "<br>";

echo '<input type="submit" name="submit" value="Submit Choices" />';

echo "<br>";
echo "<br>";

echo "</form>";

/*
Allows queries to be made if all choices have been made and submit button has been clicked.
*/

if(!empty($_POST['doctor']) && !empty($_POST['patient']) && isset($_POST["submit"])) {
    $doctor = $_POST['doctor'];
    $patient = $_POST['patient'];

    echo "You have chosen to assign doctor " . $doctor . " to patient " . $patient . ".";
    echo "<br>";

$sql1 = "INSERT INTO looksafter VALUES ('$doctor','$patient')";

/*
If the doctor can be assigned to the patient then the query was successful. If not, its because they are already assigned to each other.
*/

if ($connection->query($sql1) === TRUE) {
echo 'The doctor was successfully assigned to the patient.';
}
else {
echo 'The doctor you selected is already assigned to the patient.';
}
}

/*
Frees results and closes database connection.
*/

 if(isset($result) && $result!=null){
     mysqli_free_result($result);
 }
 if(isset($result2) && $result2!=null){
     mysqli_free_result($result2);
 }

$connection->close();
?>

</body>
</html>
