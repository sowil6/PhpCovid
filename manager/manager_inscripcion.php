<?php

if(defined('RUTA_BASE')){
include_once RUTA_INCLUDE.'include_session.php';
//include_once RUTA_MODELO."modelo_inscripcion.php";
//include_once RUTA_BEANS.'beans_estudiante.php';
// include_once RUTA_Get_Set."get_set_estudiante.php";

}
else
{
include_once "../modelo/modelo_inscripcion.php";
//include_once '../Beans/beans_estudiante.php';
//include_once '../includes/include_session.php';
//  include "../get_set/get_set_estudiante.php";
}
ob_start();
$valida= new modelo_inscripcion();
//$comboProgramas= $valida->get_Programas();//trae los programas registrados en la tabla tabla_curriculoprograma
//$inscripciones= modelo_inscripcion::get_Consultar_proInscritos();//llena combo programas en consulta inscritos
//get_datos= modelo_inscripcion::get_Datos('7313233');
//print_r($resultado);

//variables persona
$documento=$password=$nombre=$email=$ciudad=$direccion=$lugar_nacido="";
$fecha_nacido=$edad=$sexo=$telefono_fijo=$telefono_Cel="";
$estudiante="";
//variables estudiante
$id_=$fecha_inscripcion=$programa=$jornada=$empresa=$direccion_empresa=$telefono_empresa="";

//variables para almacenar erores
$errdocumento=$errpassword=$errprograma=$errprograma2=$errciudad=$errjornada=$errnombre=$erredad=$errsexo=$errlugar_nacido="";
$errfecha_nacido=$errdireccion=$erremail=$errtelefono_fijo=$errtelefono_Cel=$errtelefono_empresa="";
$errMensaje=$errAlert=$errRep_password="";


//arrays para guardar mensajes y errores
$aMensajes = array();
$errores = array();

//VERIFICAR DOCUMENTO
if(isset($_POST['ejecutar'])){
$op=$_POST['ejecutar'];

switch ($op) {
case "Calcularw":
get_Datos_Paciente();
	     break;
case "Calcular":
    pruebaPOST();
break;


}// fin switch ($op)
}//fin $_POST['ejecutar']


function pruebaPOST(){
    $estudio=set_estudiante_POST();
	$document=$estudio->getDocumento();
	$passwor=$estudio->getPassword();
$errores['$errdocumento']= "los datos que llegaron son docuemnto=".$document." contraseña =".$passwor;
ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($errores);

return $errores;

}


 /*INICIO VERIFICACIONES*/

 /*verifica si el estudiante esta inscrito*/
 function bool_Existe_estudio(){
   	$errores = array();
	$errores['$errMensaje']='';
//      $estudio= new beans_estudiante();
	$estudio= set_estudiante_POST();
	$expresion ="/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s0-9]+$/";
$estado="";
$id_estudiante=trim($estudio->getId_estudiante());
$documento=trim($estudio->getDocumento());
$password=trim($estudio->getPassword());
/*$programa=$estudio->getPrograma();*/

if (!is_numeric($documento)) {$errores['$errdocumento']= 'El campo documento debe contener numero'; $errores['$errAlert']= 'hay_error'; }
if (!validarSQLInjection($expresion,$password)) {$errores['$errpassword']='La contraseña no es validaxxx'.$estudio->getPassword().$documento;}
/*if (empty($programa)) { $errores['$errprograma']= 'Debe seleccionar un programa de estudio';}
*/

 //$ins_modelo= modelo_inscripcion::();
 //$bool_user= modelo_inscripcion::bool_existe_documento($documento);//si existe el documento en tabla usuario
  $bool_user= modelo_inscripcion::bool_documento($documento);//si existe el documento en tabla usuario y prsona main

 $bool_login= modelo_inscripcion::bool_existe_documentoyPassword($documento,$password);

if($documento!==""&&$password!==""){


if($bool_login){

	$result = modelo_inscripcion::get_Datos($id_estudiante,$documento);
$errores= $result->fetchAll(PDO::FETCH_ASSOC);//puse el fetchAll aqui porque en generar pdr tuve que quitarselo del metodo get_Datos

		$errores['$errMensaje']='Login Correcto';

	}
else{
	$errores['$errMensaje']='Login incorrecto';

	}

/*if(!$bool_loginTrue&&$bool_usertrue){//si no existe el usuario, es un nuevo registro

 $errores['$errMensaje']='Digite la contraseña';

}*/


}//else si estan en blanco documento y contraseña
	else{
		$errores['$errMensaje']= 'No ha digitado informacion';

		if($documento!==""&&!$bool_user){//si no existe el usuario, es un nuevo registro

		 $errores['$errMensaje']='Nueva Inscripción';

		}//fin iif($documento!==""&&!$bool_user)

		if($documento!==""&&$bool_user){//si no existe el usuario, es un nuevo registro
			$errores['$errMensaje']= 'Digite la contraseña1 '.$password;

			}


		}//fin if($documento!==""&&$bool_user)


ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($errores);
return $errores;



  }//fin bool_Existe_estudio()

 /*FIN VERIFICACION*/

