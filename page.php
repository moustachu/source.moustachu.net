<?php 
	
	require_once('php/core/App.class.php') ;
	
	if(App::get('page')){
		App::trace("Request page : " . App::get('page') ) ;
		require_once('page/' . App::get('page') . '.php') ;
	}
	
	
	
?>