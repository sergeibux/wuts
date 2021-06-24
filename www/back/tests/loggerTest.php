<html>
   <head>
   		<title>Dbo test... . . .  .  .  . </title>
   	</head>
   	<body>
   	<?php
include_once '../Logger.php';
    function loggerTest(){
        echo "make some tests...";
        $msg = 'test message';
        $origin = 'loggerTest()';
        $targetFile = 'testLog.txt';
        loggerLog($msg, $origin, $targetFile, true, true);
        echo 'done';
    }
    loggerTest();

    ?>
	</body>
</html>