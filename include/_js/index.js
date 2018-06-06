$(function () {
  // Call the resizer for list-group
  resizeListGroup();
  // Searchbox filter
  $("#searchBox").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#listItems a").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // Fill the side menu
  getAllProducts();

  // Enabling confirmation
  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    // other options
  });
});

// Calculate the height of main area and asign it to list-group
function resizeListGroup() {
  $('.list-group').height($('#main-area').height() - $('footer').outerHeight() - $('.navbar').outerHeight() + 10);
}

// Bind the resize event to resizeListGroup()
$(window).bind('resize', resizeListGroup);

// Make passed id in items selected and scroll to it
function makeItemSelected(id) {
  var id = window.location.search.split("?id=")[1];
  $('.list-group #' + id).trigger('click');
  window.location.href += "#" + id;
}

// Read all the data 
function getAllProducts() {
  _apiRequest(
    "../include/_php/services/read.php",
    "GET",
    null,
    "json",
    function (result) {
      // Fill the table with first data
      getProductById(Object.keys(result)[0], fillMainTable);
      $.each(result, function (i) {
        $('#listItems').append('<a href="#" id="' + i + '" class="list-group-item list-group-item-action">' + result[i]['title'] + '</a>');
      });
      $($('#listItems').children()[0]).addClass('active');
      $($('#listItems').children()).click(function () {
        $($('#listItems').children()).removeClass('active');
        $(this).addClass('active');
        // Fill the tables and place the photo if exists
        getProductById($(this)[0].id, fillMainTable);
      });

      // Check if there's a return queryString 
      if (window.location.search) {
        makeItemSelected(id);
      }
    }
  );
}

// Fills in the main table 
function fillMainTable(result, id) {
  $("table #title").text(id != undefined ? result[id]['title'] : "Example Product Name");
  $("table #releaseDate").text(id != undefined ? result[id]['released_date'] : "20xx");
  $("table #rate").text(id != undefined ? result[id]['rate'] + "/5" : "#/5");
  $("table #genre").text(id != undefined ? result[id]['genres'] : "Example Genre");
  $("table #platform").text(id != undefined ? result[id]['platforms'] : "Example platform");
  $("table #publisher").text(id != undefined ? result[id]['publishers'] : "Example Company");
  $("#description").text(id != undefined ? result[id]['description'] : "Full Description goes here in multiple lines providing more and detailed information about the product, like story line or history.");
  $("#cover-pic").attr('src', id != undefined ? result[id]['cover_pic'] : "http://via.placeholder.com/270x330");
}

// Find the selected product's id
function getCurrentProductID() {
  return $('#listItems .active').attr('id');
}

// Delete the product
function deleteProduct() {
  _apiRequest(
    "../include/_php/services/delete.php",
    "GET",
    "id=" + getCurrentProductID(),
    "text",
    function (result) {
      createAlertMessage("messageBox", "Success", result);
      var delElement = $('#listItems .active');
      var preElement = delElement.prev();
      var preId = preElement.attr('id');
      preElement.addClass('active');
      delElement.remove();
      if (preId != undefined)
        getProductById(preId, fillMainTable);
      else
        fillMainTable();
    },
    function (result) {
      createAlertMessage("messageBox", "Fail", result);
    },
  );
}

// Update the product
function updateProduct() {
  window.location.replace("update_product.php?id=" + getCurrentProductID());
}