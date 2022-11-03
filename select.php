<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteSelect;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteSelect($pdo);

echo "Test SQLiteSelect::getProjects()";
$projects = $sqlite->getProjects();
echo "<pre>";
print_r($projects);
echo "</pre>";

echo "Test SQLiteSelect::getProjectObjectList()";
echo "<pre>";
print_r($sqlite->getProjectObjectList());
echo "</pre>";

foreach($projects as $project){
    $projectId = $project["project_id"];

    echo "Test SQLiteSelect::getTaskByProject($projectId)";
    $tasks = $sqlite->getTaskByProject($projectId);
    echo "<pre>";
    print_r($tasks);
    echo "</pre>";

    echo "Test SQLiteSelect::getTaskCountByProject($projectId)";
    echo "<pre>";
    echo $sqlite->getTaskCountByProject($projectId);
    echo "</pre>";
}
