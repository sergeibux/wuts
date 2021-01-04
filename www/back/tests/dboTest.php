<body>Dbo test...</body>
<?php
include_once '../Dbo.php';
include_once '../Logger.php';
function connectTest(){
        loggerLog('conexion to DB ... 0', 'connectTest()', 'dboLog.txt', true, false);
        $dbo = new Dbo();
        loggerLog('conexion to DB ... 1', 'connectTest()', 'dboLog.txt', true, false);
        $dbo->connect();
        loggerLog('conexion to DB ... 2', 'connectTest()', 'dboLog.txt', true, false);
    }
    connectTest();
    loggerLog('...', 'connectTest()', 'dboLog.txt', true, false);
