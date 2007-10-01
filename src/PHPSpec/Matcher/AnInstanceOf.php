<?php

require_once 'PHPSpec/Matcher/Interface.php';

class PHPSpec_Matcher_AnInstanceOf implements PHPSpec_Matcher_Interface
{

    protected $_expected = null;

    protected $_actual = null;

    public function __construct($expected)
    {
        $this->_expected = $expected;
    }

    public function matches($actual)
    {
        if ($actual instanceof $this->_expected) {
            $this->_actual = $this->_expected;
            return true;
        } else {
            $this->_actual = get_class($actual);
        }
        return false;
    }

    public function getFailureMessage()
    {
        return 'expected ' . strval($this->_expected) . ', got ' . strval($this->_actual) . ' (using anInstanceOf())';
    }

    public function getNegativeFailureMessage()
    {
        return 'expected ' . strval($this->_actual) . ' not to be ' . strval($this->_expected) . ' (using anInstanceOf())';
    }

    public function getDescription()
    {
        return 'be an instance of ' . strval($this->_expected);
    }
}