--TEST--
Should be able to be instantiated from a static method getSpec with variable params
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

class Foo {}

$spec = PHPSpec_Specification_Object::getSpec('Foo');
assert('$spec instanceof PHPSpec_Specification_Object')

?>
===DONE===
--EXPECT--
===DONE===