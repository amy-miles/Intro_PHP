<?php   
    function timestampFormatter($inUnix){
        date_default_timezone_set("America/Chicago");
        return date("m/d/Y", $inUnix);
    }

    function intlTimestampConverter($inUnix){
        date_default_timezone_set("America/Chicago");
        return date('m/d/Y H:i:s', $inUnix);
    }

    function getFranceTimestamp(){
        date_default_timezone_set("Europe/Paris");
        return time();
    }

    function formatFranceTimestamp($inUnix){
        date_default_timezone_set("Europe/Paris");
        return date('m/d/Y H:i:s', $inUnix);
    }
    
    function stringPlay($inString){
        $tempString = $inString;
        echo "Number of characters in the string: " . strlen($tempString) . "<br>";  
        $tempString = trim($inString);      
        echo "Number after trimming any leading or trailing whitespace: " . strlen($tempString) . "<br>";

        echo "This is the string converted to lower case: " . strtolower($tempString) . "<br>";

        if (strpos($tempString, "DMACC") !== false){
            echo "The word 'DMACC' is contained in the string.";
        }else{
            echo "The word 'DMACC' is not contained in the string.";
        }
        
    }

    function formatPhoneNumber($inPhoneNumber){
        $areaCode = substr($inPhoneNumber, 0, 3);
        $prefix = substr($inPhoneNumber, 3, 3);
        $lineNumber = substr($inPhoneNumber, 6, 4 );

        $formattedNumber = "(" . $areaCode . ") " . $prefix . "-" . $lineNumber;

        return $formattedNumber;       
    }

    function formatCurrency($inCurrency){
        $number = (float)$inCurrency;        
        return "$" . number_format($number, 2);
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3-1 PHP Functions</title>
</head>
<body>
    <h1>3-1 PHP Functions</h1>

    <h2>Timestamp Functions</h2>
    <h4>Create a function that will accept a Unix Timestamp as a parameter and format it into mm/dd/yyyy format.</h4>
    <?php 
        $t = time(); 
        echo "Our current timestamp is " . time() . ".<br>" ;      
        echo "Our current date is " . timestampFormatter($t) . ".";
    ?>
    <h4>Create a function that will accept a Unix Timestamp as a parameter and format it into dd/mm/yyyy format to use when working with international dates.</h4>
    <?php
        $franceTimeStamp = getFranceTimestamp();        
        echo "The current timestamp of France is " . $franceTimeStamp . ".<br>";
        echo "The formatted timestamp of France is " . formatFranceTimestamp($franceTimeStamp) . ".<br>";
        echo "Local Date and Time: " . intlTimestampConverter($franceTimeStamp);
    ?>
    <h2>String Functions</h2>
        <p>String to test is " I am a student at DMACC.  " with 2 leading and 3 trailing spaces</p>
    <?php        
        $string1 = " I am a student at DMACC.  ";
        stringPlay($string1);        
    ?>
    <p>String to test is "   He is a student at Iowa State. " with 3 leading and 1 trailing space. </p>
    <?php        
        $string2 = "   He is a student at Iowa State. ";
        stringPlay($string2);        
    ?>
    <h4>Create a function that will accept a number parameter and display it as a formatted phone number.   Use 1234567890 for your testing.</h4>
    <?php
        $testNumber = "1234567890";
        echo formatPhoneNumber($testNumber);
    ?>
    <h4>Create a function that will accept a number parameter and display it as US currency with a dollar sign.  Use 123456 for your testing.</h4>
    <?php 
        $testDollar = "123456";
        echo formatCurrency($testDollar);
    ?>


</body>
</html>