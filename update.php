<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteUpdate;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteUpdate($pdo);

// mark task #2 as completed
$taskId = 2;
$result = $sqlite->completeTask($taskId, '2016-05-02');

if ($result)
    echo "Task #${taskId} has been completed";
else
    echo 'Whoops, something wrong happened.';
