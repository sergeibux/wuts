<?php

include_once '../Logger.php';

class Dbo{
    private const DB_UNAME = 'semevafremgsb';
    private const DB_NAME = 'mysql:host=semevafremgsb.mysql.db;dbname=' . Dbo::DB_UNAME;
    private const DB_PWD = 'PCmLJUwWGKW4SE';
        
    private $connected = false;
    private $error = "pending";
    private $connexion;
    
    function __construct(){
    }
    
    function connect(){
         loggerLog('conexion to DB ... 0.2.1', 'connect()', 'dboLog.txt', true, false);
        try{
            $this->connexion = new PDO(Dbo::DB_NAME, Dbo::DB_UNAME, Dbo::DB_PWD);
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
     
     /* 
      * returns query's result
      */
     function sendRequest(string $request){
         loggerLog('will send request : ' . $request, 'sendRequest()', 'dboLog.txt', true, false);
         $query = $this->connexion->prepare($request);
         try {
             $query->execute();
         } catch (Exception $ex){
             echo '<pre> EXCEPTION <br>';
             echo $ex;
             echo '</pre>';
         }
         loggerLog('send sql request : $request', 'sendRequest()', 'dboLog.txt', true, false);
         return $query->fetchAll(PDO::FETCH_ASSOC);
     }
     
     /*
      * return array id of the object
      */
     function searchStringInTable(string $str, string $table, string $column){
         $this->connect();
         return $this->sendRequest("SELECT id from $table WHERE $column LIKE '%$str%';");
     }
     
    function addToTable(string $table, array $columns, array $values){
        $first = true;
        foreach ($columns as $column){
            if ($first){
                $columnStr .= "`$column`";
                $first = false;
            } else {
                $columnStr .= ", `$column`";
            }
        }
        $first = true;
        foreach ($values as $value){
            if ($first){
                $valueStr .= "\"$value\"";
                $first = false;
            } else {
                $valueStr .= ", \"$value\"";
            }
        }
        $this->connect();
        $id = $this->searchStringInTable($values[0], $table, $columns[0]);
        if (sizeof($id) < 1){
            $this->sendRequest("INSERT INTO `$table` ($columnStr) VALUES ($valueStr);");
            return $this->searchStringInTable($values[0], $table, $columns[0]);
        }
        return $id;
     }
}

