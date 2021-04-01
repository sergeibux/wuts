<br>--- - - -  -  -  -
<?php

include_once 'Logger.php';

class Dbo{
    private const DB_UNAME = 'semevafremgsb';
    private const DB_NAME = 'mysql:host=semevafremgsb.mysql.db;dbname=' . Dbo::DB_UNAME;
    private const DB_PWD = 'PCmLJUwWGKW4SE';
        
    private $connected = false;
    private $error = "pending";
    private $connexion;
    
    function __construct(){
        loggerLog('conexion to DB ... 0.1', 'connect__construct()', 'dboLog.txt', true, false);
    }
    
     function connect(){
         loggerLog('conexion to DB ... 0.2.1', 'connect()', 'dboLog.txt', true, false);
        try{
            $connexion = new PDO(Dbo::DB_NAME, Dbo::DB_UNAME, Dbo::DB_PWD);
//             $connexion = new PDO(DB_NAME, DB_UNAME, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            loggerLog('conexion to DB ...0.2.2', 'connect()', 'dboLog.txt', true, false);
        } catch (PDOException $Exception) {
            $result = 'DB connexion error.0.2.3 | ';
            $result .= $Exception->getCode() . '|';
            $result .= $Exception->getMessage();
            loggerLog('conexion to DB failed : ' 
                . $result, 'connect()\n' 
                . 'DB_NAME = '. Dbo::DB_NAME . '\n' 
                . 'DB_UNAME = '. Dbo::DB_UNAME . '\n' 
                . 'DB_PWD = '. Dbo::DB_PWD . '\n'
                , 'dboLog.txt', true, false);
            return false;
        }
        loggerLog('conexion to DB established 0.2.4', 'connect()', 'dboLog.txt', true, false);
        return true;
     }
}

