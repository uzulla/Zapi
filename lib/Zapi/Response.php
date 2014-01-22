<?php
namespace Zapi;
class Response
{
    public $content_type = 'text/plain';
    public $header_list = array();
    public $body = null;
    public $status_code = 200;

    /**
     * send header, send data. finish.
     */
    public function finalize()
    {
        if(!headers_sent()){
            http_response_code($this->status_code);
            header('Content-Type: '.$this->content_type);
            foreach($this->header_list as $name => $val){
                header("{$name}: {$val}");
            }
        }else{
            error_log('NOTICE: header was sent');
        }

        echo $this->body;
        exit; // done all.
    }

    public function not_found($extra_message = '')
    {
        $this->flush_error(404, '404 not found. '.PHP_EOL.$extra_message);
    }

    public function bad_request($extra_message = '')
    {
        $this->flush_error(400, '400 bad request. '.PHP_EOL.$extra_message);
    }

    public function server_error($extra_message = '')
    {
        $this->flush_error(500, '500 server error. '.PHP_EOL.$extra_message);
    }

    public function flush_error($code, $body){
        ob_clean();
        $this->status_code = $code;
        $this->body = $body;
        $this->finalize();
    }

}
