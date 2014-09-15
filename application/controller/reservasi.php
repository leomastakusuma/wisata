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
    private $_model         = 'reservasimodels';
    private $_modelorder    = 'ordermodels';
    public function index(){
        require 'application/templates/header-page.html';
        require 'application/templates/menu.html';
        $model  = $this->loadModel($this->_model);
        $getall=$model->getall();
        require 'application/views/reservasi/index.html';
        require 'application/templates/footer.php';
        
        
    }
    
    public function getorder($idreservasi){
        if(isset($idreservasi)){
            $model = $this->loadModel($this->_model);
            $getall=$model->searchreservasi($idreservasi);
        
            require 'application/templates/header.html';
            require 'application/templates/menu.html'; 
            require 'application/views/reservasi/order.html';
            require 'application/templates/footer.php';
        }
        
    }


    public function booking(){
        echo '<pre>';
        $id_user        = $_SESSION['id_user'];
        $form           = $_POST;
        $id_reservasi   = $form['id'];
        $tanggal        = $form['tanggal'];
        $pesan          = $form['pesan'];
        
        
        $model   = $this->loadModel($this->_modelorder);
        
        $id_reservasi = '19';
        $jml          = 12;
        $harga        = 100000000;
        print_r($_POST);
//        $model->saveorder($id_reservasi, $id_user, $jml,$harga);
        
        
//        echo $id_user;
//        print_r($_POST);
////    	if (isset($idreservasi)) {
//            $model = $this->loadModel($this->_model);
//            $getall = $model->searchreservasi($idreservasi);
//            echo "<pre>";
//            print_r($getall);
//        }
    }
   
    public function cek(){
        $id_reservasi = 19;
        $tanggal      = '2014-09-15';
        $model = $this->loadModel($this->_modelorder);
        $cek   = $model->cekorder($id_reservasi, $tanggal);
        print_r($cek);
    }

}


