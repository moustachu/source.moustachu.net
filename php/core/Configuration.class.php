<?php

require_once 'php/global.conf.php';

/**
 * Classe Configuration
 *
 * Singleton permettant de récupérer la configuration du site
 *
 * @author moustachu
 *
 */
class Configuration{

	/**
	 * Référence sur le tableau de configuration global
	 * @var array
	 */
	private $global_conf ;

	const PROJECT_NAME = "project_name" ;
	const PROJECT_VERSION = "project_version" ;
	const PROJECT_CONTACT = "project_contact" ;
	const PRODUCTION_MODE = "production_mode" ;
	const MAIN_LOG_FILE = "main_log_file" ;
	const SMARTY_TEMPLATE_DIR = "smarty_template_dir" ;
	const SMARTY_COMPIL_DIR = "smarty_compil_dir" ;
	const SMARTY_CONFIG_DIR = "smarty_config_dir" ;
	const SMARTY_CACHE_DIR = "smarty_cache_dir" ;
	const JQUERY = "jquery" ;
	const JQUERY_UI = "jquery.ui" ;
	const JQUERY_UI_CSS = "jquery.ui.css" ;
	
	/**
	 * Chemin du fichier de log
	 * @var string
	 */
	private $log_file ;

	/**
	 * Singleton
	 * @var Configuration
	 */
	private static $instance = null ;

	/**
	 * Permet de récupérer le singleton de l'objet Configuration
	 * @return Configuration
	 */
	public static function getInstance(){
		if ( self::$instance == null ){
			self::$instance = new Configuration() ;
		}
		
		//self::$instance->innerTrace("Configuration::getInstance()") ;
		
		return self::$instance ;
	}
	
	/**
	 * Fonction statique de journalisation
	 * @param string $message
	 */
	public static function trace( $message ){
		self::getInstance()->innerTrace($message) ;
	}
		
	/**
	 * Fonction statique pour récupérer un élément de configuration à partir de son nom
	 * @param string $name
	 * @return string
	 */
	public static function get( $name ){
		return self::getInstance()->innerGet($name) ;
	}
	
	
	private function Configuration(){
		global $GLOBAL_CONF ;
			
		$this->global_conf = &$GLOBAL_CONF ;

		$this->log_file = $this->innerGet(self::MAIN_LOG_FILE) ;

		$this->innerTrace("instanciation Configuration") ;
		
	}
	
	/**
	 * Permet de récupérer un élément de configuration à partir de son nom
	 * @param string $name
	 * @return string
	 */
	public function innerGet( $name ){
		return $this->global_conf[$name] ;
	}
	
	/**
	 * Fonction interne de journalisation
	 * @param string $message
	 */
	private function innerTrace( $message ){
		error_log(date(DateTime::RFC850)." : ".$message."\n", 3, $this->log_file ) ;
	}
	
	
}

?>