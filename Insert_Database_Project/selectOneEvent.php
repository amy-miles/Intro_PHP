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

//hard code one row
//$sql = "SELECT events_name, events_description FROM wdv341_events WHERE events_id = 1";

//Pass the desired record
$sql = "SELECT events_name, events_description FROM wdv341_events WHERE events_id = :eventsID";// named parameter
$stmt = $conn->prepare($sql);
$eventsID = 1;
$stmt->bindParam(':eventsID', $eventsID);


//////////////////////////////remeind how to use a variable and json ajax//////////////////////////////////////


//prepared statements allow protection from SQL injection attacks
//prepare and bind
//i - integer
// d - double
// s - string
// b - BLOB (binary large object like images, audio files, videos)
// We must have one of these for each parameter.
// By telling mysql what type of data to expect, we minimize the risk of SQL injections.



//bind parameters

$stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

$stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array



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
    <h3>Assignment 7-2 Selecting One</h3>

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