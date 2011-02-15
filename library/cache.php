<?php
 Class Cache 
 {
  public function __construct()
  {
   if(!function_exists('apc_fetch')) die("PECL APC Not Installed, Cache Library cannot be use");
  }
  
   public function get($key)
  {
    if(empty($key)){
      return null;
    }else{
      $value = apc_fetch($key);
      return $value;
    }
  }

  public function set($key = null, $value = null)
  {
    if(empty($key) || $value === null)
      return false;
    apc_store($key, $value);
    return true;
  }
  
  public function clear()
  {
   return apc_clear_cache('user');
  }
  
  public function info()
  {
   return apc_cache_info('user');
  }
 }
?> 