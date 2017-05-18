<?php
namespace Annotation;


class ValueTest extends \PHPUnit\Framework\TestCase 
{
	/**
	 * @flag string
	 */
	public function test_get_AnnotationWithValue_ReturnValue()
	{
		$value = new Value('flag');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag   		 string		 	
	 */
	public function test_get_AnnotationWithValue_ReturnTrimmedValue()
	{
		$value = new Value('flag');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag   		 string
	 *string string string
	 */
	public function test_get_MultipleLineAnnotationWithValue_ReturnTrimmedValueOfFirstString()
	{
		$value = new Value('flag');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 *@flag string
	 */
	public function test_get_AnnotationWithoutSpacesAndWithValue_ReturnValue()
	{
		$value = new Value('flag');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag
	 */
	public function test_get_EmptyAnnotation_ReturnDefault()
	{
		$value = new Value('flag', 'string');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag
	 */
	public function test_setDefault()
	{
		$value = new Value('flag', 'something');
		$value->setDefault('string');
		self::assertEquals('string', $value->get([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag
	 */
	public function test_Exists_WithAnnotation_ReturnTrue()
	{
		$value = new Value('flag');
		self::assertTrue($value->exists([ValueTest::class, __FUNCTION__]));
	}
	
	public function test_Exists_WithoutAnnotation_ReturnFalse()
	{
		$value = new Value('flag');
		self::assertFalse($value->exists([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @value
	 */
	public function test_isEmpty_EmptyAnnotation_ReturnTrue()
	{
		$value = new Value('value');
		self::assertTrue($value->isEmpty([ValueTest::class, __FUNCTION__]));
	}
	
	/**
	 * @flag a
	 */
	public function test_getValue_AnnotationWithValue_ReturnValue()
	{
		self::assertEquals('a', Value::getValue([ValueTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @flag
	 */
	public function test_getValue_EmptyAnnotation_ReturnDefault()
	{
		self::assertNull(Value::getValue([ValueTest::class, __FUNCTION__], 'flag', null));
	}
}