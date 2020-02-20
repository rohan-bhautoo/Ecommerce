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
  document.getElementById(
    "recommendations"
  ).innerHTML = recommender.getTopKeyword();
}
