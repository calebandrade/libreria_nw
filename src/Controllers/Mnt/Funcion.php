<?php

 namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Funciones;

class Funcion extends PrivateController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    
    public function run():void
    {
        
        $this->init();
        
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        
        $this->processView();
        Renderer::render('mnt/funcion', $this->viewData);
    }
    private function init()
    {

        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["fncod"] = "";
        $this->viewData["fndsc"] = "";
        $this->viewData["error_fncod"] = array();
        $this->viewData["error_fndsc"] = array();
        $this->viewData["fnest"] = "";
        $this->viewData["fnestArr"] = array();
        $this->viewData["fntyp"] = "";
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nueva Funcion",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );
        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );
        
    
        $this->viewData["fnestArr"] = $this->arrEstados;
    
    }
    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Rol) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_funciones",
                    "No se puede procesar su solicitud!"
                );
            }
        }

        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["fncod"] = ($_GET["id"]);
            $tmpRol = Funciones::getById($this->viewData["fncod"]);
            error_log(json_encode($tmpRol));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRol, $this->viewData);
        }
    }

    private function procesarPost()
    {
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);

        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_funciones",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["fncod"])) {
            $this->viewData["error_fncod"][]
                = "El código es requerido";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["fndsc"])) {
            $this->viewData["error_fndsc"][]
                = "La descripción es requerida";
            $hasErrors = true;
        }


        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = Funciones::insert(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_funciones",
                            "Función Guardada Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = Funciones::update(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_funciones",
                        "Función Actualizado Satisfactoriamente"
                    );
                }
                break;
            case 'DEL':
                $result = Funciones::delete(
                    $this->viewData["fncod"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_funciones",
                        "Función Eliminado Satisfactoriamente"
                    );
                }
                break;
            }
        }
    }
    private function processView()
    {
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["fncod"],
                $this->viewData["fndsc"]
            );
          
            $this->viewData["fnestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["fnest"]
                    
                );
          
            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
            }
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}