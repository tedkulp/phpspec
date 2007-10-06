<?php

class PHPSpec_Context
{

    protected $_description = null;
    protected $_runner = null;
    protected $_specMethods = array();
    protected $_count = 0;
    protected $_sharedContextName = null;

    public function __construct()
    {
        $this->_buildDetails();
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getSpecMethods()
    {
        return $this->_specMethods;
    }

    public function getSpecificationCount()
    {
        return $this->_count;
    }

    public function run(PHPSpec_Runner $runner)
    {
        $this->_runner = $runner;
        // ...
    }

    public function setRunner(PHPSpec_Runner $runner)
    {
        $this->_runner = $runner;
    }

    /**@todo */
    public function sharedBehaviourWith($contextName)
    {
        $this->_sharedContextName = $contextName;
    }


    public function before()
    {
    }

    public function after()
    {
    }

    protected function _buildDetails()
    {
        $object = new ReflectionObject($this);
        $class = $object->getName();
        if (substr($class, 0, 8) !== 'describe') {
            throw new Exception('behaviour context did not start with \'describe\'');
        }
        $this->_addSpecifications($object->getMethods());
        $this->_addDescription($class);
    }

    protected function _addDescription($class)
    {
        if (!is_string($class)) {
            return false;
        }
        $terms = preg_split("/(?=[[:upper:]])/", $class, -1, PREG_SPLIT_NO_EMPTY);
        $termsLowercase = array_map('strtolower', $terms);
        $this->setDescription(implode(' ', $termsLowercase));
    }

    protected function _addSpecifications($methods)
    {
        foreach ($methods as $method) {
            $name = $method->getName();
            if (substr($name, 0, 2) == 'it') {
                $this->_addSpecMethod($name);
                $this->_setSpecificationCount( $this->getSpecificationCount() + 1 );
            }
        }
    }

    protected function _addSpecMethod($method)
    {
        $this->_specMethods[] = $method;
    }

    protected function _setSpecificationCount($i)
    {
        $this->_count = $i;
    }

}