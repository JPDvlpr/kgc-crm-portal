
    <div class="container">
        <form id="transactionForm" name="transactionForm" action="#" method="post">
            <table id="deposit" class="table table-bordered">
                <thead>
                <th colspan="6"><strong>Transaction Information</strong></th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Created By: <span class="text-success">*</span></td>
                        <td colspan="4">
                            <select id="adminId" class="form-control">
                                <?php
                                    include_once ('views/getAdmins.php');
                                ?>
                            </select>

                            <ul id='depositByError' class='error hidden'>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Contact: <span class="text-success">*</span></td>
                        <td colspan="4">
                            <input id="chosenContact" type=text list=contacts class="form-control">
                            <datalist id="contacts">
                            </datalist>
                            <ul id='contactIdError' class='error hidden'>
                            </ul>
                            <p id="conAddress" class="hidden"></p>
                            <p id="conCell" class="hidden"></p>
                            <p id="conPhone" class="hidden"></p>
                            <p id="conEmail" class="hidden"></p>
                            <p id="altName" class="hidden"></p>
                            <p id="altPhone" class="hidden"></p>
                            <ul id='depositByError' class='error hidden'>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Date: </td>
                        <td colspan="4"><input id="date" type="date" name="date" class="form-control"></td>

                        <ul id='dateCreatedError' class='error hidden'>
                        </ul>
                    </tr>
                    <tr>
                        <td colspan="6">Reason for Deposit: <span class="text-success">*</span>
                            <div id="categories" class="container">
                                <?php
                                    include("categories.php");
                                ?>
                                <ul id='itemError' class='error hidden'>
                                </ul>
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
                        <td colspan="2">Amount Paid: <span class="text-success">*</span></td>
                        <td colspan="4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="paid" type="text" class="form-control">

                                <ul id='amountError' class='error hidden'>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Deposit Type: <span class="text-success">*</span></td>
                        <td colspan="4">
                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="A"> Cash</label>
                            </div>

                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="H"> Check</label>
                            </div>
                            <input id="checkNum" class="hidden form-control" type="text" name="checkNum" placeholder="Check Number">
                            <ul id='checkNumError' class='error hidden'>
                            </ul>

                            <div class="radio">
                                <label><input class="payMethod" type="radio" name="payMethod" value="R"> Credit Card</label>
                                <label id="paypal" class="hidden"><input type="radio" name="credit" value="paypal"> Paypal</label>
                                <label id="square" class="hidden"><input type="radio" name="credit" value="square"> Square</label>
                            </div>

                            <ul id='transTypeError' class='error hidden'>
                            </ul>
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