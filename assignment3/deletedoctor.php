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

<h1>Delete a Doctor</h1>

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

if(!empty($_POST['doctor'])) {
        $selected = $_POST['spec'];
        echo 'You have chosen doctor: ' . $_POST['doctor'] . ' to delete.';
        echo "<br>";
}

/*
Allows users to confirm a permanent deletion.
*/

echo 'Please confirm below that you would like to delete the selected doctor:';

echo "<br>";
echo "<br>";

echo '<form action="" method="post">';
echo '<select name="confirm">';
echo '<option value="" selected disabled hidden>Confirm or Cancel</option>';
echo '<option value="yes">Confirm</option>';
echo '<option value="no">Cancel</option>';
echo "</select>";

echo "<br>";
echo "<br>";
echo '<input type="submit" name="submit" value="Submit Choices" />';

echo "<br>";
echo "<br>";

echo "</form>";

/*
Once all options have been selected and buttons have been clicked, the confirmation is parsed to see if they confirmed or canceled their deletion.
*/

if(!empty($_POST['doctor']) && !empty($_POST['confirm']) && isset($_POST["submit"])) {
        $doctor = $_POST['doctor'];

        $confirmation = $_POST['confirm'];

        if($confirmation == "yes"){

                $sql3 = "DELETE FROM doctor WHERE licensenum='$doctor'";

                if ($connection->query($sql3) === TRUE) {
                        echo 'The selected doctor has been successfully deleted.';
                }
                else {
                    echo "The selected doctor cannot be deleted as they are either a hospital's head doctor or have patients they look after.";
            }
    }
    elseif($confirmation == "no"){
            echo 'Doctor ' . $doctor . ' will not be deleted.';
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
