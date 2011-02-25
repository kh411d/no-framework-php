<?php 
// Initialize !Important!
include "config.php";

// Include Loader !Important!
include LIBRARY_DIR."load.php";

// Load Session
load::l('session');

// Sanitize all input !Important!
load::l('input');

// Set Default Route
if(!defined('DEFAULT_ROUTE') || DEFAULT_ROUTE == '')die('Default Route is Missing');
load::l('router')->add('/',DEFAULT_ROUTE);

//Include Other Routes
include "routes.php";

//Ready get set .... Go!
load::l('router')->run();