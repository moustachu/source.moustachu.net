<?php
require_once 'php/core/auth/AuthPage.class.php';
require_once 'php/app/admin/UserAddForm.class.php';
require_once 'php/app/admin/UserChangeForm.class.php';
require_once 'php/app/admin/UserDeleteForm.class.php';

/**
 * UserPage class
 * 
 * User management page
 * 
 * @author moustachu
 *
 */
class UserPage extends AuthPage{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function UserPage(){
		parent::AuthPage() ;
		
		$this->trace("instanciation admin/UserPage") ;
		
		$this->setTitle("debug") ;
		$this->setTemplate("admin/user/page.tpl") ;
		
		$this->addCSS("debug.css") ;
	
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
		$this->smarty->assign_by_ref("userlist",$this->user_manager->getList()) ;
		
		$this->addForm("UserAdd", new UserAddForm($this->user_manager, $this->smarty) ) ;
		$this->addForm("UserChange", new UserChangeForm($this->user_manager, $this->smarty) ) ;
		$this->addForm("UserDelete", new UserDeleteForm($this->user_manager, $this->smarty) ) ;
		
	}
	
	public function validateForm($action){
		
		$username = App::get("User".$action."_username") ;
		if( ! $username ){
    		throw new Exception($action." : missing username") ;
    	}
    	
    	if( ( $action == "Add" ) || ( $action == "Change" )   ){
    		$password = App::get("User".$action."_password") ;
    		if( ! $password ){
    			throw new Exception($action." : missing password") ;
    		}
    	}
	}
	
}

?>