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
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    private $_model  = 'reservasimodels';
    public function index(){
        require 'application/templates/header-page.html';
        require 'application/templates/menu.html';
        $model  = $this->loadModel($this->_model);
        $getall=$model->getall();
        require 'application/views/reservasi/index.html';
        require 'application/templates/footer.php';
        
        
    }
    
    public function booking(){
        echo '<pre>';
        $id_user = $_SESSION['id_user'];
        echo $id_user;
        print_r($_POST);
//    	if (isset($idreservasi)) {
//            $model = $this->loadModel($this->_model);
//            $getall = $model->searchreservasi($idreservasi);
//            echo "<pre>";
//            print_r($getall);
//        }
    }


}


