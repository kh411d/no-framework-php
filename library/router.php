<?php
 Class Router 
 {
	protected $routes = array();
	protected $regexes = array();
	public $uri_string;
	public $segments = array();
	public $permitted_uri_chars = 'a-z 0-9~%.:_\-';
	
 
	public function __construct()
	{
	 $this->fetch_uri_string();
	 $this->explode_segments();
	}
	
	public function add($path,$view)
	{
	  $this->routes[] = array('path' => $path, 'view' => $view);
      $this->regexes[]= "#^{$path}\$#";
	}
	
	protected function fetch_uri_string()
	{
			if (is_array($_GET) && count($_GET) == 1 && trim(key($_GET), '/') != '')
			{
				$this->uri_string = key($_GET);
				return;
			}

			$path = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : @getenv('PATH_INFO');
			if (trim($path, '/') != '' && $path != "/".SELF)
			{
				$this->uri_string = $path;
				return;
			}

			$path =  (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');
			if (trim($path, '/') != '')
			{
				$this->uri_string = $path;
				return;
			}

			$path = str_replace($_SERVER['SCRIPT_NAME'], '', (isset($_SERVER['ORIG_PATH_INFO'])) ? $_SERVER['ORIG_PATH_INFO'] : @getenv('ORIG_PATH_INFO'));
			if (trim($path, '/') != '' && $path != "/".SELF)
			{
				$this->uri_string = $path;
				return;
			}

			$this->uri_string = '/';
			
	}
	
	protected function explode_segments()
	{
		foreach(explode("/", preg_replace("|/*(.+?)/*$|", "\\1", $this->uri_string)) as $val)
		{
			// Filter segments for security
			$val = trim($this->filter_uri($val));

			if ($val != '')
			{
				$this->segments[] = $val;
			}
		}
	}
	
	protected function filter_uri($str)
	{
		if ($str != '' && $this->permitted_uri_chars != '' )
		{
			// preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
			// compatibility as many are unaware of how characters in the permitted_uri_chars will be parsed as a regex pattern
			if ( ! preg_match("|^[".str_replace(array('\\-', '\-'), '-', preg_quote($this->permitted_uri_chars, '-'))."]+$|i", $str))
			{
				die('The URI you submitted has disallowed characters.');
			}
		}

		// Convert programatic characters to entities
		$bad	= array('$', 		'(', 		')',	 	'%28', 		'%29');
		$good	= array('&#36;',	'&#40;',	'&#41;',	'&#40;',	'&#41;');

		return str_replace($bad, $good, $str);
	}

	
	 public function run()
	  { 
		foreach($this->regexes as $ind => $regex)
		{
		  if(preg_match($regex, $this->uri_string, $arguments))
		  { 
			array_shift($arguments);
			$def = $this->routes[$ind];
			if(file_exists(VIEW_DIR.$def['view'].'.php'))
			{
			 load::v($def['view']);
			 return;
			}else{
			 die('Could not call ' . json_encode($def) . " for route {$regex}");
			}
		  }
		}
		die("Could not find route {$this->uri_string} from {$_SERVER['REQUEST_URI']}");
	  }
 }