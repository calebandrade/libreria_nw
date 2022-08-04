<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{

    public function run():void
    {
        $viewData = array();
        
        if ($this->isPostBack()) {
            if (!isset($_SESSION['CARRITO'])){
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_carrito",
                    "No hay nada en el carrito"
                );
            }else{
                $haylibrosencarro = count($_SESSION['CARRITO']);
                if($haylibrosencarro == 0) { 
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_carrito",
                        "No hay nada en el carrito"
                    );
                }else{
                    $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                        "test".(time() - 10000000),
                        "http://localhost/libreria_nw/index.php?page=checkout_error",
                        "http://localhost/libreria_nw/index.php?page=checkout_accept"
                    );
                    foreach ($_SESSION['CARRITO'] as $indice=>$ebook){
                        //$PayPalOrder->addItem($ebook['Nombre'], $ebook['Descripcion'], $ebook['Codigo'], $ebook['Precio'], 15, 1, $ebook['Categoria']);
                        $PayPalOrder->addItem($ebook['Nombre'], $ebook['Descripcion'], $ebook['Codigo'], $ebook['Precio'], 15, 1, "DIGITAL_GOODS");
                    }
                    //$PayPalOrder->addItem("Test", "TestItem1", "PRD1", 100, 15, 1, "DIGITAL_GOODS");
                    //$PayPalOrder->addItem("Test 2", "TestItem2", "PRD2", 50, 7.5, 2, "DIGITAL_GOODS");
                    $response = $PayPalOrder->createOrder();
                    $_SESSION["orderid"] = $response[1]->result->id;
                    \Utilities\Site::redirectTo($response[0]->href);
                    die();
                    \Views\Renderer::render("paypal/checkout", $viewData);
                }
            }       
        }
        
    }
}



// <?php  Version 1.0

// namespace Controllers\Checkout;

// use Controllers\PublicController;

// class Checkout extends PublicController{

    
//     public function run():void
//     {
//         $viewData = array();
//         if ($this->isPostBack()) {
//             $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
//                 "test".(time() - 10000000),
//                 "http://localhost/mvco02/index.php?page=checkout_error",
//                 "http://localhost/mvco02/index.php?page=checkout_accept"
//             );
//             $PayPalOrder->addItem("Test", "TestItem1", "PRD1", 100, 15, 1, "DIGITAL_GOODS");
//             $PayPalOrder->addItem("Test 2", "TestItem2", "PRD2", 50, 7.5, 2, "DIGITAL_GOODS");
//             $response = $PayPalOrder->createOrder();
//             $_SESSION["orderid"] = $response[1]->result->id;
//             \Utilities\Site::redirectTo($response[0]->href);
//             die();
//         }

//         \Views\Renderer::render("paypal/checkout", $viewData);
//     }
// }
//

?>