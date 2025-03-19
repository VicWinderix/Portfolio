<?php
require 'ErrorLog.php';
function handleErrors($errno, $errMsg, $errFile, $errLine) {
    $error = "[ " . $errno . " ]: ";
    $error .= $errMsg;
    $error .= " in file " . $errFile;
    $error .= " on line " . $errLine . "\n";

    $errorLogger = new ErrorLog($errno, $errMsg, $errFile, $errLine);
    $errorLogger->WriteError();
    exit();
}
?>