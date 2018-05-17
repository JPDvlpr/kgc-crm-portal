//creates csv file
$(document).on('click', '#generate', function (){
    $('#generate').html('Generating');
    // $('#generate').replaceWith('<button id="generate"><a href="filename">Download CSV</a></button>');

    var filename = $(this).attr('href');
    var me = $(this);
    $.ajax({
        type: "POST",
        // url: "views/items_temp.php",
        url: "controller/generateCSV.php",

        // dataType:"json",
        // data: { category: category },
        // data: { filename: filename},
        // success: function (data) {
        success: function (results) {
                // $('.subCategory').remove();
            // $('#add').remove();
            alert("Still need to dynamically get filename to download");
            alert("Also it seems that I get into success before the file has actually written.");
            $('#generate').replaceWith('<button id="download"><a href="files/LATEST_FILE.csv" download>Download CSV</a></button>');
        },
        error: function(xhr, textStatus, thrownError, data) {
            alert("Error: " + thrownError);
        }
    });
});
