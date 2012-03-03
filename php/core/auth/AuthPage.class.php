<?php
require_once 'php/core/Page.class.php';
require_once 'php/core/auth/LoginForm.class.php';
require_once 'php/core/auth/LogoutForm.class.php';
require_once 'php/core/auth/UserManager.class.php';

/**
 * Classe AuthPage
 * 
 * Page de debug vide
 * 
 * @author moustachu
 *
 */
abstract class AuthPage extends Page{
	
	/*
	 * the user manager
	 *
	 * @var UserManager
	 */
	protected $user_manager ;
	
	/*
	 * Login Controller
	 *
	 * @var LoginForm
	 */
	private $login_form ;

	
	/*
	 * Logout Controller
	 *
	 * @var LogoutForm
	 */
	private $logout_form ;

	/*
	 * the username
	 *
	 * @var bool
	 */
	protected $username ;
	
	/*
	 * logged in status 
	 *
	 * @var bool
	 */
	protected $logged ;
	
	/*
	 * Is this page accessible in public mode ?
	 *
	 * @var bool
	 */
	protected $public_mode ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	function AuthPage( $public = false ){
		parent::Page() ;
		
		$this->trace("instanciation AuthPage") ;
		
		$this->public_mode = $public ;
		
		$this->loginForm = new LoginForm($this->smarty);
		$this->user_manager = $this->loginForm->getUserManager() ;
		$this->username = $this->loginForm->getUsername() ;
		$this->logged = $this->loginForm->isLogged() ;
		
		if( ( ! $this->logged ) && ( ! $this->public_mode ) ){
			$this->fail( array_pop( $this->loginForm->getErrors() ) ) ;
		}
		
		$this->logoutForm = new LogoutForm($this->smarty);
		
		if( App::get("action") == "Logout" ){
			$this->logoutForm->execute();
			$this->logged = false ;
			if( ! $this->public_mode ){
				$this->fail( "Logged out" ) ;
			}
		}
		
	}
	
	/**
	 * Default failure redirection
	 * 
	 * @param string $msg failure message
	 */
	protected function fail( $msg ){
		App::set("forward",Configuration::get(Configuration::AUTH_LOGIN_PAGE)) ;
		throw new Exception( $msg ) ;
	}
	
	
	/**
	 * Affichage de la template principale
	 */
	public function display(){
		$this->smarty->assign("auth_main_content",$this->template) ;
		$this->setTemplate("auth/page.tpl") ;
		parent::display() ;
	}
	
}

?>