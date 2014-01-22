<?php
namespace Sample\Action;
class Book extends \Zapi\Action
{
    public function doList()
    {
        $this->setJsonBodyByArray(\Sample\Model\Book::getData());
        $this->res->header_list['X-MY-HEADER'] = 'MYHEADER';
        $this->res->finalize();
    }

    public function getText($text)
    {
        $this->res->body = $text;
        $this->res->finalize();
    }
}
