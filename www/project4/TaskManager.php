<?php
require_once("./ITaskManager.php");

class TaskManager implements ITaskManager {
    private $db;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->db = new PDO($dsn, $username, $password);
    }

    public function create($desc) {
        $stmt = $this->db->prepare("INSERT INTO Project4.Task (description) VALUES (:desc)");
        $stmt->bindParam(':desc', $desc);
        return $stmt->execute();
    }

    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM Project4.Task WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        return $this->db->query("SELECT * FROM Project4.Task")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $newDesc) {
        $stmt = $this->db->prepare("UPDATE Project4.Task SET description=:newDesc WHERE id=:id");
        $stmt->bindParam(':newDesc', $newDesc);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Project4.Task WHERE id=:id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
