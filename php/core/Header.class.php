<?php

require_once 'php/core/Control.class.php';

/**
 * Classe Header
 * 
 * Représente une page destinée à être affiché via Smarty
 * 
 * @author moustachu
 *
 */
class Header extends Control{
	
	function Header(){
		parent::Control() ;
		
		$this->trace("Header()") ;
		
	}
	
}

?>