<?php

declare(strict_types=1);

namespace TaskStepApi\Middleware\Helpers;

class Services {
    private static ?Services $_instance = null;

    public static function instance() : Services
    {
        if(is_null(Self::$_instance))
        {
            Self::$_instance = new Services();
        }
        return Self::$_instance;
    }

    private array $_impls = [];

    public function add(string $name, string $class) : Services {
    	$this->_impls[$name] = ['class' => $class];
    	return $this;
    }

    public function addInstance(string $name, object $object) : Services {
        $this->_impls[$name] = ['instance' => $object];
        return $this;
    }

    public function get(string $name) : object {
    	if (!isset($this->_impls[$name]))
    	{
    		throw new \Exception("$name: no such service registered");
    	}
    	if (!isset($this->_impls[$name]['instance']))
    	{
    		$class = $this->_impls[$name]['class'];
    		$this->_impls[$name]['instance'] = new $class();
    	}
    	return $this->_impls[$name]['instance'];
    }
}