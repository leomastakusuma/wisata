<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Index extends Controller{
    private $model = 'beritamodels';


    public function index(){
//        require_once 'application/templates/user.php';
//    require_once 'application/views/index/index.html';
      require_once 'application/templates/header.html';
      require_once 'application/templates/menu.html';
      $model        = $this->loadModel($this->model);
      $get          = $model->geta();
      require_once 'application/templates/content.php';
      require_once 'application/templates/footer.php';  
        
        
        
    }
    
    public function Nama(){
    	if(!empty($login)){
            echo $login;
        }
        else {
            echo 'a';
            
        }
    }
}