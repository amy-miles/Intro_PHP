<!-- UPDATE table_name SET column1 = value1, column2 = value2,… 
WHERE condition; -->
<?php
session_start();
if (!isset($_SESSION['validSession']) || $_SESSION['validSession'] !== "yes") {
    // Redirect to login page
    header("Location: login.php");
    exit; // Stop further script execution
}

$eventsID = $_GET["events_id"];

try {
    require 'db_connect.php'; //access to the database

    //Pass the desired record
    $sql = "SELECT * FROM wdv341_events WHERE events_id = :eventsID"; // named parameter
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':eventsID', $eventsID);

    $stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

    $stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array

    //fetch all into a record
    $eventRecord = $stmt->fetch();

    //assign all columns to a variable
    
    $eventsName = $eventRecord["events_name"];
    $eventsDescription = $eventRecord["events_description"];
    $eventsDate = $eventRecord["events_date"];
    $eventsPresenter = $eventRecord["events_presenter"];
    $eventsTime = $eventRecord["events_time"];
    $eventsDateInserted = $eventRecord["events_date_inserted"];
    $eventsDateUpdated = $eventRecord["events_date_updated"];

} catch (PDOException $e) {
    echo "Database Failed" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>

    <script> 
    // this allows the prepopulated fields to adjust the width dynamically
    document.addEventListener("DOMContentLoaded", function () {
        // Select all input fields on the page
        const inputs = document.querySelectorAll("input[type='text']");

        // Function to adjust the width of an input field
        function adjustWidth(input) {
            input.style.width = input.value.length + "ch";
        }

        // Iterate through all input fields and set up event listeners
        inputs.forEach((input) => {
            // Adjust width on input (typing)
            input.addEventListener("input", function () {
                adjustWidth(input);
            });

            // Initial adjustment on page load (for pre-filled values)
            adjustWidth(input);
        });
    });
</script>

</head>

<body>
    <h1>Update Event</h1>
    <form id="update_form" name="update_form" method="POST" action="updateEvent.php?eventsID=<?php echo $eventsID; ?>">
        <legend>Update an Event</legend>

        <!-- Honeypot Field -->
        <p style="display: none;">
            <label for="event_honeypot">Leave this field blank:</label>
            <input type="text" name="event_honeypot" id="event_honeypot" value="" />
        </p>

        <!-- hidden to send value to the updateEvent page -->
        <input type="hidden" name="events_id" value="<?php echo $eventsID?>" />
              

        <p>
            <label for="events_name">Event Name:</label>
            <input type="text" name="events_name" id="events_name" class="responsive-text-field" value="<?php echo $eventsName  ?>" minlength="3"  />
        </p>
        
        <p>
            <label for="events_description">Event Description: </label>
            <input type="text" name="events_description" id="events_description" class="auto-width"  value="<?php echo $eventsDescription ?>" minlength="10"
                maxlength="255" />
        </p>
        <p>
            <label for="events_presenter">Presenter: </label>
            <input type="text" name="events_presenter" id="events_presenter" value="<?php echo $eventsPresenter ?>" required minlength="3" maxlength="100" />
        </p>
        <p>
            <label for="events_date">Date: </label>
            <input type="date" name="events_date" id="events_date" value="<?php echo $eventsDate ?>" required />
        </p>
        <p>
            <label for="events_time">Time: </label>
            <input type="time" name="events_time" id="events_time" value="<?php echo $eventsTime ?>" required />
        </p>
        <p>
            <button type="submit">Update</button>
            <input type="reset" name="button2" id="button2" value="Reset" />
        </p>
    </form>
</body>

</html>