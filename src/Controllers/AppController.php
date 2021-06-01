<?php

require_once ROOT . '/Models/UrlModel.php';
require_once ROOT . '/Controllers/Controller.php';

class AppController extends Controller
{

    private UrlModel $_model;

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

        $url = $_POST['url'] ?? '';

        if (empty($_POST['url'])) {
            $this->render('create');
            return;
        }

        $this->_model->add($url);
        echo $this->_model->get_max_id();
    }
}