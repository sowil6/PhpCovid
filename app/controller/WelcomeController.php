<?php
class WelcomeController{

	public function index(){

		include_once LIBRERIA ."Vista.php";
	return Vista::crear("inicio");
	}

}