function  get_Datos_Paciente(){
	$estudio=set_paciente();
	$id_paciente=$estudio->getId_paciente();
	$medicamento=$estudio->getMedicamento();
	$presion_s=$estudio->getPresion_s();
	$presion_d=$estudio->getPresion_d();


ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($estudio);

return $$estudio;
	}
function bool_Existe_Documento(){
	$errores = array();
	$estudio=set_estudiante();
	$expresion ="/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s0-9]+$/";


$documento=$estudio->getDocumento();

/*$programa=$estudio->getPrograma();*/

if(count($errores)==0){

 $ins_modelo= new modelo_inscripcion();
 $bool_documento= $ins_modelo->bool_existe_documento($documento);
if($bool_documento){
echo  "Digite su contraseña";

return ;


}else{
	//si no existe la inscripcion
	echo "Digite una Contraseña";
	return ;
	}//if $bool_documento

}else{
echo "Digite una Contraseña";
	return ;

	}//fin count errores

  }//fin bolexiste
function validar_datos_y_grabar($accion) {
$errores = array();

//expresiones regulares
$expresion ="/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s0-9]+$/";
$expresion_fecha  = "^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$";

//Get_estudiante($estudiante);asignamos nombres de variables a los datos
$estudiante= set_estudiante_POST();//seteamos las variables

//persona
$id_estudiante=$estudiante->getId_estudiante();
$documento_estudiante=trim($estudiante->getDocumento_estudiante());
$documento=trim($estudiante->getDocumento());
$password=trim($estudiante->getPassword());
$rep_password=trim($estudiante->getRep_password());
$nombre=$estudiante->getNombre();
$programa=$estudiante->getPrograma();
$email=$estudiante->getEmail();
$ciudad=$estudiante->getCiudad();
$direccion=$estudiante->getDireccion();
$lugar_nacido=$estudiante->getLugar_nacido();
$fecha_nacido=$estudiante->getFecha_nacido();
$edad=$estudiante->getEdad();
$sexo=$estudiante->getSexo();
$telefono_fijo=$estudiante->getTelefono_fijo();
$telefono_Cel=$estudiante->getTelefono_Cel();
$mensaje= $estudiante->getMensaje();

//estudiante

$fecha_inscripcion=$estudiante->getFecha_inscripcion();
$jornada=$estudiante->getJornada();
$empresa=$estudiante->getEmpresa();
$direccion_empresa=$estudiante->getDireccion_empresa();
$cargo=$estudiante->getCargo();
$telefono_empresa=$estudiante->getTelefono_empresa();
$estado_estudiante=$estudiante->getEstado_estudiante();
//$expresion = @"[^\w]";$errores ="";


//asignamos nombres de variables a los beans

//INICIO VALIDACION DE LAS VARIABLES

if (!is_numeric($documento)) {$errores['$errdocumento']= 'El campo documento debe contener numero';}

if($accion=="grabar" &&$mensaje!=="Estado de nueva inscripcion"){
if (!validarSQLInjection($expresion,$password)) {$errores['$errpassword']='La contraseña no es valida ss'.$password;}
if ($password!=$rep_password) {$errores['$errRep_password']='Las contraseñas no son iguales ';}
}

if ($programa=="") {$errores['$errprograma']='El campo programa es requerido';}
////validad que el estudiante no escoja dos veces el mismo programa
$prog= new modelo_inscripcion();
$bool_programa= $prog->bool_documento_y_programa($documento,$programa);
if ($bool_programa&&$accion=="grabar") {$errores['$errprograma2']='El programa ya fue inscrito';}

if (empty($ciudad)) {$errores['$errciudad']='El campo ciudad es requerido';}

if (!validarSQLInjection( $expresion,$nombre)) {$errores['$errnombre']= 'El campo nombre es requerido';}
if (empty($jornada)) { $errores['$errjornada']= 'La jornada es requerida';}
if (empty($direccion)) {$errores['$errdireccion']= 'El campo direccion es requerido';}
$valida_email=validaEmail($email);
if ($valida_email=="false") {$errores['$erremail']= 'El campo email es incorrecto';}
if ($telefono_fijo!=""&&!is_numeric($telefono_fijo)) {$errores['$errtelefono_fijo']= 'El campo telefono Fijo debe contener numero';}
if ($telefono_Cel!=""&&!is_numeric($telefono_Cel)) {$errores['$errtelefono_Cel']= 'El campo telefono celular debe contener numero';}
if (empty($telefono_Cel)) { $errores['$errtelefono_Cel']= 'El telefono celular es requerido';}
if (empty($jornada)) { $errores['$errjornada']= 'La jornada es requerida';}
if ($telefono_empresa!=""&&!is_numeric($telefono_empresa)) {$errores['$errtelefono_empresa']= 'El campo telefono de la Empresa debe contener numero';}


/*
$errores['$errdocumento']= "llegaron documento=".$documento.
        " contraseña = ".$password.
        "recontraseña= ".$rep_password.
        "accion= ".$accion.
        "nombre= ".$nombre.
        "ciudad= ".$ciudad.
        "jornada= ".$jornada.
        "direccion= ".$direccion.
        "email= ".$email.
        "fecha de Inscripcion= ".$fecha_inscripcion;

*/

//preguntamos si n hay errores, si no hay, graba los datos

if(count($errores)==0){
if($accion=="grabar"){
	//verificar si es un registro nuevo, o registro de un programa nuevo a un estudiante registrado
//$errores['$errdocumento']= "entro en grabar";
grabar($estudiante);
}else{
//echo "la fecha de inscripcion es".	$estudiante->getFecha_inscripcion();
actualizar($estudiante);
	}
//return $accion;
} else{
ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($errores);
return $errores;	 //si hay errores se almacenan en la variable $errores
}//fin count($errores)==0)

  //FIN VALIDACION DE LAS VARIABLES
//ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
//echo json_encode($errores);
//return $errores;
  }//fin $_SERVER

