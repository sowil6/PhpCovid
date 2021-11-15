<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="./Styles/css_inscripcion.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script src="./Scripts/inscripcion.js"></script>
    <script type="text/javascript" src="./Scripts/jquery-1.12.0.js" charset="utf-8"></script>
</head>
<body>
    <h3>REGISTRO DE PACIENTES</h3>
    <div id="container" class="container">
<div class="container-fluid">
		
<div  id="html_body" class="formBox">
 <form method="post">
     <div class="row group-row" id="group-row">
<div class="row" >
    <!--col jornada-->
<div class="col-sm-3">
    
      <h4>Digite los Medicamentos</h4>
<div class='input-group text'>
		<span class="input-group-addon"> <span >Cantidad de Medicamento1:</span>   </span>
                    <input type='text' class="form-control input-sm" id="medicamento_1" value="" />
</div> 
    <div class='input-group text'>
<span class="input-group-addon"> <span >Cantidad de Medicamento2:</span>   </span>
<input type='text' class="form-control input-sm" id="medicamento_2"  value=""/>
</div>
    <button type="button" class="btn btn-success" style="padding: 3px;" id="btngrabar_Med" title="permite registrar y/o actualizar la inscripcion de estudiante"	href="javascript:;" 	onClick="AgregarMedicamentos();return false;">Agregar Medicamentos</button>
</div>
<!--fin col jornada-->


<!--col presiones agregadas-->
 <div class=" col-sm-4 ">
          <h4>Listado de medicamentos agregados</h4>
<div class='input-group text'>
      <input type='text' class="form-control input-sm" id="medicamentos_1" value="" />
</div> 
<div class='input-group text'>
<input type='text' class="form-control input-sm" id="medicamentos_2"  value=""/>
</div>
</div>
<!--fin col presiones agregadas-->
     
  </div>

<div class="row" >
    <!--col jornada-->
<div class="col-sm-3">
    
      <h4>Digite las presiones del paciente</h4>
<div class='input-group text'>
		<span class="input-group-addon"> <span >Presion Sistolica:</span>   </span>
                    <input type='text' class="form-control input-sm" id="presion_s" value="" />
</div> 
    <div class='input-group text'>
<span class="input-group-addon"> <span >Presion Diastolica:</span>   </span>
<input type='text' class="form-control input-sm" id="presion_d"  value=""/>
</div>
    <button type="button" class="btn btn-success" style="padding: 3px;" id="btngrabar" title="permite registrar y/o actualizar la inscripcion de estudiante"	href="javascript:;" 	onClick="Agregar();return false;">Agregar presiones</button>
</div>
<!--fin col jornada-->


<!--col presiones agregadas-->
 <div class=" col-sm-4 ">
          <h4>Listado de Presiones agregadas de los pacientes</h4>
<div class='input-group text'>
      <input type='text' class="form-control input-sm" id="presiones_s" value="" />
</div> 
<div class='input-group text'>
<input type='text' class="form-control input-sm" id="presiones_d"  value=""/>
</div>
</div>
<!--fin col presiones agregadas-->
     
  </div>


 
 <!--fila-->
 <div class="row"> 
      <div class="col-sm-6 izq">
     <label class="izq">INFORMACION LABORAL:</label>   
     </div>
      </div>
 <!--fin_fila-->
 
 <!--fila-->
 <div class="row"> 
      <div class="col-sm-6 izq">
        <div class='input-group text'>
		<span class="input-group-addon"> <span >Empresa:</span>   </span>
        <input type='text' class="form-control input-sm" id="empresa"  />
     </div>
         </div>
         
        <div class="col-sm-6 der">    
          <div class='input-group text'>
		<span class="input-group-addon"> <span >Cargo:</span>   </span>
        <input type='text' class="form-control input-sm" id="cargo"  />
     </div>    
      </div>
              
        </div>
 <!--fin_fila-->
     
 <!--fila-->
 <div class="row">
  <div class="col-sm-6 izq">
    <div class='input-group text'>
		<span class="input-group-addon"> <span >Direccion de la Empresa:</span>   </span>
        <input type='text' class="form-control input-sm" id="dirEmpresa"  />
     </div>
    </div>
  <div class="col-sm-6 der">     
        <div class='input-group text'>
		<span class="input-group-addon"> <span >Telefono de la Empresa:</span>   </span>
        <input type='text' class="form-control input-sm" id="telEmpresa"  />
     </div>
    </div>      
        </div>
 <!--fin_fila-->
    

<div class="row">
    
<button type="button" class="btn btn-success" style="padding: 3px;" id="btnNuevo" title="permite la incripcion de un nuevo estudiante"	href="javascript:;" 	onClick="nuevo();">Nueva Inscripción</button>
<button type="button" class="btn btn-success" style="padding: 3px; display:inline-block" id="btnNuevo2" title="" href="javascript:;" 	onClick="generapdf();">Constancia en Pdf</button>
<label class="la_mensaje" id="la_mensaje2"></label>

</div>

</div>
     </form> 
 </div> 
</div>
</div>
</body>
</html>
