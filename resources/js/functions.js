// Print the footer
function getFooter(ownerName) {
    const startYear = "2018";
    const currentYear = (new Date()).getFullYear().toString();
    const startYearText = startYear === currentYear ? "" : "2018 - ";
    return `\u00A9 ${startYearText + currentYear} ${ownerName} | All Rights Reserved`;
}

// Mark the current page as active in navbar 
function activeCurrPage(url) {
    $('ul.navbar-nav a').filter(() => {
        return url.href.includes(this.href);
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

// Push value into tagmanager manually 
function pushIntoTagmanager(id, value) {
    $("#" + id).tagsManager("pushTag", value);
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

// Read the data by passed id
function getProductById(id, successFunc) {
    _apiRequest(
        "../include/_php/services/product/read.php",
        "GET",
        "id=" + id,
        "json",
        function (result) {
            successFunc(result);
        }
    );
}

// Generates uniqe guids 
function uuidv4() {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    )
}

// Returns selected option of a select element
function getSelectedOption(element) {
    return $($(element)[0].selectedOptions[0]);
}