function consultarDatos(){
	$errores = array();

	$estudio=set_estudiante();
$estado="";
	$id_estudiante=trim($estudio->getId_estudiante());
$documento=trim($estudio->getDocumento());
/*$programa=$estudio->getPrograma();*/
if($id_estudiante=="0"){
$errores=modelo_inscripcion::get_Datos_SinID($documento);
$errores['$errMensaje']= 'entro en vacio';
}else{
    $valida= new modelo_inscripcion();
	$result= $valida->get_Datos($id_estudiante,$documento);
	$errores= $result->fetchAll(PDO::FETCH_ASSOC);//puse el fetchAll aqui porque en generar pdr tuve que quitarselo del metodo get_Datos
	$errores['$errMensaje']= 'id estudiante ='.$id_estudiante." documento= ".$documento;
	}


ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($errores);
return $errores;



  }//fin consultarDatos()
//Pregunta si está llegando una petición por POST, lo que significa que el usuario envió el formulario.


/*LLENAR COMBO PROGRAMA EN CONSULTA*/
function set_paciente(){
    $paciente=new beans_paciente();
//persona
echo "entro";
if(isset($_POST["id_paciente"])){$paciente->setId_paciente($_POST["id_paciente"]);	}
if(isset($_POST["documento_paciente"])){$paciente->setDocumento_paciente($_POST["documento_paciente"]);	}
if(isset($_POST["medicamento"])){$estudiante->setMedicamento($_POST["medicamento"]);	}
if(isset($_POST["presion_s"])){$estudiante->setPresion_s($_POST["presion_s"]);	}
if(isset($_POST["presion_d"])){$estudiante->setPresion_d($_POST["presion_d"]);	}

return $paciente;

	 }//fin set_estudiante
