/*
 *  previewDataCSV.js
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file provides the ajax that passes in the filters
 *  And calls the file that generates the preview of the csv
 *  It updates the buttons so that the user knows what is currently available
 *
 *  TODO: Determine if Preview or Generate button needs updating
 *  TODO: Figure out what Tyler wants in the view file that this will return
 */

//creates preview of data in csv file
$(document).on('click', '#preview', function (){
    // $('#preview').html('Generating');
    // var filter = ':' + $('#filter').val() + '"';
    // var filter = $('#filter').val();

    var filters = {};
    $('input').each(function() {
        var index = $(this).attr("id");
        filters[index] = $(this).val();
    });

    var filename = {"filteringData":{
            "filename": $('#filename').val(),
            "filters": filters
        }
    };

    var me = $(this);
    $.ajax({
        type: "POST",
        url: "controller/previewDataCSV.php",
        data: filename,

        success: function (results) {
            // var filename = "files/" + results;
            // $('#generate').replaceWith('<button id="download"><a href="' + filename+ '"download>Download CSV</a></button>');
            // console.log(filename);
            alert(results);
            $('#result').html(results);
            $('#download').replaceWith('<button id="generate">Generate CSV</button>');

        },
        error: function(xhr, textStatus, thrownError, data) {
            alert("Error: " + thrownError);
        }
    });
});


/*
 *  generateCSV.js
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file provides the ajax that passes in the filters
 *  And calls the file that generates the csv
 *  It updates the buttons so that the user knows what is currently available
 *
 */

//creates csv file
$(document).on('click', '#generate', function (event){
    event.preventDefault();
    $('#generate').html('Generating');
    var filter = ':' + $('#filter').val() + '"';
    var filter = $('#filter').val();

    var filters = {};
    $('input').each(function() {
        var index = $(this).attr("id");
        filters[index] = $(this).val();
    });

    var filename = {"filteringData":{
            "filename": $('#filename').val(),
            "filters": filters
        }
    };

    var me = $(this);
    $.ajax({
        type: "POST",
        url: "controller/generateCSV.php",
        data: filename,

        success: function (results) {
            var filename = "files/" + results;
            $('#generate').replaceWith('<button id="download"><a href="' + filename+ '"download>Download CSV</a></button>');
            console.log(filename);
        },
        error: function(xhr, textStatus, thrownError, data) {
            alert("Error: " + thrownError);
        }
    });
});
