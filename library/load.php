<?php
Class Load 
{  
   public static $instance = array();
   public function __construct(){}
   
	public static function c($name)
	{
	 if(!file_exists(CONTROLLER_DIR.$name.".php")) die("$name - File Not Found");
	 include_once CONTROLLER_DIR.$name.".php";
	}

	public static function l($name)
	{ 
	 if(!file_exists(LIBRARY_DIR.$name.".php"))die("$name - File Not Found");
	 include_once LIBRARY_DIR.$name.".php";
	 return self::set_instance($name);
	}

	public static function m($name)
	{
	 if(!file_exists(MODEL_DIR.$name.".php"))die("$name - File Not Found");
	 include_once MODEL_DIR.$name.".php";
	 return self::set_instance($name);
	}

	public static function v($name)
	{
	 if(!file_exists(VIEW_DIR.$name.".php"))die("$name - File Not Found");
	 include_once VIEW_DIR.$name.".php";
	}
	
	public static function set_instance($name)
	{
	 if (class_exists($name) && !array_key_exists($name,self::$instance)) {
		  self::$instance[$name] = new $name();
		  return self::$instance[$name];
	 }elseif(class_exists($name) && array_key_exists($name,self::$instance)){
	 	  return self::$instance[$name];
	 }else{
	  return NULL;
	 }
	}
}

