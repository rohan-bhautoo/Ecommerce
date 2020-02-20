<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection in database
$collection = $db->Order;

//Extract ID from POST data
$OrderID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Build PHP array with delete criteria
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($OrderID)
];

//Delete the order document
$deleteRes = $collection->deleteOne($deleteCriteria);

//Echo result back to user
if($deleteRes->getDeletedCount() == 1){
    echo 'The order of ' . $OrderID . '  has been successfully deleted.';
}
else {
    echo 'Error deleting order';
}
?>
