<?php
/** 
 * Create a logfile
 * @param string $msg
 * @param string $origin (src function)
 * @param string $target (ie. /tmp/logFile.txt)
 * @param boolean $console  will show in js console
 * @param boolean $alert will prompt an alert
 */
function loggerLog(string $msg, string $origin, string $targetFile, bool $console = false, bool $alert = false){
    $target = $_SERVER['DOCUMENT_ROOT'] . '/back/log/' . $targetFile;
    $string = date("d/m/Y - H:i:s");
    $string .= "\n\t$origin :\n\t\t";
    $string .= $msg;
    $string .= "\n------------------------------\n";

    $handle = fopen($target, "a+");
    if ($handle){
        fwrite($handle, $string);
    } else {
        jsConsoleLog("Error opening or creating log file ($target)");
    }
    fclose($handle);
    
    if ($console == true){
        jsConsoleLog($msg);
    }
    
    if ($alert == true){
        alertLog($msg);
    }
}

function alertLog($msg){
    $msg = str_ireplace("\n", "\\n", $msg);
    $msg = str_ireplace("\"", "\\\"", $msg);
    echo '
        <script>
            alert("' . $msg . '");
        </script>
    ';
}

function jsConsoleLog($msg){
    $msg = str_ireplace("\n", "\\n", $msg);
    $msg = str_ireplace("\"", "\\\"", $msg);
    echo '
        <script>
            console.log("' . $msg . '");
        </script>
    ';
}