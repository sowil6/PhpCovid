<?php include_once(RUTA_INCLUDE.'include_session.php');?>
<!--<script src="./Scripts/jquery-1.12.0.js" type="text/javascript"></script>
Esta linea permite que funcione la barraherrameinte-fixed y tambien la ventana popup nota: el 30oct me di cuanta que esta linea aqui, impedia ejecutar la ventana modal
     <link href="./Styles/css_navidad.css" rel="stylesheet" type="text/css"> esta linea se debe activar en fecha de navidad-->
<!--Bootstrap's JavaScript requires jQuery poner jquery antes de bootstrap para que no muestre el error-->

<div class="contenedorHeader">
    <div class="contenedorAntesMenu">
     <div class="linePista"> </div>
 
<div class="menuLogo">
    <div class="logo">
 <!--<a href="https://fundasaberes.org/portal/" target="_blank"><img src="./ImgSistema/logofront.png"/></a>-->
<!--        <a href="https://fundasaberes.org/portal/" target="_blank"><img src="./ImgSistema/Logo_width.png" alt=""/>-->
<!--     <img src="./ImgSistema/logofront.png" alt=""/>
     <img src="./ImgSistema/logofront.jpg"  alt=""/>
     <img src="./ImgSistema/logofront2.png" alt=""/>-->
     
     </a></div>

      </div>  
     <div id="table">
  <div id="centeralign">
    <p>Asesoría, Consultoria y Asistencia Técnica de Empresas de Salud, Educación y Economía Solidaria.</p>
    <!--<p>Lorem ipsum dolor sit amet, consectetur t eu nec nunc. Pellentesque ut pulvinar quam.</p>-->
  </div>
</div>
     
<!--      <div class="divTitulo">
       <p class="p1">Asesoría, Consultoria y Asistencia Técnica de Empresas de Salud, Educación y Economía Solidaria</p>
     </div>    -->
        <!--LOGIN-->
<div class="login_">  
     <!-- logged in user information -->
			<?php   
                        $rolnombre= new include_session(); 
                        $rol_acceso = $rolnombre->getRol($_SESSION['nivel_acceso']); 
                          if (isset($_SESSION['username'])) {
                            ?>
			<a href="login?logout='1'" style="color: red;">logout </a> Welcome
                <?php echo $_SESSION['username']." ".$rol_acceso; ?>  
                <?php } else { //echo $rol_acceso; este echo es opcional, se puede quitar despues?>
                <a href="login" style="color: red; display:none" >login</a>   <!---->
		<?php } ?>

         </div> 
        <div class="control_session" style="display:block; background-color: #fff; height: auto; display: none "  > 
        <?php if(session_status()==PHP_SESSION_DISABLED){echo 'Sesion deshabilitada -';}else{echo 'Sesion habilitada -';};?>
     <?php  if(session_status()==PHP_SESSION_NONE){echo 'no xiste -';}else{echo 'existe -';};?>
     <?php  if(session_status()==PHP_SESSION_ACTIVE){echo 'ACTIVA --';}else{echo 'INACTIVA --';}; 
    	    
     ?>
      </div> 
<!--FIN LOGIN-->

   <div  class="resolucion_" style="display:none">

    </div>
 


<div class="info" style="display:none">

           <ul class="InfoUL">
               <li>
                 <div class="info-Phone">  
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x" fa-lg style="color:#4495E9" ></i>
                  <i class="fa fa-phone fa-stack-1x" fa-lg style="color:#a70000"></i>
               
                  </span>
                      
                <a>
                   <strong class="mb-none">3012740934 </strong><br />
                   <strong>Hora de Atención 7:00-18:00</strong>            
                    </a>
                    
                    </div> 
                  </li>
              <li> 
              <div class="info-Email">
              <span class="fa-stack fa-lg">
  
  <i class="fa fa-circle  fa-stack-2x " style="color:#4495E9"></i>
  <a href="http://webmail.fundasaberes.org" target="_blank">  <i class="fa fa-envelope  fa-stack-1x " style="color:#a70000"></i></a>
