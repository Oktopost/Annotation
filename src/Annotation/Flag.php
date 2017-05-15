<?php
namespace Annotation;


class Flag
{
	private $flag;
	
	
	public function __construct(string $flag)
	{
		$this->flag = $flag;
	}
	
	
	/**
	 * @param mixed $element
	 * @return bool
	 */
	public function has($element): bool
	{
		return self::hasFlag($element, $this->flag);
	}
	
	/**
	 * @param mixed $element
	 * @param string $flag
	 * @return bool
	 */
	public static function hasFlag($element, string $flag): bool
	{
		$comment = Comment::get($element);
		
		if (!$comment || strlen($comment) < strlen($flag) + 5) 
			return false;
		
		if (stripos($comment, "@$flag") === false)
			return false;
		
		$regex = '/^[ \t]*(\/\*\*|\*)[ \t\*]*@' . $flag . '([ \t]+.*|[ \t]*)$/mi';
		
		return (preg_match($regex, $comment) == 1);
	}
}