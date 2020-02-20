<?php

//Start session management
session_start();

//Get name and address strings
$Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
$Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Connect to MongoDB and select database
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Create a PHP array with the search criteria
$findCriteria = [
    "Username" => $Username,
];

//Find all of the Staff that match this criteria
$cursor = $db->Staff->find($findCriteria);

//Check that there is exactly one Staff
if($cursor->count() == 0){
    echo 'Username not recognised.';
    return;
}

else if($cursor->count() > 1){
    echo 'Database error: Multiple staffs have the same username.';
    return;
}

//Get Staff
$Staff = $cursor->getNext();

//Check password
if($Staff['Password'] != $Password){
    echo 'Password incorrect!';
    return;
}

//Start session for this user
$_SESSION['loggedInUserUsername'] = $Username;

//Inform web page that login is successful
echo 'Login successful.';

?>

