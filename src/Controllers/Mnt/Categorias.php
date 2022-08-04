<?php

 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PrivateController;
use Dao\Mnt\Categorias as DaoCategorias;
use Views\Renderer;


class Categorias extends PrivateController
{
    
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["categorias"] = DaoCategorias::getAll();
        error_log(json_encode($viewData));

        Renderer::render('mnt/categorias', $viewData);
    }
}

?>