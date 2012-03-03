<?php

require_once 'php/core/Configuration.class.php';

/**
 * Class UserManager
 *
 * User management : Create, Update, Delete and Authenticate 
 * 
 * Notes : 
 * 
 * 12/2010 :
 * 
 * The user database is a simple XML file, it is not intended for large collection.
 * Go to the read() function to see the XML template.
 * 
 * @author moustachu
 *
 */
class UserManager{
	
	/**
	 * user / password storage
	 * @var SimpleXMLElement
	 */
	private $data ;
	
	/**
	 * database file path
	 * @var string
	 */
	private $db_file ;
	
	/**
	 * Constructor 
	 * @param string database file path
	 */
	function UserManager($file){
		$this->db_file = $file ;
		$this->read() ;
	}
	
	/**
	 * Read the database file to retrieve the user collection.
	 * 
	 * XML template : 
	 * <directory>
	 * 		<user>
	 * 			<username>--username--</username>
	 *   		<password>--password--</password>
	 *   	</user>
	 * 	 	[...]	
	 *  </directory>
	 * 
	 */
	private function read(){
		Configuration::trace("UserManager : reading " . $this->db_file ) ;
		$this->data = simplexml_load_file($this->db_file) ;	
	}
	
	/**
	 * Save the user collection in the database file
	 * 
	 * @return boolean true for success, false otherwise
	 */
	public function save(){
		Configuration::trace("UserManager : saving " . $this->db_file ) ;
		return $this->data->saveXML($this->db_file) ;
	}
	
	/**
	 * Authenticate a user with its name and password
	 * 
	 * @param username the user id
	 * @param password the user password
	 * @return boolean true for success, false otherwise
	 */
	public function authenticate( $username, $password ){
		
		$user = $this->getUser($username) ;
		
		if( empty($user) ){
			return false ;
		}
		
		return $user->password == $password ;
	}
	
	/**
	 * Create a new user with its name and password
	 * 
	 * @param username the user id
	 * @param password the user password
	 * @return boolean true for success, false otherwise
	 */
	public function create( $username, $password ){
		
		if( empty($username) ){
			return false ;
		}
		
		if( empty($password) ){
			return false ;
		}
		
		$user = $this->data->addChild("user") ;
		
		$user->addChild("name",$username) ;
		$user->addChild("password",$password) ;
		
		return $this->save() ;
	}
	
	public function update( $username, $password ){
		
		if( empty($username) ){
			return false ;
		}
		if( empty($password) ){
			return false ;
		}
		
		$user = $this->getUser($username) ;
		if( empty($user) ){
			return false ;		
		} else {
			$user->password = $password ;
			return $this->save() ;
		}
	}
	
	public function delete( $username ){
		$ct = 0 ;
		foreach( $this->data->user as $user){
			if( $user->name == $username ){
				unset($this->data->user[$ct]) ;
				break ;
			}
			$ct++ ;
		}
		
		return $this->save() ;
	}
	
	public function toXML(){
		return $this->data->asXML() ;
	}
	
	public function getUser( $username ){
		
		foreach( $this->data->user as $index => $user){
			if( $user->name == $username ){
				Configuration::trace("UserManager : finding user " . $username . " at index " . $index ) ;
				return $user ;
			}
		}
		
		return false ;
	}
	
	public function getList(){
		$result = array() ;
		foreach( $this->data->user as $index => $user){
			array_push($result,$user->name) ;
		}
		return $result ; 
	}
}	

?>