<?php

require_once 'php/core/Configuration.class.php';

/**
 * Class PluginManager
 *
 * Plugin management : Register the template engine plugin
 * 
 * Notes : 
 * 
 * 02/2012 : Smarty 3.17
 * 
 * @author moustachu
 *
 */
class PluginManager{
	
	/**
	 * Parent control Smarty Object
	 * @var Smarty Class
	 */
	protected $smarty ;
	
	/**
	 * Constructor 
	 * @param Object template template engine
	 */
	function PluginManager($template){
		$this->smarty = $template ;
		
		$this->smarty->registerPlugin("function","tx_std",array($this,"processTextInput")) ;
		$this->smarty->registerPlugin("function","tx_icon",array($this,"processTextInputWithIcon")) ;
		
	}
		
	/**
	 * Text input
	 * 
	 * @return Text input	 
	 */
	public function processTextInput($params, $s){
		
		//Configuration::trace("processTextInput") ;
		
		$s->assign("wrapper_width", $params["size"] * 8 ) ;
		
		$s->assign("input_id", $params["id"]) ;
		$s->assign("input_name", $params["name"]) ;
		$s->assign("input_size", $params["size"]) ;
		$s->assign("input_value", $params["value"]) ;
		
		return $s->fetch('ui/tx-std.tpl') ;
	}
		
	/**
	 * Text input with icon
	 * 
	 * @return Text input with icon
	 */
	public function processTextInputWithIcon($params, $s){
		
		$s->assign("wrapper_width", $params["size"] * 8 ) ;
		
		$s->assign("rs_icon", $params["icon"]) ;
		$s->assign("input_id", $params["id"]) ;
		$s->assign("input_name", $params["name"]) ;
		$s->assign("input_size", $params["size"]) ;
		$s->assign("input_value", $params["value"]) ;
		
		return $s->fetch('ui/tx-icon.tpl') ;
	}

}	

?>