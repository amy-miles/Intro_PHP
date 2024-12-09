<?php
session_start();

if ($_SESSION['validSession'] !== "yes") {
    header("Location: login.php"); //server side redirect
}

//page will delete an event
//no confirmation is required
//it wil return to selctEvents.hp to display the updated events list
try {
    require 'db_connect.php'; //access to the database

    $eventsID = $_GET['eventsID'];

    $sql = "DELETE FROM wdv341_events WHERE events_id = :eventsID";

    //prepared statements allow protection from SQL injection attacks
    //prepare and bind
    //i - integer
    // d - double
    // s - string
    // b - BLOB (binary large object like images, audio files, videos)
    // We must have one of these for each parameter.
    // By telling mysql what type of data to expect, we minimize the risk of SQL injections.

    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':eventsID', $eventsID);
    $stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

    $stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array

    

} catch (PDOException $e) {
    echo "Database Failed " . $e->getMessage();
}
header("Location: selectEvents.php");
?>