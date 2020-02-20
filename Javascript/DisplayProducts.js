//Download products when page loads
window.onload = loadProducts;

//Downloads JSON description of products from server
function loadProducts() {
  //Create request object
  let request = new XMLHttpRequest();

  //Create event handler that specifies what should happen when server responds
  request.onload = () => {
    //Check HTTP status code
    if (request.status === 200) {
      //Add data from server to page
      displayProducts(request.responseText);
    } else {
      alert("Error communicating with server: " + request.status);
    }
  };

  //Set up request and send it
  request.open("GET", "ProductDetails.php");
  request.send();
}

//Loads products into page
function displayProducts(jsonProducts) {
  //Convert JSON to array of product objects
  var prodArray = JSON.parse(jsonProducts);
  var option = document.getElementById("sort");
  var selected = option.options[option.selectedIndex].value;

  // Use sort function to display in table
  if (selected == "Name") {
    prodArray.sort(SortLowest("ProductName"));
  } else if (selected == "LowestPrice") {
    prodArray.sort(SortLowest("Price"));
  } else if (selected == "HighestPrice") {
    prodArray.sort(SortHighest("Price"));
  } else {
    var prodArray = JSON.parse(jsonProducts);
  }

  //Create HTML table containing product data
  let htmlStr = "<table>";

  for (let i = 0; i < prodArray.length; ++i) {
    htmlStr += "<tr>";
    htmlStr +=
      "<td style='text-align: center' width='400'><img width=250 height=250 src='" +
      prodArray[i].Path +
      "'></td>";
    htmlStr +=
      "<td valign='top'><p style='font-size: 25px'><strong> " +
      prodArray[i].ProductName +
      "</strong></p>" +
      "<p style='font-size: 22px'>" +
      prodArray[i].Description +
      "</p>" +
      "Price: $" +
      prodArray[i].Price +
      "<br/>Shipping: $" +
      prodArray[i].Shipping +
      "<br/>In Stock: " +
      prodArray[i].AvailableQty +
      "<br/>" +
      "<button class='addToCartButton'>Add to cart</button>" +
      "</td>";
    htmlStr += "</tr>";
  }
  //Finish off table and add to document
  htmlStr += "</table>";

  document.getElementById("Products").innerHTML = htmlStr;
}

function SortLowest(prop) {
  return function(a, b) {
    if (a[prop] > b[prop]) {
      return 1;
    } else if (a[prop] < b[prop]) {
      return -1;
    }
    return 0;
  };
}

function SortHighest(prop) {
  return function(a, b) {
    if (a[prop] > b[prop]) {
      return -1;
    } else if (a[prop] < b[prop]) {
      return 1;
    }
    return 0;
  };
}

function viewDetails() {
  location.replace("http://localhost/Website/PHP/Product.php");
}
