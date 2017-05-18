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
	 * @param $element
	 * @param $name
	 * @return string|bool
	 */
	private static function getMatch($element, $name)
	{
		$comment = Comment::get($element);
		
		$regex = '/^[ \t]*(\/\*\*|\*)[ \t\*]*@' . $name . '([ \t]+.*|[ \t]*)$/mi';
		
		$match = preg_match($regex, $comment, $matches);
		
		if (!$match || !is_array($matches) || !isset($matches[2]))
		{
			return false;
		}
		
		return $matches[2];
	}
	
	
	/**
	 * @param mixed $element
	 * @return string|null
	 */
	public function get($element)
	{
		return Value::getValue($element, $this->name, $this->default);
	}
	
	/**
	 * @param mixed $element
	 * @return bool
	 */
	public function exists($element): bool
	{
		return Flag::hasFlag($element, $this->name);
	}
	
	/**
	 * @param mixed $element
	 * @return bool
	 */
	public function isEmpty($element): bool
	{
		return !self::getMatch($element, $this->name);
	}
	
	/**
	 * @param string $default
	 */
	public function setDefault(string $default) 
	{
		$this->default = $default;
	}
	
	
	/**
	 * @param mixed $element
	 * @param string $name
	 * @param string|null $default
	 */
	public static function getValue($element, $name, $default = null)
	{
		$result = self::getMatch($element, $name);
		return $result ? trim($result) : $default;
	}
}