<?php
    function logToFile($msg){
        logToFileNamed(".\log\output.log", $msg);
    }
    function logToFileNamed($filename, $msg)
    {
        $str = "[" . date("Y/m/d h:i:s", time()) . "] " . $msg;
        $type = "a";
        if(filesize($filename)>1700)
          $type = "w";
        $fd = fopen($filename, $type);

        fwrite($fd, $str . "\r\n");

        fclose($fd);
    }
?>
