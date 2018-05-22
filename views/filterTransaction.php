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
                <th>Start Date:</th>
                <th>End Date:</th>
            </tr>
            <tr>
                <td>
                    <input type="date" class="form-control" id="from_date" name="from_date"
                           value="<?php echo date("Y-01-01") ?>">
                </td>
                <td>
                    <input type="date" class="form-control" id="to_date" name="to_date"
                           value="<?php echo date("Y-m-d") ?>">
                </td>
            </tr>
            <tr>
                <th>Contact Columns</th>
                <th>Contacts</th>
            </tr>
            <tr>
                <td>
                    <input id="chosenContact" type=text list=contacts class="form-control">
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
                    <input id="chosenContact" type=text list=contacts class="form-control">
                    <datalist id="contacts">
                        <select id="columnselect">
                            <option>
                                Bob Smith
                            </option>
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

