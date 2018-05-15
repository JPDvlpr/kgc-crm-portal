<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
?>

    <div class="container">
        <form id="transactionForm" name="transactionForm" action="#" method="post">
            <table id="deposit" class="table table-bordered">
                <thead>
                <th colspan="6"><strong>Transaction Information</strong></th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Created By: </td>
                        <td colspan="4"><input id="adminId" type="text" name="depositby" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Contact: </td>
                        <td colspan="4">
                            <input id="chosenContact" type=text list=contacts class="form-control">
                            <datalist id="contacts">
                            </datalist>
                            <p id="conAddress"></p>
                            <p id="conCell"></p>
                            <p id="conPhone"></p>
                            <p id="conEmail"></p>
                            <p id="altName"></p>
                            <p id="altPhone"></p>
                        </td>
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
                        <td colspan="2">Total: </td>
                        <td id="total" colspan="4">$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="2">Discount: </td>
                        <td colspan="4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="discount" type="text" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Amount Paid: </td>
                        <td colspan="4">
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
                                <label><input class="payMethod" type="radio" name="payMethod" value="A"> Cash</label>
                            </div>

                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="H"> Check</label>
                            </div>
                            <input id="checkNum" class="hidden form-control" type="text" name="checkNum" placeholder="Check Number">

                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="R"> Credit Card</label>
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

            <button id="submit" type="submit" class="btn" name="submit">Submit Transaction</button>
        </form>

        <div id='dialog' title='Delete Confirmation'>
            <p>Are you sure you want to delete this item</p>
        </div>

    </div>