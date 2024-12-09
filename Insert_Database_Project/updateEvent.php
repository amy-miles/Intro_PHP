<?php
session_start();
if (!isset($_SESSION['validSession']) || $_SESSION['validSession'] !== "yes") {
    // Redirect to login page
    header("Location: login.php");
    exit; // Stop further script execution
}
//to get the variable from the form in url
//$eventsID2 = $_GET['eventsID'];

//htmlspecialchars converts special characters in a string to their corresponding HTML entities.
//It prevents cross-site scripting(XSS) which ensures chars like <> aren't interpreted as HTML or JavaScript
$events_id = htmlspecialchars(trim($_POST["events_id"]), ENT_QUOTES, 'UTF-8');
$events_name = htmlspecialchars(trim($_POST["events_name"]), ENT_QUOTES, 'UTF-8');
$events_description = htmlspecialchars(trim($_POST["events_description"]), ENT_QUOTES, 'UTF-8');
$events_presenter = htmlspecialchars(trim($_POST["events_presenter"]), ENT_QUOTES, 'UTF-8');
$events_date = htmlspecialchars(trim($_POST["events_date"]), ENT_QUOTES, 'UTF-8');
$events_time = htmlspecialchars(trim($_POST["events_time"]), ENT_QUOTES, 'UTF-8');


try {
    require 'db_connect.php'; //access to the database

    //UPDATE table_name SET column1 = value1, column2 = value2,… WHERE condition;
    $sql = "UPDATE wdv341_events 
                   SET 
                        events_name = :events_name,
                        events_description = :events_description,
                        events_presenter = :events_presenter,
                        events_date = :events_date,
                        events_time = :events_time,                       
                        events_date_updated = NOW()
                    WHERE events_id = :events_id";


    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':events_id', $events_id);
    $stmt->bindParam(':events_name', $events_name);
    $stmt->bindParam(':events_description', $events_description);
    $stmt->bindParam(':events_presenter', $events_presenter);
    $stmt->bindParam(':events_date', $events_date);
    $stmt->bindParam(':events_time', $events_time);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $message = "Event updated successfully!";
        $messageClass = "success"; // Set class for success
    } else {
        $message = "Failed to update the event.";
        $messageClass = "error"; // Set class for error
    }
} catch (PDOException $e) {
    echo "Database Failed " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .logout-button {
            background-color: red;
            /* Set the button background to red */
            color: white;
            /* Set the text color to white for contrast */
            margin-right: 10px;
        }

        .logout-button:hover {
            background-color: darkred;
            /* Change background color on hover */
        }

        .events-buttons {
            margin-top: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <h1>Update Page</h1>
    <div id="update-message-div">
        <p id="update-message" class="<?php echo $messageClass; ?>"><?php echo $message; ?></p>
    </div>
    <div>
        <?php

        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Description</th><th>Presenter</th><th>Date</th><th>Time</th></tr>";
        echo '<tr>';
        echo "<td>" . $events_name . "</td>";
        echo "<td>" . $events_description . "</td>";
        echo "<td>" . $events_presenter . "</td>";
        echo "<td>" . $events_date . "</td>";
        echo "<td>" . $events_time . "</td>";
        echo "</tr>";
        echo "</table>";
        ?>
    </div>
    <div class="events-buttons">
        <button class="logout-button" onclick="window.location.href='logout.php';">Logout</button>
        <button onclick="window.location.href='eventInputForm.php';">Add an Event</button>
        <button onclick="window.location.href='selectEvents.php';">All Events</button>
        <button onclick="window.location.href='userPage.php';">User Page</button>

    </div>
</body>

</html>