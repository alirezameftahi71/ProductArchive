// Global variables
let id = window.location.search.split("?id=")[1];

$(() => {
  // Tag inputs functionalities
  tagsManagerHandler("genre", "../include/_php/services/get_genres.php");
  tagsManagerHandler("platform", "../include/_php/services/get_platforms.php");
  tagsManagerHandler(
    "publisher",
    "../include/_php/services/get_publishers.php"
  );
  $("#btn-submit").click(sendUpdateInfo);
  getProductById(id, fillUpdateForm);
});

// Fill Form with existing data
function fillUpdateForm(result) {
  $("#title").val(result[0].title);
  $("#released-date").val(result[0].released_date);
  $("#rate").val(result[0].rate);
  $("#isDone").val(result[0].completed || 0);
  result[0].genres.split(", ").forEach(genre => {
    pushIntoTagmanager("genre", genre);
  });
  result[0].platforms.split(", ").forEach(genre => {
    pushIntoTagmanager("platform", genre);
  });
  result[0].publishers.split(", ").forEach(genre => {
    pushIntoTagmanager("publisher", genre);
  });
  $("#desc-box").val(result[0].description);
}

// Send data to php services
function sendUpdateInfo() {
  const data = $("form").serialize();
  _apiRequest({
    url: `../include/_php/services/product/update.php?id=${id}`,
    type: "POST",
    data: data,
    dataType: "TEXT",
    success: result => {
      let last_update_id = result;
      const file = $("#cover-pic").prop("files")[0];
      const file_data = new FormData();
      file_data.append("file", file);
      // Send photo
      _apiRequest({
        url: `../include/_php/services/add_picture.php?id=${last_update_id}`,
        type: "POST",
        data: file_data,
        dataType: "TEXT",
        success: result => {
          window.location.replace(`./index.php?id=${last_update_id}`);
        },
        fail: () => {
          createAlertMessage("messageBox", "fail", result);
        },
        isFileContent: true
      });
    }
  });
}

// Remove the picture for product from database functionality
function deletePicture() {
  _apiRequest({
    url: `../include/_php/services/delete_picture.php?id=${id}`,
    type: "GET",
    data: null,
    dataType: "TEXT",
    success: result => {
      createAlertMessage("messageBox", "success", result);
    },
    fail: result => {
      createAlertMessage("messageBox", "fail", result);
    }
  });
}
