<?php

class PHPSpec_Specification
{

    protected $_interrogator = null;

    protected $_expectation = null;

    protected $_expectedValue = null;

    protected $_actualValue = null;

    protected $_matcherResult = null;

    protected $_matcher = null;

    public function __construct(PHPSpec_Object_Interrogator $interrogator = null)
    {
        if (!is_null($interrogator)) {
            $this->_interrogator = $interrogator;
        }
        $this->_expectation = new PHPSpec_Expectation;
    }

    public static function getSpec() // variable param list
    {
        $args = func_get_args();
        $class = new ReflectionClass('PHPSpec_Object_Interrogator');
        $interrogator = call_user_func_array(array($class, 'newInstance'), $args);
        $spec = new self($interrogator);
        return $spec;
    }

    public function __call($method, $args)
    {
        if (in_array($method, array('should', 'shouldNot'))) {
            $this->_expectation->$method();
            return $this;
        }
        if (in_array($method, array('equal', 'be', 'anInstanceOf', 'greaterThan', 'true', 'false'))) {
            $this->setExpectedValue(array_shift($args));
            $this->_createMatcher($method);
            $this->_performMatching();
            return;
        }
        $this->setActualValue(call_user_func_array(array($this->_interrogator, $method), $args));
        return $this;
    }

    public function __get($name)
    {
        $this->setActualValue($this->_interrogator->{$name});
        return $this;
    }

    public function getInterrogator()
    {
        if (is_null($this->_interrogator)) {
            throw new Exception('an Interrogator has not yet been created');
        }
        return $this->_interrogator;
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

    protected function __set($name, $value)
    {
        $this->_interrogator->{$name} = $value;
    }

    protected function __isset($name)
    {
        return isset($this->_interrogator->{$name});
    }

    protected function __unset($name)
    {
        unset($this->_interrogator->{$name});
    }

    protected function _createMatcher($method)
    {
        $matcherClass = 'PHPSpec_Matcher_' . ucfirst($method);
        $this->_matcher = new $matcherClass($this->getExpectedValue());
    }

    protected function _performMatching()
    {
        $this->setMatcherResult($this->_matcher->matches($this->getActualValue()));
    }

}