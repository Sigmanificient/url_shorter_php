<?php

require_once ROOT . '/Models/UrlModel.php';

class AppController
{
    private $_model;

    public function __construct()
    {
        $this->_model = new UrlModel();
    }

    public function read()
    {
        echo "foo";
    }

    public function create()
    {
        echo "bar";
    }
}