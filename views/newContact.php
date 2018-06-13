<?php
/**
 * The contacts() function takes the errors variable to
 * see if there aren't any errors. Then the function
 * displays the new contact form, so the user can enter a new contact.
 * @param $errors
 *
 * @author Just oK TeaM
 */
function contacts($errors)
{
    //The array of states
    $states = array('WA', 'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL',
        'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
        'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN',
        'TX', 'UT', 'VT', 'VA', 'WV', 'WI', 'WY');
    ?>
    <div class="container">
        <form id="newContact" name="newContact" action="#" method="post">
            <table id="contact" class="table table-bordered">
                <thead>
                <th colspan="6"><strong>New Contact</strong></th>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">Created By: <span class="text-success">*</span></td>
                    <td colspan="4"><select id="adminId" type="text" name="contactCreatedBy"
                                            class="form-control">
                            <?php
                            include_once("getAdmins.php");
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Contact Name: <span class="text-success">*</span></td>
                    <td colspan="4"><input id="contactName" type="text" name="name" class="form-control" value="<?php if($_POST) echo $_POST['name']; ?>">
                    <?php
                        if(array_key_exists('contactNameError', $errors)){
                            echo '<ul id="contactNameError" class="error">';
                            echo '<li>'.$errors['contactNameError'].'</li>';
                            echo '</ul>';
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Address: <span class="text-success">*</span></td>
                    <td colspan="4">
                        <input id="contactAddress" type="text" name="address" class="form-control"
                               placeholder="Street Address" value="<?php if($_POST) echo $_POST['address']; ?>">
                        <div id="addressDiv" class="input-group">
                            <input id="contactCity" type="text" name="city" class="form-control my-2"
                                   placeholder="City" value="<?php if($_POST) echo $_POST['city']; ?>">
                            <select id="states" name="state" class="form-control m-2">
                                <?php
                                foreach ($states as $state) {
                                    echo '<option value="' . $state . '"';
                                    if($_POST){
                                        if($_POST['state'] == $state)
                                            echo "selected";
                                    }
                                    echo '>'.  $state . '</option>';
                                }
                                ?>
                            </select>
                            <input id="contactZipCode" type="text" name="zipCode" class="form-control my-2"
                                   placeholder="Zip Code" value="<?php if($_POST) echo $_POST['zipCode']; ?>">
                        </div>
                        <?php
                        if(array_key_exists('addressError', $errors)){
                            echo '<ul id="addressError" class="error">';
                            echo '<li>'.$errors['addressError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                        <?php
                        if(array_key_exists('cityError', $errors)){
                            echo '<ul id="cityError" class="error">';
                            echo '<li>'.$errors['cityError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                        <?php
                        if(array_key_exists('zipError', $errors)){
                            echo '<ul id="zipError" class="error">';
                            echo '<li>'.$errors['zipError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Phone: <span class="text-success">*</span></td>
                    <td colspan="4">
                        <div id="cellPhone" class="input-group w-100">
                            Primary<input id="contactCellPhone" type="text" name="cellPhone" class="form-control m-2" value="<?php if($_POST) echo $_POST['cellPhone']; ?>">
                        </div>
                        <div id="otherPhone" class="input-group w-100">
                            Secondary<input id="contactPhone" type="text" name="phone" class="form-control m-2" value="<?php if($_POST) echo $_POST['phone']; ?>">
                        </div>
                        <?php
                        if(array_key_exists('phoneError', $errors)){
                            echo '<ul id="phoneError" class="error">';
                            echo '<li>'.$errors['phoneError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Email Address: <span class="text-success">*</span></td>
                    <td colspan="4"><input id="contactEmail" type="email" name="email" class="form-control" value="<?php if($_POST) echo $_POST['email']; ?>">
                        <?php
                        if(array_key_exists('emailAddressError', $errors)){
                            echo '<ul id="emailAddressError" class="error">';
                            echo '<li>'.$errors['emailAddressError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Alternate Contact Name:</td>
                    <td colspan="4"><input id="contactAltName" type="text" name="altName" class="form-control" value="<?php if($_POST) echo $_POST['altName']; ?>">
                        <?php
                        if(array_key_exists('altContactNameError', $errors)){
                            echo '<ul id="altContactNameError" class="error">';
                            echo '<li>'.$errors['altContactNameError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Alternate Contact Phone:</td>
                    <td colspan="4"><input id="altPhone" type="text" name="altPhone" class="form-control" value="<?php if($_POST) echo $_POST['altPhone']; ?>">
                        <?php
                        if(array_key_exists('altContactPhoneError', $errors)){
                            echo '<ul id="altContactPhoneError" class="error">';
                            echo '<li>'.$errors['altContactPhoneError'].'</li>';
                            echo '</ul>';
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <button id="submit" type="submit" class="btn" name="submit">Submit Contact</button>
        </form>
    </div>
    <?php
}

?>