<?php

namespace Dao\Mnt;

use Dao\Table;

class Ventas extends Table
{

    public static function getAll()
    {
        $sqlstr = "select * from ventas";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getById(int $Ventaid)
    {
        $sqlstr = "SELECT * from `ventas` where Ventaid=:Ventaid;";
        $sqlParams = array("Ventaid" => $Ventaid);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }


    public static function insert(
        $fechaventa,
        $libroVendido,
        $monto
    ) {
        $sqlstr = "INSERT INTO `ventas`
(`fechaventa`, `libroVendido`, `monto`)
VALUES
(:fechaventa, :libroVendido, :monto);";
        $sqlParams = [
            "fechaventa" => $fechaventa,
            "libroVendido" => $libroVendido,
            "monto" => $monto 
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function update(
        $Ventaid,
        $fechaventa,
        $libroVendido,    
        $monto
    ) {
        $sqlstr = "UPDATE `ventas` set
        `fechaventa`=:fechaventa, `libroVendido`=:libroVendido,`monto`=:monto
        where `Ventaid` = :Ventaid;";
        $sqlParams = array(
            "Ventaid"=> $Ventaid,
            "fechaventa"=> $fechaventa,
            "libroVendido"=>$libroVendido,
            "monto"=>$monto
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($Ventaid)
    {
        $sqlstr = "DELETE from `ventas` where Ventaid = :Ventaid;";
        $sqlParams = array(
            "Ventaid" => $Ventaid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
}
