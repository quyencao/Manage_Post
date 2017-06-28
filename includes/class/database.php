<?php

    class Database {

        private $db_host;
        private $db_name;
        private $db_pass;
        private $db_user;
        private $connection = null;

        public function __construct(
            string $db_host,
            string $db_user,
            string $db_pass
        ) {
            $this->db_host = $db_host;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;

            try {
                $this->connection = new PDO("mysql:host=$this->db_host", $this->db_user, $this->db_pass);
            } catch (PDOException $e) {
                $this->connection = null;
            }
        }

        public static function connectToDatabase(
            string $db_host,
            string $db_user,
            string $db_pass,
            string $db_name
        ) {
            $database = new self($db_host, $db_user, $db_pass);
            $database->db_name = $db_name;
            $database->setConnection();
            return $database;
        }

        private function setConnection() {
            try {
                $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            } catch (PDOException $e) {
                echo "Connect fail: " . $e->getMessage();
                exit();
            }
        }

        public function getConnection() {
            return $this->connection;
        }

        public function createDatabase(string $dbName) {
            if($this->connection instanceof PDO) {
                $this->connection->query("CREATE DATABASE IF NOT EXISTS $dbName");
                $this->connection = new PDO("mysql:host=$this->db_host;dbname=$dbName", $this->db_user, $this->db_pass);

                $this->connection->query("CREATE TABLE IF NOT EXISTS posts(
                     id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                     title VARCHAR( 50 ) NOT NULL, 
                     description TEXT NOT NULL,
                     image VARCHAR( 255 ) NOT NULL, 
                     status INT( 3 ) NOT NULL DEFAULT 0, 
                     create_at DATE,
                     update_at DATE)");
            }
        }

    }