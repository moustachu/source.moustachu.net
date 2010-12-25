<?php

require_once 'php/core/Configuration.class.php';
require_once 'php/lib/smarty/Smarty.class.php';

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
	 * Constructeur
	 */
	function Control(){
		
		$this->trace("instanciation Control") ;
		
		$this->smarty = new Smarty() ;
		
		$this->smarty->template_dir = Configuration::get("smarty_template_dir");
        $this->smarty->compile_dir  = Configuration::get("smarty_compil_dir");
        $this->smarty->config_dir   = Configuration::get("smarty_config_dir");
        $this->smarty->cache_dir	= Configuration::get("smarty_cache_dir");
		
       	$this->smarty->assign("app_name", Configuration::get("project_name") ) ;
		
       	if( Configuration::get("production_mode") ){
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
	 * Active le cache
	 */
	public function toogleCacheOn(){
		$this->smarty->caching = 2 ;
		$this->smarty->compile_check = false ;
	}
	
	/**
	 * Désactive le cache
	 */
	public function toogleCacheOff(){
		$this->smarty->caching = 0 ;
	}
	
	/**
	 * Affichage de la template principale
	 */
	public function display(){
		$this->smarty->display($this->template) ;
	}
	
	/**
	 * Paramétrage de la template principale utilisée par la fonction display()
	 */
	public function setTemplate( $tpl ){
		$this->template = $tpl ;
	}
	
	// fetch() ?
	
}

?>