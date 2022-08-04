<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;

class Funciones extends PrivateController{
    public function run():void
    {
        $viewData = array();
        \Views\Renderer::render("mnt/funciones", $viewData);
    }
}

?>
