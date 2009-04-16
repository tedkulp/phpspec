--TEST--
Should proxy member setting to source object
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

class Foo {
    public $arg1 = null;
}

$spec = PHPSpec_Specification_Object::getSpec('Foo');

$spec->arg1 = 1;
assert('$spec->arg1->getActualValue() == 1');

?>
===DONE===
--EXPECT--
===DONE===