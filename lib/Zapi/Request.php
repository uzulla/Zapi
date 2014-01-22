<?php
namespace Zapi;
class Request
{
    public $path = null;
    public $path_list = null;
    public $method = null;
    public $param_list = null;
    public $is_https = null;
    public $is_post = null;
    public $is_get = null;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->is_post = ($this->method === "POST");

        $this->is_get = ($this->method === "GET");

        $this->param_list = array_merge($_GET, $_POST);

        $this->header_list = $this->getHeaderList();

        if(!empty($_SERVER['PATH_INFO']))
            $this->path = $_SERVER['PATH_INFO'];

        if(!empty($this->param_list['_url']))
            $this->path = $this->param_list['_url'];

        $this->path_list = explode('/', preg_replace("|^/|", "", $this->path));

        $this->is_https = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) ? true : false ; // IIS SAPI NOT SUPPORT

        $this->ip = $this->getRemoteIP();

        $this->ua = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }


    public function params($key = null, $default=null){
        if(is_null($key))
            return $this->param_list;

        if(isset($this->param_list[$key]))
            return $this->param_list[$key];

        return $default;
    }

    public function getRemoteIP(){
        $_SERVER_UC = array_change_key_case($_SERVER, CASE_UPPER);
        if(isset($_SERVER_UC['HTTP_CLIENT_IP']))
            return $_SERVER_UC['HTTP_CLIENT_IP'];

        if(isset($_SERVER_UC['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER_UC['HTTP_X_CLUSTER_CLIENT_IP'];

        if(isset($_SERVER_UC['HTTP_FORWARDED_FOR']))
            return $_SERVER_UC['HTTP_FORWARDED_FOR'];
        if(isset($_SERVER_UC['HTTP_X_FORWARDED_FOR']))
            return $_SERVER_UC['HTTP_X_FORWARDED_FOR'];

        if(isset($_SERVER_UC['HTTP_FORWARDED']))
            return $_SERVER_UC['HTTP_FORWARDED'];
        if(isset($_SERVER_UC['HTTP_X_FORWARDED']))
            return $_SERVER_UC['HTTP_X_FORWARDED'];

        if(isset($_SERVER_UC['REMOTE_ADDR']))
            return $_SERVER_UC['REMOTE_ADDR'];
    }

    public function getHeaderList(){
        $headers = array();
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) === 'HTTP_')
            {
                $name = substr($name, 5);
                $headers[$name] = $value;
            } else if ($name == "CONTENT_TYPE") {
                $headers["CONTENT_TYPE"] = $value;
            } else if ($name == "CONTENT_LENGTH") {
                $headers["CONTENT_LENGTH"] = $value;
            }
        }
        \U::p($headers);
        return $headers;
    }
}
