<?php

require_once 'php/core/Configuration.class.php';
require_once 'php/lib/smarty/Smarty.class.php';
require_once 'php/core/ui/PluginManager.class.php';

/**
 * Classe Control
 * 
 * Représente un objet destiné à être affiché via Smarty
 * 
 * @author moustachu
 *
 */
abstract class Control{
	
	/**
	 * Objet smarty lié au contrôle
	 * @var Smarty Class
	 */
	protected $smarty ;
	
	/**
	 * Nom de la template principale utilisée par la fonction display()
	 * @var string
	 */
	protected $template ;
	
	/**
	 * Plugin Manager
	 * @var PluginManager class
	 */
	protected $plugin_manager ;
	
	
	/**
	 * error list
	 * @var array
	 */
	protected $error_list ;
	
	/**
	 * Constructor
	 */
	function Control( $tpl_engine = null ){
		
		$this->trace("instanciation Control") ;
		$this->error_list = array() ;
		
		$this->setTemplateEngine($tpl_engine) ;
		
		$this->smarty->SetTemplateDir(Configuration::get(Configuration::SMARTY_TEMPLATE_DIR));
        $this->smarty->SetCompileDir(Configuration::get(Configuration::SMARTY_COMPIL_DIR));
        $this->smarty->SetConfigDir(Configuration::get(Configuration::SMARTY_CONFIG_DIR));
        $this->smarty->setCacheDir(Configuration::get(Configuration::SMARTY_CACHE_DIR));
		
		$this->smarty->assign("app_name", Configuration::get(Configuration::PROJECT_NAME) ) ;
		
       	if( Configuration::get(Configuration::PRODUCTION_MODE) ){
       		$this->toogleCacheOn() ;
       	} else {
       		$this->toogleCacheOff() ;
       	}
       	
       	
       	
       	
	}
	
	/**
	 * Fonction de journalisation
	 * @param string $message
	 */
	public function trace( $message ){
		Configuration::trace($message) ;
	}
	
	/**
	 * Create / Update the Component template engine
	 * @param string $tpl_engine engine to update, if null then create a new one
	 */
	public function setTemplateEngine($tpl_engine){
		if( ! empty( $tpl_engine ) ){
			$this->smarty = $tpl_engine ;
		} else {
			$this->smarty = new Smarty() ;
		}
	}
	
	/**
	 * Active le cache
	 */
	public function toogleCacheOn(){
		$this->smarty->SetCaching(2) ;
		$this->smarty->SetCompileCheck(false) ;
	}
	
	/**
	 * Désactive le cache
	 */
	public function toogleCacheOff(){
		$this->smarty->SetCaching(0) ;
	}
	
	
	/**
	 * Désactive le cache
	 */
	abstract public function execute() ;
	
	
	/**
	 * Generate and return the page code
	 * 
	 * @return string the page code 
	 */
	public function compile(){
		if( ! empty($this->error_list) ){
			$this->smarty->assignByRef("errors", $this->error_list ) ;
		}
		
		return $this->smarty->fetch($this->template) ;
	}
	
	/**
	 * Affichage de la template principale
	 */
	public function display(){
		print($this->compile()) ;
		// $this->smarty->display($this->template) ;
	}
	
	/**
	 * Paramétrage de la template principale utilisée par la fonction display()
	 */
	public function setTemplate( $tpl ){
		$this->template = $tpl ;
	}
	
	// fetch() ?
	
	/**
	 * @return bool true if the form has errors
	 */
	public function hasErrors(){
		return ! empty($this->error_list) ;
	}
	
	/**
	 * Return the error array
	 * 
	 * @return array error list 
	 */
	public function getErrors(){
		return $this->error_list ;
	}
	
	/**
	 * Add an error
	 * 
	 * @param string the error to add
	 */
	public function addError( $error ){
		$this->trace("Error -> " . $error) ;
		array_push( $this->error_list, $error ) ;
	}
	
	public function setPathToRoot( $path ){
		$this->smarty->assign("root", $path ) ;
	}
	
}

?>