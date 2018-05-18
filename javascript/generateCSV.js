//creates csv file
$(document).on('click', '#generate', function (){
    $('#generate').html('Generating');

    var filename = $(this).attr('href');
    var me = $(this);
    $.ajax({
        type: "POST",
        url: "controller/generateCSV.php",

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
