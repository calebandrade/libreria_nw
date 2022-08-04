<?php
namespace Controllers\Mnt;
use Controllers\PrivateController;

class Roles extends PrivateController{
    public function run():void
    {
        $viewData = array();
        $viewData["Roles"] = \Dao\Mnt\Roles::getAll();

        \Views\Renderer::render("mnt/roles", $viewData);
    }
}

?>
