<?php

require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteDelete as SQLiteDelete;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteDelete($pdo);

// delete task id 1
$taskId = 1;
$rowDeleted = $sqlite->deleteTask($taskId);

echo 'The number of rows deleted: ' . $rowDeleted . '<br>';

// delete task associated with a project id 1
$projectId = 1;
$sqlite->deleteTaskByProject($projectId);

echo 'The number of task in the project #' . $projectId . ' deleted: ' . $rowDeleted . '<br>';

// delete project with id 1 and also its associated tasks
$projectId = 2;
$sqlite->deleteProject(2);
echo 'The number of project deleted: ' . $rowDeleted . '<br>';
