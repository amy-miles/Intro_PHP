<?php
$events_name = htmlspecialchars(trim($_POST["events_name"]), ENT_QUOTES, 'UTF-8');
$events_description = htmlspecialchars(trim($_POST["events_description"]), ENT_QUOTES, 'UTF-8');
$events_presenter = htmlspecialchars(trim($_POST["events_presenter"]), ENT_QUOTES, 'UTF-8');
$events_date = htmlspecialchars(trim($_POST["events_date"]), ENT_QUOTES, 'UTF-8'); 
$events_time = htmlspecialchars(trim($_POST["events_time"]), ENT_QUOTES, 'UTF-8'); 

// DB Connection
require 'db_connect.php';

// SQL insert statement
$sql = "INSERT INTO wdv341_events (events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated)
    VALUES (:events_name, :events_description, :events_presenter, :events_date, :events_time, NOW(), NOW())";

// Prepare
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bindParam(':events_name', $events_name);
$stmt->bindParam(':events_description', $events_description);
$stmt->bindParam(':events_presenter', $events_presenter);
$stmt->bindParam(':events_date', $events_date);  
$stmt->bindParam(':events_time', $events_time);  

// Execute the statement
if ($stmt->execute()) {
    $message =  "Event added successfully!";
} else {
    $message =  "Error adding event.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert an Event Handler</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form id="submission_result_form" name="submission_result_form">
        <legend>Submission Result</legend>
        <p><?php echo $message; ?></p>  
        <p>
            <a href="eventInputForm.html">Add Another Event</a>
        </p>
    </form>
</body>
</html>