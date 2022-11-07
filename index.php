<?php
require 'vendor/autoload.php';

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SQLite Tutorial PHP Demo</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>SQLite Tutorial PHP Demo</h1>
    </div>
    <p>
    <?php
    if ($pdo != null)
        echo 'Connected to the SQLite database successfully!';
    else
        echo 'Whoops, could not connect to the SQLite database!';
    ?></p>

    <h2>Contents</h2>
    <ol>
        <li><a href="./create_table.php">Creating Tables</a></li>
        <li><a href="./insert.php">Inserting Data</a></li>
        <li><a href="./update.php">Updating Data</a></li>
        <li><a href="./select.php">Querying Data</a></li>
        <li>Working with BLOB Data</li>
        <ol>
            <li><a href="./write_blob.php">Writing BLOB into the table</a></li>
            <li>Reading BLOB from the table</li>
            <ol>
                <li><a href="./read_blob.php?id=1">id=1</a></li>
                <li><a href="./read_blob.php?id=2">id=2</a></li>
            </ol>
            <li><a href="./update_blob.php?id=1">Update BLOB data (id=1)</a></li>
        </ol>
        <li><a href="./transaction.php">Transaction</a></li>
        <li><a href="./delete.php">Deleting Data</a></li>
    </ol>
</div>
</body>
</html>


