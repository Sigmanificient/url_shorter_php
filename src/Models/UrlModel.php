<?php

require_once ROOT . '/Core/DBConnexion.php';

class UrlModel
{
    private DbConnexion $conn;

    public function __construct()
    {
        $this->conn = DBConnexion::getInstance();
    }

    public function get_max_id(): int
    {
        $stmt = $this->conn->execute("select max(id) as 'id' from url_shorter.urls");
        return (int)$stmt->fetch()['id'];
    }

    public function get($id)
    {
        $stmt = $this->conn->execute(
            "select redirect from url_shortener.urls where id = :id;", ['id' => $id]
        );

        return $stmt->fetch();
    }

    public function add($redirect)
    {
        $this->conn->execute(
            "SELECT insert_return(:redirect) AS id_url;", ['redirect' => $redirect]
        );
    }

}