<?php
require_once("validation/backendValidations.php");
validateDate('04/11/2015');
echo'<br>';
validateInteger(1);
echo'<br>';
validateEmail('a@m.com');
echo'<br>';
validateAddress('1234 main st se se 4');
echo'<br>';
validateName('a');
