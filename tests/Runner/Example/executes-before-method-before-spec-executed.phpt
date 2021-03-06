--TEST--
Executing a spec with a before() method executes that method first
--FILE--
<?php
require_once dirname(__FILE__) . '/../../_setup.inc';

class describeEmptyArray extends PHPSpec_Context
{
    public function before() {
        echo 'before ran';
    }
    public function itShouldBeEmpty(){
        $this->spec(array())->should->beEmpty();
        echo 'spec ran';
    }
}

$ex = new PHPSpec_Runner_Example(new describeEmptyArray, 'itShouldBeEmpty');
$ex->execute();

?>
--EXPECT--
before ranspec ran