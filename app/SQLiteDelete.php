<?php

namespace App;

/**
 * Demonstration of SQLite transaction.
 */
class SQLiteDelete{
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
     * Delete a task by task id
     * @param int $taskId
     * @return int the number of rows deleted
     */
    public function deleteTask($taskId) {
        $sql = 'DELETE FROM tasks WHERE task_id = :task_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':task_id', $taskId);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Delete all tasks associated with a project
     * @param int $projectId
     * @return int the number of rows deleted
     */
    public function deleteTaskByProject($projectId) {
        $sql = 'DELETE FROM tasks WHERE project_id = :project_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);

        return $stmt->rowCount();
    }

    /**
     * Delete the project by project id
     * @param int $projectId
     * @return int the number of rows deleted
     */
    public function deleteProject($projectId) {
        $sql = 'DELETE FROM projects WHERE project_id = :project_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);

        return $stmt->rowCount();
    }
}