function get_estudiante2($estudiante){
//$estudiante=new beans_estudiante();

//persona
$id_estudiante=$estudiante->getId_estudiante();
$documento_estudiante=$estudiante->getDocumento_estudiante();
$documento=$estudiante->getDocumento();
$password=$estudiante->getPassword();
$nombre=$estudiante->getNombre();
$email=$estudiante->getEmail();
$ciudad=$estudiante->getCiudad();
$direccion=$estudiante->getDireccion();
$lugar_nacido=$estudiante->getLugar_nacido();
$fecha_nacido=$estudiante->getFecha_nacido();
$edad=$estudiante->getEdad();
$sexo=$estudiante->getSexo();
$telefono_fijo=$estudiante->getTelefono_fijo();
$telefono_Cel=$estudiante->getTelefono_Cel();

//estudiante
$fecha_inscripcion=$estudiante->getFecha_inscripcion();
$programa=$estudiante->getPrograma();
$jornada=$estudiante->getJornada();
$empresa=$estudiante->getEmpresa();
$direccion_empresa=$estudiante->getDireccion_empresa();
$telEmpresa=$estudiante->getTelEmpresa();
$estado_estudiante=$estudiante->getEstado_estudiante();
$observacion=$estudiante->getObservacion();

$estado_certificacion=$estudiante->getEstado_certificacion();
$fecha_certificacion=$estudiante->getFecha_certificacion();

return $estudiante;
	}  //fin get_estudiante
function EliminarInscripcion(){
   echo $errores['$errMensaje']= '...';
if (isset($_SESSION['nivel_acceso'])&&$_SESSION['nivel_acceso']=="1")
  {
//    echo $errores['$errMensaje']= $ex.'Hay errores '.$_SESSION['nivel_acceso'];

$nmodelo= new modelo_inscripcion();
	if(isset($_POST["id_estudiante"])){$id= $_POST["id_estudiante"];	}
	if(isset($_POST["documento_estudiante"])){$documento_estudiante= $_POST["documento_estudiante"];	}
	if(isset($_POST["documento"])){$documento= $_POST["documento"];	}
$count_Inscripcion;
$count_Inscripcion= $nmodelo->contar_inscripciones($documento);//contamos las inscripciones si es mas de uno, solo se elimina en tabla estudiante
try{
if($count_Inscripcion>1)
{
$nmodelo->Eliminar_inscrito_Id($id);
$errores['$errMensaje']="Se elimino el registro con exito";
}
else
{//si solo queda un registro, se elimina hasta el usuario
$nmodelo->Eliminar_inscrito_todo($documento);
$errores['$errMensaje']="Se elimino el registro por completo con exito";
}
//ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
//echo json_encode($errores);

}catch(Exception $ex){
echo $errores['$errMensaje']= $ex.'Hay errores';
	}

}else{
   $errores['$errMensaje']="No tiene privilegios para eliminar xx";
 }

 ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
echo json_encode($errores);
return $errores;
}
function Boton_prueba(){
//echo __DIR__.'/vendor/autoload.php';
echo 	'../html-pdf/vendor/autoload.php';
/*require __DIR__.'/html-pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
$html2pdf->output();*/
	}
//Comprobar validaciones
function validarSQLInjection($expresion, $dato) {
     if(preg_match($expresion,$dato)){
    return true;
  }else{
  return false;}

        }
function validaRequerido($valor){
    if(trim($valor) == ''){
       return false;
    }else{
       return true;
    }
 }
function validarEntero($valor, $opciones=null){
    if(filter_var($valor, FILTER_VALIDATE_INT, $opciones) === FALSE){
       return false;
    }else{
       return true;
    }
 }
function validardni($valor) {
	function numerodni($numdni) {return substr("TRWAGMYFPDXBNJZSQVHLCKE",$numdni%23,1);}//función para asignar la letra de control
	$patron="^([0-9]{1,8})([T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E]{1})$";//patrón que controla que haya entre 1 y 8 números y una letra de las de la lista; además carga en el array los datos numéricos y la letra por separado
	if (ereg($patron, $valor, $regs) && $regs[2]==numerodni($regs[1])) {
		return true;
	}else {
		return false;
	}
}
function validaEmail($email){
	$estado = "false";
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $estado = "true";
   // echo "Esta dirección de correo ($email) es válida.";
}
return $estado;
}
function validarDate($fecha){
	$estado = "false";
echo  $valores = explode('-', $fecha);
   if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
	$estado = "true";
	    }
	return 	$estado;
}

