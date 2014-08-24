<?php

class bukutamu extends Controller{
    public function index(){
//        require 'application/templates/header.html';
        require 'application/views/signup/test.html';
       
       
        
    }
    public function save(){
        print_r($_POST);
//        $this->redirect('bukutamu');
    }
    
    
}