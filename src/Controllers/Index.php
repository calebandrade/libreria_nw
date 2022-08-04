<?php

namespace Controllers;

class Index extends PublicController
{
    
    public function run() :void
    {      
        $viewData = array();
        \Views\Renderer::render("index", $viewData);
    }
}
?>
