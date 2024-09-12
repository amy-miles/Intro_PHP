<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php 
        
        $yourName = "Amy";
        
        echo "<h1>2-1 PHP Basics</h1>";        
       
        $number1 = 5;
        $number2 = 8;
        $total = $number1 + $number2;

       
        $myArray = array("PHP", "HTML", "JavaScript");//php array
        
        echo "<script>";            
            echo "let jsArray = [];";
            foreach($myArray as $x){
                echo "jsArray.push('$x');";
            } 
        echo "</script>";
    ?>
</head>

  
<body>

    <h2><?php echo $yourName ?></h2>
    <?php echo "<h3>$number1  +  $number2  =  $total</h3>" ?>
    <?php
        echo "<script>";  
            echo "document.write(jsArray)";
        echo "</script>";
    ?>

</body>
</html>