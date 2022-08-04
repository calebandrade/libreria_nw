<?php

 namespace Controllers\Mnt;
// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PrivateController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\categorias as CategoriasDao;

class Categoria extends PrivateController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    
    public function run():void
    {
        // code
        $this->init();
        // Cuando es método GET (se llama desde la lista)
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        // Ejecutar Siempre
        $this->processView();
        Renderer::render('mnt/categoria', $this->viewData);
    }
    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["catid"] = "";
        $this->viewData["catnom"] = "";
        $this->viewData["catest"] = "";
        $this->viewData["catestArr"] = array();
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo categoria",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );
        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );
        
    
        $this->viewData["catestArr"] = $this->arrEstados;
    
    }
    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Piano) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_categorias",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["catid"] = intval($_GET["id"]);
            $tmpCategoria= CategoriasDao::getById($this->viewData["catid"]);
            error_log(json_encode($tmpCategoria));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpCategoria, $this->viewData);
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
                "index.php?page=mnt_categorias",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

      

        if (Validators::IsEmpty($this->viewData["catnom"])) {
            $this->viewData["error_catnom"][]
                = "El nombre es requerido";
            $hasErrors = true;
        }


        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = CategoriasDao::insert(
                   
                    $this->viewData["catnom"],
                    $this->viewData["catest"],
                    null,
                    1,
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_categorias",
                            "PGuardadoiano  Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = CategoriasDao::update(
                 
                    $this->viewData["catnom"],
                    $this->viewData["catest"],
                    $this->viewData["catid"],

                    intval($this->viewData["catid"])
    
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_categorias",
                        "Piano Actualizado Satisfactoriamente"
                    );
                }
                break;
            case 'DEL':
                $result = CategoriasDao::delete(
                    intval($this->viewData["catid"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_categorias",
                        "Piano Eliminado Satisfactoriamente"

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
                $this->viewData["catid"],
            );
          
            $this->viewData["catesttArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["catest"]
                    
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