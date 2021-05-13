<?php
//     include_once '../Dbo.php';
include_once '../DbFacilities/DbCreator.php';
include_once '../DbFacilities/DbSucker.php';
    include_once '../Logger.php';
    
    function connectTest(){
        $dbo = new Dbo;
        $dbo->connect();
    }
    
    function dbCreatorTest(){
        $dbCreator = new DbCreator;
//         $dbCreator->DbCreator();
    }
    
    function dbSuckerTest(){
        $dbSucker = new DbSucker();
    }
    
    
//     connectTest();
//     dbCreatorTest();
    dbSuckerTest();
?>
<br>.
<hr>
</body>
</html>