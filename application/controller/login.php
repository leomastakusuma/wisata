<?php
class login extends Controller {

    public function index(){
        require 'application/views/login/index.html';
       
    }
    
    public function cari(){
        $id = '1';
        $cari = $this->loadModel('usermodels');
        $getuser = $cari->searchuser($id);
        foreach ($getuser as $row)
        {
            print_r($row).'<br>';
        }
//        echo $getuser;
//        $user
    }
    
    public function hapus(){
        require_once "application/views/login/index.html";
        
    }
    
    public function tesquery(){
         $usermodel     = $this->loadModel('user');
         $getalluser    = $usermodel->getuser();
         foreach ($getalluser as $row){
             echo $row->id;
             echo $row->user;
             echo $row->pass;
         }
           
    }
    
    public function tesfunc(){
        
      
        $usermodel  = $this->loadModel('user');
        $user       = $usermodel->getuser();
           $this->view('login','index',$user);
    }
    
    public function proses(){
       $form = $_POST;
       $username = $form['username'];
       $password = $form['password'];
       
       if(!empty($form)){
            $msg = array();
                if(empty($username)){
                    $msg[] = 'Username Tidak Boleh Kosong';
                }
                if(empty($password)){
                    $msg[] = 'Password Tidak Boleh Kosong';
                }
                
            if(count($msg)>0){
                $error_msg = $msg;
                require 'application/views/login/index.html';
            }
           
            else {
                $login   = $this->loadModel('loginmodels');
                $prosess = $login->loginaction($username,$password);
                foreach($prosess as $row){
                    $level= $row->level;
                }
                if(count($prosess)>0){
                      if($level== 'admin'){
                      $form['create']=  date('Y-d-m');
                      $session  = $username;
                      $_SESSION = $username.'-'.$form['create'];
                      $this->redirect('admin');
                      }
                      if($level== 'user'){
                      $form['create']=  date('Y-d-m');
                      $_SESSION = $username.'-'.$form['create'];
                      $this->redirect('home/news');}
                }
                else{
                   echo "<script>alert('username dan password salah !!')</script>";
                   require 'application/views/login/index.html';

                }
            }
            
       }
        
      
      
    }
}
    
