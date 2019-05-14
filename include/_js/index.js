$(() => {
  // Searchbox filter
  $("#searchBox").on("keyup", e => {
    const value = $(e.currentTarget)
      .val()
      .toLowerCase();
    $("#list-items a").filter((i, item) => {
      $(item).toggle(
        $(item)
          .text()
          .toLowerCase()
          .indexOf(value) > -1
      );
    });
  });

  // Fill the side menu
  getAllProducts();
});

// Make passed id in items selected and scroll to it
function makeItemSelected(id) {
  $(`.list-group #${id}`).trigger("click");
  window.location.href += `#${id}`;
}

// Read all the data
function getAllProducts() {
  _apiRequest({
    url: "../include/_php/services/product/read.php",
    type: "GET",
    data: null,
    dataType: "json",
    success: result => {
      // fill the sidebar
      $.each(result, i => {
        $("#list-items").append(
          `<a href="#" id="${
            result[i]["id"]
          }" class="list-group-item list-group-item-action">
          ${result[i]["title"]}
          </a>`
        );
      });
      // bind click event on each item in sidebar
      $($("#list-items").children()).click(e => {
        $($("#list-items").children()).removeClass("active");
        $(e.currentTarget).addClass("active");
        // Fill the tables and place the photo if exists
        getProductById($(e.currentTarget)[0].id, fillMainTable);
      });
      // Check if there's a return queryString
      if (window.location.search) {
        const id = window.location.search.split("?id=").pop();
        makeItemSelected(id);
      } else {
        // Fill the table with first data
        getProductById(result[0]["id"], fillMainTable);
        $($("#list-items").children()[0]).addClass("active");
      }
    },
    fail: result => {}
  });
}

// Sets picture passed in on the cover pic box
function getCoverPic(data) {
  return data
    ? `data:image/jpeg;base64,${data}`
    : "../resource/_img/cover-placeholder-265x320.png";
}

// Fills in the main table
function fillMainTable(result) {
  if (result) {
    $("table #title").html(result[0]["title"] ? result[0]["title"] : "---");
    $("table #releaseDate").html(
      result[0]["released_date"] ? result[0]["released_date"] : "---"
    );
    $("table #rate").html(result[0]["rate"] ? result[0]["rate"] + "/5" : "---");
    $("table #genre").html(result[0]["genres"] ? result[0]["genres"] : "---");
    $("table #platform").html(
      result[0]["platforms"] ? result[0]["platforms"] : "---"
    );
    $("table #publisher").html(
      result[0]["publishers"] ? result[0]["publishers"] : "---"
    );
    $("#description").html(
      result[0]["description"] ? result[0]["description"] : ""
    );
    $("#cover-pic").attr(
      "src",
      getCoverPic(result[0]["cover_pic"])
        ? getCoverPic(result[0]["cover_pic"])
        : "../resource/_img/cover-placeholder-265x320.png"
    );
  } else {
    $("table #title").html("Example Product Name");
    $("table #releaseDate").html("20xx");
    $("table #rate").html("#/5");
    $("table #genre").html("Example Genre");
    $("table #platform").html("Example platform");
    $("table #publisher").html("Example Company");
    $("#description").html(
      "Full Description goes here in multiple lines providing more and detailed information about the product, like story line or history."
    );
    $("#cover-pic").attr(
      "src",
      "../resource/_img/cover-placeholder-265x320.png"
    );
  }
}

// Find the selected product's id
function getCurrentProductID() {
  return $("#list-items .active").attr("id");
}

// Delete the product
function deleteProduct() {
  _apiRequest({
    url: "../include/_php/services/product/delete.php",
    type: "GET",
    data: `id=${getCurrentProductID()}`,
    dataType: "text",
    success: result => {
      const delElement = $("#list-items .active");
      const preElement = delElement.prev();
      const preId = preElement.attr("id");
      preElement.addClass("active");
      delElement.remove();
      preId ? getProductById(preId, fillMainTable) : fillMainTable();
    },
    fail: result => {}
  });
}

// Update the product
function updateProduct() {
  window.location.replace(`update_product.php?id=${getCurrentProductID()}`);
}
