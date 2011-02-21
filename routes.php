<?php
if(!defined('ROOT_DIR'))die('Access Denied');
// NEED TO DEFINE ALL ROUTE HERE! !Important!
// http://www.xxx.com/index.php/home
// with htaccess: http://www.xxx.com/home
// load::l('router')->add('/[YOUR URI PATH]','[YOUR VIEW/TEMPLATE FILE NAME]');

load::l('router')->add('/home/(.+)/([0-9]+)','home');
