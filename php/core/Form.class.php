<?php

require_once "php/core/Control.class.php";
require_once "php/core/Parameter.class.php";

/**
 * Form class
 *
 * @author moustachu
 *
 */
abstract class Form extends Control{

	/**
	 * Form name
	 * @var string
	 */
	protected $name ;
	
	protected $params ;
	
	protected $values ;
	
	/**
	 * Constructeur
	 */
	function Form( $tpl_engine = null ){
		parent::Control( $tpl_engine ) ;

		$this->trace("instanciation Form") ;
		
		$this->params = array() ;
		$this->values = array() ;
		
	}

	public function display(){
		parent::display() ;
	}

	/**
	 * add a form parameter
	 * 
	 * @param string $name parameter name 
	 * @param bool $mandatory true if the paramter is mandatory
	 */
	public function addParam( $name, $code, $mandatory ){
		$this->params[$code] = new Parameter($name, $code, $mandatory) ;
	}
	
	public function validate(){
		foreach( $this->params as $p ){
			$value = $p->getValue() ;
			if( $p->isRequired() && empty($value) ){
				$this->addError( "missing " . $p->getName() ) ;
			}
		}
	}
	
	public function prepare(){
		$this->trace( count($this->params) ) ;
		
		//	throw new Exception("fail") ;
				
		foreach( $this->params as $p ){
			$input_name = $this->getParameterInputName($p->getCode()) ;
			$this->trace( $input_name . " = " . App::get( $input_name ) ) ;
				
			if( App::get( $input_name ) ){
				$p->setValue( App::get( $input_name ) ) ;
				$this->smarty->assignByRef( $input_name , $p ) ;
			}
		}
	}
	
	public function getParameterInputName( $p_name ){
		return $this->name . "_" . $p_name ;
	}
	
	
	/**
	 * Forwarding the template path to smarty
	 */
	public function setTemplate( $tpl ){
		parent::setTemplate( $tpl );
		$this->smarty->assign($this->name."Form_template",$tpl) ;
	}
	
}


?>