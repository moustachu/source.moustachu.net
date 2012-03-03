<?php
require_once 'php/core/auth/AuthPage.class.php';

/**
 * Classe AuthDebugPage
 * 
 * Page de debug authentifiée vide
 * 
 * @author moustachu
 *
 */
class AuthDebugPage extends AuthPage{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function AuthDebugPage(){
		parent::AuthPage() ;
		
		$this->trace("instanciation AuthDebugPage") ;
		
		$this->setTitle("debug") ;
		$this->setTemplate("auth/debug.tpl") ;
		
		$this->addCSS("debug.css") ;
	
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
	}
	
	
}

?>