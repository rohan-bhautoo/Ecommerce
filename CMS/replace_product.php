<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection in database
$collection = $db->Product;


//Extract the product details

$ProductName = filter_input(INPUT_POST, 'ProductName', FILTER_SANITIZE_STRING);
$Description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
$Price = filter_input(INPUT_POST, 'Price', FILTER_SANITIZE_STRING);
$Shipping = filter_input(INPUT_POST, 'Shipping', FILTER_SANITIZE_STRING);
$AvailableQty = filter_input(INPUT_POST, 'AvailableQty', FILTER_SANITIZE_STRING);
$Path = filter_input(INPUT_POST, 'Path', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Criteria for finding document to replace
$replaceCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($id)
];

//Data to replace
$productData = [
    "ProductName" => $ProductName,
    "Description" => $Description,
    "Price" => $Price,
    "Shipping" => $Shipping,
    "AvailableQty" => $AvailableQty,
    "Path" => $Path
];

//Replace product data for this ID
$updateRes = $db->Product->replaceOne($replaceCriteria, $productData);

//Echo result back to the user
if($updateRes->getModifiedCount() == 1)
    echo 'Product document has been successfully replaced.';
else
    echo 'Product replacement error.';
?>