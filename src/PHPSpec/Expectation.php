<?php

class PHPSpec_Expectation
{

    protected $_expectedMatcherResult = true;

    public function __construct()
    {
    
    }

    public function should()
    {
        $this->_expectedMatcherResult = true;
        return $this;
    }

    public function shouldNot()
    {
        $this->_expectedMatcherResult = false;
        return $this;
    }

    public function getExpectedMatcherResult()
    {
        return $this->_expectedMatcherResult;
    }

}