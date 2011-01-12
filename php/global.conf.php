<?php

/*
 * Tableau de configuration principal $GLOBAL_CONF
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


/* SMARTY */
$GLOBAL_CONF["smarty.template.dir"] = "php/tpl";
$GLOBAL_CONF["smarty.compil.dir"]   = "tmp/tpl";
$GLOBAL_CONF["smarty.config.dir"]   = "php/conf";
$GLOBAL_CONF["smarty.cache.dir"]    = "tmp/cache";

/* JQUERY */

$GLOBAL_CONF["jquery"]			= "jquery-1.4.4.min.js";
$GLOBAL_CONF["jquery.ui"]		= "jquery-ui-1.8.7.custom.min.js";
$GLOBAL_CONF["jquery.ui.css"] 	= "jquery-ui-1.8.7.custom.css";

/* AUTH */ 
$GLOBAL_CONF["auth.db.file"] = "data/auth.db";


?>