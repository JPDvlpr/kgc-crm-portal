<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
?>

<head>
    <title>New Transaction</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/temp.css">
</head>
<body>
    <div class="container">
        <form id="transactionForm" name="transactionForm" action="#" method="post">
            <table id="deposit" class="table table-bordered">
                <thead>
                <th colspan="6"><strong>Deposit Information</strong></th>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">Deposit By: </td>
                    <td colspan="4"><input type="text" name="depositby" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="2">Date: </td>
                    <td colspan="4"><input id="date" type="date" name="date" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="6">Reason for Deposit:
                        <div id="categories" class="container">
                            <?php
                                include("categories.php");
                            ?>
                        </div>
                    </td>
                </tr>
                <thead id="lineItems" class="hidden">
                    <th>Qty</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Delete</th>
                </thead>
                <tr>
                    <td colspan="4">Total: </td>
                    <td id="total" colspan="2">$0.00</td>
                </tr>
                <tr>
                    <td colspan="4">Discount: </td>
                    <td colspan="2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input id="discount" type="text" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Amount Paid: </td>
                    <td colspan="2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input id="paid" type="text" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Deposit Type: </td>
                    <td colspan="4">
                        <div class="radio">
                            <label><input class="payMethod" type="radio" name="payMethod" value="cash"> Cash</label>
                        </div>

                        <div class="radio">
                            <label><input class="payMethod" type="radio" name="payMethod" value="check"> Check</label>
                        </div>
                        <input id="checkNum" class="hidden form-control" type="text" name="checkNum" placeholder="Check Number">

                        <div class="radio">
                            <label><input class="payMethod" type="radio" name="payMethod" value="credit"> Credit Card</label>
                            <label id="paypal" class="hidden"><input type="radio" name="credit" value="paypal"> Paypal</label>
                            <label id="square" class="hidden"><input type="radio" name="credit" value="square"> Square</label>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">Notes: </td>
                    <td colspan="4">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="notes"></textarea>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <button type="submit" class="btn" name="submit">Submit Transaction</button>
        </form>

    </div>