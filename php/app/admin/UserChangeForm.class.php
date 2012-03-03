<?php
require_once 'php/core/Form.class.php';

/**
 * UserChangeForm class
 * 
 * User management form : updating a user
 * 
 * @author moustachu
 *
 */
class UserChangeForm extends Form{
	
	private $user_manager ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function UserChangeForm( $manager , $tpl_engine = null ){
		parent::Form($tpl_engine) ;
		
		$this->user_manager = $manager ;
		$this->name = "UserChange" ;
		$this->setTemplate("admin/user/edit.form.tpl") ;
		
		$this->addParam("username","username",true) ;
		$this->addParam("password","password",true) ;
		
	}	
	
	public function execute(){
		
		$username = $this->params["username"]->getValue() ;
		$password = $this->params["password"]->getValue() ;
		
		if( $this->user_manager->getUser( $username ) ){
		
			if( $this->user_manager->update($username,App::crypt($password)) ){
    			$this->addError("Change : fail ...") ;
    		}
		
		} else {
			$this->addError("Change : User not found") ;
		}
		
    	
    	
	}
	
}
?>