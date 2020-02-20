<?php

session_start();

// Include libraries
require __DIR__ . '/vendor/autoload.php';

// Create instance of MongoDB
$mongoClient = (new MongoDB\Client);

// Select database
$db = $mongoClient->Shop;

// Select Collection
$collection = $db->Customer;

// Extract data sent to server
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

// Update id of document
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectId($id)
];

// Delete customer document
$deleteData = $collection->deleteOne($deleteCriteria);

if ($deleteData->getDeletedCount() == 1) {
    $message = "Details Deleted!";

    // Remove session variables
    session_unset();

    // Destroy session
    session_destroy();

    echo "<script type='text/javascript'>
    alert('$message');
    window.location.replace('http://localhost/Website/PHP/Register.php');
    </script>";
    echo '<script type="text/javascript" src="../Javascript/Login.js"></script>';
} else {
    $message = "Error! Details Not Deleted.";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location.replace('http://localhost/Website/PHP/User.php');
    </script>";
}
