<?php
namespace Sample;
class Dispatcher extends \Zapi\Dispatcher
{
    public function runAction()
    {
        if($this->req->is_post){
            if($this->req->path_list[0] === 'test')
                (new \Sample\Action\Book($this))->doList();

        }elseif($this->req->is_get){
            if($this->req->path_list[0] === 'test')
                (new \Sample\Action\Book($this))->doList();

            if($this->req->path_list[0] === 'val'){
                $text = $this->req->path_list[1];
                (new \Sample\Action\Book($this))->getText($text);
            }
        }
    }
}
