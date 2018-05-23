/*
 *  generateCSV.js
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file provides the ajax that passes in the filters // or it will!
 *  And calls the file that generates the csv
 *  It updates the buttons so that the user knows what is currently available
 *
 *  TODO: get it to pass in the array of values to filter on
 */

//creates csv file
//this command will eventually need to pass in the variables to filter on...
$(document).on('click', '#generate', function (){
    $('#generate').html('Generating');
    var filter = ':' + $('#filter').val() + '"';
    var filter = $('#filter').val();
    // alert(filter);

    // var filename = $(this).attr('href');
    var filename = {"filteringData":{
            "filename": $('#filename').val(),
            "filters": [
                {filter: $('#filter_value').val()}
            ]
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
