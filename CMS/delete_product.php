<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection in database
$collection = $db->Product;

//Extract ID from POST data
$productID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Build PHP array with delete criteria
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($productID)
];

//Delete the product document
$deleteRes = $collection->deleteOne($deleteCriteria);

//Echo result back to user
if($deleteRes->getDeletedCount() == 1){
    echo 'The product of id ' . $productID . '  has been successfully deleted.';
}
else {
    echo 'Error deleting product';
}
?>
