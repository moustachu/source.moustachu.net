<?php

/*
 * Tableau de configuration principal $GLOBAL_CONF
 * 
 * Notes :
 * - les chemins sont relatifs à la racine web du projet, ie. le point d'entrèe PHP
 */

global $GLOBAL_CONF ;

/* COMMON */
$GLOBAL_CONF["project_name"] = "moustachu.net" ; 
$GLOBAL_CONF["project_version"] = "1.a" ; 
$GLOBAL_CONF["project_contact"] = "moustachu@moustachu.net" ; 

$GLOBAL_CONF["production_mode"] = false ; 
$GLOBAL_CONF["main_log_file"] = "main.log" ; 


/* SMARTY */
$GLOBAL_CONF["smarty_template_dir"] = "php/tpl";
$GLOBAL_CONF["smarty_compil_dir"]   = "tmp/tpl";
$GLOBAL_CONF["smarty_config_dir"]   = "php/conf";
$GLOBAL_CONF["smarty_cache_dir"]    = "tmp/cache";

/* JQUERY */

$GLOBAL_CONF["jquery"]    = "jquery-1.4.4.min.js";
$GLOBAL_CONF["jquery.ui"]    = "jquery-ui-1.8.7.custom.min.js";
$GLOBAL_CONF["jquery.ui.css"]    = "jquery-ui-1.8.7.custom.css";


?>