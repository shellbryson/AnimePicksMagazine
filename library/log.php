<?php
/* -----------------------------------------------------------
 * ANIME PICKS 2
 * Copyright 2012
 * 
 * File: log.php
 * Desc: PHP Error logging
 * Last Author: Sheru
 * Original Author: Sheru
 *
 * Notes:
 *
 *  Provides PHP logging for error tracing
 *  
 * -----------------------------------------------------------
 */

error_reporting(0); 
$old_error_handler = set_error_handler("userErrorHandler");

function userErrorHandler ($errno, $errmsg, $filename, $linenum,  $vars) {
    $time=date("d M Y H:i:s"); 
    // Get the error type from the error number 
    $errortype = array (1    => "Error",
                        2    => "Warning",
                        4    => "Parsing Error",
                        8    => "Notice",
                        16   => "Core Error",
                        32   => "Core Warning",
                        64   => "Compile Error",
                        128  => "Compile Warning",
                        256  => "User Error",
                        512  => "User Warning",
                        1024 => "User Notice",
                        2048 => "Depreciated");
    $errlevel=$errortype[$errno];

    // ONLY WRITE CRITICAL ERRORS TO FILE, IGNORE WARNINGS AND MESSAGES
    if($errno!=2 && $errno!=8 && $errno!=2048) {
        $errfile=fopen("errors.csv","a");
        fputs($errfile,"\"$time\",\"$filename:$linenum\",\"$errno\",\"$errmsg\"\r\n"); 
        fclose($errfile);
    }
}
 
?>