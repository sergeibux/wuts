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
//          loggerLog('conexion to DB ... 0.2.1', 'connect()', 'dboLog.txt', true, false);
        try{
            $this->connexion = new PDO(Dbo::DB_NAME, Dbo::DB_UNAME, Dbo::DB_PWD);
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
         $ret = $query->fetchAll(PDO::FETCH_ASSOC);
         return $ret;
     }
     
     /*
      * return array id of the object
      */
     function listAllFromTable(array $list, string $table){
         $first = true;
         foreach ($list as $column){
             if ($first){
                 $columnStr .= "`$column`";
                 $first = false;
             } else {
                 $columnStr .= ", `$column`";
             }
         }
         $this->connect();
         $ret = $this->sendRequest("SELECT $columnStr from $table;");
         return $ret;
     }
     
     /*
      * return array id of the object
      */
     function searchStringInTable(string $str, string $table, string $column){
         $this->connect();
         return $this->sendRequest("SELECT id from $table WHERE $column LIKE '%$str%';");
     }
     
     /*
      * return array id of the object
      */
     function searchLastStringInTable(string $str, string $table, string $column){
         $this->connect();
         $all = $this->sendRequest("SELECT id from $table WHERE $column LIKE '%$str%';");
         $last = $all[sizeof($all) - 1];
         loggerLog('Last sql result : ' . $last["id"], 'searchLastStringInTable()', 'dboLog.txt', true, false);
         return $last["id"];
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
        $id = $this->searchLastStringInTable($values[0], $table, $columns[0]);
        if ($id == null){
            $this->sendRequest("INSERT INTO `$table` ($columnStr) VALUES ($valueStr);");
            $id = $this->searchLastStringInTable($values[0], $table, $columns[0]);
        }
        return $id;
     }
}

