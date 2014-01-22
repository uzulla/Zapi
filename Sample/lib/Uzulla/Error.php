<?php
namespace Uzulla;
class Error
{
    public static function strict()
    {
        set_error_handler(
            function ($errno, $errstr, $errfile, $errline)
            {
                ob_clean();
                error_log("STRICT ERROR: NO:{$errno} STR:{$errstr} FILE:{$errfile} LINE:{$errline}");
                http_response_code(500);
                die ("ERROR");
            }
        );

    }

    public static function setDisplayFatalError(){
        register_shutdown_function(
            function(){
                $e = error_get_last();
                if( $e['type'] == E_ERROR ||
                    $e['type'] == E_PARSE ||
                    $e['type'] == E_CORE_ERROR ||
                    $e['type'] == E_COMPILE_ERROR ||
                    $e['type'] == E_USER_ERROR ){

                    ob_clean();
                    error_log("FATAL ERROR: NO:{$e['type']} STR:{$e['message']} FILE:{$e['file']} LINE:{$e['line']}");
                    http_response_code(500);
                    die ("FATAL ERROR");
                }
            }
        );
    }

    public static function setConvertErrorToException()
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
        });
    }

}
