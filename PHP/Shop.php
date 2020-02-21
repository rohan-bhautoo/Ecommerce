<?php
include('Common.php');

outputHeader("Shop");
?>

<!-- Header tag -->
<header>
    <!-- Navigation Bar -->
    <div class="navigationBar">
        <?php
        outputNavigationBar();
        ?>

        <!-- Search bar -->
        <div class="searchContainer">
            <form name="searchBar" action="../PHP/search_product.php" method="post">
                <input type="text" placeholder="Search.." name="search" id="searchInput">
                <button type="submit" id="searchButton"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</header>

<!-- Container with Title and subtitle -->
<div id="shopContents">
    <div class="jumbotron">
        <div class="container text-center">
            <h1>Shop</h1>
            <p>Have a look at your future watch..</p>
        </div>
    </div>

    <div class="sort">
        <select id="sort" name="sort">
            <option disabled selected>Sort by:</option>
            <option value="Name">Name</option>
            <option value="LowestPrice">Lowest Price</option>
            <option value="HighestPrice">Highest Price</option>
        </select>
        <button type="button" id="sortBtn" onclick="window.location.reload();">Sort</button>
    </div>

    <div id="Products">

    </div>

    <?php
    outputFooter();
    ?>

    <script type="text/javascript" src="../Javascript/DisplayProducts.js" src="../Javascript/ViewRecommended.js"></script>

</div>

<?php
outputFooterEnd();
?>