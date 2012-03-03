<?php
require_once 'php/core/Page.class.php';

/**
 * Classe CssPreviewPage
 * 
 * CSS preview page
 * 
 * @author moustachu
 *
 */
class CssPreviewPage extends Page{
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function CssPreviewPage(){
		parent::Page() ;
		
		$this->trace("instanciation CssPreviewPage") ;
		
		$this->setTitle("CSS Preview") ;
		$this->setTemplate("css.tpl") ;
		
		$this->addJs(Configuration::get(Configuration::JQUERY)) ;
		$this->addJs(Configuration::get(Configuration::JQUERY_UI)) ;
		$this->addJs("init-ui.js") ;
		$this->addCss(Configuration::get(Configuration::JQUERY_UI_CSS)) ;
		$this->addCss(Configuration::get(Configuration::JQUERY_UI_MOD_CSS)) ;
		
		$this->smarty->assign("project_name",Configuration::get(Configuration::PROJECT_NAME)) ;
		$this->smarty->assign("project_version",Configuration::get(Configuration::PROJECT_VERSION)) ;
		
		// CSS Loaded in Page Class
		// reset.css
		// common.css
		
	}
	
	
}

?>