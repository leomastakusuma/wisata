<?php
class News extends Controller{


	public function index(){
//            $this->view($controller, $action)
		require_once 'application/templates/header.html';
 		require_once 'application/templates/menu.html';
		require_once "application/views/news/fisrt.html";
                require_once 'application/templates/footer.php';

	}


	

}
