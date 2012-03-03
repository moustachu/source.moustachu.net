<?php
require_once 'php/core/Form.class.php';

/**
 * LogoutForm class
 * 
 * logout action
 * 
 * @author moustachu
 *
 */
class LogoutForm extends Form{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Form::__contruct()
	 */
	function LogoutForm( $tpl_engine = null ){
		parent::Form($tpl_engine) ;
		
		$this->name = "Logout" ;
		$this->setTemplate("auth/logout.form.tpl") ;
		
	}	
	
	public function execute(){
		
		App::trace("Logout Action");
		// My bad … the "Login_" is on purpose ...
		App::setCookie("Login_userkey",false) ;
    	$this->smarty->assign("auth_logged",false) ;
    	
	}
	
}
?>