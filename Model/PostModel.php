<?php

namespace Model;

class PostModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save($name, $text)
    {
        $query = $this->db->prepare('INSERT INTO posts (author, text) VALUES (:name, :text)');
        $query->bindValue(':name', $name, SQLITE3_TEXT);
        $query->bindValue(':text', $text, SQLITE3_TEXT);
        $result = $query->execute();
        return $result;
    }

    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM posts ORDER BY created');
        $results = [];
        while ($row = $query->fetchArray()) {
            array_push($results, $row);
        }
        return $results;
    }

    public function get($id)
    {
        $query = $this->db -> prepare('SELECT * FROM posts WHERE id=:id');
        $query -> bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $query -> execute();
        return $result->fetchArray();
    }

}