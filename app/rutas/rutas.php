<?php

//todas las rutas disponibles en el proyecto
$ruta= new Ruta();
$ruta->controladores(
	array("/" =>"WelcomeController",
	""=>"InicioController" ,
	"/institucional"=>"InstitucionalController",
	""=>"RaizController"
	
	));
	
	