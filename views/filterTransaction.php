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

</head>
<body>

<form action="#" method="post">

    <div class="container">
        <h1 class="display-4">Filter Transactions</h1>

        <div class="row">

            <div class="col-md-1 form-group">
                Date: <input type="checkbox"><br>
            </div>
            <div class="col-md-3 form-group">
                <h4>Start Date:</h4>
                <input type="date" class="form-control" id="from_date" name="from_date"
                       value="<?php echo date("Y-01-01") ?>">
            </div>
            <div class="col-md-3 form-group">
                <h4>End Date:</h4>
                <input type="date" class="form-control" id="to_date" name="to_date"
                       value="<?php echo date("Y-m-d") ?>">
            </div>
            <div class="col-md-3 ">
                <input type="submit" class="btn btn-secondary" name="submit" id="filter" value="Filter">
            </div>
        </div>
    </div>
</form>
</body>
<style>
    html {
        margin-top: 5%;
        margin-left: 25%;
        text-align: center;
    }

    h1 {
        display: table-header-group;
    }

    .col-md-1 form-group{
        position: absolute;
        left: 0%;
        bottom: 0%;
    }

    #filter{
        position: absolute;
        left: 0%;
        bottom: 0%;
    }
    #from_date,#to_date{
        left: 0%;
        bottom: 0%;
    }

</style>
</html>

