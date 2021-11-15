function AgregarMedicamentos() {
	//alert("paso");
	"use strict";//para no causar el error  This will not cause an error.  use strct stamento
	var fecha_ = "";
	var medicamento_1 = document.getElementById('medicamento_1').value;
	var medicamento_2 = document.getElementById('medicamento_2').value;
	if (validarNumero(medicamento_1) & validarNumero(medicamento_2)) {
		
			document.getElementById('medicamentos_1').value =  medicamento_1;
		document.getElementById('medicamentos_2').value = medicamento_2;
		Calcular();
	}
}//fin function grabar()


function Agregar() {
	//alert("paso");
 	"use strict";//para no causar el error  This will not cause an error.  use strct stamento
	var fecha_ = "";
	var presion_s = document.getElementById('presion_s').value;
	var presion_d = document.getElementById('presion_d').value;
	//alert(presion_s + "-" + presion_d+"-");
	var presiones_s = document.getElementById('presiones_s').value;
	var presiones_d = document.getElementById('presiones_d').value;

	if (validarNumero(presion_s) & validarNumero(presion_d)) {
		if (presiones_d == "") {
			document.getElementById('presiones_s').value = presiones_s + presion_s;
			document.getElementById('presiones_d').value = presiones_d + presion_d;
		} else {
			document.getElementById('presiones_s').value =presiones_s + ","+ presion_s;
			document.getElementById('presiones_d').value =  presiones_d + "," +presion_d;
		}
		Calcular();
	}
}//fin function grabar()

function Calcular() {
	//alert("paso");
	"use strict";//para no causar el error  This will not cause an error.  use strct stamento
	if (medicamentos_1 != "" & presiones_s != "") {
		var medicamentos_1 = document.getElementById('medicamentos_1').value;
		var medicamentos_2 = document.getElementById('medicamentos_2').value;

		var presiones_s = document.getElementById('presiones_s').value;
		var presiones_d = document.getElementById('presiones_d').value;
		//alert(medicamentos_1 + " - " + medicamentos_2 + " - " + presiones_s + " - " + presiones_d);
		
		var parametros = {
			//"id_estudiante":id_estudiante_,			
			"ejecutar": "Calcular",
			"medicamentos_1": medicamentos_1,
			"medicamentos_2": medicamentos_2,
			"presiones_s": presiones_s,
			"presiones_d": presiones_d
		};

		$.ajax({
			data: parametros,
			url: "./manager/manager_inscripcion.php",
			type: "post",
			beforeSend: function () {
				
				//$("#mostrarmodal").modal("show");//muestra la ventana modal mientras graba o actualiza
			},
			success: function (result) {
				response = JSON.parse(result);
				console.log("Resultado= " + result + "fin");

			}//fin succes ajax
		});//fin ajax
		
	}//fin function grabar()
}

function validarNumero(dato) {
	var isNum = new Boolean(false);
	var valoresAceptados = /^[0-9]+$/;
	if (dato.match(valoresAceptados)) {
		isNum = true;
		//alert("entro2");
	} 
	return isNum;
}