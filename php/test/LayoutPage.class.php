<?php
require_once 'php/core/Page.class.php';

/**
 * Classe LayoutPage
 * 
 * Page de test de mise en page
 * 
 * @author moustachu
 *
 */
class LayoutPage extends Page{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function LayoutPage(){
		parent::Page() ;
		
		$this->trace("instanciation LayoutPage") ;
		
		$this->setTitle("layout") ;
		$this->setTemplate("common/debug.tpl") ;
		
		$this->addCSS("debug.css") ;
	
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
	}
	
	
}

?>