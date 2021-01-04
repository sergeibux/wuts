<?php

include_once 'Logger.php';

class Dbo{
    private const DB_NAME = 'mysql:host=../semevafrem/semevafremgsb.mysql.db;dbname=semevafremgsb';
    private const DB_UNAME = 'semevafremgsb';
    private const DB_PWD = 'PCmLJUwWGKW4SE';

    private $connected = false;
    private $error = "pending";
     private $connexion;
    
    function __construct(){
        
    }
    
     function connect(){
        loggerLog('conexion to DB ... 0', 'connect()', 'dboLog.txt', true, false);
        try{
            $connexion = new PDO(DB_NAME, DB_UNAME, DB_PWD);
//             $connexion = new PDO(DB_NAME, DB_UNAME, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            loggerLog('conexion to DB ...', 'connect()', 'dboLog.txt', true, false);
        } catch (PDOException $Exception) {
            $result = 'DB connexion error. | ';
            $result .= $Exception->getCode() . '|';
            $result .= $Exception->getMessage();
            loggerLog('conexion to DB failed : ' . $result, 'connect()', 'dboLog.txt', true, false);
            return false;
        }
        loggerLog('conexion to DB established', 'connect()', 'dboLog.txt', true, false);
        return true;
     }
}

