<?php
require_once 'php/core/tool/page/DirectoryPage.class.php';

/**
 * Classe UiBrowserPage
 * 
 * Custom interface browser
 * 
 * @author moustachu
 *
 */
class UiBrowserPage extends Page{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function UiBrowserPage(){
		parent::DirectoryPage("ui") ;
		
		$this->trace("instanciation UiBrowserPage") ;
		
		$this->setTitle("UI Browser") ;
		$this->setTemplate("ui-browser.tpl") ;
		
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
	}
	
	
}

?>