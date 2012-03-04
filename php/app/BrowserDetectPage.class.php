<?php
require_once 'php/app/DebugPage.class.php';
require_once 'php/core/Browser.class.php';

/**
 * Classe BrowserDetectPage
 * 
 * Page de test de la détection du navigateur
 * 
 * @author moustachu
 *
 */
class BrowserDetectPage extends DebugPage{
	
	private $browser ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function BrowserDetectPage(){
		parent::DebugPage() ;
		
		$this->trace("BrowserDetectPage()") ;
		
		$this->setTitle("Browser informations") ;
		$this->setTemplate("browser_detect.tpl") ;
		
		$this->browser = new Browser() ;
		
		$this->smarty->assign("php_user_agent",$this->browser->getPhpUserAgent()) ;
		$this->smarty->assign("b_info",$this->browser->getBrowserInfo()) ;
		$this->smarty->assignByRef("b_feature",$this->browser->getBrowserFeatures()) ;
		
	}
	
	
	
}

?>