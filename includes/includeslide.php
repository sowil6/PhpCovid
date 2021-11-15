<link href="./Styles/css_IncludeSlide.css" rel="stylesheet" type="text/css">
<script src="./Scripts/slideshow.js" type="text/javascript"></script><!--ubicar despues del jquery-->
<script type="text/javascript" >
$(document).ready(function () {
var $s = $('.slideshow').slides();// permite que se inicie el slide
$('#exampleModal').modal(); 
$('#LabelCodigoPrograma').text(" response");
$('#nombreprograma').val("response.nombre_Programa");
$('#horasPrograma').val("response.horasPrograma");
});

function enviarDato(id){
//alert (id);
	 var dato = id;
    $.ajax({
    data: {"dato" : dato},
    url: "./includes/modal.php",
    type:"POST",
    dataType: "html",
    success:  function (response) {
    $('#exampleModal').html('show');
    console.log(response);
      }
    });
    }
	
	/*en esta funcion con el codigo, hacemos la consulta al xml y mostramos los datos en el modal*/
selPersona = function(foto,Titulo_,introduccionNoticia_,mensajeNoticia_,codigo_){
//	alert(codigo_+foto);
	//ponemos la imagen en blanco
        
	var img = document.getElementById('crs_imgPrevia');
img.src= "./Img/"+foto;
$('#nombreconvenio').html("");
$('#mtxtIntro').html("");
$('#mtxtContenido').html("");
$("#divsubtemas_datagrid").html("");
$('#nombreconvenio').html(Titulo_);
$('#mtxtIntro').html(introduccionNoticia_);
//HTMLfoto_OVideo = "<embed  class='imgModal' id='crs_imgPrevia' src='./ImgSistema/noHaSeleccionadoImagen.jpg' />";	

//alert(codigo_);
        var parametros={
		"ejecutar":"get_DatosConvenio",
		"codigo":codigo_
		
		/*"programa": programa_ */
        };
			$.ajax({
			data: parametros,
			url:"./manager/manager_slide.php",
			type:"post",
                        dataType: 'html',
			beforeSend: function(){
				//$("#resultado").html("Procesando, espere por favor");
				},
			success: function (resultado){
                          
			//alert(" Proceso terminado "+ resultado);
			Json_response= JSON.parse(resultado);  
//		console.log(Json_response['titulo'][0]);
//$('#nombreconvenio').html(Json_response['titulo'][0]);
//$('#mtxtIntro').html(Json_response['intro'][0]);
//$('#mtxtContenido').html(Json_response['mensaje'][0]);
$("#divsubtemas_datagrid").html(Json_response['slide']);
resultado="";
//alert(resultado);
	
//var img = document.getElementById('crs_imgPrevia');
//	img.src= "./Img/"+Json_response['foto'][0];
	
				}//fin success: function
				
			});//fin ajax
	};//fin function existe documento

    </script>
    <style>

    
    </style>
</head>

<body>

<div class="divsliderSeccionSuperior" ><!-- style="display:none"-->
<div class="containerslider">
 <div class="slideshow" data-transition="crossfade" data-loop="true" data-skip="false">
        <ul class="carousel">

  <?php include_once "./manager/manager_global.php";
$master="slider";
$canciones = simplexml_load_file("./XMLPage/xmlPaginaInicioParteSuperior.xml");
foreach($canciones as $cancion)
{
	$info = new SplFileInfo($cancion->foto);//obtenemos la extension del archivo
	$ext= $info->getExtension();
	
	$valida= new manager_global();
$estado = $valida->ValidaExtension2($ext);//con la extension evaluamos si es tipo imagen o video
if($estado==1){
	//si es imagen se embebe en el control html imagen
$HTMLfoto_OVideo= "<img class='" .$master. "imagenoVideo '   src = './Img/".$cancion->foto. "' />";
}else{
	//si es video se embebe en el control html video
$HTMLfoto_OVideo= "<video controls  class='" .$master. "imagenoVideo'> <source src = './Img/".$cancion->foto. "' type = 'video/mp4' > <source src = './img/" . $cancion->foto. "' type = 'video/ogg' ></ video >";
		}
echo' <li class="slide">';
echo'   <span class="textoTituloSlide">'. $cancion->Titulo.' </span>' ;
echo'   <span class="TextoIntroSlide">'. $cancion->introduccionNoticia.'</span>' ;
echo'   <span class="TextoMensajeSlide">'. $cancion->mensajeNoticia.'</span>' ;
echo	$HTMLfoto_OVideo;
echo'  </li>';
}
?>
               
           </ul>
           
        
     </div>
  </div><!-- end .container -->
