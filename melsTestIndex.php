<?php
error_reporting(E_ALL);
require_once("views/standard_peices.php");
require_once("validation/backendValidations.php");
include_once("classes/transaction.php");
include_once("classes/contact.php");
standard_header("sample", "");

echo "hello 3";

$errors;
?>

<php?
//require_once("views/categories.php");
//if (validateCategory('Class', $errors)) {
//    echo "Class was valid";
//}
//echo "hi";

require_once("views/items.php");

?>
    <script src="validation/frontendValidations.js"></script>
    <div id="results">Nothing2</div>
<!--    <script>-->
<!---->
<!--        if (isAlphString('')) {-->
<!--            $('#results').append('accepted empty string<br>');-->
<!--        } else {-->
<!--            $('#results').append('rejected empty string<br>');-->
<!---->
<!--        }-->
<!--        if (isAlphString('category234')) {-->
<!--            $('#results').append('category234<br>');-->
<!--        }-->
<!--        if (isAlphString('category')) {-->
<!--            $('#results').append('category<br>');-->
<!--        }-->
<!--        if (isPrice('4.25')) {-->
<!--            $('#results').append('$4.15<br>');-->
<!--        }-->
<!--        if (isPrice('4.2')) {-->
<!--            $('#results').append('$4.2<br>');-->
<!--        }-->
<!--        if (isPrice('54444444.2')) {-->
<!--            $('#results').append('$544444.2<br>');-->
<!--        }-->
<!--        if (isPrice('4.')) {-->
<!--            $('#results').append('$4.<br>');-->
<!--        }-->
<!--        if (isPrice('4')) {-->
<!--            $('#results').append('$4done<br>');-->
<!--        }-->
<!--        if (isPrice('four')) {-->
<!--            $('#results').append('four<br>');-->
<!--        }-->
<!--    </script>-->
<?php
    $transDate = date("Y-m-d H:i:s");
//$itemDesc = $item[3];
//$itemQuantity = $item[1];
//$amount = $item[2];
//$itemId = $item[0];
    $transactionItemsArray = array
    (
        array(2,1,18,"Nothing"),
        array(1,1,3,"test"),
        array(5,2,89,"junk"),
        array(7,1,5,"fiction")
    );
    //$createdBy, $contactId, $transDate, $transactionItemsArray, $amount, $transDesc, $transType, $checkNum, $ccType, $id = 0)
   $test=new Transaction(4, 4, $transDate, $transactionItemsArray, 30, ' ','A', 0, 'Paypal', 789);
   $errors = array();
   $errors = $test->validateTransaction($errors);
//   print_r($errors);
   $test->saveTransaction();
   echo "It appears to be making it this far.";
   $errors2 = array();
   //$createdDate, $createdBy, $contactName, $address, $city, $state, $zip, $phone = null,
    // $cell = null, $emailAddress = null, $altContactName = null,$altContactPhone = null)
   $testContact = new Contact($transDate, 1, "New Person", "123 4th Street", "Renton", "WA", "98023", "(253) 431-6969",
       "(253) 431-6969", "not@none.com", "Grandmother Person", "(253) 431-6969");
   $errors2 = $testContact->validateContact($errors2);
print_r($errors2);
   if(sizeof($errors2) != 0){
       $testContact->saveContact();
   } else {
       echo "<p>Did not validate</p>";
       echo "<pre>";
       var_dump($errors);
       echo "</pre>";
   }
?>
<?php
standard_footer("javascript/transactionEvents.js");
?>