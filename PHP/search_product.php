<?php
include('Common.php');

outputHeader("Product");
?>

<header>
    <!-- Navigation Bar -->
    <div class="navigationBar">
        <?php
        outputNavigationBar();
        ?>
        <div class="searchContainer">
            <form action="search_product.php" method="post">
                <input type="text" placeholder="Search by product name" name="search" id="search" autocomplete="off">
                <button type="submit"><i class="fa fa-search"></i></button>
                <ul class="list-group" id="result"></ul>
            </form>
        </div>
    </div>
</header>

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
    '$text' => ['$search' => $search_string]
];

//Find the product
$cursor = $collection->find($findCriteria);

//Output the results
foreach ($cursor as $cust) {
    echo '<div class="aside">';
    echo "<p>" . $cust['ProductName'] . "</p>";
    echo "<br>";
    echo '<div class="image">';
    echo "<img width=250 height=250 src = " . $cust['Path'] . ">";
    echo '</div>';
    echo "<br>";
    echo "$" . $cust['Price'];
    echo "<br>";
    echo '<button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
            </button>';
    echo "<hr>";
}
?>

<?php
outputFooter();
?>

<?php
outputFooterEnd();
?>