function exportToExcel2(){
echo "entro";
    $conect= new Conectar();
$db = $conect->conexion();

 $estudiante=set_estudiante();//seteamos las variables
$documento=$estudiante->getDocumento();
$nombre=$estudiante->getNombre();
$programa=$estudiante->getPrograma();
$estado_estudiante=$estudiante->getEstado_estudiante();
$estado_certificacion=$estudiante->getEstado_certificacion();

$sql="SELECT * FROM tabla_personamain p, tabla_estudiante e where
e.documento_estudiante like '%$documento%'
and  p.nombre like '%$nombre%'
and  e.programa like '%$programa%'
and  e.estado_estudiante like '%$estado_estudiante%'
and  e.estado_certificacion like '%$estado_certificacion'
and p.documentoIdentidad=e.documento_estudiante";

$data = $db->query($sql);
$libros = $data->fetchAll(PDO::FETCH_ASSOC);


if(!empty($libros)) {
$filename = "libros.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);
header("progma: no-cache");
header("Expires:0");



//inicio bloque html tabla
    echo "<table class='table table-hover table-condensed'>
<thead><th> Documento</th>
<th>Nombre</th>
<th>Programa</th>
<th>email</th>
<th>telefono</th>
<th>Estado del Estudiante</th>
<th>Estado Certificacion</th>
<!--<th>id_estudiante</th>-->
</tr>
</thead>
<tbody>";
$sql= "SELECT * FROM tabla_personamain p, tabla_estudiante e where
e.documento_estudiante like '%$documento%'
and  p.nombre like '%$nombre%'
and  e.programa like '%$programa%'
and  e.estado_estudiante like '%$estado_estudiante%'
and  e.estado_certificacion like '%$estado_certificacion'
and p.documentoIdentidad=e.documento_estudiante";//and p.idPersona=e.id_estudiante
//and  e.estado_certificacion like '%$estado_certificacion%'
$valida= new modelo_inscripcion();
$result= $valida->get_Consultar_Inscritos($estudiante, $sql);//si no encuentra datos, solo busca en la tabla persona
$inscripciones = $result->fetchAll(PDO::FETCH_ASSOC);
echo count($inscripciones) . " registros entrontrados ";
if($inscripciones==null){
	//$inscripciones= modelo_inscripcion::get_RegistradosSinCursos($estudiante);

 foreach($inscripciones as $datos){

echo $html=
"<tr return false;'href='#'>
<td>" .$datos['documentoIdentidad']."</td>
<td>".$datos['nombre']."</td>
<td>".$datos['email']."</td>
<td>".$datos['nombre']."</td>
<td>".$datos['telefono_cel']." - ".$datos['telefono_fijo']."</td>
<td>".$datos['estado_estudiante']."</td>
<td>".$datos['estado_certificacion']."</td>";
	 }
echo "</td></tbody>";
 echo "</table>";

//fin bloque html tabla

echo implode("\t", array_values($libro)) . "\n";

}else{
echo "no hay datos a exportar";
}

}}

function exportToExcel(){

$filename = "libros.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);
require './libreria/PHPExcel/PHPExcel.php';
$excel= new PHPExcel();
$excel->getProperties()->setCreator("william")->setLastModifiedBy("william")->setTitle("reporte");
$excel->setactiveSheetIndex(0);
$pagina=getActiveSheet();
$pagina->setTitle("productos");
//header("progma: no-cache");
//header("Expires:0");
	$estudiante=set_estudiante();//seteamos las variables
	$documento=$estudiante->getDocumento();
	$nombre=$estudiante->getNombre();
	$programa=$estudiante->getPrograma();
        $programa=$estudiante->getEmail();
        $programa=$estudiante->getTelefono_Cel();
        $programa=$estudiante->getTelefono_fijo();
        $estado_estudiante=$estudiante->getEstado_estudiante();
	$estado_certificacion=$estudiante->getEstado_certificacion();

        $campo=$estudiante->getCampo();
        $orden=$estudiante->getOrden();

	$sinCurso="";
echo "<table class='table table-hover table-condensed'>
<thead><th> Documento</th>
<th>Nombre</th>
<th>Programa</th>
<th>email</th>
<th>telefono</th>
<th>Estado del Estudiante</th>
<th>Estado Certificacion</th>
<!--<th>id_estudiante</th>-->
</tr>
</thead>
<tbody>";
$sql= "SELECT * FROM tabla_personamain p, tabla_estudiante e where
e.documento_estudiante like '%$documento%'
and  p.nombre like '%$nombre%'
and  e.programa like '%$programa%'
and  e.estado_estudiante like '%$estado_estudiante%'
and  e.estado_certificacion like '%$estado_certificacion'
and p.documentoIdentidad=e.documento_estudiante order by " .$campo." ". $orden;//and p.idPersona=e.id_estudiante
//and  e.estado_certificacion like '%$estado_certificacion%'
$valida= new modelo_inscripcion();
$result= $valida->get_Consultar_Inscritos($estudiante, $sql);//si no encuentra datos, solo busca en la tabla persona
$inscripciones = $result->fetchAll(PDO::FETCH_ASSOC);
echo count($inscripciones) . " registros entrontrados ";
if($inscripciones==null){
	//$inscripciones= modelo_inscripcion::get_RegistradosSinCursos($estudiante);
	$sinCurso="vacio";}
 foreach($inscripciones as $datos){
for($i=0;$i<count($productos);$i++){
    $pagina->setCellValue('A'.($i+1), $productos[$i]['documento_estudiante']);
    $pagina->setCellValue('B'.($i+1), $productos[$i]['nombre']);
    $pagina->setCellValue('C'.($i+1), $productos[$i]['programa']);
}
$objWriter=PHPExcel_IOFactory::createWriter($excel,'Excel5');
$objWriter->save('php:output');


	 }


	}//fin function contultar_inscritos

