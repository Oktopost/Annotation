<?php
namespace Annotation;


class Value
{
	private $name;
	private $default = null; 
	
	
	public function __construct($name, $default = null)
	{
		$this->name = $name;
		$this->default = $default;
	}
	
	
	/**
	 * @param mixed $element
	 * @return string|null
	 */
	public function get($element)
	{
		throw new \Exception();
	}
	
	/**
	 * @param mixed $element
	 * @return bool
	 */
	public function has($element): bool
	{
		return Flag::hasFlag($element, $this->name);
	}
	
	/**
	 * @param string $default
	 */
	public function setDefault(string $default) 
	{
		throw new \Exception();
	}
	
	
	/**
	 * @param mixed $element
	 * @param string $name
	 * @param string|null $default
	 */
	public static function getValue($element, $name, $default = null)
	{
		throw new \Exception();
	}
}