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
            <form name="searchBar" action="search_product.php" method="post">
                <input type="text" placeholder="Search..." name="search" id="searchInput">
                <button type="submit" id="searchButton"><i class="fa fa-search"></i></button>
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

foreach ($_POST as $post_var) {

    $recommendCriteria = [
        '$text' => ['$search' => $post_var]
    ];
}

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

//Create a PHP array with the search criteria
//Created an index in mongodb as db.Product.createIndex({ProductName: "text"})
$findCriteria = [
    '$text' => ['$search' => $search_string]
];

//Find the product
$cursor = $collection->find($findCriteria);

if ($collection->count($findCriteria) > 0) {
    echo '<div id="recommendations" style="font-size: 20px; padding: 8px">';
    echo '</div>';

    echo '<h1 style="text-align: center">Results</h1>';
    echo "<hr style='border-top: 1px solid black;'>";
    //Output the results
    foreach ($cursor as $prod) {
        echo '<div class="aside">';
        echo "<p>" . $prod['ProductName'] . "</p>";
        echo "<br>";
        echo '<div class="image">';
        echo "<img width=250 height=250 src = " . $prod['Path'] . ">";
        echo '</div>';
        echo "<br>";
        echo "$" . $prod['Price'];
        echo "<br>";
        echo '<button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
            </button>';
        echo "</div>";
    }

    echo '<script type="module" src="../Javascript/ViewRecommended.js"></script>';
} else {
    $message = "No product found!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location.replace('http://localhost/Website/PHP/Shop.php');
    </script>";
    return;
}
?>

<?php
outputFooter();
?>

<?php
outputFooterEnd();
?>