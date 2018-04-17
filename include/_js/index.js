$(function() {
  // Searchbox filter
  $("#searchBox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listItems a").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // Fill the table with first data
  _apiRequest(
    "../include/_php/services/read.php",
    "GET",
    "id=1",
    "json",
    function(result){
      fillMainTable(result, 1);
    }
  );

  // Fill the side menu
  _apiRequest(
    "../include/_php/services/read.php",
    "GET",
    null,
    "json",
    function(result){
      $.each(result, function(i) {
        $('#listItems').append('<a href="#" id="' + i + '" class="list-group-item list-group-item-action">' + result[i]['title'] + '</a>');
      });
      $($('#listItems').children()[0]).addClass('active');
      $($('#listItems').children()).click(function(){
        $($('#listItems').children()).removeClass('active');
        $(this).addClass('active');
        var id = $(this)[0].id
        // Fill the tables and place the photo if exists
        _apiRequest(
          "../include/_php/services/read.php",
          "GET",
          "id=" + id,
          "json",
          function(result){
            fillMainTable(result, id);
          }
        );
      });
    }
  );
});