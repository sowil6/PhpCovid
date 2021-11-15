<?php
if(defined('RUTA_BASE')){ include_once RUTA_BEANS."beans_persona.php"; }else{include_once('../Beans/beans_persona.php');}


class beans_paciente extends beans_persona{
	private $id_paciente;
  	private $documento_paciente;
    private  $medicamento;
    private  $presion_s;
    private  $presion_d;

public function getId_paciente() {
        return $this->id_paciente;
    }
public function setId_paciente($id_paciente) {
    $this->id_paciente = $id_paciente;
    }

public function getDocumento_paciente() {
    return $this->documento_paciente;
    }
public function setDocumento_paciente($documento_paciente) {
    $this->documento_paciente = $documento_paciente;
    }

public function getMedicamento() {
    return $this->medicamento;
    }
public function setMedicamento($medicamento) {
    $this->medicamento = $medicamento;
    }

public function getPresion_s() {
    return $this->presion_s;
    }
public function setPresion_s($presion_s) {
    $this->presion_s = $presion_s;
    }

public function getPresion_d() {
    return $this->presion_d;
    }
public function setPresion_d($presion_d) {
    $this->presion_d = $presion_d;
    }
}
?>