function exportToExcel3(){

$filename = "libros.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);
//header("progma: no-cache");
//header("Expires:0");
	$estudiante=set_estudiante();//seteamos las variables
	$documento=$estudiante->getDocumento();
	$nombre=$estudiante->getNombre();
	$programa=$estudiante->getPrograma();
        $programa=$estudiante->getEmail();
        $programa=$estudiante->getTelefono_Cel();
        $programa=$estudiante->getTelefono_fijo();
        $estado_estudiante=$estudiante->getEstado_estudiante();
	$estado_certificacion=$estudiante->getEstado_certificacion();
	$sinCurso="";
echo "<table class='table table-hover table-condensed'>
<thead><th> Documento</th>
<th>Nombre</th>
<th>Programa</th>
<th>email</th>
<th>telefono</th>
<th>Estado del Estudiante</th>
<th>Estado Certificacion</th>
<!--<th>id_estudiante</th>-->
</tr>
</thead>
<tbody>";
$sql= "SELECT * FROM tabla_personamain p, tabla_estudiante e where
e.documento_estudiante like '%$documento%'
and  p.nombre like '%$nombre%'
and  e.programa like '%$programa%'
and  e.estado_estudiante like '%$estado_estudiante%'
and  e.estado_certificacion like '%$estado_certificacion'
and p.documentoIdentidad=e.documento_estudiante";//and p.idPersona=e.id_estudiante
//and  e.estado_certificacion like '%$estado_certificacion%'
$valida= new modelo_inscripcion();
$result= $valida->get_Consultar_Inscritos($estudiante, $sql);//si no encuentra datos, solo busca en la tabla persona
$inscripciones = $result->fetchAll(PDO::FETCH_ASSOC);
echo count($inscripciones) . " registros entrontrados ";
if($inscripciones==null){
	//$inscripciones= modelo_inscripcion::get_RegistradosSinCursos($estudiante);
	$sinCurso="vacio";}
 foreach($inscripciones as $datos){

if($sinCurso=="vacio"){
	$prog = "vacio";
        $email = "vacio";
        $telCel ="vacio";
        $telfijo="vacio";
	$id_estudiante = "0";
	$documento_estudiante ="0";
	$estado_estudiante="vacio";
	$estado_certificacion="vacio";
	}else{
	$prog = $datos['programa'];
        $email = $datos['email'];
        $telCel = $datos['telefono_Cel'];
        $telfijo = $datos['telefono_fijo'];
        $id_estudiante = $datos['id_estudiante'];
	$documento_estudiante = $datos['documentoIdentidad'];
	$estado_estudiante=$datos['estado_estudiante'];
	$estado_certificacion=$datos['estado_certificacion'];
	}
echo $html=
"<tr>
<td><a href=''>" .$datos['documentoIdentidad']."</a></td>
<td><a href=''>".$datos['nombre']."</a></td>
<td>".$prog."</td>
<td>".$email."</td>
<td>".$telCel." - ".$telfijo."</td>
<td>".$estado_estudiante."</td>
<td>".$estado_certificacion."</td>";
	 }
echo "</td></tbody>";
 echo "</table>";

	}//fin function contultar_inscritos



?>
