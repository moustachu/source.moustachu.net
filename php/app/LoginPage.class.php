<?php
require_once 'php/core/Page.class.php';

/**
 * Classe LoginPage
 * 
 * Page de debug vide
 * 
 * @author moustachu
 *
 */
class LoginPage extends Page{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function LoginPage(){
		parent::Page() ;
		
		$this->trace("instanciation LoginPage") ;
		
		$this->setTitle("login") ;
		$this->setTemplate("auth/login.form.tpl") ;
		
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
	}
	
	
}

?>