<?php
require_once 'php/core/Control.class.php';
require_once 'php/core/auth/UserManager.class.php';

/**
 * Classe AuthControl
 * 
 * Authentication Controller
 * 
 * @author moustachu
 *
 */
class AuthControl extends Control{
	
	protected $user_manager ;
	
	/*
	 * the username
	 *
	 * @var bool
	 */
	private $username ;
	
	/*
	 * logged in status 
	 *
	 * @var bool
	 */
	private $logged ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Control::__contruct()
	 */
	function AuthControl( $tpl_engine = null ){
		parent::Control($tpl_engine) ;
		
		$this->trace("instanciation AuthControl") ;
		
		$this->logged = false ;
		
		$this->username = App::get("username") ;
		
		$this->user_manager = new UserManager(Configuration::get(Configuration::AUTH_DB_FILE)) ;
		
				
	}
	
	public function execute(){
	
		if( $this->username ){
			
	    	$this->smarty->assign("username",$this->username) ;
	    	
	    	if( $this->user_manager->getUser($this->username) ){
	    		
	    		App::setCookie("username",$this->username) ;
	    		
	    		$password = App::get("password") ;
	    		if( $password ){
	    			$password = App::crypt($password) ;
	    		} else{
	    			// let's try the cookie
	    			$password = App::get("userkey") ;
	    		}
	    		
	    		if( $password ){
	    			
	    			// TODO : remove
	    			App::debug($password) ;
	    			
	    			if($this->user_manager->authenticate($this->username,$password)){
	    				App::setCookie("userkey",$password) ;
	    				$this->logged = true ;
	    			} else {
	    				$this->addError("Wrong password") ;
	    			}
	    			
	    		} else {
	    			$this->addError("No password") ;
	    		}
	    		
	    	} else {
	    		$this->addError("User not found") ;
	    	}	
	    		
	    } else {
	    	$this->addError("Not logged in") ;
	    }
	    
	}
	
	/**
	 * @return bool true if the user is successfully logged in
	 */
	public function isLogged(){
		return $this->logged ;
	}
	
	/**
	 * @return string the current username
	 */
	public function getUsername(){
		return $this->username ;
	}
	
	/**
	 * @return UserManager the current user manager
	 */
	public function getUserManager(){
		return $this->user_manager ;
	}
	
}

?>