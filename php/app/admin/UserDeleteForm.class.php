<?php
require_once 'php/core/Form.class.php';

/**
 * UserDeleteForm class
 * 
 * User management form : updating a user
 * 
 * @author moustachu
 *
 */
class UserDeleteForm extends Form{
	
	private $user_manager ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function UserDeleteForm( $manager , $tpl_engine = null ){
		parent::Form($tpl_engine) ;
		
		$this->user_manager = $manager ;
		$this->name = "UserDelete" ;
		$this->setTemplate("admin/user/delete.form.tpl") ;
		
		$this->addParam("username","username",true) ;
		
	}	
	
	public function execute(){
		
		$username = $this->params["username"]->getValue() ;
		
		if( $this->user_manager->getUser( $username ) ){
		
			if( $this->user_manager->delete($username) ){
    			$this->addError("Delete : fail ...") ;
    		}
		
		} else {
			$this->addError("Delete : User not found") ;
		}
		
    	
    	
	}
	
}
?>