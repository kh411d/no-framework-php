<?php
Class Load 
{  
   protected static $instance = array();
   public function __construct(){}
   
	public static function c($name)
	{
	 include_once ROOT_DIR."/controller/".$name.".php";
	}

	public static function l($name)
	{ 
	 include_once ROOT_DIR."/library/".$name.".php";
	 return self::set_instance($name);
	}

	public static function m($name)
	{
	 include_once ROOT_DIR."/model/".$name.".php";
	 return self::set_instance($name);
	}

	public static function v($name)
	{
	 include_once ROOT_DIR."/".$name.".php";
	}
	
	public static function set_instance($name)
	{
	 if (class_exists($name) && !in_array($name,self::$instance)) {
		  self::$instance[$name] = new $name();
		  return self::$instance[$name];
	 }elseif(class_exists($name) && in_array($name,self::$instance)){
		  return self::$instance[$name];
	 }else{
	  return NULL;
	 }
	}
}

