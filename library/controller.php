<?php
abstract Class Controller 
{
 protected $vars = array();
 
 public function getVars()
 {
  return $this->vars; 
 }
 
 protected function setVars($key,$value = NULL)
 {
  if(is_array(func_get_arg(0))){
    foreach(func_get_arg(0) as $key => $value)$this->vars[$key] = $value;
  }else{  
	$this->vars[$key] = $value;
  }
 }
} 