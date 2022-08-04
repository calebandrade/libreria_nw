<?php

 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PrivateController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Libros as DaoLibros;

class Libro extends PrivateController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    private $arrCategorias = array();
    private $arrEditoriales = array();


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
        Renderer::render('mnt/libro', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["libId"] = "";

        $this->viewData["libDsc"] = "";
        $this->viewData["error_libDsc"] = array();
       
        $this->viewData["catid"] = "";
        $this->viewData["catidArr"] = array();
      
        $this->viewData["editid"] = "";
        $this->viewData["editidArr"] = array();
       
        $this->viewData["libest"] = "";
        $this->viewData["libestArr"] = array();
        
        $this->viewData["libprice"] ="";
        $this->viewData["error_libprice"] = array();

        $this->viewData["libCodInt"] ="";
        $this->viewData["error_libCodInt"] = array();

        $this->viewData["libimg"] ="";
        $this->viewData["error_libimg"] = array();

        $this->viewData["libautor"] ="";
        $this->viewData["error_libautor"] = array();

      
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Libro",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        
        foreach (DaoLibros::getAllC() as $key){
            $this->arrCategorias[] = array("value" => $key["catid"],"text" => $key["catnom"]);
        }
        

      foreach(DaoLibros::getAllE() as $keys){
        $this->arrEditoriales[] = array("value" => $keys["editid"], "text" => $keys["editnom"]); 
      }

        $this->viewData["libestArr"] = $this->arrEstados;
        $this->viewData["catidArr"] = $this->arrCategorias;
        $this->viewData["editidArr"] = $this->arrEditoriales;
    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Libro) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_libros",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["libId"] = intval($_GET["id"]);
            $tmpLibros = DaoLibros::getById($this->viewData["libId"]);
            error_log(json_encode($tmpLibros));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpLibros, $this->viewData);
        }
    }
    private function procesarPost()
    {
        // Validar la entrada de Datos
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_libros",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        
        if (Validators::IsEmpty($this->viewData["libDsc"])) {
            $this->viewData["error_libDsc"][]
                = "La descripcion es requerida";
            $hasErrors = true;
        }


        if (Validators::IsEmpty($this->viewData["libprice"])) {
            $this->viewData["error_libprice"][]
                = "El precio es requerido";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["libCodInt"])) {
            $this->viewData["error_libCodInt"][]
                = "El código de barra es requerido";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["libimg"])) {
            $this->viewData["error_libimg"][]
                = "La imagen es requerida";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["libautor"])) {
            $this->viewData["error_libautor"][]
                = "El autor es requerido";
            $hasErrors = true;
        }

       

        error_log(json_encode($this->viewData));
        
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = DaoLibros::insert(
                    $this->viewData["libDsc"],
                    $this->viewData["catid"],
                    $this->viewData["editid"],
                    $this->viewData["libprice"],
                    $this->viewData["libCodInt"],
                    $this->viewData["libimg"],
                    $this->viewData["libautor"],
                    $this->viewData["libest"],
                    
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_libros",
                            "Libro Guardado Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = DaoLibros::update(
                    $this->viewData["libDsc"],
                    $this->viewData["catid"],
                    $this->viewData["editid"],
                    $this->viewData["libprice"],
                    $this->viewData["libCodInt"],
                    $this->viewData["libimg"],
                    $this->viewData["libautor"],
                    $this->viewData["libest"],
                    intval($this->viewData["libId"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_libros",
                        "Libro Actualizado Satisfactoriamente"
                    );
                }
                break;
            case 'DEL':
                $result = DaoLibros::delete(
                    intval($this->viewData["libId"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_libros",
                        "Libro Eliminado Satisfactoriamente"
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
                $this->viewData["libId"],
                $this->viewData["libDsc"]
            );
            
            $this->viewData["libestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["libest"]
                );

                $this->viewData["catidArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrCategorias,
                    'value',
                    'text',
                    'value',
                    $this->viewData["catid"]
                );

                $this->viewData["editidArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEditoriales,
                    'value',
                    'text',
                    'value',
                    $this->viewData["editid"]
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