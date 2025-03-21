<?php
class ErrorLog {
    const ERROR_FILE = "../log/SiteErrors.log";
    private $errno;
    private $errMsg;
    private $errFile;
    private $errLine;

    public function __construct($errno, $errMsg, $errFile, $errLine) {
        $this->errno = $errno;
        $this->errMsg = $errMsg;
        $this->errFile = $errFile;
        $this->errLine = $errLine;
    }

    public function WriteError() {
        $error = "Error logged: " . date("Y-m-d H:i:s - ");
        $error .= "[ " . $this->errno . " ]: ";
        $error .= $this->errMsg;
        $error .= " in file " . $this->errFile;
        $error .= " on line " . $this->errLine . "\n";
        
        // Log details of error in a file
        error_log($error, 3, self::ERROR_FILE);
    }
}
?>
