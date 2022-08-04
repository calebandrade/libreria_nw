<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
use Dao\Mnt\Ventas as VentasDao;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class Accept extends PublicController{
    public function run():void
    {
        $libros = "";
        $total = 0;
        $fecha = date('y-m-d h:i:s');
        foreach ($_SESSION['CARRITO'] as $indice=>$ebook){
            $libros = $libros . $ebook['Nombre']. ", ";
            if($ebook['Precio']){
                $precio = intval($ebook['Precio']);
                $total += $precio;                    
             }
        }

        VentasDao::insert($fecha, $libros, intval($total));    

        unset($_SESSION['CARRITO']);

        // \Utilities\Site::redirectToWithMsg(
        //     "index.php?page=mnt_carrito",
        //     "Compra Realizada Correctamente"
        // );

        
        $dataview = array();
        $token = $_GET["token"] ?: "";
        $session_token = $_SESSION["orderid"] ?: "";
        if ($token !== "" && $token == $session_token) {
            $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token);
            $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $dataview["orderjson"] = "No Order Available!!!";
        }
        \Views\Renderer::render("paypal/accept", $dataview);
    }
}

?>
