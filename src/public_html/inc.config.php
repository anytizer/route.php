<?php
#header("Content-Type: text/plain");

define("__LIBRARIES__", realpath(dirname(__FILE__)."/../libraries"));
#die(__LIBRARIES__);

require_once(__LIBRARIES__."/classes/backend/class.spl_include.inc.php");

/**
 * Placeholder for system defined class files
 */
spl_autoload_register(array(new \backend\spl_include(__LIBRARIES__."/classes"), "namespaced_inc_dot"));

/**
 * Placeholder for third party installed/serviced packages
 */
spl_autoload_register(array(new \backend\spl_include(__LIBRARIES__."/packages"), "namespaced_inc_dot"));
