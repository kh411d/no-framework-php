<?php 
// Initialize !Important!
include "config.php";
// Include Loader !Important!
include LIBRARY_DIR."load.php";
// Sanitize all input !Important!
load::l('input');
// Set Default Route
load::l('router')->add('/',DEFAULT_ROUTE);

// NEED TO DEFINE ALL ROUTE HERE! !Important!
// http://www.xxx.com/index.php/home
// with htaccess: http://www.xxx.com/home
load::l('router')->add('/home/(.+)/([0-9]+)','home');
load::l('router')->run();