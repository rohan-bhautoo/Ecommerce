"use strict";

// Import recommender class
import { Recommender } from "./Recommender.js";

// Create recommender object
let recommender = new Recommender();

/*
Button to call search function.
*/
document.getElementById("searchButton").onclick = search;

window.onload = showRecommendation;

function search() {
  // Extract search text
  let searchText = document.getElementById("searchInput").value;

  // Add search keyword to the recommender
  recommender.addKeyword(searchText);
  showRecommendation();
}

function showRecommendation() {
  let recommendProd = recommender.getTopKeyword();
  var request = new XMLHttpRequest();

  request.onload = function() {
    let htmlStr = '<h1 style="text-align: center">Recommendations</h1>';
    htmlStr += "<hr style='border-top: 1px solid black;'>";
    document.getElementById("recommendations").innerHTML =
      htmlStr + this.responseText;
  };

  request.open("POST", "RecommendProducts.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("ProductName=" + recommendProd);
}
