<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Contains essential configurations for all php scripts
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 20 july 2013
 */

/**
 * Defines the root directory. Used by all other scripts.
 */
define('ROOT_DIR', dirname(__FILE__));

/**
 * Define a varaible to avoid calling pages arbitaraly
 */
define('TALE', '234223nbnhj432');

/**
 * Includes the database configs
 */
require_once './dbconfig.php';
?>
