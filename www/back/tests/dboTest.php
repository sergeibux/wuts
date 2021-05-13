<html>
   <head>
   		<title>Dbo test... . . .  .  .  . </title>
   	</head>
<body>Dbo test... . . .  .  .  . <hr>
<?php
//     include_once '../Dbo.php';
include_once '../DbFacilities/DbCreator.php';
include_once '../DbFacilities/DbSucker.php';
    include_once '../Logger.php';
    
    function connectTest(){
        loggerLog('conexion to DB ... 0', 'connectTest()', 'dboLog.txt', true, false);
        $dbo = new Dbo;
        loggerLog('conexion to DB ... 1', 'connectTest()', 'dboLog.txt', true, true);
        $dbo->connect();
        loggerLog('conexion to DB ... 2', 'connectTest()', 'dboLog.txt', true, true);
    }
    
    function dbCreatorTest(){
        loggerLog('calling DbCreator ... 0', 'dbCreatorTest()', 'dboLog.txt', true, false);
        $dbCreator = new DbCreator;
//         $dbCreator->DbCreator();
        loggerLog('DbCreator ended ... 1', 'dbCreatorTest()', 'dboLog.txt', true, true);
    }
    
    function dbSuckerTest(){
        loggerLog('calling DbSucker : create object ... 0', 'DbSuckerTest()', 'dboLog.txt', true, false);
        $dbSucker = new DbSucker();
        loggerLog('calling DbSucker : obect created ... 1', 'DbSuckerTest()', 'dboLog.txt', true, false);
    }
    
    
//     connectTest();
//     dbCreatorTest();
    loggerLog('test DbSucker started ... 0', 'Test()', 'dboLog.txt', true, false);
    dbSuckerTest();
    loggerLog('test DbSucker completed ... 1', 'Test()', 'dboLog.txt', true, false);
?>
<br>.
<hr>
</body>
</html>