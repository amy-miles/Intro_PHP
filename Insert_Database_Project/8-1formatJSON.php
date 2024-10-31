<?php
    //this application will access the db to get the events data
    //it will create an event object using the event class
    //load the event data into that object
    //format the event ovject into a JSON format
    //echo the object back to the client

    try{
        require 'db_connect.php'; //access to the database
        
        $sql = "SELECT events_id, events_name, events_description, events_presenter FROM wdv341_events";      
        
        $stmt = $conn->prepare($sql);           
        
        $stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array
    }
    catch(PDOException $e){
            //echo "Database Failed " . $e->getMessage();
            

            //////// updated catch /////////////////
            // $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log($e->getLine());
            //error_log(var_dump(debug_backtrace()));
        
            // //Clean up any variables or connections that have been left hanging by this error.		
        
            header('Location: 505_error_response_page.php');	//sends control to a User friendly page	
    }

    require "Event.php";

    //$eventObject = new Event();
    //fetch an event 
   
    //fetch one event
    //this will pull one row return as assoc array

    $eventArray = []; //array to hold event objects

    while($eventRow = $stmt->fetch()){
        $eventObject = new Event();

        $eventObject->setID($eventRow["events_id"]);
        $eventObject->setName($eventRow["events_name"]);
        $eventObject->setDescription($eventRow["events_description"]);
        $eventObject->setPresenter($eventRow["events_presenter"]);

        array_push($eventArray, $eventObject);

        echo json_encode($eventArray, JSON_PRETTY_PRINT);//array of JSON objects

        //echo json_decode($eventArray);

    }

    //set the variable values of the object
    // $eventObject->setID($eventRow["events_id"]);
    // $eventObject->setName($eventRow["events_name"]);
    // $eventObject->setDescription($eventRow["events_description"]);
    // $eventObject->setPresenter($eventRow["events_presenter"]);

    // echo "<p>Event ID: " . $eventObject->getID() . "<p>";
    // echo "<p>Event Name: " . $eventObject->getName() . "<p>";
    // echo "<p>Event Description: " . $eventObject->getDescription() . "<p>";
    // echo "<p>Event Presenter: " . $eventObject->getPresenter() . "<p>";

    //convert $eventObject into a JSON object $eventObjectJSON
    //echo json_encode($eventObject, JSON_PRETTY_PRINT);
    //echo "<br>";
    //echo $eventObject; //cannot read PHP object, so errors

    

?>