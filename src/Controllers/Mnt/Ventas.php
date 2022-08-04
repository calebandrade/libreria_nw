<?php

namespace Controllers\Mnt;
use Controllers\PrivateController;
use Dao\Mnt\Ventas as Daoventas;
use Views\Renderer;


class Ventas extends PrivateController
{
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Ventas"] = Daoventas::getAll();
        error_log(json_encode($viewData));
      
        Renderer::render('mnt/ventas', $viewData);
    }
}

?>