<?php

namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Usuarios;
use Exception;

class Usuario extends PublicController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrUsuarioTipo = array();
    private $arrEstados = array();
    private $arruserpswdest = array();

    public function run(): void
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
        Renderer::render('mnt/usuario', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["usercod"] = "";
        $this->viewData["useremail"] = "";
        $this->viewData["error_useremail"] = array();
        $this->viewData["username"] = "";
        $this->viewData["error_username"] = array();
        $this->viewData["userpswd"] = "";
        $this->viewData["error_userpswd"] = array();
        $this->viewData["userfching"] = "";
        $this->viewData["error_userfching"] = array();
        $this->viewData["userpswdest"] = "";
        $this->viewData["error_userpswdest"] = array();
        $this->viewData["userpswdexp"] = "";
        $this->viewData["userpswdestArr"] = array();
        $this->viewData["error_userpswdexp"] = array();
        $this->viewData["useractcod"] = "";
        $this->viewData["error_useractcod"] = array();
        $this->viewData["userpswdchg"] = "";
        $this->viewData["error_userpswdchg"] = array();
        $this->viewData["userest"] = "";
        $this->viewData["userestArr"] = array();
        $this->viewData["usertipo"] = "";
        $this->viewData["usertipoArr"] = array();
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS" => "Nuevo Usuario",
            "UPD" => "Editando %s %s",
            "DSP" => "Detalle de %s %s",
            "DEL" => "Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
            array("value" => "BLQ", "text" => "Bloqueado"),
            array("value" => "SUS", "text" => "Suspendido"),
        );

        $this->arruserpswdest = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->arrUsuarioTipo = array(
            array("value" => "PBL", "text" => "Publico"),
            array("value" => "ADM", "text" => "Administrador"),
            array("value" => "AUD", "text" => "Auditor"),
        );


        $this->viewData["userestArr"] = $this->arrEstados;
        $this->viewData["usertipoArr"] = $this->arrUsuarioTipo;
        $this->viewData["userpswdestArr"] = $this->arruserpswdest;
    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Usuarios) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_usuarios",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["usercod"] = intval($_GET["id"]);
            $tmpUsuarios = Usuarios::getById($this->viewData["usercod"]);
            error_log(json_encode($tmpUsuarios));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpUsuarios, $this->viewData);
        }
    }
    private function procesarPost()
    {
        // Validar la entrada de Datos

        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (
            isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_usuarios",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (!(Validators::IsValidEmail($this->viewData["useremail"]))) {
            $this->viewData["error_useremail"][]
                = "Correo no es válido";
            $hasErrors = true;
        }
        if (!Validators::IsValidPassword($this->viewData["userpswd"])) {
            $this->viewData["error_userpswd"][]
                = "Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["useremail"])) {
            $this->viewData["error_useremail"][]
                = "El correo electronico es requerido";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["username"])) {
            $this->viewData["error_username"][]
                = "El nombre de usuario es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["userpswd"])) {
            $this->viewData["error_userpswd"][]
                = "La contraseña de usuario es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["userpswdexp"])) {
            $this->viewData["error_userpswdexp"][]
                = "Campo requerido";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["useractcod"])) {
            $this->viewData["error_useractcod"][]
                = "Campo requerido";
            $hasErrors = true;
        }




        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch ($this->viewData["mode"]) {
                case 'INS':
                    $result = Usuarios::insert(
                        $this->viewData["useremail"],
                        $this->viewData["username"],
                        $this->viewData["userpswd"],
                        $this->viewData["userpswdest"],
                        $this->viewData["userpswdexp"],
                        $this->viewData["userest"],
                        $this->viewData["useractcod"],
                        $this->viewData["usertipo"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Actualizado Satisfactoriamente"
                        );
                    }

                    break;
                case 'UPD':
                    $result = Usuarios::update(
                        $this->viewData["useremail"],
                        $this->viewData["username"],
                        $this->viewData["userpswd"],
                        $this->viewData["userpswdest"],
                        $this->viewData["userpswdexp"],
                        $this->viewData["userest"],
                        $this->viewData["useractcod"],
                        $this->viewData["usertipo"],
                        intval($this->viewData["usercod"])
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Actualizado Satisfactoriamente"
                        );
                    }
                    break;
                case 'DEL':
                    $result = Usuarios::delete(
                        intval($this->viewData["usercod"])
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Eliminado Satisfactoriamente"
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
                $this->viewData["usercod"],
                $this->viewData["username"]
            );

            $this->viewData["userestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["userest"]
                );

            $this->viewData["usertipoArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrUsuarioTipo,
                    'value',
                    'text',
                    'value',
                    $this->viewData["usertipo"]
                );

            $this->viewData["userpswdestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arruserpswdest,
                    'value',
                    'text',
                    'value',
                    $this->viewData["userpswdest"]
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