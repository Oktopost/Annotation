<?php
namespace Annotation;


class ValueTest extends \PHPUnit\Framework\TestCase 
{
	/**
	 * @flag				string
	 */
	public function test_get_Return_Value()
	{
		$value = new Value('flag');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	/**
	 * @flag
	 */
	public function test_get_Return_Default()
	{
		$value = new Value('flag', 'string');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag
	 */
	public function test_get_After_setDefault_Return_Default()
	{
		$value = new Value('flag', 'something');
		$value->setDefault('string');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag okay
	 */
	public function test_has_return_true()
	{
		$value = new Value('flag');
		self::assertTrue($value->has([ValueTest::class, __FUNCTION__]));
	}
	
	public function test_has_return_false()
	{
		$value = new Value('flag');
		self::assertFalse($value->has([ValueTest::class, __FUNCTION__]));		
	}
	
	/**
	 * @flag a
	 */
	public function test_getValue_Return_Value()
	{
		self::assertEquals('a', Value::getValue([ValueTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @flag
	 */
	public function test_getValue_Return_Default()
	{
		self::assertNull(Value::getValue([ValueTest::class, __FUNCTION__], 'flag'));
	}
}