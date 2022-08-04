<?php
 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PrivateController;
use Dao\Mnt\Usuarios as DaoUsuarios;
use Views\Renderer;

class Usuarios extends PrivateController
{
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Usuarios"] = DaoUsuarios::getAll();
        error_log(json_encode($viewData));
      
        Renderer::render('mnt/usuarios', $viewData);
    }
}

?>