</div>

    <!--INICIO MODULO MAITE-->
<div class="divSeccionMaite" >
        <p class="titulo_Maite">Claustro de Expertos listos para Asesorarte</p>
    <?php
$master="Maite";
/*$canciones = simplexml_load_file("./XMLPage/xmlPaginaInicioParteBaja.xml");*/
$noticias = simplexml_load_file("./XMLPage/xmlMaite.xml");
echo'	<ul class="ulMaite">';
foreach($noticias as $item)
{$info = new SplFileInfo($item->foto);//obtenemos la extension del archivo
$ext= $info->getExtension();
$valida= new manager_global();
$estado = $valida->ValidaExtension2($ext);//con la extension evaluamos si es tipo imagen o video

//bloque para crear un nombre de clase a la imagen y poder moverla de izqueirda o derecha segun el numero de
    //codigo sea par o impar
    if($item->Codigo%2==0){ $master="Left-Maite"; }else{  $master="Right-Maite"; }
if($estado==1){
	//si es imagen se embebe en el control html imagen
$HTMLfoto_OVideo= "<embed class='" .$master. "imagenoVideo'   src = './Img/" . $item->foto. "' />";
}else{
    
	//si es video se embebe en el control html video
$HTMLfoto_OVideo= "<video controls  class='" .$master. "imagenoVideo'> <source src = './Img/" . $item->foto. "' type = 'video/mp4' > <source src = './img/" . $item->foto. "' type = 'video/ogg' ></ video >";
//$HTMLfoto_OVideo= "<embed class='" .$master. "imagenoVideo'   src = './Img/".$cancion->foto. "' />";

}
echo '<li class="li'.$master.'">';
//echo '<div class="divInLiMaite">';
echo '<a href="'.$item->urlFile.'?Accion='.$item->Codigo.'">';
echo '<div class="divMaite-ContenedorImagen">';
echo  $HTMLfoto_OVideo;
echo '</div>';
echo '<div class="divMaiteBloqueTexto">';
echo '<p class="Titulo-'.$master.'">'. $item->Titulo.'</p>';
echo '<p class="Intro-'.$master.'">'. $item->introduccionNoticia.'</p>';
//echo '<p>'. $item->mensajeNoticia.'</p>';
echo '</div>';
echo '</a>';
//echo '<a href="contacto" class="btn btn-success">Contactanos</a>';
//echo '</div>';
echo'</li>';
}
   echo'</ul>';	  
?>
 </div>  
<!--FIN MODULO MAITE-->

<!--INICIO MODULO PROGRAMAS-->
    <div class="divSeccionBajaSlide" >
<p class="Titulo_portafolio">PORTAFOLIO DE SERVICIO</p>
    <?php
$master="portafolio";
/*$canciones = simplexml_load_file("./XMLPage/xmlPaginaInicioParteBaja.xml");*/
$canciones = simplexml_load_file("./XMLPage/xmlMenuCatalogo.xml");
echo'	<ul class="galeria">';
foreach($canciones as $cancion)
{$info = new SplFileInfo($cancion->foto);//obtenemos la extension del archivo
$ext= $info->getExtension();
$valida= new manager_global();
$estado = $valida->ValidaExtension2($ext);//con la extension evaluamos si es tipo imagen o video
if($estado==1){
	//si es imagen se embebe en el control html imagen
$HTMLfoto_OVideo= "<embed class='" .$master. "imagenoVideo'   src = './Img/" . $cancion->foto. "' />";
}else{
	//si es video se embebe en el control html video
$HTMLfoto_OVideo= "<video controls  class='" .$master. "imagenoVideo'> <source src = './Img/" . $cancion->foto. "' type = 'video/mp4' > <source src = './img/" . $cancion->foto. "' type = 'video/ogg' ></ video >";
//$HTMLfoto_OVideo= "<embed class='" .$master. "imagenoVideo'   src = './Img/".$cancion->foto. "' />";
}
echo '<li><a href="'.$cancion->urlFile.'?Accion='.$cancion->Codigo.'"target="_blank">'.$HTMLfoto_OVideo.' </br><p>'. $cancion->Titulo.'</p></a></li>';
}
   echo'	</ul>';	  
