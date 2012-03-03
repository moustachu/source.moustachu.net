<?php

require_once "php/core/Control.class.php";
require_once "php/core/Browser.class.php";

/**
 * Classe Page
 *
 * Représente une page destinée à être affiché via Smarty
 *
 * @author moustachu
 *
 */
abstract class Page extends Control{

	/**
	 * Liste des balises meta de la page
	 * @var array
	 */
	private $meta ;

	/**
	 * Liste des fichiers CSS de la page
	 * @var array
	 */
	private $css ;

	/**
	 * Liste des fichiers javascript de la page
	 * @var array
	 */
	private $js ;

	/**
	 * Titre de la page
	 * @var string
	 */
	private $title ;

	/**
	 * Analyse du navigateur
	 * @var Browser
	 */
	private $browser ;

	protected $forms ;

	/**
	 * Constructeur
	 *
	 * TODO : Page Object initialization from a Control Object
	 */
	function Page( $tpl_engine = null ){
		parent::Control($tpl_engine) ;

		$this->trace("instanciation Page") ;
		
		$this->title = "New Page" ;
		$this->smarty->assignByRef("title",$this->title) ;
		
		$this->forms = array() ;
		
		// Browser configuration
		
		$this->browser = new Browser() ;
		
		$this->meta = array() ;
		$this->smarty->assignByRef("meta",$this->meta) ;

		if( $this->browser->isIphone() ){
			$this->addMeta("viewport","width=640") ;
			$this->addMeta("apple-mobile-web-app-capable","yes") ;
		}

		if( $this->browser->isInternetExplorer() ){
			$this->addMeta("X-UA-Compatible","IE=8") ;
		}

		$this->css = array() ;
		$this->smarty->assignByRef("css",$this->css) ;

		$this->addCss("reset.css") ;
		$this->addCss("common.css") ;
		
		$this->js = array() ;
		$this->smarty->assignByRef("js",$this->js) ;
		
	}

	public function prepare(){
		foreach( $this->forms as $f ){
			$f->prepare() ;
		}
	}

	public function execute( $action = false ){
		
		if( $action && isset($this->forms[$action]) ){
			
			$form = $this->forms[$action] ;
	    	
	    	$form->validate() ;
	    	if( $form->hasErrors() ){
	    		$this->trace($action . "_errors") ;
	    		$this->smarty->assignByRef( $action . "_errors",$form->getErrors()) ;
	    	} else {
	    		$form->execute() ;
	    		if( $form->hasErrors() ){
	    			$this->smarty->assignByRef( $action . "_errors",$form->getErrors()) ;
	    		}
	    	}
	    
		}
	}
	
	/**
	 * Affichage de la template principale
	 */
	public function display(){
		$this->smarty->assign("main_content",$this->template) ;
		$this->setTemplate("common/page.tpl") ;
		parent::display() ;
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
			$this->plugin_manager = new PluginManager($this->smarty) ;
			$this->setPlugin();
		}
	}
	
	/**
	 * Paramétrer le titre de la page
	 * @param string $p_title le titre de la page
	 */
	public function setTitle( $p_title ){
		$this->title = $p_title ;
	}
	
	/**
	  * Ajouter un fichier css à la page
	  * @var string
	  */
	public function addCss( $css_file ){
		if( !array_search($css_file, $this->css) ){
			array_push($this->css, $css_file) ;
		}
	}
	
	/**
	  * Ajouter un fichier javascript à la page
	  * @var string
	  */
	public function addJs( $js_file ){
		if( !array_search($js_file, $this->js) ){
			array_push($this->js, $js_file) ;
		}
	}
		
	/**
	  * Standard jquery configuration
	  * @var string
	  */
	public function setJquery(){
		$this->addJs(Configuration::get(Configuration::JQUERY)) ;
	}
	
	/**
	  * UI Plugin configuration
	  * @var string
	  */
	public function setPlugin(){
		$this->setJquery() ;
		$this->addJs(Configuration::get(Configuration::JQUERY_UI)) ;
		$this->addJs("init-ui.js") ;
		$this->addCss(Configuration::get(Configuration::JQUERY_UI_CSS)) ;
		$this->addCss(Configuration::get(Configuration::JQUERY_UI_MOD_CSS)) ;
	}
	
	
	/**
	  * Ajouter un tag meta à l'entète de la page
	  * @var string
	  */
	public function addMeta( $name, $value ){
		$this->meta[$name] = $value ;
	}
	
	public function addForm( $name , $form ){
		$this->forms[$name] = $form ;
	} 
	
}


?>