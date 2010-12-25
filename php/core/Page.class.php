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

	/**
	 * Constructeur
	 */
	function Page(){
		parent::Control() ;

		$this->trace("instanciation Page") ;

		$this->title = "New Page" ;
		$this->smarty->assign_by_ref("title",$this->title) ;

		$this->browser = new Browser() ;
		
		$this->meta = array() ;
		$this->smarty->assign_by_ref("meta",$this->meta) ;

		if( $this->browser->isIphone() ){
			$this->addMeta("viewport","width=640") ;
			$this->addMeta("apple-mobile-web-app-capable","yes") ;
		}

		if( $this->browser->isInternetExplorer() ){
			$this->addMeta("X-UA-Compatible","IE=8") ;
		}

		$this->css = array() ;
		$this->smarty->assign_by_ref("css",$this->css) ;

		$this->addCss("reset.css") ;
		$this->addCss("common.css") ;
		
		$this->js = array() ;
		$this->smarty->assign_by_ref("js",$this->js) ;
		
	}

	/**
	 * Affichage de la template principale
	 */
	public function display(){
		$this->smarty->assign("main_content",$this->template) ;
		$this->smarty->display("common/page.tpl") ;
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
		array_push($this->css, $css_file) ;
	}
	
	/**
	  * Ajouter un fichier javascript à la page
	  * @var string
	  */
	public function addJs( $js_file ){
		array_push($this->js, $js_file) ;
	}
	
	/**
	  * Ajouter un tag meta à l'entète de la page
	  * @var string
	  */
	public function addMeta( $name, $value ){
		$this->meta[$name] = $value ;
	}

}


?>