<?php
 Class Home_c extends Controller
 {
  public function __construct()
  {
   //Getting Regex Arguments from URL Segments if exists (optional)
   $reg = load::l('router')->reg_segments;
   
   $this->setVars(array('hello'=>"Hello World!"));
  }
 } 
 