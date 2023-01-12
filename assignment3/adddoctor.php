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

<h1>Add a Doctor</h1>

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
Creates all of the textboxes for users to enter doctor info.
*/

echo 'Doctors License Number: <input type="text" name="licensenum" value="">';

echo "<br>";
echo "<br>";

echo 'Doctors Firstname: <input type="text" name="fname" value="">';

echo "<br>";
echo "<br>";

echo 'Doctors Lastname: <input type="text" name="lname" value="">';

echo "<br>";
echo "<br>";

echo 'Doctors Birthdate: <input type="text" name="bday" value="YYYY-MM-DD">';

echo "<br>";
echo "<br>";

echo 'Doctors License Date: <input type="text" name="licensedate" value="YYYY-MM-DD">';

echo "<br>";
echo "<br>";

echo 'Doctors Speciality: <input type="text" name="spec" value="">';

echo "<br>";
echo "<br>";

echo '<input type="submit" name="submit" value="Submit Change" />';

echo "<br>";
echo "<br>";

echo "</form>";

/*
Only runs queries if all textboxes are filled, hospital has been selected and submit button has been clicked.
*/

if(!empty($_POST['hospital']) && !empty($_POST['spec']) && isset($_POST["submit"]) && !empty($_POST['licensedate']) && !empty($_POST['bday']) && !empty($_POST['lname']) &&  !empty($_POST['$fname']) && !empty($_POST['licensenum'])) {

        $hospital = $_POST['hospital'];
        $speciality = $_POST['spec'];
        $bday = $_POST['bday'];
        $licensedate = $_POST['licensedate'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $licensenum = $_POST['licensenum'];

        $sql1 = "SELECT * FROM doctor WHERE licensenum='$licensenum'";

        $result1 = $connection->query($sql1);

/*
If the query returns a row, that means the license number exists in the db and cannot be used. Else, the doctor will be added.
*/

        if ($result1->num_rows > 0) {
                echo 'A doctor with license number ' . $licensenum . ' already exists, please try again.';
                echo "<br>";
        }
        else{
                $sql2 = "INSERT INTO doctor VALUES ('$licensenum', '$fname', '$lname', '$licensedate', '$bday', '$hospital', '$speciality')";

                if ($connection->query($sql2) === TRUE) {
                        echo 'The doctor has successfully been added to the database.';
                        echo "<br>";
                    }
                }
        }
        
        /*
        Freeing the results and closing the database connection.
        */
        
         if(isset($result) && $result!=null){
             mysqli_free_result($result);
         }
         if(isset($result1) && $result1!=null){
             mysqli_free_result($result1);
         }
        
        $connection->close();
        
        ?>
        