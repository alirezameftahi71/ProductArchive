import "./_addUpdate.js";

// Fill Form with existing data
function fillUpdateForm(game) {
  $("#name").val(game.name);
  $("#released-date").val(game.released_date);
  $("#rate").val(game.rate);
  $("#isChecked").val(game.checked || 0);
  game.genres.forEach((item) => {
    pushIntoTagmanager("genre", item.name);
  });
  game.platforms.forEach((item) => {
    pushIntoTagmanager("platform", item.name);
  });
  game.publishers.forEach((item) => {
    pushIntoTagmanager("publisher", item.name);
  });
  $("#desc-box").val(game.description);

  // displaying the name of cover pic in browse element
  // const dT = new ClipboardEvent('').clipboardData || new DataTransfer();
  // dT.items.add(new File(['coverPic'], game.cover_pic.replace('uploads/','')));
  // document.querySelector('#cover-pic').files = dT.files;
}

// Push value into tagmanager manually
function pushIntoTagmanager(id, value) {
  $(`#${id}`).tagsManager("pushTag", value);
}

fillUpdateForm(game);
