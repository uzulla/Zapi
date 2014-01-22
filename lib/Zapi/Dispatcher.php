<?php
namespace Zapi;
class Dispatcher
{
    /** @var \Zapi\Request  */
    public $req;
    /** @var \Zapi\Response  */
    public $res;

    public function __construct(\Zapi\Request $request=null, \Zapi\Request $response=null)
    {
        ob_start();

        if(is_null($request))
            $this->req = new \Zapi\Request;
        else
            $this->req = $request;

        if(is_null($response))
            $this->res = new \Zapi\Response;
        else
            $this->res = $response;
    }

    /**
     * must override.
     */
    public function runAction()
    {
    }

    public function run()
    {
        try
        {
            $this->runAction(); // will finish in side.
            throw new \OutOfBoundsException();
        }
        catch (\UnexpectedValueException $e)
        {
            $this->res->bad_request($e->getMessage());
        }
        catch (\OutOfBoundsException $e)
        {
            $this->res->not_found($e->getMessage());
        }
        catch (\Exception $e)
        {
            $this->res->server_error($e->getMessage());
        }
    }
}
