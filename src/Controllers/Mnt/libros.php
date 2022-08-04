<?php
 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PrivateController;
use Dao\Mnt\Libros as DaoLibros;
use Views\Renderer;


class Libros extends PrivateController
{
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Libros"] = DaoLibros::getAll();
        error_log(json_encode($viewData));
      
        Renderer::render('mnt/libros', $viewData);
    }
}

?>