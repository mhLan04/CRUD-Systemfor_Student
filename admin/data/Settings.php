<?php
class Settings {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM settings");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save($key, $value) {
        $stmt = $this->conn->prepare("SELECT * FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        if ($stmt->rowCount() > 0) {
            $updateStmt = $this->conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
            return $updateStmt->execute([$value, $key]);
        } else {
            $insertStmt = $this->conn->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)");
            return $insertStmt->execute([$key, $value]);
        }
    }
}
?>
