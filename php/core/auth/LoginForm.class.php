<?php
require_once 'php/core/Form.class.php';

/**
 * LoginForm class
 * 
 * Login action
 * 
 * @author moustachu
 *
 */
class LoginForm extends Form{
	
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
	 * @see www/v1.a/php/core/Form::__contruct()
	 */
	function LoginForm( $tpl_engine = null ){
		parent::Form($tpl_engine) ;
		
		$this->name = "Login" ;
		$this->setTemplate("auth/login.form.tpl") ;
		
		$this->logged = false ;
		$this->user_manager = new UserManager(Configuration::get(Configuration::AUTH_DB_FILE)) ;
		
		$this->addParam("username","username",false) ;
		$this->addParam("password","password",false) ;
		$this->addParam("userkey","userkey",false) ;
		
		// Login Action special case
		// Not included in the normal page lyfecycle
		$this->prepare();
		$this->validate();
		$this->execute();
		
	}	
	
	public function execute(){
		
		App::trace("Login Action");
		
		$this->username = $this->params["username"]->getValue() ;
		$password = $this->params["password"]->getValue() ;
		$userkey = $this->params["userkey"]->getValue() ;
		
		if( $this->username ){
			
	    	$this->smarty->assign("auth_username",$this->username) ;
	    	
	    	if( $this->user_manager->getUser($this->username) ){
	    		
	    		App::setCookie($this->getParameterInputName("username"),$this->username) ;
	    		
	    		if( $password ){
	    			$password = App::crypt($password) ;
	    		} else{
	    			// let's try the cookie
	    			$password = $userkey ;
	    		}
	    		
	    		if( $password ){
	    			
	    			// TODO : remove
	    			App::debug($password) ;
	    			
	    			if($this->user_manager->authenticate($this->username,$password)){
	    				App::setCookie($this->getParameterInputName("userkey"),$password) ;
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
    	
    	$this->smarty->assign("auth_logged",$this->logged) ;
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