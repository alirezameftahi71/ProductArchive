$(() => {
  // Tag inputs functionalities
  tagsManagerHandler("genre", "../include/_php/services/get_genres.php");
  tagsManagerHandler("platform", "../include/_php/services/get_platforms.php");
  tagsManagerHandler(
    "publisher",
    "../include/_php/services/get_publishers.php"
  );
  $("#btn-submit").click(sendAddInfo);
  $("#file-browse-wrapper a").hide();
});

// Send data to php services
function sendAddInfo() {
  const data = $("form").serialize();
  _apiRequest({
    url: "../include/_php/services/product/create.php",
    type: "POST",
    data: data,
    dataType: "TEXT",
    success: result => {
      let last_insert_id = result;
      const file = $("#cover-pic").prop("files")[0];
      const file_data = new FormData();
      file_data.append("file", file);
      // Send photo
      _apiRequest({
        url: `../include/_php/services/add_picture.php?id=${last_insert_id}`,
        type: "POST",
        data: file_data,
        dataType: "TEXT",
        success: result => {
          createAlertMessage("messageBox", "success", result);
        },
        fail: () => {
          createAlertMessage("messageBox", "fail", result);
        },
        isFileContent: true
      });
    },
    fail: result => {}
  });
}
