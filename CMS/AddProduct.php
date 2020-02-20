<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select a collection
$collection = $db->Product;

//Extract the data that was sent to the server
$ProductName = filter_input(INPUT_POST, 'ProductName', FILTER_SANITIZE_STRING);
$Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
$Price = filter_input(INPUT_POST, 'Price', FILTER_SANITIZE_STRING);
$Shipping = filter_input(INPUT_POST, 'Shipping', FILTER_SANITIZE_STRING);
$AvailableQty = filter_input(INPUT_POST, 'AvailableQty', FILTER_SANITIZE_STRING);
$Path = filter_input(INPUT_POST, 'Path', FILTER_SANITIZE_STRING);


//Convert to PHP array
$dataArray = [

"ProductName" => $ProductName,
"Description" => $Description,
"Price" => $Price,
"Shipping" => $Shipping,
"AvailableQty" => $AvailableQty,
"Path" => $Path

];

//Add the new product to the database
$returnVal = $collection->insertOne($dataArray);


//Echo result back to the user
if($returnVal->getInsertedCount()==1){
    echo 'Product added';
    echo' New document id: ' .$returnVal->getInsertedId();
}
else {
    echo 'Error adding product';
}

?>