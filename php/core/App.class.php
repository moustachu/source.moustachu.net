<?php

require_once 'php/core/Configuration.class.php';

/**
 * App Class
 * 
 * 
 * Application manager :
 * - static access
 * - variable registry
 * - main execution sequence 
 * 
 * Note : make it singleton in case of emergency ...
 * 
 * @author moustachu
 *
 */
class App{
	
	/**
	 * Local registry
	 * @var array
	 */
	private static $local = array() ;
	
	/**
	 * Local registry
	 * @var array
	 */
	private static $cookiesToSave = array() ;
	
	/**
	 * Setting a value in the App local context
	 * 
	 * @param string $name the name of the value to be set
	 * @param mixed $value the value to be set
	 */
	public static function set($name,$value){
		self::$local[$name] = $value ;
	}
	
	/**
	 * Retrieve a parameter in all available context (user input or in app).
	 * ORDER : local > COOKIE > POST > GET
	 * return false if not found
	 * @param string $name
	 * @return mixed
	 */
	public static function get( $name ){
	
		if( isset(self::$local[$name])){
			 return trim(self::$local[$name]);
		} else if( isset($_COOKIE[$name])){
			 return trim($_COOKIE[$name]);
		} else if ( isset($_POST[$name])){
			return trim($_POST[$name]);	
		} else if ( isset($_GET[$name])){
			return trim($_GET[$name]);
		} else {
			return false ;
		}
	}
	
	/**
	 * logging static function
	 * @param string $message
	 */
	public static function trace( $message ){
		Configuration::trace($message) ;
	}
	
	/**
	 * debugging static function
	 * @param string $message
	 */
	public static function debug( $message ){
		Configuration::debug($message) ;
	}
	
	/**
	 * Main application sequence
	 */
	public static function start(){
		$page = false ;
		$pathToRoot = "" ;
		try{
    	
    		// Page loop
    		
    		// Instanciation
    		if( self::get("page") ){
    			$pathToRoot = self::calculatePathToRoot(self::get("page")) ;
   			} else {
   				self::set("page", Configuration::get(Configuration::APP_DEFAULT_PAGE) ) ;
   			}
    		
    		
    		$page = self::discover("page","Page") ;
    		
    		if( $page ){	
    			
    			$page->setPathToRoot($pathToRoot) ;
    			
    			// Page Initialisation
    			$page->prepare() ;
    			
    			// Action management
    			$page->execute( self::get("action") ) ;
    			
    			self::saveCookie() ;
    			$page->display() ;
    			
    		} else {
    			
    			if( self::get("page") ){
    				throw new Exception("Page unknown") ;
    			} else {
    				self::set("page", Configuration::get(Configuration::APP_DEFAULT_PAGE) ) ;
    				self::start() ;
    			}
    		}
    		
    		
    		
    	} catch( Exception $e ){
    		
    		self::trace("Standard Error : " . $e->getMessage()) ;
    		
    		// Standard error -> internal redirection
    		// the page var is supposed to have change
    		
    		if( self::get("forward") ){
    		
    			self::set("page", self::get("forward") ) ;
    			self::start() ;
    		
    		} else {
    			
    			self::trace("Critical Error : " . $e->getMessage()) ;
    			
    			$error = $e->getMessage() ;
    			
    			if(Configuration::get(Configuration::PRODUCTION_MODE)){
    				header("HTTP/1.1 500 Internal server error",true,500) ;
    			} else {
    				require_once('php/fail.php') ;
    			}
    		
    		}
    		
    	}

	}
	
	/**
	 * Custom dynamic class loading
	 * 
	 * @param string $key the parameter key used to retrieve the class name
	 * @param string $suffix additionnal class name suffix
	 * @return object an instance of the loaded class
	 */
	public static function discover($key,$suffix){
		$result = false ;
		$link = self::get($key) ;
		if( $link ){
			$path = Configuration::get(Configuration::APP_INCLUDE_DIR) ;
			
			$include_path = $path . "/" . $link . $suffix . ".class.php" ;
			
			if( ! file_exists($include_path) ){
				throw new Exception( "Page not found : " . $link ) ;
			}
			
			require_once( $include_path ) ;
		 	
		 	$offset = strrpos( $link, "/" ) ;
			$className = substr( $link, ( $offset ) ? $offset + 1 : 0 ) . $suffix ;
			
			$result = new $className() ;
		}
		return $result ;
	}
	
	/**
	 * return an encrypted string
	 * 
	 * @param string $value the value to encrypt
	 * @return string the encrypted value
	 */
	public static function crypt( $value ){
		return md5($value) ;
	}
	
	/**
	 * Set a cookie value (to save later)
	 * 
	 * @param string $name the cookie name
	 * @param string $value the cookie value
	 */
	public static function setCookie($name, $value){
		if( !empty($name) ){
			self::$cookiesToSave[$name] = $value ;
		}
	}
	
	/**
	 * Send to cookie to the response
	 * 
	 */
	public static function saveCookie(){
		$expire = time() + Configuration::get(Configuration::APP_COOKIE_TIME) ;
		foreach( self::$cookiesToSave as $n => $v ){
			setcookie($n,$v,$expire) ;
		}
	}
	
	public static function calculatePathToRoot( $path ){
		$result = "" ;
		$a = substr_count($path,"/") ;
		
		// Page path begin with p/
		// So we do this at least once 
		for( $i = 0 ; $i <= $a ; $i++ ){
			$result = $result . "../" ;
		}
		return $result ;
	}
	
}

?>