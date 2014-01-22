<?php
namespace Zapi;
class Action
{
    /** @var \Zapi\Dispatcher  */
    public $dis = null;
    /** @var \Zapi\Request  */
    public $req = null;
    /** @var \Zapi\Response  */
    public $res = null;

    public function __construct(\Zapi\Dispatcher $dispatcher)
    {
        $this->dis = $dispatcher;
        $this->res = $dispatcher->res;
        $this->req = $dispatcher->req;
    }

    public function setJsonBodyByArray(array $data)
    {
        $this->res->content_type = 'application/json; charset=utf-8';
        $this->res->body = \Zapi\Converter::json($data);
    }
}