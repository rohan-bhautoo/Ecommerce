<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Shop;

//Select collection in database
$collection = $db->Product;

foreach ($_POST as $post_var) {
    $recommendCriteria = [
        '$text' => ['$search' => $post_var]
    ];

    //Find the product
    $cursor = $collection->find($recommendCriteria);

    foreach ($cursor as $prod) {
        echo "<p>" . $prod['ProductName'] . "</p>";
        echo "<br>";
        echo '<div class="image">';
        echo "<img width=250 height=250 src = " . $prod['Path'] . ">";
        echo '</div>';
        echo "<br>";
        echo "$" . $prod['Price'];
    }
}
