<?php

namespace Dao\Mnt;
use Dao\Table;

class categorias extends Table
{
    public static function getAll()
    {
        $sqlstr = "Select * from categorias;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getById(int $catid)
    {
        $sqlstr = "SELECT * from `categorias` where catid=:catid;";
        $sqlParams = array("catid" => $catid);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function insert(
        $catnom,
        $catest,
    ) {
        $sqlstr = "INSERT INTO `categorias` (`catnom`, `catest`)
                    VALUES (:catnom, :catest);";
        $sqlParams = [
            "catnom" => $catnom ,
            "catest" => $catest 
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    
    public static function update(
        $catnom,
        $catest,
        $catid
    ) {
        $sqlstr = "UPDATE `categorias` set `catnom`=:catnom, `catest`=:catest
                    where `catid` = :catid;";
        $sqlParams = array(
            "catnom" => $catnom,
            "catest" => $catest,
            "catid" => $catid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($catid)
    {
        $sqlstr = "DELETE from `categorias` where catid = :catid;";
        $sqlParams = array(
            "catid" => $catid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}