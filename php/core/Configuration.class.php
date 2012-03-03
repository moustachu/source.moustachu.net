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

	const PROJECT_NAME = "project.name" ;
	const PROJECT_VERSION = "project.version" ;
	const PROJECT_CONTACT = "project.contact" ;
	const PRODUCTION_MODE = "production.mode" ;
	const MAIN_LOG_FILE = "main.log.file" ;
	const DEBUG_MODE = "debug.mode" ;
	const DEBUG_LOG_FILE = "debug.log.file" ;
	const APP_INCLUDE_DIR = "app.include.dir" ;
	const APP_COOKIE_TIME = "app.cookie.time" ;
	const APP_DEFAULT_PAGE = "app.default.page" ;
	const SMARTY_TEMPLATE_DIR = "smarty.template.dir" ;
	const SMARTY_COMPIL_DIR = "smarty.compil.dir" ;
	const SMARTY_CONFIG_DIR = "smarty.config.dir" ;
	const SMARTY_CACHE_DIR = "smarty.cache.dir" ;
	const JQUERY = "jquery" ;
	const JQUERY_UI = "jquery.ui" ;
	const JQUERY_UI_CSS = "jquery.ui.css" ;
	const JQUERY_UI_MOD_CSS = "jquery.ui.mod.css" ;
	const AUTH_DB_FILE = "auth.db.file" ;
	const AUTH_LOGIN_PAGE = "auth.login.page" ;
	
	/**
	 * Chemin du fichier de log
	 * @var string
	 */
	private $log_file ;

	
	/**
	 * Chemin du fichier de log de debug
	 * @var string
	 */
	private $debug_file ;
	
	
	/**
	 * String buffer of the debug trace
	 * @var string[]
	 */
	private $debug_buffer ;

	
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
	 * Fonction statique de journalisation de debug
	 * @param string $message
	 */
	public static function debug( $message ){
		self::getInstance()->innerDebug ($message) ;
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
		
		if($this->innerGet(self::DEBUG_MODE)){
			$this->debug_file = $this->innerGet(self::DEBUG_LOG_FILE) ;
			$this->debug_buffer = array() ;
			$this->innerTrace("DEBUG MODE activated") ;
		}

		$this->innerTrace("instanciation Configuration") ;
		
	}
	
	/**
	 * Permet de récupérer un élément de configuration à partir de son nom
	 * @param string $name
	 * @return string
	 */
	private function innerGet( $name ){
		return $this->global_conf[$name] ;
	}
	
	/**
	 * Fonction interne de journalisation
	 * @param string $message
	 */
	private function innerTrace( $message ){
		if($this->innerGet(self::DEBUG_MODE)){
			$this->innerDebug("[MAIN] ".$message) ;
		}
		error_log(date(DateTime::RFC850)." : ".$message."\n", 3, $this->log_file ) ;
	}
	
	
	/**
	 * Fonction interne de journalisation de debug
	 * @param string $message
	 */
	private function innerDebug( $message ){
		if($this->innerGet(self::DEBUG_MODE)){
			array_push($this->debug_buffer, $message ) ;
			error_log(date(DateTime::RFC850)." : ".$message."\n", 3, $this->debug_file ) ;
		}
	}
	
	
}

?>