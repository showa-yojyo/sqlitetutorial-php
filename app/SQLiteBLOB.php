<?php

namespace App;

/**
 * SQLite PHP Blob Demo
 */
class SQLiteBLOB {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Insert blob data into the documents table
     * @param type $pathToFile
     * @return type
     */
    public function insertDoc($mimeType, $pathToFile) {
        if (!file_exists($pathToFile))
            throw new \Exception("File $pathToFile not found.");

        $sql = "INSERT INTO documents(mime_type, doc) "
                . "VALUES(:mime_type, :doc)";

        // read data from the file
        $fh = fopen($pathToFile, 'rb');
        if (!is_resource($fh)) {
            throw new \Exception("File $pathToFile open failed.");
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':mime_type', $mimeType);
        $stmt->bindParam(':doc', $fh, \PDO::PARAM_LOB);
        $stmt->execute();

        if (is_resource($fh)) {
            fclose($fh);
        }

        return $this->pdo->lastInsertId();
    }

    /**
     * Read document from the documents table
     * @param type $documentId
     * @return type
     */
    public function readDoc($documentId) {
        $sql = "SELECT mime_type, doc "
                . "FROM documents "
                . "WHERE document_id = :document_id";

        // initialize the params
        $mimeType = null;
        $doc = null;
        //
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([":document_id" => $documentId])) {

            $stmt->bindColumn(1, $mimeType);
            $stmt->bindColumn(2, $doc, \PDO::PARAM_LOB);

            return $stmt->fetch(\PDO::FETCH_BOUND) ?
                    ["document_id" => $documentId,
                     "mime_type" => $mimeType,
                     "doc" => $doc] : null;
        } else {
            return null;
        }
    }

   /**
    * Update document
    * @param type $documentId
    * @param type $mimeType
    * @param type $pathToFile
    * @return type
    * @throws \Exception
    */
    public function updateDoc($documentId, $mimeType, $pathToFile) {

        if (!file_exists($pathToFile))
            throw new \Exception("File %s not found.");

        $fh = fopen($pathToFile, 'rb');
        if (!is_resource($fh)) {
            throw new \Exception("File $pathToFile open failed.");
        }

        $sql = "UPDATE documents
                SET mime_type = :mime_type,
                    doc = :doc
                WHERE document_id = :document_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':mime_type', $mimeType);
        $stmt->bindParam(':data', $fh, \PDO::PARAM_LOB);
        $stmt->bindParam(':document_id', $documentId);

        //fclose($fh);

        return $stmt->execute();
    }
}
