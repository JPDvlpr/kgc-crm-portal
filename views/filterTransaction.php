<!--
Just Ok Team
Filter page has the option to retrieve data
back between certain dates and can filter by
contact category that returns real contact data
-->

<form action="#" method="post">
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <th colspan="6"><strong>Filter Transactions</strong></th>
            </thead>
            <tbody>
            <tr>
                <td class="td-left-col">
                    <h5>Date:</h5>
                </td>
                <td class="td1" colspan="2">
                    <div class="form-row">
                        <div class="col">
                            <h5>Start Date:</h5>
                            <label for="from_date"></label><input type="date" class="form-control" id="start_date"
                                                                  name="start_date"
                                                                  value="<?php echo date("Y-01-01") ?>">

                        </div>

                        <div class="col">
                            <h5>End Date:</h5>
                            <label for="to_date"></label><input type="date" class="form-control" id="end_date"
                                                                name="end_date"
                                                                value="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td class="td-left-col">
                    <h5>Contact Name</h5>
                </td>
                <td colspan="2">
                    <input id="contact_name" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">

                    </datalist>
                </td>
            </tr>

            <tr>
                <td id="td-left-col" height="150px">
                    <h5>Category/Item</h5>
                </td>
                <td height="150px">
                    <!--                    <input list="contacts" name="contacts"-->
                    <!--                           placeholder="Filter By Contact Columns">-->
                    <!--                    <datalist id="contacts">-->
                    <!--                            <option value="purple">-->
                    <!--                            <option value="yellow">-->
                    <!--                    </datalist>-->

                    <input list=category id="chosencategory" class="form-control" placeholder="textttt">
                    <datalist id="category">
                        <?php
                        require("categories2.php");
                        ?>
                    </datalist>
                </td>
                <td>
                    <input id="contactColumn" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">

                    </datalist>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--    <input type="submit" class="btn btn-secondary" name="submit" id="filter" value="Filter">-->
</form>


<form action="#" method="post">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 border"><strong>Filter Transactions</strong></div>
    </div>
    <div class="row">
        <div class="col-1"></div>

        <div class="col-2 border"><h5>Date</h5></div>
        <div class="col-8 border">
            <div class="row">
                <div class="col-6"><h5>Start Date:</h5>
                    <label for="from_date"></label><input type="date" class="form-control" id="start_date"
                                                          name="start_date"
                                                          value="<?php echo date("Y-01-01") ?>">

                </div>
                <div class="col-6">
                    <h5>End Date:</h5>
                    <label for="to_date"></label><input type="date" class="form-control" id="end_date"
                                                        name="end_date"
                                                        value="<?php echo date("Y-m-d") ?>">
                </div>
            </div>
            <br>

        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>

        <div class="col-2 border"><h5>Contact Name</h5></div>

        <div class="col-8 border">
            <br>
            <input id="contact_name" type=text list=contacts class="form-control"
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
            <br>
        </div>
    </div>

    <div class="row" id="categoryDiv">
        <div class="col-1"></div>

        <div class="col-2 border"><h5>Category/Item</h5></div>

        <div class="col-4 border">
            <br>
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
            <br>
        </div>
        <div class="col-4 border">
            <br>
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
            <br>
        </div>

    </div>


    </div>
    <!--    <input type="submit" class="btn btn-secondary" name="submit" id="filter" value="Filter">-->
    <div class="row p-3">
        <div class="col-1"></div>
        <div class="col-2">
            <button id="preview">Preview Data</button>
        </div>
        <div class="col-6"></div>
        <div class="col-2">
            <button id="generate">Generate CSV</button>
        </div>
    </div>
</form>
<div id="results"></div>
<?php
//require_once("../model/db-filters.php");
