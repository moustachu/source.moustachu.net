<?php
require_once 'php/core/Form.class.php';

/**
 * UserAddForm class
 * 
 * User management form : creating a new user
 * 
 * @author moustachu
 *
 */
class UserAddForm extends Form{
	
	private $user_manager ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function UserAddForm( $manager , $tpl_engine = null ){
		parent::Form($tpl_engine) ;
		
		$this->user_manager = $manager ;
		$this->name = "UserAdd" ;
		$this->setTemplate("admin/user/add.form.tpl") ;
		
		$this->addParam("username","username",true) ;
		$this->addParam("password","password",true) ;
		
	}	
	
	public function execute(){
		
		$username = $this->params["username"]->getValue() ;
		$password = $this->params["password"]->getValue() ;
		
		if( ! $this->user_manager->getUser( $username ) ){
		
			if( ! $this->user_manager->create($username,App::crypt($password)) ){
    			$this->addError("Add : fail ...") ;
    		}
		
		} else {
			$this->addError("Add : User already exist") ;
		}
		
    	
    	
	}
	
}
?>