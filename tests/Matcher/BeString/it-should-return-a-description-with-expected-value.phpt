--TEST--
Should return a description of the expectation
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

$null = new PHPSpec_Matcher_BeString(null);
$null->matches(null);
echo $null->getDescription();

?>
--EXPECT--
be string