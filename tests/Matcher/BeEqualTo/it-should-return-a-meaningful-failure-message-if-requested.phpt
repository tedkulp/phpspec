--TEST--
Should return a meaningful failure message if requested
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

$equal = new PHPSpec_Matcher_BeEqualTo(1);
$equal->matches(0);
assert('$equal->getFailureMessage() == "expected 1, got 0 (using beEqualTo())"');

?>
===DONE===
--EXPECT--
===DONE===