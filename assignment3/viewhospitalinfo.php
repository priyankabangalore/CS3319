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

<h1>View Hospital Information</h1>

<?php
include "connecttodb.php";

/*
Creates dropdown with hospital codes as options.
*/

$sql = "SELECT hoscode FROM hospital";
$result = mysqli_query($connection, $sql);

echo '<form action="" method="post">';
echo '<select name="hospital">';
while ($row = mysqli_fetch_assoc($result))
{
    echo '<option value="" selected disabled hidden>Choose Hospital</option>';
    echo '<option value="' . $row["hoscode"] . '">' . $row["hoscode"];
    echo '</option>';
}
echo "</select>";

echo "<br>";
echo "<br>";

echo '<input type="submit" name="submit" value="Submit Choice" />';

echo "<br>";
echo "<br>";

if(!empty($_POST['hospital'])) {
        $selected = $_POST['spec'];
        echo 'You have chosen hospital: ' . $_POST['hospital'];
        echo "<br>";
}

echo "</form>";

/*
If a hospital is chosen and the submit button is clicked, the query is ran. A table is produced based on the query results.
*/

if(!empty($_POST['hospital']) && isset($_POST["submit"])) {

$selected = $_POST['hospital'];

/*
Shows all hospital info in a table.
*/

$sql = "SELECT hosname, city, prov, numofbed, headdoc, doc.firstname, doc.lastname FROM hospital, doctor doc WHERE hoscode='$selected' AND doc.licensenum=hospital.headdoc";
$result = $connection->query($sql);

        if ($result->num_rows > 0) {
                echo "<h3>Hospital Information</h3>";
                echo "<table><tr><th>Hospital Name</th><th>City</th><th>Province</th><th>Number of Beds</th><th>Head Doctor</th><th>Head Doctor Firstname</th><th>Head Doctor Lastname</th></tr>";
                while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["hosname"] . "</td><td>" . $row["city"]. "</td><td>" . $row["prov"] . "</td><td>" . $row["numofbed"] . "</td><td>"
                        . $row["headdoc"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td></tr>";
               }
        echo "</table>";
        echo "<br>";
        }
        else{
                echo "There are no head doctors for this hospital... Yikes!";
        }

/*
Shows all doctors that work at the selected hospital in a table..
*/

$sql1 = "SELECT firstname, lastname FROM doctor WHERE hosworksat='$selected'";

$result1 = $connection->query($sql1);

        if ($result1->num_rows > 0) {
                echo "<h3>Doctors Who Work at The Hospital</h3>";
                echo "<table><tr><th>Doctor First Name</th><th>Doctor Last Name</th></tr>";
                while($row = $result1->fetch_assoc()) {
                        echo "<tr><td>" . $row["firstname"] . "</td><td>" . $row["lastname"]. "</td></tr>";
                }
        echo "</table>";
        echo "<br>";
        }
        else{
                echo "There are no doctors that work at this hospital... Yikes!";
        }
}

/*
Frees result and result 1 variables, and closes the database connecion.
*/

 if(isset($result) && $result!=null){
     mysqli_free_result($result);
 }
 if(isset($result1) && $result1!=null){
    mysqli_free_result($result1);
}

$connection->close();
?>

</body>
</html>
