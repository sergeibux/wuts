<body>Dbo test... . . .  .  .  . <hr>
<?php
include_once '../Dbo.php';
include_once '../Logger.php';
function connectTest(){
        loggerLog('conexion to DB ... 0', 'connectTest()', 'dboLog.txt', true, false);
         $dbo = new Dbo();
        loggerLog('conexion to DB ... 1', 'connectTest()', 'dboLog.txt', true, true);
         $dbo->connect();
        loggerLog('conexion to DB ... 2', 'connectTest()', 'dboLog.txt', true, true);
    }
    connectTest();
    loggerLog('...', 'connectTest()', 'dboLog.txt', true, true);

?>
<br>.
<hr>
</body>