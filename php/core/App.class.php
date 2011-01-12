<?php

require_once 'php/core/Configuration.class.php';

/**
 * Classe App
 *
 * Singleton représentant le contexte d'exécution 
 * GET, POST, COOKIE, etc ...
 *
 * @author moustachu
 *
 */
class App{


	/**
	 * Singleton
	 * @var App
	 */
	private static $instance = null ;

	/**
	 * Permet de récupérer le singleton de l'objet App
	 * @return App
	 */
	public static function getInstance(){
		if ( self::$instance == null ){
			self::$instance = new App() ;
		}
		
		self::trace("App::getInstance()") ;
		
		return self::$instance ;
	}
		
	/**
	 * Fonction statique pour récupérer un paramètre à partir de son nom
	 * retourne false si le paramètres n'est pas trouvé.
	 * @param string $name
	 * @return mixed
	 */
	public static function get( $name ){
		return self::getInstance()->innerGet($name) ;
	}
	
	/**
	 * Fonction statique de journalisation
	 * @param string $message
	 */
	public static function trace( $message ){
		Configuration::trace($message) ;
	}
	
	private function App(){

		Configuration::trace("instanciation App") ;
		
	}
	
	/**
	 * Permet de récupérer un paramètre partir de son nom.
	 * retourne false si le paramètres n'est pas trouvé.
	 * @param string $name
	 * @return mixed
	 */
	public function innerGet( $name ){
		// ORDRE : COOKIE < POST < GET 
		if( isset($_COOKIE[$name])){
			 return trim($_COOKIE[$name]);
		} else if ( isset($_POST[$name])){
			return trim($_POST[$name]);	
		} else if ( isset($_GET[$name])){
			return trim($_GET[$name]);
		} else {
			return false ;
		}
	}
	
	
	
}

?>