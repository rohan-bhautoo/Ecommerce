<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection of Order
//Search orders in collection
$mObj = $db->Order->find();

?>

<!DOCTYPE html>
<html>

<head>
    <title> View Order </title>

    <!-- These are the styling sheets for each pages-->
    <link rel="stylesheet" type="text/css" href="../CSS/CmsLogin.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <!-- List buttons for nagivation between pages -->
                <li><a href="../CMS/CmsLogin.html">Login</a></li>
                <li><a href="../CMS/ViewProduct.php">View Products</a></li>
                <li><a href="../CMS/AddProducts.html">Add Products</a></li>
                <li><a href="../CMS/EditProducts.html">Edit Products</a></li>
                <li><a href="../CMS/DeleteProducts.html">Delete Products</a></li>
                <li><a href="../CMS/ViewOrder.php">View Order</a></li>
                <li><a href="../CMS/DeleteOrder.html">Delete Order</a></li>
            </ul>
            </div>
        </nav>
    </header>

    <!-- A class for the whole page display setting-->
    <div class="main"></div>

    <!-- A class for listing the orders made -->
    <div class="list">

    <!-- The width of the table -->
    <table style = "width:100%">
    <tr>
        <!-- The columns of the table -->
        <th>OrderNumber</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>ShippingAddress</th>
        <th>Date</th>
    </tr>

    <!-- For each column, retrieve all orders data from database through method mObj as rows in the table -->
    <?php
    foreach($mObj as $row){
        ?>
        <tr>
            <!-- output all data of all orders made as rows in the table -->
            <td><?php echo $row['OrderNumber'] ?></td>
            <td><?php echo $row['Price'] ?></td>
            <td><?php echo $row['Quantity'] ?></td>
            <td><?php echo $row['Total'] ?></td>
            <td><?php echo $row['ShippingAddress'] ?></td>
            <td><?php echo $row['Date'] ?></td>
    </tr>
<?php
    }
?>
    </table>
</div>
    
</body>

</html>
































