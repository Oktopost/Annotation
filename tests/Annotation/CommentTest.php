<?php
namespace Annotation;


class CommentTest extends \PHPUnit\Framework\TestCase 
{
	const FUNC_COMMENT = '/** Hello world */';
	const CLASS_COMMENT = '/** Comment on class a */';
	const METHOD_COMMENT = '/** Comment on method a */';
	const STATIC_METHOD_COMMENT = '/** Comment on static method b */';
	const PROPERTY_COMMENT = '/** @var Comment on property */';
	
	
	public function test_get_ByFunctionName()
	{
		self::assertEquals(self::FUNC_COMMENT, Comment::get('\Annotation\CommentTest_Func'));
	}
	
	public function test_get_ByFunctionReflection()
	{
		self::assertEquals(self::FUNC_COMMENT, Comment::get(new \ReflectionFunction('\Annotation\CommentTest_Func')));
	}
	
	
	public function test_get_ByClassName()
	{
		self::assertEquals(self::CLASS_COMMENT, Comment::get('\Annotation\CommentTest_HelpClass'));
	}
	
	public function test_get_ByClassReflection()
	{
		self::assertEquals(self::CLASS_COMMENT, Comment::get(new \ReflectionClass('\Annotation\CommentTest_HelpClass')));
	}
	
	public function test_get_ByClassInstance()
	{
		self::assertEquals(self::CLASS_COMMENT, Comment::get(new \Annotation\CommentTest_HelpClass));
	}
	
	
	public function test_get_ByMethodName()
	{
		self::assertEquals(self::METHOD_COMMENT, Comment::get('\Annotation\CommentTest_HelpClass::a'));
	}
	
	public function test_get_ByMethodReflection()
	{
		self::assertEquals(self::METHOD_COMMENT, Comment::get(new \ReflectionMethod('\Annotation\CommentTest_HelpClass::a')));
	}
	
	public function test_get_ByCallableArray()
	{
		self::assertEquals(self::METHOD_COMMENT, Comment::get([new \Annotation\CommentTest_HelpClass, 'a']));
	}
	
	
	public function test_get_ByStaticMethodName()
	{
		self::assertEquals(self::STATIC_METHOD_COMMENT, Comment::get('\Annotation\CommentTest_HelpClass::b'));
	}
	
	public function test_get_ByStaticMethodReflection()
	{
		self::assertEquals(self::STATIC_METHOD_COMMENT, Comment::get(new \ReflectionMethod('\Annotation\CommentTest_HelpClass::b')));
	}
	
	public function test_get_ByStaticMethodInArrayWithInstance()
	{
		self::assertEquals(self::STATIC_METHOD_COMMENT, Comment::get([new \Annotation\CommentTest_HelpClass, 'b']));
	}
	
	public function test_get_ByStaticMethodInArray()
	{
		self::assertEquals(self::STATIC_METHOD_COMMENT, Comment::get(['\Annotation\CommentTest_HelpClass', 'b']));
	}
	
	
	public function test_get_ByPropertyReflection()
	{
		self::assertEquals(self::PROPERTY_COMMENT, Comment::get(new \ReflectionProperty('\Annotation\CommentTest_HelpClass', 'c')));
	}
	
	/**
	 * @expectedException \Exception
	 */
	public function test_get_InvalidObject_ErrorThrown()
	{
		Comment::get('a');
	}
}

{
	/** Hello world */
	function CommentTest_Func()
	{
		
	}
	
	
	/** Comment on class a */
	class CommentTest_HelpClass
	{
		/** @var Comment on property */
		public $c;
		
		/** Comment on method a */
		public function a() {}
		
		/** Comment on static method b */
		public static function b() {}
	}
}