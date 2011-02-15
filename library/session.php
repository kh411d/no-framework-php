<?php
 Class Session 
 {
	public function __construct()
	{
	 session_start();
	}
	
	public function set($key,$value = NULL)
	{
	 if(empty($key))die('Session Key undefined');
	 $_SESSION[$key] = $value;
	 return $value;
	}
	
	public function get($key)
	{
	 if(empty($key))die('Session Key undefined');
	 return $_SESSION[$key] = $value;
	}
	
	public function end()
	{
	 $_SESSION = array();
	 session_destroy();
	}
 }