<?php

namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Libros as Libros;
use Dao\Mnt\Libros as DaoCategorias;
use Dao\Mnt\Libros as DaoEditoriales;

class LibroClient extends PublicController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    private $arrCategorias = array();
    private $arrEditoriales = array();

    /**
     * Runs the controller
     *
     * @return void
     */
    public function run(): void
    {

        $this->init();

        if (!$this->isPostBack()) {
            $this->procesarGet();
        }

        $this->processView();
        Renderer::render('mnt/libroClient', $this->viewData);
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

        $this->viewData["libprice"] = "";
        $this->viewData["error_libprice"] = array();


        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS" => "Nuevo Libro",
            "UPD" => "Editando %s %s",
            "DSP" => "Detalle de %s %s",
            "DEL" => "Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );


        foreach (DaoCategorias::getAllC() as $key) {
            $this->arrCategorias[] = array("value" => $key["catid"], "text" => $key["catnom"]);
        }


        foreach (DaoEditoriales::getAllE() as $keys) {
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
            $tmpLibros = DaoCategorias::getById($this->viewData["libId"]);
            error_log(json_encode($tmpLibros));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpLibros, $this->viewData);
        }
    }

    private function processView()
    {
        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["readonly"] = true;
            $this->viewData["showBtn"] = false;
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}