</span>
                    <div class="div-mb-email">
                   <strong class="mb-none">secretaria.general@fundasaberes.org
                   </strong><br />
                       <strong class="mb-none">Solicita Información por Correo</strong>
                 </div>
                 </div>   
                  
               </li>
               
           </ul>
          
            </div>


</div>
         
<ul class="class_menu">
		<div class="btn_menu_bar">
			<a href="#" class="bt-menu"><span class="icon icon-menu"></span></a>
		</div>
 
		<nav class="nav_barraMenu">
<ul>
    <li><a href="."><span class="icon icon-home"></span>INICIO</a></li>
        <li class="submenu">
            <a href="#"><span class="icon icon-office"></span>CULTURA CORPORATIVA<span class="icon icon-circle-down"></span></a>
            <ul class="children">
                <li><a href="institucional?refpage=mision">Mision <span class="icon icon-dot"></span></a></li>
		<li><a href="institucional?refpage=vision">Visión <span class="icon icon-dot"></span></a></li>
		<li><a href="institucional?refpage=principios">Quienes Somos<span class="icon icon-dot"></span></a></li><!--antes principios institucionales-->
                <li><a href="institucional?refpage=valores">Valores Éticos Institucionales<span class="icon icon-dot"></span></a></li>
                <li><a href="institucional?refpage=calidad">Sistema de Calidad<span class="icon icon-dot"></span></a></li>
            </ul>
        </li>
                
        <li class="submenu">
            <a href="#"><span class="icon icon-user-tie"></span>Estudiante  <span class="icon icon-circle-down"></span></a>
            <ul class="children">
                <li><a href="https://formacionfundasaberes.com/course/view.php?id=20" target="_blank">Aula Virtual<span class="icon icon-dot"></span></a></li>
                <li><a href="https://es.duolingo.com" target="_blank" style="display:none">duolingo<span class="icon icon-dot"></span></a></li>
                <li><a href="estudiante?action=inscripcion">Inscripción<span class="icon icon-dot"></span></a></li>
                <!----> <li><a href="estudiante?action=certificado" style="display:block">Certificaciones<span class="icon icon-dot"></span></a></li>
                <li><a href="pruebas" style="display:none" >Pruebas<span class="icon icon-dot"></span></a></li>
            </ul>
	</li>
                
    <li><a href="oferta"><span class="icon icon-pencil2"></span>NUESTROS SERVICIOS</a></li>
    <li><a href="contacto"><span class="icon icon-mail"></span>CONTACTO</a></li>
    <li><a href="inscripcion" class="inscribete_Aqui">Inscribete Aquí <span class="icon icon-pencil2"></span></a></li>
    <li style="display:none"><a href="electricidad" >Prueba Session<span class="icon icon-pencil2"></span></a></li>
    <li style="display:none"><a href="dosier" >DOSIER 2021<span class="icon icon-pencil2"></span></a></li>
    <li class="submenu" id="Administrativo" style="display:none">
    <a href="#"><span class="icon icon-user-tie"></span>ADMINISTRATIVO<span class="icon icon-circle-down"></span></a>
	<ul class="children">
            <li><a href="registro" >Registro<span class="icon icon-dot"></span></a></li>
            <li><a href="noticia" >Noticias<span class="icon icon-dot"></span></a></li>
            <li><a href="login?logout='1'" >Cerrar Sesión<span class="icon icon-dot"></span></a></li>
            <li><a href="consultarinscripcion" >Consultar Inscritos<span class="icon icon-dot"></span></a></li>
            <li><a href="probarsesion" >Probar Sesion<span class="icon icon-dot"></span></a></li>
	</ul>
    </li>
</ul>
</nav>
</ul>  

                           
   
</div>

            <!--</section>-->
