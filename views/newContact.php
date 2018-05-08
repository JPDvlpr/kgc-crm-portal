<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    $states = array('WA','AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL',
        'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
        'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN',
        'TX', 'UT', 'VT', 'VA', 'WV', 'WI', 'WY');
?>

<head>
    <title>New Contact</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form id="newContact" name="newContact" action="#" method="post">
            <table id="contact" class="table table-bordered">
                <thead>
                    <th colspan="6"><strong>New Contact</strong></th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Contact Name:</td>
                        <td colspan="4"><input id="contactName" type="text" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Address:</td>
                        <td colspan="4"><input id="contactAddress" type="text" name="address" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="1">City:</td>
                        <td colspan="1"><input id="contactCity" type="text" name="city" class="form-control"></td>
                        <td colspan="1">State:</td>
                        <td colspan="1">
                            <select name="state">
                                <?php
                                    foreach ($states as $state){
                                        echo '<option value="'.$state.'">'.$state.'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td colspan="1">Zip:</td>
                        <td colspan="1"><input id="contactZipCode" type="text" name="city" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Phone #:<input id="contactPhone" type="text" name="phone" class="form-control"></td>
                        <td colspan="2">Cell Phone #:<input id="contactCellPhone" type="text" name="cellPhone" class="form-control"></td>
                        <td colspan="2">Email Address:<input id="contactEmail" type="email" name="email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Preferred Name:</td>
                        <td colspan="4"><input id="contactAltName" type="text" name="altName" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Alternate Phone #:</td>
                        <td colspan="4"><input id="altPhone" type="text" name="altPhone" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <button id="submit" type="submit" class="btn" name="contactSubmit">Submit Contact</button>
        </form>
    </div>
</body>
