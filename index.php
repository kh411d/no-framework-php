<?php 
// Initialize
include "config.php";

// Include Loader
include LIBRARY_DIR."load.php";

// Sanitize all input
load::l('input');

// NEED TO DEFINE ALL ROUTE HERE!
// http://www.xxx.com/index.php/home
// with htaccess: http://www.xxx.com/home
load::l('router')->add('/','home');
load::l('router')->add('/home/(.+)/([0-9]+)','home');
load::l('router')->run();