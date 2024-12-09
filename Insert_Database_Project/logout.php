<!-- //set your session veriable validUser to false
    //session_unset()
    //session_destroy()
//redirect the user to the website's home page or login password_get_info
    //use the PI IP hearer() fuction to perfor the redirect -->

<?php
session_start();
//destroy the session
session_unset();
session_destroy();


//disconnect from the database
$conn = null;
$stmt = null;

//redirect to home page or login
header("Location:login.php");



?>