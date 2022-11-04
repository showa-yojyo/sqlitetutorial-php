<?php

require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteBLOB as SQLiteBlob;

$sqlite = new SQLiteBlob((new SQLiteConnection)->connect());

// insert a PDF file into the documents table
$pathToPDFFile = 'assets/test.pdf';
$pdfId = $sqlite->insertDoc('application/pdf', $pathToPDFFile);

// insert a PNG file into the documents table
$pathToPNGFile = 'assets/test.png';
$pngId = $sqlite->insertDoc('image/png', $pathToPNGFile);

echo "OK";
