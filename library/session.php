<?php
 Class Session 
 {
	public function __construct()
	{
	 session_start();
	}
	
	public function set($key,$value = NULL,$overwrite = TRUE)
	{
	 if($overwrite)
	 $_SESSION[$key] = $value;
	 
	 return $_SESSION[$key];
	}
	
	public function get($key,$prefix = false)
	{
	 if($prefix)
	 { 
	  $tmp = array();
	  foreach($_SESSION as $k => $v){
	   if(strpos($k, $key) === 0)
	     $tmp[$k] = $_SESSION[$k];
	  }
	  return $tmp;
	 }
	 
	 return $_SESSION[$key];
	}
	
	public function is_set($key)
	{
	 if(!is_array($key)){
	   $key = func_num_args() > 0 ? func_get_args() : array($key);
	 }else{
	  $key = array_values($key);
	 }
	 foreach ($key as $v){
	  if(!isset($_SESSION[$v]) || empty($_SESSION[$v]))return false; 
	 }
	 return true;
	}
	
	public function clear($key,$prefix = false)
	{
	 if($prefix)
	 {
	  foreach($_SESSION as $k => $v){
	   if(strpos($k, $key) === 0) unset($_SESSION[$k]);
	  }
	  return;
	 }
	 unset($_SESSION[$key]);
	 return;
	}
	
	public function end()
	{
	 $_SESSION = array();
	 session_destroy();
	}
 }