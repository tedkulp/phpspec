--TEST--
Should return FALSE if actual value not greater than or equal to (>=) expected value
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

$greater = new PHPSpec_Matcher_BeGreaterThanOrEqualTo(1);
assert('!$greater->matches(0)');

?>
===DONE===
--EXPECT--
===DONE===