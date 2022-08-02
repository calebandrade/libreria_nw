<?php
 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Dao\Mnt\Libros as DaoLibros;
use Views\Renderer;


class Libros extends PublicController
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