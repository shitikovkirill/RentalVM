<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 13.12.16
 * Time: 21:59
 */

namespace Model;


class CommentModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save($name, $text)
    {
        $query = $this->db->prepare('INSERT INTO comments (author, text) VALUES (:name, :text)');
        $query->bindValue(':name', $name, SQLITE3_TEXT);
        $query->bindValue(':text', $text, SQLITE3_TEXT);
        $result = $query->execute();
        return $result;
    }
}