<?php

namespace App;

/**
 * Demonstration of SQLite transaction.
 */
class SQLiteTransaction{
    /**
     * PDO object
     */
    private $pdo;

    /**
     * The constructor
     */
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    /**
     * Insert blob data into the documents table
     * @param type $pathToFile
     * @return document id
     */
    public function insertDoc($mimeType, $pathToFile) {

        $sql = "INSERT INTO documents(mime_type, doc) "
                . "VALUES(:mime_type, :doc)";

        // read data from the file
        $fh = fopen($pathToFile, 'rb');

        $stmt = $this->pdo->prepare($sql);

        // pass values
        $stmt->bindParam(':mime_type', $mimeType);
        $stmt->bindParam(':doc', $fh, \PDO::PARAM_LOB);

        // execute the INSERT statement
        $stmt->execute();

        if(is_resource($fh)){
            fclose($fh);
        }

        // return the document id
        return $this->pdo->lastInsertId();
    }

    /**
     * Assign a document to a task
     * @param int $taskId
     * @param int $documentId
     */
    private function assignDocToTask($taskId, $documentId) {
        $sql = "INSERT INTO task_documents(task_id, document_id) "
                . "VALUES(:task_id, :document_id)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':task_id', $taskId);
        $stmt->bindParam(':document_id', $documentId);

        $stmt->execute();
    }

    /**
     * Add a task and associate a document to it
     * @param int $taskId
     * @param string $mimeType
     * @param string $pathToFile
     */
    public function attachDocToTask($taskId, $mimeType, $pathToFile) {
        try {
            // to make sure the foreign key constraint is ON
            $this->pdo->exec('PRAGMA foreign_keys = ON');

            // begin the transaction
            $this->pdo->beginTransaction();

            // insert a document first
            $documentId = $this->insertDoc($mimeType, $pathToFile);

            // associate document with the task
            $this->assignDocToTask($taskId, $documentId);

            // commit update
            $this->pdo->commit();
        } catch (\PDOException $e) {
            // rollback update
            $this->pdo->rollback();
            throw $e;
        }
    }
}
