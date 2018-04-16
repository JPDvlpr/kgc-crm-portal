<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
?>

<DOCTYPE html>
<html>
    <head>
        <title>New Transaction</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="../../temp.css">
    </head>
    <body>
        <div class="container" style="margin-top: 1%">
            <form action="#" method="post">
                <table class="table table-bordered">
                    <thead>
                    <th colspan="4"><strong>Deposit Information</strong></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Deposit By: </td>
                        <td colspan="3"><input type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Date: </td>
                        <td colspan="3"><input type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Reason for Deposit</td>
                        <td colspan="3">
                            <?php
                                include ("categories.php");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total: </td>
                        <td id="total" colspan="3">$</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                    <th colspan="4"><strong>Payment Information</strong></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Amount Paid: </td><div class="input-group">
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="paid" type="text" class="form-control">
                            </div>
                        </td>
                        <td>Discount: </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="discount" type="text" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Deposit Type: </td>
                        <td colspan="3">
                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="cash"> Cash</label>
                            </div>
                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="check"> Check</label>
                            </div>
                            <input class=""
                            <div class="radio disabled">
                                <label><input class="payMethod" type="radio" name="payMethod" value="credit"> Credit Card</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.js"
                integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="../javascript/newTransaction.js"></script>
    </body>
</html>
</DOCTYPE>