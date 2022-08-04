<?php

namespace Controllers\Mnt;


use Controllers\PublicController;
use Views\Renderer;

use Dao\Mnt\Libros;  //cambiar esto es de productos


class Carrito extends PublicController
{
    private $viewData = array();
    
    public function run():void
    {
        $this->init();

        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        if ($this->isPostBack()) {
            $this->procesarPost();
        }               
        $this->processView();
        Renderer::render('mnt/carrito', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();

        //prueba con productos
        // $this->viewData["libId"] = "";   
        // $this->viewData["invPrdBrCod"] = "";
        // $this->viewData["libCodInt"] = "";
        // $this->viewData["invPrdDsc"] = "";        
        // $this->viewData["invPrdTip"] = "";
        // $this->viewData["invPrdEst"] = "";
        // $this->viewData["invPrdVnd"] = "";
        //prueba con productos 


        if(!isset($_SESSION['CARRITO'])){
            $this->viewData["carrito"] = "";
            $this->viewData["total"] = "0";
        }else{
            $this->viewData["carrito"] = $_SESSION['CARRITO'];
            $total = 0;
            foreach ($_SESSION['CARRITO'] as $indice=>$ebook){ //calcular suma total
                if($ebook['Precio']){
                    $precio = intval($ebook['Precio']);
                    $total += $precio;                    
                    $this->viewData["total"] = strval($total);
                }
            }
        }
    }


    private function procesarGet()
    {
        if(!isset($_SESSION['CARRITO'])){
            $this->viewData["carrito"] = "";
            $this->viewData["total"] = "0";
        }else{
            $this->viewData["carrito"] = $_SESSION['CARRITO'];
            $total = 0;
            foreach ($_SESSION['CARRITO'] as $indice=>$ebook){ //calcular suma total
                if($ebook['Precio']){
                    $precio = intval($ebook['Precio']);
                    $total += $precio;                    
                    $this->viewData["total"] = strval($total);
                }
            }
        }
    }

    private function procesarPost(){
        //verificar por id de ebook y ya existe en el carrito
        //guardar en variuables para despues guardar en la session
        $encarro = false;
        if(isset($_POST['btnAccion'])){
            
            switch($_POST['btnAccion']) {
                case 'Agregar':
                    //verificar por id de ebook y ya existe en el carrito
                    //guardar en variables para despues guardar en la session
                    //ver si existe en la base de datos
                    
                    //Esto es de productos cambair
                    $libroexiste = Libros::getById($_POST['id']);
                    //Esto es de productos cambiar

                    if(is_array($libroexiste)){

                        if (!isset($_SESSION['CARRITO'])){
                            $ebook = array(
                                'ID' => $libroexiste['libId'],         //Cambiar variables de productos
                                'Nombre' => $libroexiste['libDsc'],    //Cambiar variables de productos
                                'Descripcion' => $libroexiste['libDsc'], //Cambiar variables de productos
                                'Codigo' => $libroexiste['libCodInt'], //Cambiar variables de productos
                                'Precio' => $libroexiste['libprice'],  //Cambiar variables de productos
                                'Categoria' => $libroexiste['catid']  //Cambiar variables de productos
                            );
                            $_SESSION['CARRITO'] [0] = $ebook;
                            $this->viewData["carrito"] = $_SESSION['CARRITO'];
                        }
                        else{
                            $Existeproducto = count($_SESSION['CARRITO']);

                            foreach ($_SESSION['CARRITO'] as $indice=>$ebook){
                                if($ebook['ID']==$libroexiste['libId']){
                                    \Utilities\Site::redirectToWithMsg(
                                        "index.php?page=mnt_librosClient",
                                        "Ya esta en el carrito"
                                    );
                                    $encarro = true;
                                }
                            }
                            if(!$encarro){
                                $ebook = array(
                                    'ID' => $libroexiste['libId'],         //Cambiar variables de productos
                                    'Nombre' => $libroexiste['libDsc'],    //Cambiar variables de productos
                                    'Descripcion' => $libroexiste['libDsc'], //Cambiar variables de productos
                                    'Codigo' => $libroexiste['libCodInt'], //Cambiar variables de productos
                                    'Precio' => $libroexiste['libprice'],  //Cambiar variables de productos
                                    'Categoria' => $libroexiste['catid']  //Cambiar variables de productos
                            );
                                $_SESSION['CARRITO'] [$Existeproducto] = $ebook;
                                $this->viewData["carrito"] = $_SESSION['CARRITO'];
                            }
                            
                        }    
                    }
                    break;
                case 'Eliminar':
                    //verificar por id de ebook y ya existe en el carrito
                    //guardar en variuables para despues guardar en la session
                    $id = $_POST['id'];
                    foreach ($_SESSION['CARRITO'] as $indice=>$ebook){
                        if($ebook['ID']==$id){
                            unset($_SESSION['CARRITO'][$indice]);
                            //print_r($_SESSION['CARRITO'][$indice]);
                            $this->viewData["carrito"] = $_SESSION['CARRITO'];
                                \Utilities\Site::redirectToWithMsg(
                                "index.php?page=mnt_carrito",
                                "Producto eliminado"
                            );
                        }
                    }
                    break;
                }
        }
    }
    
    private function processView()
    {
        
        if(!isset($_SESSION['CARRITO'])){
            $this->viewData["carrito"] = "";
            $this->viewData["total"] = "0";
        }else{
            $this->viewData["carrito"] = $_SESSION['CARRITO'];
            $total = 0;
            foreach ($_SESSION['CARRITO'] as $ebook){ //calcular suma total
                if($ebook['Precio']){
                    $precio = intval($ebook['Precio']);
                    $total += $precio;                    
                    $this->viewData["total"] = strval($total);
                }
            }

        }
    }
    
}

?>