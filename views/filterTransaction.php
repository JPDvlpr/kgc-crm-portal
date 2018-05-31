<!--
Just Ok Team
Filter page has the option to retrieve data
back between certain dates and can filter by
contact category that returns real contact data
-->

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

            </datalist>
            <br>
        </div>
    </div>

    <div class="row" id="categoryDiv">
        <div class="col-1"></div>

        <div class="col-2 border"><h5>Category/Item</h5></div>

        <div class="col-4 border">
            <br>
            <select id="cat_name" class="form-control">
                <option value="all" selected>All</option>
                <?php
                require("categories2.php");
                ?>
            </select>
            <br>
        </div>
        <div class="col-4 border">
            <br>
            <select id="item_name" class="form-control" disabled>
                <option>Please Select Category First</option>
            </select>
            <br>
        </div>
    </div>
    </div>

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


<div class="row" id="filter-div">
    <div class="col-10 border">
        <table id="example" class="display">
            <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Contact Name</th>
                <th>Total Amount</th>
                <th>Item Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            <tr>
                <td>11/30/2017</td>
                <td>Tim Tebow</td>
                <td>$250.00</td>
                <td>Some item description</td>
            </tr>
            <tr>
                <td>05/25/2018</td>
                <td>Kevin Durant</td>
                <td>$375.00</td>
                <td>Some other item description</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>