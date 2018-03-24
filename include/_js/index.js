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
      $("table #title").text(result[1]['title']);
      $("table #releaseDate").text(result[1]['released_date']);
      $("table #rate").text(result[1]['rate']);
      $("table #genre").text(result[1]['genres']);
      $("table #platform").text(result[1]['platforms']);
      $("table #publisher").text(result[1]['publishers']);
      $("#description").text(result[1]['description']);
      $("#cover-pic").attr('src', result[1]['cover_pic']);
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
            $("table #title").text(result[id]['title']);
            $("table #releaseDate").text(result[id]['released_date']);
            $("table #rate").text(result[id]['rate']);
            $("table #genre").text(result[id]['genres']);
            $("table #platform").text(result[id]['platforms']);
            $("table #publisher").text(result[id]['publishers']);
            $("#description").text(result[id]['description']);
            $("#cover-pic").attr('src', result[id]['cover_pic']);
          }
        );
      });
    }
  );
});