<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * 
 */
class reservasi extends Controller{
    private $_model  = 'reservasimodels';
    public function index(){
        require 'application/templates/header.html';
        require 'application/templates/menu.html';
       $model  = $this->loadModel($this->_model);
        $getall=$model->pagex();
        echo '<pre>';
        print_r($getall);
        require 'application/templates/footer.php';
        
        
    }
    
}