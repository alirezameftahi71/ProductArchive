// Print the footer
function getFooter(ownerName) {
  return "\u00A9 2018 - " + (new Date()).getFullYear() + " " + ownerName + " | All Rights Reserved"
}

// Mark the current page as active in navbar 
function activeCurrPage(url) {
  $('ul.navbar-nav a').filter(function () {
    return this.href == url.href.replace('#', '');
  }).parent().addClass('active');
}

// AJAX request general function
function _apiRequest(url, type, data, dataType, onSuccFunc, onFailFunc, isFileContent) {
  if (isFileContent)
    $.ajax({
      url: url,
      type: type,
      data: data,
      dataType: dataType,
      cache: false,
      processData: false,
      contentType: false,
      success: function (e) {
        onSuccFunc(e);
      }
    });
  else
    $.ajax({
      url: url,
      type: type,
      data: data,
      dataType: dataType,
      cache: false,
      success: function (e) {
        onSuccFunc(e);
      }
    });
}

// Tagmanager working with typeahead general function
function tagsManagerHandler(id, url) {
  var tagMan = $("#" + id).tagsManager();
  $("#" + id).typeahead({
    source: function (query, process) {
      return _apiRequest(
        url,
        'GET',
        'query=' + query,
        'json',
        function (data) {
          var newData = [];
          $.each(data, function () {
            newData.push(this.name);
          });
          process(newData);
          return;
        }
      );
    },
    afterSelect: function (item) {
      tagMan.tagsManager("pushTag", item);
    }
  });
}

// Creates a bootstrap 4 alert message
function createAlertMessage(id, type, message) {
  var alertBox = $("<div class='alert alert-" + type + " alert-dismissible'></div>");
  var closeBtn = $("<button type='button' class='close' data-dismiss='alert'>&times;</button>");
  var alertMessage = $("<strong>" + type + "!</strong> " + message + ".");
  $(alertBox).append($(closeBtn));
  $(alertBox).append($(alertMessage));
  $("#" + id).append($(alertBox));
}

// Fills in the main table 
function fillMainTable(result, id) {
  if(id == undefined) id = 1;
  $("table #title").text(result[id]['title']);
  $("table #releaseDate").text(result[id]['released_date']);
  $("table #rate").text(result[id]['rate'] + "/5");
  $("table #genre").text(result[id]['genres']);
  $("table #platform").text(result[id]['platforms']);
  $("table #publisher").text(result[id]['publishers']);
  $("#description").text(result[id]['description']);
  $("#cover-pic").attr('src', result[id]['cover_pic']);
}