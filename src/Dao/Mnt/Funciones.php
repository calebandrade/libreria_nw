<?php

namespace Dao\Mnt;
use Dao\Table;

class Funciones extends Table
{
   
    public static function getAll()
    {
        $sqlstr = "SELECT * from funciones;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getById($fncod)
    {
        $sqlstr = "SELECT * from `funciones` where fncod=:fncod";
        $sqlParams = array("fncod" => $fncod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }
    
    public static function insert(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ) {
        $sqlstr = "INSERT INTO `funciones`
        (`fncod`,`fndsc`,`fnest`,`fntyp`)
        VALUES
        (:fncod,:fndsc,:fnest,:fntyp);";
        $sqlParams = [
            "fncod"=> $fncod,
            "fndsc"=> $fndsc,
            "fnest"=> $fnest,
            "fntyp"=> $fntyp
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function update(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ) {
        $sqlstr = "UPDATE `funciones` set
        `fndsc`=:fndsc,`fnest`=:fnest,`fntyp`=:fntyp
        where `fncod` = :fncod;";
        $sqlParams = array(
            "fncod"=> $fncod,
            "fndsc"=> $fndsc,
            "fnest"=> $fnest,
            "fntyp"=> $fntyp
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($fncod)
    {
        $sqlstr = "DELETE from `funciones` where fncod = :fncod;";
        $sqlParams = array(
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}