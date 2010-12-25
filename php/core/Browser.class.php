<?php

require_once 'php/core/Configuration.class.php';
require_once 'php/lib/UserAgent.php';
require_once 'php/lib/modernizr-server-custom.php';

/**
 * Classe Browser
 *
 * Collection d'utilitaire relatif au navigateur
 * 
 * Note : 
 * 
 * 10/2010
 * 
 * on utilise ici une bibliothèque externe car la fonctionnalité interne "browscap" de PHP dépend 
 * d'un paramètrage PHP_INI_SYSTEM (php.ini et httpd.conf, pas de ini_set() ni de .htaccess)
 * et d'une base utilisateur à mettre à jour régulièrement ...
 * 
 * 02/11/2010 : 
 * 
 * Intégration de la librairie JS modernizr.js et de son portage en PHP modernizr-server.php
 * pour la detection de fonctionnalités avancées : HTML5, CSS3, Touch events etc ...
 * http://www.modernizr.com/
 * http://tripleodeon.com/2010/10/modernizr-on-the-server-side/
 * 
 * @author moustachu
 *
 */
class Browser{

	/**
	 * Sauvegarde de l'analyse du navigateur
	 * @var unknown_type
	 */
	private $browser_data ;

	/**
	 * Sauvegarde de l'analyse des fonctionnalités du navigateur
	 * @var unknown_type
	 */
	private $browser_features ;
	
	/**
	 * Construteur
	 */
	function Browser(){
		Configuration::trace("instantiation Browser" ) ;

		// La fonction retourne un tableau associatif avec des clés type "is_xxx"
		$this->browser_data = GetUserAgent() ;
		
		$this->browser_features = Modernizr::getInstance() ;
		
	}

	/**
	 * retourne le USER_AGENT récupérer par PHP
	 * @return string
	 */
	public function getPhpUserAgent(){
		return $_SERVER["HTTP_USER_AGENT"] ;
	}

	/**
	 * retourne l'analyse du navigateur
	 * @return array
	 */
	public function getBrowserInfo(){
		return $this->browser_data ;
	}

	/**
	 * retourne l'analyse du navigateur
	 * @return object
	 */
	public function getBrowserFeatures(){
		return $this->browser_features ;
	}
	
	/**
	 * toString ...
	 * @return string
	 */
	public function toString(){
		// return $this->type." ".$this->version." ".$this->platform ;
		return "Browser->toString() : TODO" ;
	}

	/**
	 * Enter description here ...
	 * @return boolean
	 */
	public function isIphone(){
		if (stripos($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
			return true ;
		}
		return false ;
	}
	
	/**
	 * Internet Explorer / toutes versions
	 * @return boolean
	 */
	public function isInternetExplorer(){
		if( $this->browser_data["is_ie"] ){
			return true ;
		}
		return false ;
	}
	
	
}

?>