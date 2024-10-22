<?php
//include and require statements
//include will produce warning
//require will produce a fatal error and stop the script
//To connect to the database the following stpes:
// 1.	Include db_connect.php (keyword require)
// 2.	Create your SQL query
// 3.	Prepare your PDO statements
// 4.	Bind Variables to the PDO Statements, if any
// 5.	Execute the PDO Statement – run your SWL against the database
// 6.	Process the results from the query

//PDO PHP Data Objects database access and built in statements for interaction
//separates the database from the application data abstract layer


require 'db_connect.php'; //access to the database

$sql = "SELECT events_name, events_description FROM wdv341_events";

//prepared statements allow protection from SQL injection attacks
//prepare and bind
//i - integer
// d - double
// s - string
// b - BLOB (binary large object like images, audio files, videos)
// We must have one of these for each parameter.
// By telling mysql what type of data to expect, we minimize the risk of SQL injections.

$stmt = $conn->prepare($sql);

//bind parameters

$stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

$stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array

//$user = $stmt->fetch();

// Example of Fetch All
// 
// // Fetch all rows at once as an associative array
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($results as $row) {
//     echo "Name: " . htmlspecialchars($row['name']) . "<br>";
//     echo "Email: " . htmlspecialchars($row['email']) . "<br>";
// }
// 

// echo "<p>" . $user["events_name"] . "</p>";
// echo "<p>" . $user["events_description"] . "</p>";

// echo "<table border='1'>";
// echo "<tr><th>Field Name</th><th>Value of Field</th></tr>";
// foreach ($_POST as $key => $value) {
//     echo '<tr>';
//     echo '<td>', $key, '</td>';
//     echo '<td>', $value, '</td>';
//     echo "</tr>";
// }
// echo "</table>";
// echo "<p>&nbsp;</p>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h3>Assignment 7-1</h3>

    <?php
        //htmlspecialchars converts special characters in a string to their corresponding HTML entities.
        //It prevents cross-site scripting(XSS) which ensures chars like <> aren't interpreted as HTML or JavaScript
        //put the loop that processes the database result and outputs the content as an HTML table
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Description</th></tr>";
        while($eventRow = $stmt->fetch()){
            echo '<tr>';
            echo "<td>" . htmlspecialchars($eventRow["events_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($eventRow["events_description"]) . "</td>"; 
            echo "</tr>";        
        }
    ?>

</body>

</html>