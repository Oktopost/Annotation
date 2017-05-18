<?php
namespace Annotation;


class FlagTest extends \PHPUnit\Framework\TestCase 
{
	public function test_hasFlag_NoComment_ReturnFalse()
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'test'));
	}
	
	/**
	 * Nothing here
	 */
	public function test_hasFlag_EmptyComment_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'test'));
	}
	
	/**
	 * @otherflag
	 */
	public function test_hasFlag_NoRequestedFlag_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'test'));
	}
	
	/**
	 * flag
	 */
	public function test_hasFlag_NoAtSign_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * 
	 @flag
	 */
	public function test_hasFlag_MissingStartBefore_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * chars @flag
	 */
	public function test_hasFlag_UnexpectedCharacters_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @flag
	 */
	public function test_hasFlag_HasFlag_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * *   @flag
	 */
	public function test_hasFlag_WhitespaceAndStarsIgnored_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @FlAg
	 */
	public function test_hasFlag_CaseIgnored_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @otherA
	 * @flag
	 * @otherB
	 */
	public function test_hasFlag_HasOtherFlags_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
	 * @flag Any comment can be here
	 */
	public function test_hasFlag_HasComment_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/** @flag
	 */
	public function test_hasFlag_OnFirstLine_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/** @flag Any comment can be here
	 */
	public function test_hasFlag_CommentOnFirstLine_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/* 
	 * @flag 
	 */
	public function test_hasFlag_FirstLineHaveOneStart_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/**
		* @flagA
* @flagB
	 */
	public function test_hasFlag_DifferentNumberOfTabs_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flagA'));
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flagB'));
	}
	
	/** 
	 * some comment before
	 * @flag
	 * some comment after
	 */
	public function test_hasFlag_OtherTextExists_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/** 
	 * @flag           
	 */
	public function test_hasFlag_HasWhitespaceAfter_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
	}
	
	/** 
	 * @invalid @flag
	 * @invalid@flagB
	 */
	public function test_hasFlag_AfterAnotherAnnotation_ReturnFalse() 
	{
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flag'));
		self::assertFalse(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'flagB'));
	}
	
	/** 
	 * @long@flag
	 */
	public function test_hasFlag_HasAtSignInName_ReturnTrue() 
	{
		self::assertTrue(Flag::hasFlag([FlagTest::class, __FUNCTION__], 'long@flag'));
	}
	
	/**
	 * @flagA Hello world
	 */
	public function test_has_Sanity()
	{
		$annotationA = new Flag('flagA');
		$annotationB = new Flag('flagB');
		
		self::assertTrue($annotationA->has([FlagTest::class, __FUNCTION__]));
		self::assertFalse($annotationB->has([FlagTest::class, __FUNCTION__]));
	}
}
