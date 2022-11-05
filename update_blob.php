<?php

require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteBLOB as SQLiteBlob;

$sqlite = new SQLiteBlob((new SQLiteConnection)->connect());
// get document id from the query string
$documentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// update a PDF file into the documents table
$pathToPDFFile = 'assets/test.pdf';
$pdfId = $sqlite->updateDoc($documentId, 'application/pdf', $pathToPDFFile);

echo "OK";
