<?php
// Class for database connection

    class Database {
        private $db;

        // Constructor to connect to database
        public function __construct($hostname, $dbname, $username, $password) {
            $dsn = "mysql:host=$hostname;dbname=$dbname;charset=UTF8";

            try {
                $this->db = new PDO($dsn, $username, $password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        // Prepare SQL statement
        public function prepare($sql) {
            return $this->db->prepare($sql);
        }

        // Execute the query SQL statement with optional parameters
        public function query($sql, $params = []) {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }

        // ✅ Fix: Add lastInsertId() method
        public function lastInsertId() {
            return $this->db->lastInsertId();
        }
    }

?>
