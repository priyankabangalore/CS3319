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
<h1>Change the Number of Hospital Beds</h1>

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

/*
Takes new number of beds as input.
*/

echo 'New number of beds: <input type="number" name="beds" value="">';

echo "<br>";
echo "<br>";

echo '<input type="submit" name="submit" value="Submit Change" />';

echo "<br>";
echo "<br>";

echo "</form>";

/*
Queries will be made when all options have been selected and submit button has been clicked.
*/

if(!empty($_POST['hospital']) && !empty($_POST['beds']) && isset($_POST["submit"])) {
        $selected = $_POST['hospital'];
        $numbeds = $_POST['beds'];

        $sql1 = "UPDATE hospital SET numofbed='$numbeds' WHERE hoscode='$selected'";

        if ($connection->query($sql1) === TRUE) {
            echo 'Hospital ' . $selected . 's number of beds has successfully been updated to ' . $numbeds . '.';
        }
        else {
                 echo 'Error updating record: ' . $connection->error;
        }
}

/*
Frees result variable and closes database connection.
*/

 if(isset($result) && $result!=null){
     mysqli_free_result($result);
 }

$connection->close();
?>

</body>
</html>
