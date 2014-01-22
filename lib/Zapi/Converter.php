<?php
namespace Zapi;
class Converter
{
    /**
     * convert array to json string.
     * @param array $data
     * @return string
     */
    public static function json(array $data){
        $json_option = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP;
        $json = json_encode($data, $json_option);
        if(isset($_GET['callback']) && preg_match('/\A[a-zA-Z0-9_]{1,64}\z/u', $_GET['callback']) ){
            $json =  $_GET['callback'].'('.$json.');';
        }
        return $json;
    }
}