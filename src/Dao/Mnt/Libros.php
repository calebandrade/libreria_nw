<?php
namespace Dao\Mnt;

use Dao\Table;


class Libros extends Table
{

    public static function getAll()
    {
        $sqlstr = "Select * from libros;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getById(int $libid)
    {
        $sqlstr = "SELECT * from `libros` where libId=:libId;";
        $sqlParams = array("libId" => $libid);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function getAllC()
    {
        $sqlstr = "Select * from categorias where catest='ACT';";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getAllE()
    {
        $sqlstr = "Select * from editoriales where editest='ACT';";
        return self::obtenerRegistros($sqlstr, array());
    }

 

    public static function insert(
        $libDsc,
        $catid,
        $editid,
        $libprice,
        $libCodInt,
        $libimg,
        $libautor,
        $libest
    ) {
        $sqlstr = "INSERT INTO `libros`
        ( `libDsc`,`catid`, `editid`,`libprice`, `libCodInt`, `libimg`, `libautor`,`libest`)
        VALUES
        (:libDsc, :catid, :editid, :libprice, :libCodInt, :libimg, :libautor, :libest)";
        $sqlParams = [
            "libDsc" => $libDsc ,
            "catid" => $catid ,
            "editid" => $editid ,
            "libprice" => $libprice ,
            "libCodInt" => $libCodInt ,
            "libimg" => $libimg ,
            "libautor" => $libautor,
            "libest" => $libest ,
            
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    

    public static function update(
        $libDsc,
        $catid,
        $editid,
        $libprice,
        $libCodInt,
        $libimg,
        $libautor,
        $libest,
        $libId

    ) {
        $sqlstr = "UPDATE `libros` set `libDsc`=:libDsc, `catid`=:catid,`editid`=:editid,`libprice`=:libprice, `libCodInt`=:libCodInt,`libimg`=:libimg,`libautor`=:libautor,`libest`=:libest
                    where `libId` = :libId;";
        $sqlParams = array(
            "libDsc" => $libDsc,
            "catid" => $catid,
            "editid" => $editid,
            "libprice" => $libprice,
            "libCodInt" => $libCodInt,
            "libimg" => $libimg,
            "libautor" => $libautor,
            "libest" => $libest,
            "libId" => $libId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    
    public static function delete($libId)
    {
        $sqlstr = "DELETE from `libros` where libId = :libId;";
        $sqlParams = array(
            "libId" => $libId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

   
}