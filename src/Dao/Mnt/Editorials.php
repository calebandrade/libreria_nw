<?php

namespace Dao\Mnt;

use Dao\Table;


class Editorials extends Table
{
    /*
        `editid` BIGINT(18) NOT NULL AUTO_INCREMENT,
        `editnom` VARCHAR(45) NULL,
        `editnum` VARCHAR(8) NULL,
        `editdirec` VARCHAR(250) NULL,
        `editest` CHAR(3) NULL,
    */
    /**
     * Obtiene todos los registros de Editorials
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "Select * from editoriales;";
        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Editorial By Id
     *
     * @param int $editid Codigo del Editorial
     *
     * @return array
     */
    public static function getById(int $editid)
    {
        $sqlstr = "SELECT * from `editoriales` where editid=:editid;";
        $sqlParams = array("editid" => $editid);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert into Editorials
     *
     * @param [type] $editnom  description
     * @param [type] $editnum description
     * @param [type] $editdirec    description
     * @param [type] $editest    description
     *
     * @return void
     */
    public static function insert(
        $editnom,
        $editnum,
        $editdirec,
        $editest
    ) {
        $sqlstr = "INSERT INTO `editoriales`
(`editnom`, `editnum`,
`editdirec`, `editest`)VALUES
(:editnom, :editnum,
:editdirec, :editest);
";
        $sqlParams = [
            "editnom" => $editnom ,
            "editnum" => $editnum ,
            "editdirec" => $editdirec ,
            "editest" => $editest
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    /**
     * Updates editorials
     *
     * @param [type] $editnom  description
     * @param [type] $editnum description
     * @param [type] $editdirec    description
     * @param [type] $editest    description
     *
     * @return void
     */
    public static function update(
        $editnom,
        $editnum,
        $editdirec,
        $editest,
        $editid
    ) {
        $sqlstr = "UPDATE `editoriales` set
`editnom`=:editnom, `editnum`=:editnum,
`editdirec`=:editdirec, `editest`=:editest
 where `editid` = :editid;";
        $sqlParams = array(
            "editnom" => $editnom,
            "editnum" => $editnum,
            "editdirec" => $editdirec,
            "editest" => $editest,
            "editid" => $editid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Undocumented function
     *
     * @param [type] $invPrdId description
     *
     * @return void
     */
    public static function delete($editid)
    {
        $sqlstr = "DELETE from `editoriales` where editid = :editid;";
        $sqlParams = array(
            "editid" => $editid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}