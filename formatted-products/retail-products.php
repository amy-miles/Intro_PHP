<?php

try {
    require 'db_connect.php'; //access to the database

    $sql = "SELECT * FROM wdv341_products ORDER BY product_name DESC";

    $stmt = $conn->prepare($sql);

    $stmt->execute(); //Exacute the PDO Prepared stamt, save results in $stmt object

    $stmt->setFetchMode(PDO::FETCH_ASSOC); //return values as an ASSOC array
} catch (PDOException $e) {
    echo "Database Failed " . $e->getMessage();
}


?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
       
</head>

<body>
    <header>
        <h1>DMACC Electronics Store!</h1>
        <p>Products for your Home and School Office</p>
    </header>
    <section>

        <!-- This .productBlock is an example displaying the format/structure of each product.
        It will be replaced by the actual data. Please loop through all of your products and display them using
        this layout and following the instructions of the assignment. -->

        <?php
            while ($productRow = $stmt->fetch()){
                echo '<div class="productBlock">';
                    echo '<div class="productImage">';
                        echo '<img src="productImages/' . $productRow['product_image'] . '">';
                    echo '</div>';
                    echo '<p class="productName">'. $productRow['product_name'] . '</p>';
                    echo '<p class="productDesc">' . $productRow['product_description'] . '</p>';
                    echo '<p class="productPrice">' . $productRow['product_price'] . '</p>';
                    if ($productRow['product_status'] !== ""){
                        echo '<p class="productStatus">' . $productRow['product_status'] . '</p>';
                    }
                    if ($productRow['product_inStock'] < 10){
                        echo '<p class="productInventory productLowInventory">' . $productRow['product_inStock'] . ' in stock!</p>';
                    }else{
                        echo '<p class="productInventory">' . $productRow['product_inStock'] . ' in stock!</p>';
                    }
                echo '</div>';
            }

        ?>
    </section>

</body>

</html>