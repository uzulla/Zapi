<?php
namespace Sample\Model;
class Book
{
    public static function getData(){
        $data = array(
            array('title'=>'nice perl book', 'author'=>'yusukebe'),
            array('title'=>'not bad php book', 'author'=>'uzulla'),
            array('title'=>'pretty good ruby book', 'author'=>'sugamasao'),
            array('title'=>'great infrastructure book', 'author'=>'koemu'),
        );
        return $data;
    }
}
