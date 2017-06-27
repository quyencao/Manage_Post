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
            string $db_pass,
            string $db_name
        ) {
            $this->db_host = $db_host;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
            $this->db_name = $db_name;

            $this->setConnection();
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

    }