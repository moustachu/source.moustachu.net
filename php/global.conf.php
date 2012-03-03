<?php

/*
 *	 Main Configuration array $GLOBAL_CONF
 * 
 * Notes :
 * - les chemins sont relatifs à la racine web du projet, ie. le point d'entrèe PHP
 */

global $GLOBAL_CONF ;

/* COMMON */
$GLOBAL_CONF["project.name"] 	= "moustachu.net" ; 
$GLOBAL_CONF["project.version"] = "1.a" ; 
$GLOBAL_CONF["project.contact"] = "moustachu@moustachu.net" ; 

$GLOBAL_CONF["production.mode"] = false ;
$GLOBAL_CONF["main.log.file"]	= "main.log" ; 
$GLOBAL_CONF["debug.mode"] = true ;
$GLOBAL_CONF["debug.log.file"]	= "debug.log" ; 


$GLOBAL_CONF["app.include.dir"] = "php/app" ;
$GLOBAL_CONF["app.cookie.time"] = 60 * 60 * 24 * 10 ; // 10 days
$GLOBAL_CONF["app.default.page"] = "Home" ;

/* SMARTY */
$GLOBAL_CONF["smarty.template.dir"] = "php/tpl";
$GLOBAL_CONF["smarty.compil.dir"]   = "tmp/tpl";
$GLOBAL_CONF["smarty.config.dir"]   = "php/conf";
$GLOBAL_CONF["smarty.cache.dir"]    = "tmp/cache";

/* JQUERY */
$GLOBAL_CONF["jquery"]			= "jquery-1.7.1.min.js";
$GLOBAL_CONF["jquery.ui"]		= "jquery-ui-1.8.17.custom.min.js";
// $GLOBAL_CONF["jquery.ui.css"] 	= "jquery/ui-darkness/jquery-ui-1.8.17.custom.css";
$GLOBAL_CONF["jquery.ui.css"] 	= "jquery/smoothness/jquery-ui-1.8.17.custom.css";
$GLOBAL_CONF["jquery.ui.mod.css"] 	= "jquery/jquery-ui.mod.css";

/* AUTH */ 
$GLOBAL_CONF["auth.db.file"] = "data/auth.db";
$GLOBAL_CONF["auth.login.page"] = "Login";


?>