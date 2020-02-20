<?php

// Include libraries
require __DIR__ . '/vendor/autoload.php';

// Connect to MongoDB and select database
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->Shop;
$product = $db->Product->find();

echo json_encode(iterator_to_array($product));
