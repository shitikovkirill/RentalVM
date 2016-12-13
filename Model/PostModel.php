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

    public function get()
    {
        $results = $this->db->query('SELECT * FROM posts');
        return $results;
    }
}