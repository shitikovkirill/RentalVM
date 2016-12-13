<?php

namespace Model;

class PostModel
{
    private $db;

    public function __construct(\SQLite3 $db)
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
        $query = $this->db->query(
            'SELECT posts.id, posts.text, posts.author, COUNT(posts_comments.comment_id) AS comment_count FROM posts
            LEFT JOIN posts_comments ON posts_comments.post_id = posts.id
            GROUP BY posts_comments.post_id
            ORDER BY created'
        );

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

    public function getPostsOrderByCountComment()
    {
        $query = $this->db->query(
            'SELECT posts.id, posts.text, posts.author, COUNT(*) AS comment_count FROM posts
            JOIN posts_comments ON posts_comments.post_id = posts.id
            GROUP BY posts_comments.post_id
            ORDER BY comment_count
            LIMIT 5;'
        );
        $results = [];
        while ($row = $query->fetchArray()) {
            array_push($results, $row);
        }
        return $results;
    }

}