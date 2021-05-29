<?php

require_once ROOT . '/Models/UrlModel.php';

class AppController
{
    private $_model;

    public function __construct()
    {
        $this->_model = new UrlModel();
    }

    public function read($url)
    {
        $url = $this->_model->get($url);
        $redirect = $url ? $url["redirect"] : "https://url_shorterner_php.test/";

        http_response_code(303);
        header("Location: {$redirect}");
    }


    public function create()
    {

    }
}