<?php 

require_once 'php/core/Configuration.class.php';
require_once 'php/core/auth/UserManager.class.php';

	
class UserManagerTest extends PHPUnit_Framework_TestCase {
	
	private static $instance ;
	private static $db_file ;
	private static $db_init ;
	private static $db_step_01 ;
	private static $db_step_02 ;
	private static $user_init ;
	private static $user_add ;
	private static $password_change ;
	
	public static function setUpBeforeClass(){
		// Test configuration
		self::$db_file = "auth/auth.test.db.xml" ;
		self::$db_init = "auth/auth.test.init.db.xml" ;
		self::$db_step_01 = "auth/auth.test.step.01.db.xml" ;
		self::$db_step_02 = "auth/auth.test.step.02.db.xml" ;
		self::$user_init = "test" ;
		self::$user_add = "new_user" ;
		self::$password_change = "new_password" ;
		
		// Preparing the db file
		copy(self::$db_init, self::$db_file) ;
		
		// One instance for the all test case
		self::$instance = new UserManager(self::$db_file) ;
	}
	
	public static function tearDownAfterClass()
    {
        //unlink(self::$db_file) ;
    }
	
	private function compareWithFile( $file ){
		$actual = self::$instance->toXML() ;
		$expected = $file ;
		
		$this->assertXmlStringEqualsXmlFile($expected, $actual,"Comparison failed with : " . $actual) ;
	}
	
	/**
	 * Need to be the first test because
	 * the read method is called in the constructor
	 * 
 	 * @covers UserManager::read
  	 * 
  	 */
	public function testRead(){
		
		$this->assertFileExists(self::$db_file) ;
		// the read method is called in the constructor
		$this->compareWithFile(self::$db_file) ;
	}
	
	/**
	 * Save unchanged
	 * 
 	 * @covers UserManager::save
 	 * @depends testRead
  	 * 
  	 */
	public function testSaveInit(){
	
		$this->assertTrue(self::$instance->save(),"Function save failed") ;
		
		$this->compareWithFile(self::$db_file) ;
	}
	
	/**
	 * 
 	 * @covers UserManager::getUser
 	 * @depends testRead
  	 * 
  	 */
	public function testGetUser(){
		
		$username = null ;
		
		$this->assertFalse(self::$instance->getUser($username)) ;
		
		$username = "" ;
		
		$this->assertFalse(self::$instance->getUser($username)) ;
		
		$username = "this is not a user" ;
		
		$this->assertFalse(self::$instance->getUser($username)) ;
		
		$user = self::$instance->getUser(self::$user_init) ;
		
		$this->assertNotNull($user,"User not found") ;
		$this->assertEquals( $user->name . "" , self::$user_init , "Comparison failed " . $user->name) ;
		
	}
	
	/**
	 * 
 	 * @covers UserManager::authenticate
 	 * @depends testGetUser
  	 * 
  	 */
	public function testAuthenticate(){
		
		$this->assertTrue(self::$instance->authenticate(self::$user_init,self::$user_init),"Function authenticate failed") ;
		
	}
	
	/**
	 * 
 	 * @covers UserManager::create
 	 * @depends testRead
  	 * 
  	 */
	public function testCreate(){
		
		$this->assertTrue(self::$instance->create(self::$user_add,self::$user_add), "Function create failed") ;
		
		$this->compareWithFile(self::$db_step_01) ;
		
	}
	
		
	/**
	 * Save with change (+ 1 user)
	 * 
 	 * @covers UserManager::save
 	 * @depends testCreate
  	 * @depends testSaveInit
  	 * 
  	 */
	public function testSaveStep01(){
	
		$this->assertTrue(self::$instance->save(),"Function save failed") ;
		
		$this->assertXmlFileEqualsXmlFile(self::$db_step_01,self::$db_file) ;
	}
	
	/**
	 * 
 	 * @covers UserManager::update
 	 * @depends testCreate
  	 * 
  	 */
	public function testUpdate(){
		
		$this->assertTrue(self::$instance->update(self::$user_add,self::$password_change), "Function update failed") ;
		
		$this->compareWithFile(self::$db_step_02) ;
		
	}
	
		
	/**
	 * Save with change (value change)
	 * 
 	 * @covers UserManager::save
 	 * @depends testUpdate
  	 * @depends testSaveStep01
  	 * 
  	 */
	public function testSaveStep02(){
	
		$this->assertTrue(self::$instance->save(),"Function save failed") ;
		
		$this->assertXmlFileEqualsXmlFile(self::$db_step_02,self::$db_file) ;
	}
	
	/**
	 * 
 	 * @covers UserManager::delete
 	 * @depends testUpdate
  	 * 
  	 */
	public function testDelete(){
		
		$this->assertTrue(self::$instance->delete(self::$user_add), "Function delete failed") ;
		
		$this->compareWithFile(self::$db_init) ;
		
	}
	
	/**
	 * Save with change (- 1 user)
	 * 
 	 * @covers UserManager::save
 	 * @depends testDelete
  	 * @depends testSaveStep02
  	 * 
  	 */
	public function testSaveStep03(){
	
		$this->assertTrue(self::$instance->save(),"Function save failed") ;
		
		$this->assertXmlFileEqualsXmlFile(self::$db_init,self::$db_file) ;
	}
	
}

?>