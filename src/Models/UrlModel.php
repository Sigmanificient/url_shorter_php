<?php

require_once ROOT . '/Core/DBConnexion.php';

class UrlModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DBConnexion::getInstance();
    }

    public function exists($id): bool
    {
        $stmt = $this->conn->execute(
            "select count(*) as 'n' from url_shorter.urls where id = :id;", ['id' => $id]
        );

        return ((int)($stmt->fetch()['n'])) > 0;
    }

    public function get($id)
    {
        $stmt = $this->conn->execute(
            "select redirect from url_shorter.urls where id = :id;", ['id' => $id]
        );

        return $stmt->fetch();

    }

    public function add($redirect)
    {
        do {
            $id = base64_encode(bin2hex(random_bytes(5)));

        } while ($this->exists($id));

        $stmt = $this->conn->execute(
            "insert into url_shorter.urls values (:id, :redirect)",
            ['id' => $id, 'redirect' => $redirect]
        );
    }

}