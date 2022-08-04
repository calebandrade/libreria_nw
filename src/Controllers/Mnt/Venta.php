<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Ventas;

class Venta extends PrivateController
{
    private $viewData = array();
    private $arrModeDesc = array();

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
        Renderer::render('mnt/venta', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["Ventaid"] = "";
        $this->viewData["fechaventa"] = "";
        $this->viewData["error_fechaventa"] = array();
        $this->viewData["libroVendido"] = "";
        $this->viewData["error_libroVendido"] = array();
        $this->viewData["monto"] = "";
        $this->viewData["error_monto"] = array();
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nueva Venta",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Ventas) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_ventas",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["Ventaid"] = intval($_GET["id"]);
            $tmpVentas = Ventas::getById($this->viewData["Ventaid"]);
            error_log(json_encode($tmpVentas));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpVentas, $this->viewData);
        }
    }
    private function procesarPost()
    {
        // Validar la entrada de Datos
        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_ventas",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = Ventas::insert(
                    $this->viewData["codigoFactura"],
                    $this->viewData["fechaventa"],
                    $this->viewData["libroVendido"],
                    $this->viewData["monto"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_ventas",
                            "Venta Guardada Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = Ventas::update(
                    intval($this->viewData["Ventaid"]),
                    $this->viewData["fechaventa"],
                    $this->viewData["libroVendido"],
                    $this->viewData["monto"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_ventas",
                        "Venta Actualizada Satisfactoriamente"
                    );s:
                }
                break;
            case 'DEL':
                $result = Ventas::delete(
                    intval($this->viewData["Ventaid"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_ventas",
                        "Venta Eliminado Satisfactoriamente"
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
                $this->viewData["Ventaid"],
                $this->viewData["clientname"]
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