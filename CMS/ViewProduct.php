<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection of Product
//Search product in collection
$mObj = $db->Product->find();

?>

<!DOCTYPE html>
<html>
<head>
    <title> View Products </title>

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

    <!-- A class for listing the products available -->
    <div class="list">
    
    <!-- The width of the table -->
    <table style = "width:100%">

    <!-- The columns of the table -->
    <tr>
        <th>ProductName</th>
        <th>Description</th>
        <th>Price</th>
        <th>Shipping</th>
        <th>AvailableQty</th>
        <th>Path</th>
    </tr>

    <!-- For each column, retrieve all products data from database through method mObj as rows in the table -->
    <?php
    foreach($mObj as $row){
        ?>
        <tr>
            <!-- output all data of all products available as rows in the table -->
            <td><?php echo $row['ProductName'] ?></td>
            <td><?php echo $row['Description'] ?></td>
            <td><?php echo $row['Price'] ?></td>
            <td><?php echo $row['Shipping'] ?></td>
            <td><?php echo $row['AvailableQty'] ?></td>
            <td><?php echo $row['Path'] ?></td>
    </tr>
<?php
    }
    ?>
    </table>
</div>
</body>

</html>

