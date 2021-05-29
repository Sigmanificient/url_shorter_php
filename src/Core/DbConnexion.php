<?php


class DbConnexion
{
    private static DbConnexion $_instance;
    public string $status;

    private string $_host = "localhost";
    private string $_dbname = "url_shorter";
    private string $_dbuser = "root";
    private string $_dbpassword = "";

    private PDO $_conn;

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

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DbConnexion();
        }

        return self::$_instance;
    }

    public function execute($sql, $params = []): PDOStatement
    {
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}