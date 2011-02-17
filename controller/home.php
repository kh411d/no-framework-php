<?php
 Class Home 
 {
  protected $results;
  public function __construct()
  { 
   //Logic here
   
   //Getting Arguments from URL Segments
   $args = func_num_args() ? func_get_arg(0) : null;
   
   $this->results = array('hello'=>"Hello World!");
  }
  
  public function get() 
  {
   return $this->results;
  }
  
 } 
 