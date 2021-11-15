<?php
 include_once "manager_global.php";
 ob_start();
if(isset($_POST['ejecutar'])){
$op=$_POST['ejecutar'];
	
switch ($op) {
      case "get_DatosConvenio":
get_datos_Convenio();
break;
}

}

function get_datos_Convenio(){


$convenio= array();

//if(isset($_POST['codigo'])){

    
$master="Modal";
if (file_exists('../XMLPage/xmlPaginaDetalleConvenios.xml')) {
$galery = simplexml_load_file("../XMLPage/xmlPaginaDetalleConvenios.xml");
foreach($galery as $imagen)
{
    $info = new SplFileInfo($imagen->foto);//obtenemos la extension del archivo
	$ext= $info->getExtension();
    $valida= new manager_global();
    $estado = $valida->ValidaExtension2($ext);//con la extension evaluamos si es tipo imagen o video
    if($estado==1){
	//si es imagen se embebe en el control html imagen
$HTMLfoto_OVideo= "<img class='" .$master. "imagenoVideo '   src = './Img/".$imagen->foto. "' />";


    }else{
	//si es video se embebe en el control html video
$HTMLfoto_OVideo= "<video controls  class='" .$master. "imagenoVideo'> "
        . "<source src = './Img/".$imagen->foto. "' type = 'video/mp4' > "
        . "<source src = './img/" . $imagen->foto. "' type = 'video/ogg' ></ video >";
		}
if(isset($_POST['codigo'])){$v2 = $_POST['codigo'];}
if(isset($v2)!=null&&$imagen->DetalleCodigo==$v2){
$html.="<li class=li_slide".$master.">
<span class='textoTituloSlide'>'. $imagen->Titulo.' </span>' 
<span class='TextoIntroSlide'> '.$imagen->introduccionNoticia.'</span>
<span class='TextoMensajeSlide'>'.$imagen->mensajeNoticia.'</span>".$HTMLfoto_OVideo."</li>";
}
}
}//fin si existe file
   else {
    $html ='Error abriendo test.xml.';
}  
	
$convenio['slide']=$html;	
ob_end_clean();	//evita el problema de json que no se ejecuta en ajax va despues de ob_start() y antes de json_encode
//echo 	'callbackEjercicio( ' . json_encode($Noticias) . ' )';
echo json_encode($convenio);
return $convenio;//si no retorna, se envia los datos mas el html de la pagina


}

function function_BeansNoticia(){
	
$noticia=new Class_BeansNoticia();

//evaluamos si es un tema o subtema
/*if(isset($_POST["subtema"])=="si"){

	if(isset($_POST["cod"])){$noticia->setCodigoDetalleNoticia($_POST["cod"]);	}

}else{
	if(isset($_POST["detCod"])){$noticia->setCodigoDetalleNoticia($_POST["detCod"]);	}
	}
	*/
	$opt= $_POST["option"];//optenemos el valor de la opcion seleccionada

opcion($opt, $noticia);//ejecutamos la function option, para asignar los valores a url, xml y la ubicacion donde se graba el registro

if(isset($_POST["detCod"])){$noticia->setCodigoDetalleNoticia(trim($_POST["detCod"]));	}
if(isset($_POST["cod"])){$noticia->setCodigoNoticia(trim($_POST["cod"]));					}
if(isset($_POST["titulo"]))		{$titulo= 	str_replace ("nbsp", "#160", $_POST["titulo"]); 	$noticia->setTituloNoticia($titulo); 		}
if(isset($_POST["intro"]))		{$introd= 	str_replace ("nbsp", "#160", $_POST["intro"]); 		$noticia->setIntroduccionNoticia($introd);	}
//if(isset($_POST["intro"]))		{$introd= $_POST["intro"]; 		$noticia->setIntroduccionNoticia($introd);	}
if(isset($_POST["contenido"]))	{$mensaje= 	str_replace ("nbsp", "#160", $_POST["contenido"]);	$noticia->setMensajeNoticia($mensaje);		}
if(isset($_POST["imagen"])){$noticia->setFotoNoticia(utf8_decode(trim($_POST["imagen"])));}
if(isset($_POST["option"])){$noticia->setAutornoticia(trim($_POST["option"]));}
/*if(isset($_POST["xml"])){$noticia->setUrlHojaXML($_POST["xml"]);}
if(isset($_POST["url"])){$noticia->setUrlPaginaNoticia($_POST["url"]);}*/

	//verGets($noticia);
//echo  'titulo='.$noticia->getTituloNoticia().'</br> intro='.$noticia->getIntroduccionNoticia();
return $noticia;

	 }


?>



