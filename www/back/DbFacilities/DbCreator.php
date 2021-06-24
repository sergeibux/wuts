<?php
include_once 'Dbo.php';
include_once '../Logger.php';
class DbCreator{
    function __construct(){
//         loggerLog('dbCreator construct ... 1', 'DbCreator()', 'dboLog.txt', true, false);
        $columnArray = array(
            'name' => "species",
            'type' => "VARCHAR",
            'size' => "0"
        );
        $columnsArray[0] = $columnArray;
        $columnArray = array(
            'name' => "groups",
            'type' => "VARCHAR",
            'size' => "20"
        );
        $columnsArray[1] = $columnArray;
        
        $size = $this->createTable("species",$columnsArray);
        echo "<hr>Table created $size columns<br>";
    }
    
    function createTable(string $tableName, array $columnsArray){
        loggerLog('dbCreator create table', 'createTable()', 'dboLog.txt', true, false);
        $req = "CREATE TABLE '$tableName' ("; 
        $size = 0;
        foreach($columnsArray as $columnArray){
            ++$size;
            if ($size > 1){
                $req .= ", ";
            }
            $req .= $columnArray["name"] . " " . $columnArray["type"];
            if ($columnArray["size"] != 0){
                $req .= "(" . $columnArray["size"] . ")";
            }
        }
        if ($size <= 0){
            return $size;
        }
        $req .= ");";
        
        $dbo = new Dbo;
        $dbo->connect();
        $dbo->sendRequest($req);
            
        return $size;
    }
}
?>