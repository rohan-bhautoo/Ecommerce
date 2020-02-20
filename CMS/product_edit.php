<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection in database
$collection = $db->Product;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

//Create a PHP array with the search criteria
//Created an index in mongodb as db.Product.createIndex({ProductName: "text"})
$findCriteria = [
    '$text' => [ '$search' => $search_string]
];

//Find the product
$cursor = $db->Product->find($findCriteria);

//Output the results
echo "<h1>Product</h1>";
foreach ($cursor as $prod){
    echo '<form action ="replace_product.php" method="post">';
    echo 'Product Name: <input type="text" name="ProductName" value="' . $prod['ProductName'] . '" required><br>';
    echo 'Product Description: <input type="text" name="Description" value="' . $prod['Description'] . '" required><br>';
    echo 'Price: <input type="text" name="Price" value="' . $prod['Price'] . '" required><br>';
    echo 'Shipping: <input type="text" name="Shipping" value="' . $prod['Shipping'] . '" required><br>';
    echo 'Quantity Available: <input type="text" name="AvailableQty" value="' . $prod['AvailableQty'] . '" required><br>';
    echo 'Path: <input type="text" name="Path" value="' . $prod['Path'] . '" required><br>';
    echo '<input type="hidden" name="id" value="' . $prod['_id'] . '" required><br>';
    echo '<input type="submit">';
    echo '</form><br>';
}

?>