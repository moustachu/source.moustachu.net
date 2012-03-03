<?php

/**
 * Parameter class
 *
 * @author moustachu
 *
 */
class Parameter {

	/**
	 * Parameter name
	 * @var string
	 */
	protected $name ;
	
	protected $code ;
	
	protected $required ;
	
	protected $value ;
	
	/**
	 * Constructeur
	 */
	function Parameter( $name, $code, $required ){
		
		$this->name = $name ;
		$this->code = $code ;
		$this->required = $required ;
		$this->value = null ;
			
	}
	
	public function setValue( $value ){
		$this->value = $value ;
	}
	
	public function getValue(){
		return $this->value ;
	}
	
	public function getName(){
		return $this->name ;
	}
	
	public function getCode(){
		return $this->code ;
	}
	
	public function isRequired(){
		return $this->required ;
	}
	
	
}


?>