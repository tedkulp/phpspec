<?php

class PHPSpec_Specification
{

    protected $_interrogator = null;

    protected $_expectation = null;

    protected $_expectedValue = null;

    protected $_actualValue = null;

    protected $_matcherResult = null;

    protected $_matcher = null;

    //protected $_runner = null; // hackish for phpt for now

    protected function __construct()
    {}

    public static function getSpec() // variable param list
    {
        $args = func_get_args();
        $value = $args[0];
        if ((is_string($value) && class_exists($value, true)) || is_object($value)) {
            $class = new ReflectionClass('PHPSpec_Object_Interrogator');
            $interrogator = $class->newInstanceArgs($args);
            $spec = new PHPSpec_Specification_Object($interrogator);
        } else {
            $scalarValue = array_shift($args);
            $spec = new PHPSpec_Specification_Scalar($scalarValue);
        }

        return $spec;
    }

    public function getExpectation()
    {
        return $this->_expectation;
    }

    public function setExpectedValue($value)
    {
        $this->_expectedValue = $value;
    }

    public function getExpectedValue()
    {
        return $this->_expectedValue;
    }

    public function setActualValue($value)
    {
        $this->_actualValue = $value;
    }

    public function getActualValue()
    {
        return $this->_actualValue;
    }

    public function hasMatcherResult()
    {
        return isset($this->_matcherResult);
    }

    public function setMatcherResult($result)
    {
        $this->_matcherResult = $result;
    }

    public function getMatcherResult()
    {
        return $this->_matcherResult;
    }

    public function getMatcherFailureMessage()
    {
        return $this->_matcher->getFailureMessage();
    }

    public function getMatcherNegativeFailureMessage()
    {
        return $this->_matcher->getNegativeFailureMessage();
    }

    public function setRunner($runner)
    {
        $this->_runner = $runner;
    }

    protected function _createMatcher($method)
    {
        $matcherClass = 'PHPSpec_Matcher_' . ucfirst($method);
        $this->_matcher = new $matcherClass( $this->getExpectedValue() );
    }

    protected function _performMatching()
    {
        $this->setMatcherResult($this->_matcher->matches( $this->getActualValue() ));
        //$this->_runner->notify($this, $this->getExpectation());
    }

}