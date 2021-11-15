<?php 
//session_start();
$rol=0;
if (isset($_SESSION['username'])) {
	//$ruta=substr($ruta, 0,-4);
	$rol=$_SESSION['nivel_acceso'];
	/* 	echo "<script> window.location='sin_acceso'</script>";*/
	}
class Vista{

public static function crear($path){
	//este bloque sirve para inicializar las variables de session rol y username 
	$rol=0;
if (isset($_SESSION['username'])) {
	//$ruta=substr($ruta, 0,-4);
	$rol=$_SESSION['nivel_acceso'];
	/* 	echo "<script> window.location='sin_acceso'</script>";*/
	}//end if username
	
	
//comprobamos si existe la variable path

if($path !=""){//if $path !=""

$paths= explode(".",$path);//convertimos a un array separado por puntos
$ruta=""; //inicializamos
for($i=0;$i <count($paths);$i++){ // for recorrer la variable paths
if($i== count($paths)-1){//comprobamos si es el ultimo
$ruta.=$paths[$i].".php";	//si es el ultimo le ponemos .php
}else{
$ruta.=$paths[$i]."/";//si no es el ultimo le ponemos una barra inclinada
}


}//end for
//comprobr si el archivo existe
//echo "la ruta es: ". $ruta;
if (file_exists(VISTA_RUTA.$ruta)){

//
	$menu = get_menu($rol);
				$acceso = false;
				//die("el estado de acceso es".$acceso);
				foreach ( $menu as $link){
					
		  if ( $link == $ruta) {
			//echo ("</br>1el rol es=".$rol." la ruta es=".$ruta." en array =".$link);
			include  VISTA_RUTA.$ruta;
				break;
				  }//if
			else{
					 //  echo("</br>el rol es=".$rol." la ruta es=".$ruta." en array =".$link);
					//  
					//echo ("</br>2el rol es=".$rol." la ruta es=".$ruta." en array =".$link);
					//include  VISTA_RUTA.'sin_acceso.php';
											  }
				}//end foreach
	
/*include  VISTA_RUTA.'sin_acceso.php'; esta linea la omiti el dia 08 de septiembre porque me duplicaba las paginas
*/
}//end if file_exists
else{
echo VISTA_RUTA.$ruta;
	die("la ruta no existe");
}


}//end if

	
}
}


	function get_menu($rol){
/* 		1. Invitado
     	2. Administrador
     	3. Administrativo
     	4. Funcionario
     	5. Estudiante
     	6. Secretaria
     	7. Coordinador
     	8. Comite
     	9. Digitador*/
  $menu = array();
switch($rol){ 
  // O haces un swith
  
case 0:
  $menu = array('gestion_estudiante.php','noticia.php','logeado.php','institucional.php','contacto_vista.php',
      'ofertaacademica.php', 'sin_acceso.php','inicio.php','login.php','registro.php','ofertaacademica.php',
	'consultarinscripcion.php', 'reporte_inscripcion.php', 'pruebas.php' ,'reporteTodosInscritos.php',
	'pruebas.php', 'catalogoform.php', 'detallecatalogo.php', 'catalogocertificaciones.php',
      'electricidad_vista.php' ,'informe_vista.php','dosier_vista.php','mercadeo_vista.php' , 
      'inscripcion.php' ,'probarsesion.php', 'recupera_contrasena.php','vista_phpMailer.php', 'createExcel.php');
  return $menu; 
  break;

case 1:
    $menu = array('gestion_estudiante.php','institucional.php', 'logeado.php','oferta.php', 'sin_acceso.php',
'inicio.php','login.php' , 'reporte_inscripcion.php', 'pruebas.php', 'reporteTodosInscritos.php',
'pruebas.php', 'catalogoform.php', 'detallecatalogo.php' , 'catalogocertificaciones.php','contacto_vista.php', 			
 'electricidad_vista.php','informe_vista.php','mercadeo_vista.php','probarsesion.php' ,'inscripcion.php', 'recupera_contrasena.php',
'vista_phpMailer.php'    , 'createExcel.php'    );
	return $menu; 
  	break;

case 2:
	$menu = array('gestion_estudiante.php', 'noticia.php',  'registro.php','logeado.php', 'sin_acceso.php',
            'login.php', 'institucional.php', 'oferta.php', 'sin_acceso.php','inicio.php','login.php','registro.php',
            'ofertaacademica.php','consultarinscripcion.php', 'reporte_inscripcion.php' , 'pruebas.php', 
            'catalogoform.php', 'detallecatalogo.php', 'catalogocertificaciones.php' , 'reporteTodosInscritos.php',
            'contacto_vista.php','electricidad_vista.php','informe_vista.php','mercadeo_vista.php','probarsesion.php',
            'inscripcion.php', 'recupera_contrasena.php','vista_phpMailer.php', 'createExcel.php');
  	return $menu; 
  	break;

case 3;
  	return $menu; 
break;

case 4;
  	return $menu; 
break;

case 5;
  	return $menu; 
break;

case 6:
	$menu = array('gestion_estudiante.php', 'noticia.php',  'registro.php','logeado.php', 'sin_acceso.php',
            'login.php', 'institucional.php', 'oferta.php', 'sin_acceso.php','inicio.php','login.php','registro.php',
            'ofertaacademica.php','consultarinscripcion.php', 'reporte_inscripcion.php' , 'pruebas.php', 
            'catalogoform.php', 'detallecatalogo.php', 'catalogocertificaciones.php' , 'reporteTodosInscritos.php',
            'contacto_vista.php','electricidad_vista.php','informe_vista.php','mercadeo_vista.php','probarsesion.php',
            'inscripcion.php', 'recupera_contrasena.php','vista_phpMailer.php', 'createExcel.php');
  	return $menu; 
  	break;
  return $menu; 
}//fin suitch
  }


?>