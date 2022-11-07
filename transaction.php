<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteTransaction;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteTransaction($pdo);

// 9999 will cause
// SQLSTATE[23000]: Integrity constraint violation: 19 FOREIGN KEY constraint failed
//$taskId = 9999;
// get task id from the query string
$taskId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
// add a new task and associate a document
    $sqlite->attachDocToTask($taskId, 'application/pdf', 'assets/test.pdf');
} catch (PDOException $e) {
    echo $e->getMessage();
}
