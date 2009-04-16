--TEST--
Should return a meaningful failure message if requested
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

$equal = new PHPSpec_Matcher_Equal(1);
$equal->matches(0);
assert('
$equal->getNegativeFailureMessage() 
    == "expected 0 not to equal 1 (using equal())"
');

?>
===DONE===
--EXPECT--
===DONE===