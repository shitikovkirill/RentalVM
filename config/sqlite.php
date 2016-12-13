<?php
/**
 * Create db connection
 */

$db = new SQLite3(__DIR__.'/../db/blog.db');

$db->exec(
    'CREATE TABLE IF NOT EXISTS posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author STRING,
    text STRING
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author STRING,
    text STRING
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    '
);

return $db;