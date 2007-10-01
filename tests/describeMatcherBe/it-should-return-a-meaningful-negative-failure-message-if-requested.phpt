--TEST--
Should return a meaningful failure message if requested
--FILE--
<?php
require dirname(__FILE__) . '/../_setup.inc';
require_once 'PHPSpec/Matcher/Be.php';

$be = new PHPSpec_Matcher_Be(1);
$be->matches(0);

echo $be->getNegativeFailureMessage();

?>
--EXPECT--
expected 0 not to be 1 (using be())