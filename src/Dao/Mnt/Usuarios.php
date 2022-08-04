<?php

namespace Dao\Mnt;

use Exception;

use Dao\Table;

class Usuarios extends Table
{
    public static function getAll()
    {
        $sqlstr = "Select * from usuario;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getById(int $usercod)
    {
        $sqlstr = "SELECT * from `usuario` where usercod=:usercod;";
        $sqlParams = array("usercod" => $usercod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function insert(
        $useremail,
        $username,
        $userpswd,
        $userpswdest,
        $userpswdexp,
        $userest,
        $useractcod,
        $usertipo
    ) {
       
       
        $sqlstr = "INSERT INTO `usuario` (`useremail`, `username`, `userpswd`,
            `userfching`, `userpswdest`, `userpswdexp`, `userest`, `useractcod`,
            `userpswdchg`, `usertipo`)
            VALUES
            ( :useremail, :username, :userpswd,
            now(), :userpswdest, :userpswdexp, :userest, :useractcod,
            now(), :usertipo);";
        $sqlParams = array(
            "useremail" => $useremail,
            "username" => $username,
            "userpswd" => $userpswd,
            "userpswdest" => $userpswdest,
            "userpswdexp" => $userpswdexp,
            "userest" => $userest,
            "useractcod" => $useractcod,
            "usertipo" => $usertipo
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }



    public static function update(
        $useremail,
        $username,
        $userpswd,
        $userpswdest,
        $userpswdexp,
        $userest,
        $useractcod,
        $usertipo,
        $usercod

    ) {
        $sqlstr = "UPDATE `usuario` set
`useremail`=:useremail, `username`=:username,
`userpswd`=:userpswd,  `userpswdest`=:userpswdest,
`userpswdexp`=:userpswdexp, `userest`=:userest, `useractcod`=:useractcod , `usertipo`=:usertipo
 where `usercod` = :usercod;";
        $sqlParams = array(
            "useremail" => $useremail,
            "username" => $username,
            "userpswd" => $userpswd,
            "userpswdest" => $userpswdest,
            "userpswdexp" => $userpswdexp,
            "userest" => $userest,
            "useractcod" => $useractcod,
            "usertipo" => $usertipo,
            "usercod" => $usercod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    
    public static function delete($usercod)
    {
        $sqlstr = "DELETE from `usuario` where usercod = :usercod;";
        $sqlParams = array(
            "usercod" => $usercod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
}