<?php
require_once 'php/core/auth/AuthPage.class.php';

/**
 * Classe HomePage
 * 
 * Start page
 * 
 * @author moustachu
 *
 */
class HomePage extends AuthPage{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function HomePage(){
		parent::AuthPage(true) ;
		
		$this->trace("instanciation HomePage") ;
		
		$this->setTitle("Home") ;
		$this->setTemplate("home.tpl") ;
		
		$this->addJs(Configuration::get(Configuration::JQUERY)) ;
		$this->addJs(Configuration::get(Configuration::JQUERY_UI)) ;
		$this->addJs("init-ui.js") ;
		$this->addCss(Configuration::get(Configuration::JQUERY_UI_CSS)) ;
		
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
		
		
	}
	
	
}

?>