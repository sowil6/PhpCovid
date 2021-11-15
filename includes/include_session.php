<?php 
if (!isset($_SESSION['username'])) {
	//	$_SESSION['msg'] = "You must log in first2";
		//$ruta=substr($ruta, 0,-4);
	 $_SESSION['nivel_acceso']=1;
	}

	class include_session{
//getRol se llama desde la cabecera.php linea 219
	public function getRol($rolNum){
switch($rolNum){
			case 1:
				$nombreNivel="Invitado";
			break;
			case 2:
				$nombreNivel="Administrador";
			break;
			case 3:
				$nombreNivel="Administrativo";
			break;
			case 4:
				$nombreNivel="Funcionario";
			break;
			case 5:
				$nombreNivel="Estudiante";
			break;
			case 6:
				$nombreNivel="Secretaria";
			break;
			case 7:
				$nombreNivel="Coordinador";
			break;
			case 8:
				$nombreNivel="Comite";
			break;
			case 9:
				$nombreNivel="Digitador";
			break;
//			return $nombreNivel;
			}		
       return $nombreNivel;
	}
		
		}//fin class include_session