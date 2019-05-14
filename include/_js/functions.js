// Print the footer
function getFooter(ownerName) {
  const startYear = "2018";
  const currentYear = new Date().getFullYear().toString();
  const startYearText = startYear === currentYear ? "" : "2018 - ";
  return `\u00A9 ${startYearText} ${currentYear} ${ownerName} | All Rights Reserved`;
}

// Mark the current page as active in navbar
function activeCurrPage(url) {
  $("ul.navbar-nav a")
    .filter((i, item) => {
      return (
        url.href.includes(item.href) ||
        (url.href.includes("update_product") &&
          item.href.includes("add_product"))
      );
    })
    .parent()
    .addClass("active");
}

// AJAX request general function
function _apiRequest(config) {
  config.isFileContent
    ? $.ajax({
        url: config.url,
        type: config.type,
        data: config.data,
        dataType: config.dataType,
        cache: false,
        processData: false,
        contentType: false,
        success: config.success,
        fail: config.fail
      })
    : $.ajax({
        url: config.url,
        type: config.type,
        data: config.data,
        dataType: config.dataType,
        cache: false,
        success: config.success,
        fail: config.fail
      });
}

// Tagmanager working with typeahead general function
function tagsManagerHandler(id, url) {
  const tagMan = $(`#${id}`).tagsManager();
  $(`#${id}`).typeahead({
    source: (query, process) => {
      return _apiRequest({
        url: url,
        type: "GET",
        data: `query=${query}`,
        dataType: "json",
        success: data => {
          let newData = [];
          $.each(data, (i, item) => {
            newData.push(item.name);
          });
          process(newData);
        },
        fail: res => {}
      });
    },
    afterSelect: item => {
      tagMan.tagsManager("pushTag", item);
    }
  });
}

// Push value into tagmanager manually
function pushIntoTagmanager(id, value) {
  $(`#${id}`).tagsManager("pushTag", value);
}

// Creates a bootstrap 4 alert message
function createAlertMessage(id, type, message) {
  const alertBox = $(
    `<div class='alert alert-${type} alert-dismissible'></div>`
  );
  const closeBtn = $(
    `<button type='button' class='close' data-dismiss='alert'>&times;</button>`
  );
  const alertMessage = $(`<strong>${type}!</strong> ${message}.`);
  $(alertBox).append($(closeBtn));
  $(alertBox).append($(alertMessage));
  $(`#${id}`).append($(alertBox));
}

// Read the data by passed id
function getProductById(id, callback) {
  _apiRequest({
    url: "../include/_php/services/product/read.php",
    type: "GET",
    data: `id=${id}`,
    dataType: "json",
    success: callback
  });
}

// Generates uniqe guids
function uuidv4() {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
    (
      c ^
      (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
    ).toString(16)
  );
}

// Returns selected option of a select element
function getSelectedOption(element) {
  return $($(element)[0].selectedOptions[0]);
}
