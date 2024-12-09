<?php

session_start(); // This will not create a PHPSESSID cookie
//echo "Session Value: " . ($_SESSION['validSession'] ?? 'Not Set'); // Debugging
//$errorMsg = ""; //option 1 define the global scope variable


if (isset($_SESSION['validSession']) && $_SESSION['validSession'] === "yes"){
    //echo "Session is valid, displaying admin area.";
    //if you are a 'validSession' then you should see the admin page
    //you do not need to sign on again. we will keep you signed on
    $validUser = true; //set flag for Valid user to display the admin page

} 
else {
    //you need to sign on

    if (isset($_POST['submit'])) {
        //the form was submitted, continue processing the form data
        /*
        get the data from the form
        connect to the database
        see if you have a mathcing record in the users table
        if match = true
            valid user
            display admin page

        else 
            invalid user
            display error message
            display the form
        */

        $inUsername = $_POST['inUsername'];
        $inPassword = $_POST['inPassword'];

        try {
            //access database
            require 'db_connect.php'; //access to the database

            //SQL statment
            // $sql = "SELECT user_username, user_username FROM wdv341_users WHERE user_username = :username 
            // AND user_password = :password";

            $sql = "SELECT COUNT(*) FROM wdv341_users WHERE user_username = :username 
        AND user_password = :password";


            // Prepare
            $stmt = $conn->prepare($sql);

            //bind parameters
            $stmt->bindParam(':username', $inUsername);
            $stmt->bindParam(':password', $inPassword);


            $stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

            $rowCount = $stmt->fetchColumn(); //gets number of records 

            if ($rowCount > 0) {
                //valid username/passwrod
                //echo "<h3>Login Successful</h3>";
                $validUser = true; //switch or flag
                $_SESSION['validSession'] = "yes"; //set the session variable
            } else {
                //invalid username/password combo
                
                $validUser = false;
                $errorMsg = "Invalid username and/or password. Please try again.";
                $_SESSION['validSession'] = "no";
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array
        } catch (PDOException $e) {
            echo "Database Failed " . $e->getMessage();
        }
    } else {
        //cusotmoer neeeds to see th form in order to fill it out and submit it for sighon
    }
}// end of check for 'validSession'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Example Page</title>
    <Style>
        .loginErrorDiv {
            color: red;
            font-style: italic;
        }
    </Style>
</head>

<body>

    <h1>WDV341 Intro PHP</h1>
    <h3>Example Login Form</h3>


    <?php
    if (isset($_POST['submit']) && $validUser === true) {
        //display admin or maybe redirect to the user's page
        header("Location:userPage.php");

    ?>
    <?php
    } else {
        //display form

    ?>
        <section class="loginForm">
            <h2>Login Form</h2>
            <form method="post" action="login.php">
                <div class="loginErrorDiv">
                    <?php
                    if (isset($errorMsg)) //option 2 check to see if you have defined this variable yet
                        echo $errorMsg;
                    ?>
                </div>
                <p>
                    <label for="inUserName">Username: </label>
                    <input type="text" name="inUsername" id="inUsername">
                </p>
                <p>
                    <label for="inPassword">Password: </label>
                    <input type="password" name="inPassword" id="inPassword">
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset">
                </p>
            </form>
        </section>
    <?php
    }   //end of else branch    
    ?>

</body>

</html>