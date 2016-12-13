<?php
/**
 * Create db connection
 */

$db = new SQLite3(__DIR__.'/../db/blog.db');

return $db;