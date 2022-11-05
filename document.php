<?php

require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteBLOB as SQLiteBlob;

$pdo = (new SQLiteConnection)->connect();
$sqlite = new SQLiteBlob($pdo);

// get document id from the query string
$documentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// read documet from the database
$doc = $sqlite->readDoc($documentId);
if ($doc != null) {
    header("Content-Type: " . $doc['mime_type']);
    echo stream_get_contents($doc['doc']);
} else {
    echo 'Error loading document ' . $documentId;
}
