<?php
 Class Session 
 {
	public function __construct()
	{
	 session_start();
	}
	
	public function set($key,$value = NULL)
	{
	 $_SESSION[$key] = $value;
	 return $value;
	}
	
	public function get($key)
	{
	 return $_SESSION[$key];
	}
	
	public function end()
	{
	 $_SESSION = array();
	 session_destroy();
	}
 }