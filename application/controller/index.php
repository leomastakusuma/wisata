<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends Controller{
    
    public function index(){
//        require_once 'application/templates/user.php';
      

       require_once 'application/views/index/index.html';
        
        
    }
    
    public function Nama(){
    	echo "Test";
    }
    
}