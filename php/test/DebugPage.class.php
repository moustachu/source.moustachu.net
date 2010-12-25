<?php
require_once 'php/core/Page.class.php';

/**
 * Classe DebugPage
 * 
 * Page de debug vide
 * 
 * @author moustachu
 *
 */
class DebugPage extends Page{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function DebugPage(){
		parent::Page() ;
		
		$this->trace("instanciation DebugPage") ;
		
		$this->setTitle("debug") ;
		$this->setTemplate("common/debug.tpl") ;
		
		$this->addCSS("debug.css") ;
	
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
	}
	
	
}

?>