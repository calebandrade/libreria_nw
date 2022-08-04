<?php

 namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Editorials as DaoEditorials;
use Views\Renderer;


class Editorials extends PublicController
{
   
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Editorials"] = DaoEditorials::getAll();
        error_log(json_encode($viewData));
      
        Renderer::render('mnt/editorials', $viewData);
    }
}

?>