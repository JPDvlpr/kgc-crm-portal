<!--
Just Ok Team
Filter page has the option to retrieve data
back between certain dates and can filter by
contact category that returns real contact data
-->
<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>

    <!-- CDN minimized bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="../styles/filters.css">-->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>
<body>

<form action="#" method="post">
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <th colspan="6"><strong>Filter Transactions</strong></th>
            </thead>
            <tbody>
            <tr>
                <td>
                    <h5>Date:</h5>
                </td>
                <td class="td1" colspan="2">
                    <div class="form-row">
                        <div class="col" >
                            <h5>Start Date:</h5>
                            <label for="from_date"></label><input type="date" class="form-control" id="from_date"
                                                                  name="from_date"
                                                                  value="<?php echo date("Y-01-01") ?>">

                        </div>

                        <div class="col">
                            <h5>End Date:</h5>
                            <label for="to_date"></label><input type="date" class="form-control" id="to_date"
                                                                name="to_date"
                                                                value="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <h5>Contact Name</h5>
                </td>
                <td colspan="2">
                    <input id="contactColumn" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">
                        <label for="columnselect"></label><select id="columnselect">
                            <script>
                                var contacts;
                                $.ajax({
                                    type: "POST",
                                    url: "views/getContacts.php",
                                    dataType: "json",
                                    success: function (data) {
                                        for (var i = 0; i < data.length; i++) {
                                            $('#columnselect').append("<option value='" + data[i]['phone'] + "'></option>" +
                                                "<option value='" + data[i]['name'] + "'></option>");
                                            contacts.push(data[i]);

                                        }
                                    },
                                    error: function (xhr, textStatus, thrownError, data) {
                                        alert("Error: " + thrownError);
                                    }
                                });
                            </script>
                        </select>
                    </datalist>
                </td>
            </tr>

            <tr>
                <td height="150px">
                    <h5>Category/Item</h5>
                </td>
                <td height="150px">
                    <input id="contactColumn" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">
                        <label for="columnselect"></label><select id="columnselect">
                            <script>
                                var contacts;
                                $.ajax({
                                    type: "POST",
                                    url: "views/getContacts.php",
                                    dataType: "json",
                                    success: function (data) {
                                        for (var i = 0; i < data.length; i++) {
                                            $('#columnselect').append("<option value='" + data[i]['phone'] + "'></option>" +
                                                "<option value='" + data[i]['name'] + "'></option>");
                                            contacts.push(data[i]);

                                        }
                                    },
                                    error: function (xhr, textStatus, thrownError, data) {
                                        alert("Error: " + thrownError);
                                    }
                                });
                            </script>
                        </select>
                    </datalist>
                </td>
                <td>
                    <input id="contactColumn" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">
                        <label for="columnselect"></label><select id="columnselect">
                            <script>
                                var contacts;
                                $.ajax({
                                    type: "POST",
                                    url: "views/getContacts.php",
                                    dataType: "json",
                                    success: function (data) {
                                        for (var i = 0; i < data.length; i++) {
                                            $('#columnselect').append("<option value='" + data[i]['phone'] + "'></option>" +
                                                "<option value='" + data[i]['name'] + "'></option>");
                                            contacts.push(data[i]);

                                        }
                                    },
                                    error: function (xhr, textStatus, thrownError, data) {
                                        alert("Error: " + thrownError);
                                    }
                                });
                            </script>
                        </select>
                    </datalist>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <input type="submit" class="btn btn-secondary" name="submit" id="filter" value="Filter">
</form>
<?php
//require_once("../model/db-filters.php");
//?>
</body>
</html>

