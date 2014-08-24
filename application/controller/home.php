<?php

class Home extends Controller{
	public function index(){
		 require_once 'application/templates/header.html';
		 require_once 'application/templates/menu.html';
		 require_once 'application/templates/content.php';
		 require_once 'application/templates/footer.php';
	// die;

	}


	public function test(){

			$data1=$_POST;
			$data = strtolower($data1['tex']);
			if(isset($data)) {
				require_once 'application/templates/header.html';
		 		require_once 'application/templates/menu.html';
				require_once"application/views/home/nama.html";
                require_once 'application/templates/footer.php';

			}
	}


	public function getall(){
		
			$form 	= $_POST;
//                        print_r($form);die;
			if(isset($form)){
				require_once 'application/templates/header.html';
		 		require_once 'application/templates/menu.html';
				require_once"application/views/home/nama.html";
                                require_once 'application/templates/footer.php';
			}

	}

}