?>
     </div>  
<!--FIN MODULO PROGRAMAS-->

    <!--MODULO CONVENIOS-->
        <div class="divSeccionConvenios" >

<p class="Titulo_Convenios" >NUESTROS CLIENTES</br>
Entidades contractuales a nivel regional y nacional.</p>
	
    <?php
       
$master="catalogoslide";
$canciones = simplexml_load_file("./XMLPage/xmlPaginaInicioConvenios.xml");
echo'	<ul class="ulConvenios">';
foreach($canciones as $cancion)
{
	$info = new SplFileInfo($cancion->foto);//obtenemos la extension del archivo
	$ext= $info->getExtension();
	$valida= new manager_global();
$estado = $valida->ValidaExtension2($ext);//con la extension evaluamos si es tipo imagen o video
if($estado==1){
	//si es imagen se embebe en el control html imagen

$HTMLfoto_OVideo= "<embed class='" .$master. "imagenoVideo imgModal'   src = './Img/" . $cancion->foto. "' />";
}else{
	//si es video se embebe en el control html video
$HTMLfoto_OVideo= "<video controls  class='" .$master. "imagenoVideo'> <source src = './Img/" . $cancion->foto. "' type = 'video/mp4' > <source src = './img/" . $cancion->foto. "' type = 'video/ogg' ></ video >";

///$HTMLfoto_OVideo= "<embed class='imgModal'   src = './Img/".$cancion->foto. "' />";
}

//<!--las dos lineas arriba de bootstrap con link web permite que funcione el modal-->
//echo'<li>';
//echo '<a  id="btnAgregarModulo" href="#"  data-toggle="modal" data-target="#exampleModal" data-tit='. $cancion->Titulo.' data-foto='. $cancion->foto.' data-intro='.$cancion->introduccionNoticia.' data-men='.$cancion->mensajeNoticia.'>';

echo '<li> <a  href="#"  data-toggle="modal" data-target="#modalEditPersona"' ;
echo 'onClick="selPersona(\''.$cancion->foto.'\',\''.$cancion->Titulo.'\',\''.$cancion->introduccionNoticia.'\',\''.$cancion->mensajeNoticia.'\',\''.$cancion->Codigo.'\');">';
//echo 'onClick="selPersona(\''.$cancion->Codigo.'\',\''.$cancion->foto.'\');" >';
echo $HTMLfoto_OVideo." <p>". $cancion->Titulo."</p>";
echo "</a>";
echo "</li>";

}
   echo'</ul>';	  

?>
       
 

    </div>    
<!--FIN MODULO CONVENIOS-->

<!-- Modal inicio -->
<div class="modal fade" id="modalEditPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header bg-blue">
        <h4 class="modal-title" id="myModalLabel">Beneficiario de Servicio: </br> <span  id="nombreconvenio" >
            </span></br><span id="mtxtIntro"></span>
    <span id="mtxtContenido"></span>
        </h4>
        <div id="ModaldivImagenPrevia">
<embed  class='imgModal' id='crs_imgPrevia' src='./ImgSistema/noHaSeleccionadoImagen.jpg' />
</div>
       </div> 
<form class="form-horizontal">
      <div class="modal-body">
<ul class='ul_carouselModal'id="divsubtemas_datagrid">
</ul>
<div class="box-body">
</div>
    </div>
</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--INICIO POPU-->  
<!--FIN POPU--> 



