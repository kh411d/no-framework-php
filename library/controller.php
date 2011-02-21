<?php
abstract Class Controller 
{
 protected $vars = array();
 
 public function getOutput()
 {
  if($idx = @func_get_arg(0)) 
   return isset($this->vars[$idx]) ? $this->vars[$idx] : $this->vars;
  
  return $this->vars; 
 }
 
 protected function setOutput($key,$value = NULL)
 {
  if(is_array(func_get_arg(0))){
    foreach(func_get_arg(0) as $key => $value)$this->vars[$key] = $value;
  }else{  
	$this->vars[$key] = $value;
  }
 }
} 