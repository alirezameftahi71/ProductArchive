// Global variables
var last_update_id = 0;
var id = window.location.search.split("?id=")[1];

$(function () {
  // Tag inputs functionalities
  tagsManagerHandler("genre", '../include/_php/services/get_genres.php');
  tagsManagerHandler("platform", '../include/_php/services/get_platforms.php');
  tagsManagerHandler("publisher", '../include/_php/services/get_publishers.php');
  $('#btn-submit').click(sendUpdateInfo);
  getProductById(id, fillUpdateForm);
});

// Fill Form with existing data
function fillUpdateForm(result) {
  $('#title').val(result[0].title);
  $('#released-date').val(result[0].released_date);
  $('#rate').val(result[0].rate);
  result[0].genres.split(', ').forEach(genre => {
    pushIntoTagmanager("genre", genre);
  });
  result[0].platforms.split(', ').forEach(genre => {
    pushIntoTagmanager("platform", genre);
  });
  result[0].publishers.split(', ').forEach(genre => {
    pushIntoTagmanager("publisher", genre);
  });
  $('#desc-box').val(result[0].description);
}

// Send data to php services
function sendUpdateInfo() {
  var data = $('form').serialize();
  _apiRequest(
    "../include/_php/services/update.php?id=" + id,
    "POST",
    data,
    "TEXT",
    function (result) {
      last_update_id = result;
      var file = $('#cover-pic').prop('files')[0];
      var file_data = new FormData();
      file_data.append('file', file);
      // Send photo
      _apiRequest(
        "../include/_php/services/add_picture.php?id=" + last_update_id,
        "POST",
        file_data,
        "TEXT",
        function (result) {
          // createAlertMessage("messageBox", "success", result);
          window.location.replace("./index.php?id=" + last_update_id);
        },
        function () {
          createAlertMessage("messageBox", "fail", result)
        },
        true
      );
    }
  );
}

function deletePicture() {
  _apiRequest(
    "../include/_php/services/delete_picture.php?id=" + id,
    "GET",
    null,
    "TEXT",
    function (result) {
      createAlertMessage("messageBox", "success", result);
    },
    function (result) {
      createAlertMessage("messageBox", "fail", result);
    },
    false
  );
}