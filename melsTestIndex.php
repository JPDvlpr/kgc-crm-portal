<?php
require_once("views/standard_peices.php");
require_once("validation/backendValidations.php");
standard_header("sample", "");

echo "hello 3";
$errors;
//require_once("views/categories.php");
//if (validateCategory('Class', $errors)) {
//    echo "Class was valid";
//}
//echo "hi";

require_once("views/items.php");

?>
    <script src="validation/frontendValidations.js"></script>
    <div id="results">Nothing</div>
    <script>

        if (isAlphString('')) {
            $('#results').append('accepted empty string<br>');
        } else {
            $('#results').append('rejected empty string<br>');

        }
        if (isAlphString('category234')) {
            $('#results').append('category234<br>');
        }
        if (isAlphString('category')) {
            $('#results').append('category<br>');
        }
        if (isPrice('4.25')) {
            $('#results').append('$4.15<br>');
        }
        if (isPrice('4.2')) {
            $('#results').append('$4.2<br>');
        }
        if (isPrice('54444444.2')) {
            $('#results').append('$544444.2<br>');
        }
        if (isPrice('4.')) {
            $('#results').append('$4.<br>');
        }
        if (isPrice('4')) {
            $('#results').append('$4done<br>');
        }
        if (isPrice('four')) {
            $('#results').append('four<br>');
        }
    </script>
<?php
standard_footer();
?>