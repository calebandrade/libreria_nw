<?php

namespace Dao\Mnt;
use Dao\Table;

class Roles extends Table
{
    
    public static function getAll()
    {
        $sqlstr = "Select * from roles;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getById($rolescod)
    {
        $sqlstr = "SELECT * from `roles` where rolescod=:rolescod;";
        $sqlParams = array("rolesCod" => $rolescod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }
    
    public static function insert(
        $rolescod,
        $rolesdsc,
        $rolesest
    ) {
        $sqlstr = "INSERT INTO `roles`
        (`rolescod`,`rolesdsc`,`rolesest`) VALUES(:rolescod,:rolesdsc,:rolesest);";
        $sqlParams = [
            "rolescod"=> $rolescod,
            "rolesdsc"=> $rolesdsc,
            "rolesest"=> $rolesest
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function update(
        $rolescod,
        $rolesdsc,
        $rolesest
    ) {
        $sqlstr = "UPDATE `roles` set
        `rolesdsc`=:rolesdsc,`rolesest`=:rolesest,
        where `rolescod` = :rolescod;";
        $sqlParams = array(
            "rolescod"=> $rolescod,
            "rolesdsc"=> $rolesdsc,
            "rolesest"=> $rolesest
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($rolescod)
    {
        $sqlstr = "DELETE from `roles` where rolescod = :rolescod;";
        $sqlParams = array(
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}