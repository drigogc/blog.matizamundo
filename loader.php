<?php

/*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	LOAD SYSTEM
-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

// Prevents users from accessing this file directly
if (!defined('ABSPATH')) exit;
 
// Initialize session
session_start();
 
// Check mode to debug
if (!defined('DEBUG') || DEBUG === false) {
 
	// Hidden all errors
	error_reporting(0);
	ini_set("display_errors", 0); 
 
} else {
 
	// Show all errors
	error_reporting(E_ALL);
	ini_set("display_errors", 1); 
 
}
 
// Global functions
require_once ABSPATH . '/functions/global.function.php';
 
// Load application
$management_mvc = new ManagementMVC();

?>