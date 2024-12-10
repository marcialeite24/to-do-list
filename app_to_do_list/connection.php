<?php

    class Connection {    
        private $host = 'localhost';
        private $dbname = 'php_com_pdo';
        private $user = 'root';
        private $password = '';

        public function connect() {
            try {
                $connection = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->user",
                    "$this->password"
                );

                return $connection;

            } catch (PDOException $e) {
                echo '<p>'.$e->getMessage().'</p>';
            }
        }
    }

?>