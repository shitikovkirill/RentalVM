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

    public function __construct(\SQLite3 $db)
    {
        $this->db = $db;
    }

    public function save($name, $text, $post_id)
    {
        $query = $this->db->prepare('INSERT INTO comments (author, text) VALUES (:name, :text)');
        $query->bindValue(':name', $name, SQLITE3_TEXT);
        $query->bindValue(':text', $text, SQLITE3_TEXT);
        $query->execute();

        $comment_id = $this->db->lastInsertRowID();

        $query = $this->db->prepare('INSERT INTO posts_comments VALUES (:post_id, :comment_id)');
        $query->bindValue(':post_id', $post_id, SQLITE3_INTEGER);
        $query->bindValue(':comment_id', $comment_id, SQLITE3_INTEGER);
        $query->execute();
    }
    public function getByPost($id)
    {
        $query = $this->db->prepare(
            'SELECT comments.id, comments.author, comments.text FROM posts_comments 
              JOIN comments ON comments.id = posts_comments.comment_id
              WHERE posts_comments.post_id = :id'
        );
        $query->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $query->execute();
        $results = [];
        while ($row = $result->fetchArray()) {
            array_push($results, $row);
        }
        return $results;
    }
}