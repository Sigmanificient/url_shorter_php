<?php


class DBConnexion
{
    public $status;

    private $_host = "localhost";
    private $_dbname = "url_shorter";
    private $_dbuser = "root";
    private $_dbpassword = "";

    private $_conn;

    private function __construct()
    {
        try {
            $this->_conn = new PDO(
                'mysql:host=' . $this->_host . ";dbname=" . $this->_dbname . ';charset=utf8',
                $this->_dbuser, $this->_dbpassword
            );

            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch (PDOException $error) {
            $this->status = $error->getMessage();
        }

    }
}