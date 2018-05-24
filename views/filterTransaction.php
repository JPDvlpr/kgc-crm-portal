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
                <td class="td1">
                    <h5>Start Date:</h5>
                    <input type="date" class="form-control" id="from_date" name="from_date"
                           value="<?php echo date("Y-01-01") ?>">
                </td>
                <td>
                    <h5>End Date:</h5>
                    <input type="date" class="form-control" id="to_date" name="to_date"
                           value="<?php echo date("Y-m-d") ?>">
                </td>
                <td>
                    <button type="button" class="btn btn-success" id="success">Add</button>
                </td>
            </tr>


            <tr>
                <td>
                    <h5>Contact Information</h5>
                    <input id="chosenContact" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Columns">
                    <datalist id="contacts">
                        <select id="columnselect">
                            <?php
                            $columns = array("contact_name", "city", "state", "zip");
                            foreach ($columns as $col)
                                echo "<option id = '$col' value='$col'>" . $col . "</option>";
                            ?>
                        </select>
                    </datalist>
                </td>
                <td>
                    <h5></h5>
                    <input id="chosenContact" type=text list=contacts class="form-control"
                           placeholder="Filter By Contact Results">
                    <datalist id="contacts">
                        <select id="columnselect">
                            <option>
                                Bob Smith
                            </option>
                        </select>
                    </datalist>
                </td>
                <td>
                    <button type="button" class="btn btn-success">Add</button>
                </td>
            </tr>
            <!--            Transactions -->
            <tr>
                <td>
                    <h5>Transaction Information</h5>

                    <input id="chosenTransaction" type=text list=transactions class="form-control"
                           placeholder="Filter By Transaction Columns">
                    <datalist id="transactions">
                        <select id="transactionSelect" placeholder="Filter By Transaction Columns">
                            <?php
                            $transactions = array("check_num", "source_type", "trans_type");
                            foreach ($transactions as $trans)
                                echo "<option id = '$trans' value='$trans'>" . $trans . "</option>";
                            ?>
                        </select>
                    </datalist>
                </td>
                <td>
                    <h5>Transactions</h5>
                    <input id="chosenTransaction" type=text list=transactions class="form-control"
                           placeholder="Filter By Transaction Results">
                    <datalist id="transactions">
                        <select id="transactionSelect">
                            <option>
                                Bob Smith
                            </option>
                        </select>
                    </datalist>
                </td>
                <td>
                    <button type="button" class="btn btn-success">Add</button>
                </td>
            </tr>
            <tr
            <tr>
                <th colspan="12">Filtered Results</th>
            </tr>
            <td colspan="12">

            </td>
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

